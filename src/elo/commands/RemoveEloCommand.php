<?php

namespace elo\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use elo\Coins;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class RemoveCoinsCommand extends PluginCommand
{
    private $main;

    public function __construct(Coins $main, $name)
    {
        parent::__construct($name, $main);
        $this->main = $main;
        $this->setPermission("removecoins.command");
    }

    public function execute(CommandSender $sender, $currentAlias, array $args)
    {
        if ($this->testPermission($sender)) {
            if(!isset($args[0])){
                $sender->sendMessage(TF::RED."Usage: /removecoins <player> <coins>");
            }

            if(isset($args[0])) {
                $name = $args[0];
                if (isset($args[1])) {
                    $lol = $args[1];
                    $elo = (int)$lol;
                    $this->main->removeCoins($name, $elo);
                }
            }
        }
    }
}
