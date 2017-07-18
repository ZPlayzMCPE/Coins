<?php

namespace elo\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use elo\Bal;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class SeeBalCommand extends PluginCommand
{
    private $main;

    public function __construct(Coins $main, $name)
    {
        parent::__construct($name, $main);
        $this->main = $main;
        $this->setPermission("seebal.command");
    }

    public function execute(CommandSender $sender, $currentAlias, array $args)
    {
        if ($this->testPermission($sender)) {
            if(!isset($args[0])){
                $sender->sendMessage(TF::RED."Usage: /seebal <name>");
            }
            if(isset($args[0])) {
                $name = $args[0];
                $coins = $this->main->getBal($name);
                $sender->sendMessage(Balance::prefix.TF::YELLOW.$name." has ".$money." Balance.");
            }
        }
    }
}
