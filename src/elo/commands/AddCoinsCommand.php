<?php

namespace elo\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use elo\Coins;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class AddCoinsCommand extends PluginCommand {

   private $main;

	public function __construct(Coins $main, $name) {
		parent::__construct($name, $main);
		$this->main = $main;
		$this->setPermission("addcoins.command");
	}

	public function execute(CommandSender $sender, $currentAlias, array $args) {
          if($this->testPermission($sender)){

           if(!isset($args[0])){
             $sender->sendMessage(TF::RED."Usage: /addcoins <player> <coins>");
              }
    
            if(isset($args[0])){
              $name = $args[0];
              if(isset($args[1])){
                 $lol = $args[1];
                  $coins = (int)$lol;
                   $this->main->addCoins($name, $coins);
                    $sender->sendMessage(Coins::prefix.TF::GREEN."Successfully added ".$coins." Coins to Player ".$name);
                }
           }
       }
   }
}
