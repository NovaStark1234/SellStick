<?php

namespace Nova\SellStick;

use pocketmine\player\Player;

use pocketmine\block\Chest;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

use Nova\SellStick\Main;

use Nova\SellStick\libs\YTBJero\LibEconomy\Economy;

class EventListener implements Listener {
  
	/**
	* @var Main $main
	*/
	private $main;
  
	public function __construct(Main $main) {
		$this->main = $main;
	}
  
	public function onInteract(PlayerInteractEvent $event) {
		$player = $event->getPlayer();
		$item = $event->getItem();
		$block = $event->getBlock();
		if($item->getCustomName() === $this->main->sell->get("sellstickname")) {
			if($block instanceof Chest) {
				//$this->main->getLogger()->info($block->getFullId());
				$this->sellItem($player, $block);
			} else {
				$player->sendMessage("§cPlease only click on chests to sell items!");
			}
		}
	}
	
	protected function sellItem(Player $player, $block) :void {
		$tile = $block->getPosition()->getWorld()->getTile($block->getPosition());
		$items = $tile->getInventory()->getContents();
		$all = [];
		foreach($items as $slot => $item) {
			foreach($this->main->sell->get("sell") as $sell) {
				$data = explode(":", $sell);
				$data_name = strtolower(str_replace(' ', '_', $data[0]));
				$name_item = strtolower(str_replace(' ', '_', $item->getVanillaName()));
				if($name_item == $data_name) {
					Economy::addMoney($player, $data[1]*$item->getCount());
					$all[] = ((int)$data[1])*$item->getCount();
					$tile->getInventory()->removeItem($item);
				}
			}
		}
		if(count($all) > 0) {
			$player->sendMessage("§aYou sold all the items in the chest and got: §e" . array_sum($all) . "$");
		} else {
			$player->sendMessage("§cThere are no items in the chest to sell!");
		}
	}

}
