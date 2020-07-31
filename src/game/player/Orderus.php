<?php

namespace HERO\game\player;

class Orderus extends Player {

    public const name = 'Orderus';
    public const properties = [
        'health'=>[
            'min'=>70,
            'max'=>100
        ],
        'strength'=>[
            'min'=>70,
            'max'=>80
        ],
        'defence'=>[
            'min'=>45,
            'max'=>55
        ],
        'speed'=>[
            'min'=>40,
            'max'=>50
        ],
        'luck'=>[
            'min'=>10,
            'max'=>30
        ]
    ];
    private const rapidStrikeChance = 10;
    private const magicShieldChance = 20;

    public function __construct($properties=null) {
        $this->name = self::name;
        if(is_null($properties)){
            $properties = self::properties;
        }
        $this->setProperties($properties);
    }
    public function getDamage(): int {

       $damage = $this->strength;
       $damage += $this->rapidStrike();

       return $damage;
    }
    public function hit(int $damage): int {
        $damage = $this->magicShield($damage);
        $this->health -= $damage;
       
        return $damage;

    }
    private function rapidStrike(): int {
        if($this->generateLuck() <= static::rapidStrikeChance) {
            $this->displaySkill('rapid strike');
            return $this->strength;
        } else {
            return 0;
            }
    }
    private function magicShield($damage): int {
        if(
            $damage > 0
            && $this->generateLuck() <= static::magicShieldChance) 
        {
            $this->displaySkill('magic shield');
            return round($damage/2,1);
        } else {
            return $damage;
            }
    }

    private function displaySkill(string $skillName): void {
        echo "{$this->name} has used {$skillName}<br>";
    }
}

