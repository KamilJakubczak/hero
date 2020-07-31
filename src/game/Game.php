<?php

namespace HERO\game;

use HERO\game\player as player;

class Game {

    private const maxRound = 20;

    private object $attacker;
    private object $defender;

    private object $orderus;
    private object $enemy;

    private int $roundCount = 1;
    private object $winner;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() 
    {
        $this->orderus = new player\Orderus();
        $this->enemy = new player\WildBeast();
        $this->setFirst();
    }    

    /**
     * setOrderus
     *
     * @param  object $orderus
     * @return void
     */
    public function setOrderus(object $orderus): void {
        $this->orderus = $orderus;
    }    

    /**
     * getAttacker
     *
     * @return object
     */
    public function getAttacker(): object {
        return $this->attacker;
    }    

    /**
     * setEnemy
     *
     * @param  object $enemy
     * @return void
     */
    public function setEnemy(object $enemy): void {
        $this->enemy = $enemy;
    }
    
    /**
     * getDefender
     *
     * @return object
     */
    public function getDefender(): object {
        return $this->defender;
    }
    
    /**
     * displayFirst
     *
     * @return void
     */
    public function displayFirst(): void {
         $this->displayMessage("{$this->attacker->getName()} will start");
    }
    
    /**
     * Check if game is finished
     *
     * @return bool
     */
    public function isFinished(): bool {
        if(
            $this->isWinner()
            || $this->roundCount > static::maxRound
        ) {
            return true;
        } 
        else 
        {
            return false;
        }
    }    

    /**
     * setWinner
     *
     * @return void
     */
    public function setWinner(): void {
        if($this->attacker->getHealth() > 0) {
            $this->winner = $this->attacker;
        } else {
            $this->winner = $this->defender;
        }
    }    
    /**
     * getWinner
     *
     * @return object
     */
    public function getWinner(): object {
        return $this->winner;
    }    

    /**
     * displayMessage
     *
     * @param  string $message
     * @return void
     */
    public function displayMessage(string $message): void {
        echo $message;
    }    

    /**
     * displayResult
     *
     * @return void
     */
    public function displayResult(): void {
        if($this->isWinner()) {
            $this->displayMessage("<h2>{$this->winner->getName()} has won.</h2>");
        } else {
            $this->displayMessage("<h2>There is no winner, the battle has riched 20 rounds.</h2>");
        }
    }
    
    /**
     * displayStatistics
     *
     * @return void
     */
    public function displayStatistics(): void{
        $this->orderus->displayStatistics();
        $this->enemy->displayStatistics();
    }
    
    /**
     * displayRound
     *
     * @return void
     */
    public function displayRound(): void {
        echo "<h3>Round: {$this->roundCount}</h3>";
    }
    
    /**
     * displayAction
     *
     * @return void
     */
    public function displayAction(): void {
        echo "{$this->attacker->getName()} attacks<br>";
    }
        
    /**
     * attact
     *
     * @return void
     */
    public function attact(): void {

        $luck = $this->defender->getLuck();
        $generatedLuck = $this->defender::generateLuck();
        $defenderName = $this->defender->getName();
        $defenderHealth = $this->defender->getHealth();
        if(!$this->miss($luck, $generatedLuck)) {
            $damage = $this->damage($this->attacker,$this->defender);
            $damageTaken = $this->defender->hit($damage);
            $this->displayMessage("{$defenderName} has received {$damageTaken} damage");
            $this->displayMessage("{$defenderName} has left {$defenderHealth}HP");
        } else {
            $this->displayMessage('miss');
        }
        
        $this->changeAttacker();
        $this->updateRoundCount();
        
    }    
    /**
     * Check if player misses the attack if yes then return true
     * if not false
     *
     * @param  mixed $defender
     * @return bool
     */
    private function miss(int $luck, int $generatedLuck): bool {
       $gotLucky = $this->checkLuck($luck, $generatedLuck);
        if($gotLucky) {
            return true;
        } else {
            return false;
        }
    }    
    /**
     * Check if player is lucky at current action
     *
     * @param  int $luck
     * @param  int $generatedLuck
     * @return bool
     */
    private function checkLuck(int $luck, int $generatedLuck): bool {
        if($generatedLuck <= $luck) {
            return true;
        } else {
            return false;
        }

    }
    private function damage(object $attacker, object $defender): int {
        $attack = $attacker->getDamage();
        $defence = $defender->getDefence();
         
        $damage = $attack - $defence;
        if($damage>0) {
            return $damage;
        } else {
            return 0;
        }
    }

    /**
     * Set first attacker
     *
     * @return void
     */
    public function setFirst(): void 
    {
        $this->compareSpeed($this->orderus, $this->enemy);
    }

    
    /**
     * compareSpeed
     *
     * @return void
     */
    private function compareSpeed(
        object $player1, 
        object $player2): void 
    {
        if($player1->getSpeed() > $player2->getSpeed()) {
            $this->setAttacker($player1);
            $this->setDefender($player2);
        } elseif($player1->getSpeed() < $player2->getSpeed()) {
            $this->setAttacker($player2);
            $this->setDefender($player1);
        } else {
            $this->compareLuck($player1, $player2);
        }
    }
  
    /**
     * compareLuck
     *
     * @return void
     */
    private function compareLuck(
        object $player1, 
        object $player2): void 
    {
        if($player1->getLuck() > $player2->getLuck())
        {
            $this->setAttacker($player1);
            $this->setDefender($player2);
        } 
        elseif($player1->getLuck() < $player2->getLuck())
        {
            $this->setAttacker($player2);
            $this->setDefender($player1);
        } 
        else 
        {
            $this->setAttacker($player1);
            $this->setDefender($player2);
        }
    }

    /**
     * setAttacker
     *
     * @param  object $player
     * @return void
     */
    private function setAttacker(object $player): void 
    {
        $this->attacker = $player;
    }
    
    /**
     * setDefender
     *
     * @param  mixed $plyer
     * @return void
     */
    private function setDefender(object $player): void 
    {
        $this->defender = $player;
    }
    
    /**
     * changeAttacker
     *
     * @return void
     */
    private function changeAttacker(): void {
        $temp = $this->defender;
        $this->defender = $this->attacker;
        $this->attacker = $temp;
    }    
    /**
     * updateRoundCount
     *
     * @return void
     */
    private function updateRoundCount(): void {
        $this->roundCount +=1;
    }    
    public function setRoundCounter(int $count): void {
        $this->roundCount = $count;
    }
    /**
     * isWinner
     *
     * @return bool
     */
    public function isWinner(): bool {
        if(
            $this->attacker->getHealth() <= 0 
            || $this->defender->getHealth() <=0 ) {
                $this->setWinner();
                return true;
            } else {
                return false;
            }
    }

}