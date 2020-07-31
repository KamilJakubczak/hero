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
    
    /**
     * getName
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }    
    /**
     * getLuck
     *
     * @return int
     */
    public function getLuck():int {
        return $this->luck;
    }    
    /**
     * getSpeed
     *
     * @return int
     */
    public function getSpeed():int {
        return $this->speed;
    }    
    /**
     * getStrength
     *
     * @return int
     */
    public function getStrength():int {
        return $this->strength;
    }    
    /**
     * getDefence
     *
     * @return int
     */
    public function getDefence():int {
        return $this->defence;
    }    
    /**
     * getHealth
     *
     * @return int
     */
    public function getHealth():float {
        return $this->health;
    }    
    /**
     * getDamage
     *
     * @return int
     */
    public function getDamage(): int {
        return $this->strength;
    }    
    /**
     * hit
     *
     * @param  mixed $damage
     * @return int
     */
    public function hit(int $damage): float {
        $this->health -= $damage;
        return $damage;
    }
        
    /**
     * displayStatistics
     *
     * @return void
     */
    public function displayStatistics():void {
        echo "<h2>{$this->name}</h2>";
        echo "<h3>Statistics:</h3>";
        foreach(static::properties as $name=>$values) {
            echo "      - {$name}: {$this->$name}<br>";
        }
    }    

    /**
     * setProperties
     *
     * @param  array $properties
     * @return void
     */
    protected function setProperties(array $properties):void {
        foreach($properties as $property=>$values) {
            $this->$property = rand($values['min'], $values['max']);

        }
    }
    
    /**
     * displayMessage
     *
     * @param  mixed $message
     * @return void
     */
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
