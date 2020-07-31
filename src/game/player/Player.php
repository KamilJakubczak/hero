<?php

namespace HERO\game\player;

abstract class Player implements iPlayer {

    protected int $health;
    protected int $strength;
    protected int $defence;
    protected int $speed;
    protected int $luck;
    protected string $name;

    public const properties = [
        'health'=>[
            'min'=>0,
            'max'=>100
        ],
        'strength'=>[
            'min'=>0,
            'max'=>100
        ],
        'defence'=>[
            'min'=>0,
            'max'=>100
        ],
        'speed'=>[
            'min'=>0,
            'max'=>100
        ],
        'luck'=>[
            'min'=>0,
            'max'=>100
        ]
    ];

    public function getName(): string {
        return $this->name;
    }
    public function getLuck():int {
        return $this->luck;
    }
    public function getSpeed():int {
        return $this->speed;
    }
    public function getStrength():int {
        return $this->strength;
    }
    public function getDefence():int {
        return $this->defence;
    }
    public function getHealth():int {
        return $this->health;
    }
    public function getDamage(): int {
        return $this->strength;
    }
    public function hit(int $damage): void {
        $this->health -= $damage;
        $this->displayMessage("{$this->name} has received {$damage} damage");
        $this->displayMessage("{$this->name} has left {$this->health}HP");
    }
    
    public function displayStatistics() {
        echo "<h2>{$this->name}</h2>";
        echo "<h3>Statistics:</h3>";
        foreach(static::properties as $name=>$values) {
            echo "      - {$name}: {$this->$name}<br>";
        }
    }
    protected function setProperties($properties) {
        foreach($properties as $property=>$values) {
            $this->$property = rand($values['min'], $values['max']);

        }
    }


    protected function displayMessage(string $message): void {
        echo $message;
        echo '<br>';
    }
    
    /**
     * Genereate players luck in current turn
     * 
     * @access public
     * @static
     * @return int
     */
    public static function generateLuck(): int {
        return rand(1, 100);
    }  
}
