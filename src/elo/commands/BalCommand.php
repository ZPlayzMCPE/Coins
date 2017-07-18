<?php

namespace elo\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use elo\Bal;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class BalCommand extends PluginCommand {

 private $main;

	public function __construct(Coins $main, $name) {
		parent::__construct($name, $main);
		$this->main = $main;
		$this->setPermission("bal.command");
	}

	public function execute(CommandSender $sender, $currentAlias, array $args) {
          if($this->testPermission($sender)){
             if($sender instanceof Player){
             $coins = $this->main->getcoins($sender->getName());
              $sender->sendMessage(Coins::prefix.TF::YELLOW."You have ".TF::BLUE.$money.TF::YELLOW." Balance.");
       }else{
       $sender->sendMessage(TF::RED."You must run this command in game, silly!");
    }
  }
 }
}

