<?php

namespace elo\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use elo\Coins;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class SeeCoinsCommand extends PluginCommand
{
    private $main;

    public function __construct(Coins $main, $name)
    {
        parent::__construct($name, $main);
        $this->main = $main;
        $this->setPermission("seecoins.command");
    }

    public function execute(CommandSender $sender, $currentAlias, array $args)
    {
        if ($this->testPermission($sender)) {
            if(!isset($args[0])){
                $sender->sendMessage(TF::RED."Usage: /seecoins <name>");
            }
            if(isset($args[0])) {
                $name = $args[0];
                $coins = $this->main->getCoins($name);
                $sender->sendMessage(Coins::prefix.TF::YELLOW.$name." has ".$coins." Coins.");
            }
        }
    }
}
