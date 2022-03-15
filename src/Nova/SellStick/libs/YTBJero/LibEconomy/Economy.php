<?php

#Thank For Eric!

declare(strict_types=1);

namespace Nova\SellStick\libs\YTBJero\LibEconomy;

use pocketmine\Server as PMServer;
use pocketmine\player\Player;

final class Economy {

	private const ECONOMYAPI = "EconomyAPI";
	
	private const BEDROCKECONOMYAPI = "BedrockEconomyAPI";

	/**
	 * @return array
	 */
	private static function getEconomy() {
		$api = PMServer::getInstance()->getPluginManager()->getPlugin("EconomyAPI");
		if($api !== null){
			return [self::ECONOMYAPI, $api];
		} else{
			$api = PMServer::getInstance()->getPluginManager()->getPlugin("BedrockEconomy");
			if($api !== null){
				return [self::BEDROCKECONOMYAPI, $api];
			}
		}
        	throw new \Exception("You not have economy plugin.");
	}
	/**
	 * @param  Player $player
	 */
	public static function myMoney(Player $player){
		if(self::getEconomy()[0] === self::ECONOMYAPI){
			return self::getEconomy()[1]->myMoney($player);
		} elseif(self::getEconomy()[0] === self::BEDROCKECONOMYAPI){
			return self::getEconomy()[1]->getAPI()->getPlayerBalance($player->getName());
		}
	}
	/**
	 * @param Player $player
	 * @param int $amount
	 */
	public static function addMoney(Player $player, $amount){
		if(self::getEconomy()[0] === self::ECONOMYAPI){
			self::getEconomy()[1]->addMoney($player, $amount);
		} elseif(self::getEconomy()[0] === self::BEDROCKECONOMYAPI){
			return self::getEconomy()[1]->getAPI()->addToPlayerBalance($player->getName(), (int) ceil($amount));
		}
	}
	/**
	 * @param  Player $player
	 * @param  int $amount
	 */
	public static function reduceMoney(Player $player, $amount){
		if(self::getEconomy()[0] === self::ECONOMYAPI){
			self::getEconomy()[1]->reduceMoney($player, $amount);
		} elseif(self::getEconomy()[0] === self::BEDROCKECONOMYAPI){
			return self::getEconomy()[1]->getAPI()->subtractFromPlayerBalance($player->getName(), (int) ceil($amount));
		}
	}
}
