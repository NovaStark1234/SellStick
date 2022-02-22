<?php

namespace Nova\SellStick;

use pocketmine\player\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\item\ItemFactory;

use Nova\SellStick\Main;

class SellStickCommand extends Command implements PluginOwned {

	/** 
	* @var Main $main
	*/
	private $main;
	  
	public function __construct(Main $main) {
		$this->main = $main;
		parent::__construct("sellstick", "Give SellStick", null, []);
		$this->setPermission("sellstick.command.use");
	}
	  
	public function execute(CommandSender $player, String $label, array $args) :bool {
		if($player instanceof Player) {
			if($this->testPermission($player)) {
				$item = explode(":", $this->main->sell->get("sellstickitem"));
				if(isset($args[0])) {
					$stick = ItemFactory::getInstance()->get($item[0], $item[1], $args[0]);
				} else $stick = ItemFactory::getInstance()->get($item[0], $item[1], 1);
				$stick->setCustomName($this->main->sell->get("sellstickname"));
				$stick->setLore([$this->main->sell->get("sellsticklore")]);
				if($player->getInventory()->canAddItem($stick)) {
					$player->getInventory()->addItem($stick);
					$player->sendMessage("§aYou have received SellStick!");
				} else {
					$player->sendMessage("§cYour inventory is full and cannot add SellStick");
				}
			} else {
				$player->sendMessage("§cYou don't have permission to use SellStick command!");
			}
		}
		return true;
	}
	  
	public function getOwningPlugin() :Plugin {
		return $this->main;
	}

}
