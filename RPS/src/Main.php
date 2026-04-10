<?php

declare(strict_types=1);

namespace Jqke207\RPS;

use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
class Main extends PluginBase implements Listener{
    private int $random = 0;

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("Rock Paper Scissors Plugin Loaded!");
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        if ($cmd->getName() == "rps") {
        $this->random = rand(1, 3); # 1 = rock           2 = paper             3 = scissors
        $this->rps($sender);
        }
        return true;
    }
        public function rps($player) {
         $form = new SimpleForm(function ($player, $data) {
            $ai = $this->random;
            if ($data === null) {
                return;
            }

            if ($data === 0) {
                # user choose rock
                if ($ai == 1) {
                    $player->sendMessage("Draw! AI Chose Rock!");
                }
                elseif ($ai == 2) {
                    $player->sendMessage("You Lost! AI Chose Paper!");
                }
                else {
                    $player->sendMessage("You Won! AI Chose Scissors!");
                }
            }

            if ($data === 1) {
                # user choose paper
                if ($ai == 1) {
                    $player->sendMessage("You Win! AI Chose Rock");
                }
                elseif ($ai == 2) {
                    $player->sendMessage("Draw! AI Chose Paper");
                }
                else {
                    $player->sendMessage("You Lost! AI Chose Scissors");
                }
            }
            if ($data === 2) {
                # user choose scissors
                if ($ai == 1) {
                    $player->sendMessage("You Lost! AI Chose Rock");
                }
                elseif ($ai == 2) {
                    $player->sendMessage("You Win! AI Chose Paper");
                }
                else {
                    $player->sendMessage("Draw! AI Chose Scissors");
                }
            }
        });

        $form->setTitle("Rock Paper Scissors VS AI");
    
        $form->addButton("Rock");
        $form->addButton("Paper");
        $form->addButton("Scissors");
        $player->sendForm($form);
    }
}
