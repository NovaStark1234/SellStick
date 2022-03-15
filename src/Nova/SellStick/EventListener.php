<?php

namespace Nova\SellStick;

use pocketmine\player\Player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

use Nova\SellStick\Main;

use YTBJero\LibEconomy\Economy;

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
			if($block->getId() == 54) {
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
				$id = explode(",", $sell);
				$cost = explode(":", $sell);
				if($item->getId() === ((int)$id[0]) and $item->getMeta() === ((int)$id[1])) {
					Economy::addMoney($player, $cost[1]*$item->getCount());
					#BedrockEconomyAPI::getInstance()->addToPlayerBalance($player->getName(), ((int)$cost[1])*$item->getCount());
					$all[] = ((int)$cost[1])*$item->getCount();
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
