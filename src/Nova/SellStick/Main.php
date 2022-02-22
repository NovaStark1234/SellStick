<?php

namespace Nova\SellStick;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use Nova\SellStick\EventListener;
use Nova\SellStick\SellStickCommand;

class Main extends PluginBase {

	/** 
	* @var Config $sell 
	*/
	public $sell;
  
	public function onEnable() :void {
		$this->saveResource("sell.yml");
		$this->sell = new Config($this->getDataFolder() . "sell.yml", Config::YAML);
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->getServer()->getCommandMap()->register("SellStick", new SellStickCommand($this));
	}

}