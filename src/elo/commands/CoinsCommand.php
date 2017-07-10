<?php

namespace elo\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use elo\Coins;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class CoinsCommand extends PluginCommand {

 private $main;

	public function __construct(Coins $main, $name) {
		parent::__construct($name, $main);
		$this->main = $main;
		$this->setPermission("coins.command");
	}

	public function execute(CommandSender $sender, $currentAlias, array $args) {
          if($this->testPermission($sender)){
             if($sender instanceof Player){
             $coins = $this->main->getcoins($sender->getName());
              $sender->sendMessage(Coins::prefix.TF::YELLOW."You have ".TF::BLUE.$coins.TF::YELLOW." Coins.");
       }else{
       $sender->sendMessage(TF::RED."You must run this command in game!");
    }
  }
 }
}

