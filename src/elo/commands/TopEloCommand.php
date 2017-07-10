<?php

namespace elo\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use elo\Coins;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class TopCoinsCommand extends PluginCommand
{
    private $main;

    public function __construct(Coins $main, $name)
    {
        parent::__construct($name, $main);
        $this->main = $main;
        $this->setPermission("topcoins.command");
    }

    public function execute(CommandSender $sender, $currentAlias, array $args)
    {
        if ($this->testPermission($sender)) {
            $this->main->sendTopcoinsTo($sender, 10);
        }
    }
}
