<?php

namespace HERO\game;

use HERO\game\player as player;

class Game {

    private object $attacker;
    private object $defeneder;

    private object $orderus;
    private object $wildBeast;

    public function __construct() {
        $this->orderus = new player\Orderus();
        $this->wildBeast = new player\WildBeast();

    }

    public function setFirst(): void {
        $this->compareSpeed($this->orderus, $this->wildBeast);
    }

    private function compareSpeed(
        object $player1, 
        object $player2): void 
    {
        if($player1->getSpeed() > $player2->getSpeed()) {
            $this->setAttacker($player1);
        } elseif($player1->getSpeed() < $player2->getSpeed()) {
            $this->setAttacker($player2);
        } else {
            $this->compareLuck($player1, $player2);
        }
    }
    private function compareLuck(
        object $player1, 
        object $player2): void 
    {
        if($player1->getLuck() > $player2->getLuck())
        {
            $this->setAttacker($player1);
        } 
        elseif($player1->getLuck() < $player2->getLuck())
        {
            $this->setAttacker($player2);
        } 
        else 
        {
            $this->setAttacker($player1);
        }
    }
    private function setAttacker(object $player): void {
        $this->attacker = $player;
        var_dump($this->attacker);
    }
}