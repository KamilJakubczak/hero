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
    private function isSkillUsable(int $luck, int $chance) {
        if($luck <= $chance) {
            return true;
        } else {
            return false;
        }
    }
    public function getDamage(): int {

        $luck = $this->generateLuck();
        $rapidStrikeChance = static::rapidStrikeChance;
        $damage = $this->strength;
        $useSkill = $this->isSkillUsable($luck, $rapidStrikeChance);

        if($useSkill){
            $damage += $this->rapidStrike();
             $this->displaySkill('rapid strike');
        }
      
        return $damage;
    }
    public function hit(int $damage): float {
        $luck = $this->generateLuck();
        $magicShieldChance = static::magicShieldChance;
        $useSkill = $this->isSkillUsable($luck, $magicShieldChance);

        if($useSkill){
            $damage = $this->magicShield($damage);
            $this->displaySkill('magic shield');
        }
        $this->health -= $damage;
        return $damage;

    }
    private function rapidStrike(): int {
           
        return $this->strength;
    }
    private function magicShield(int $damage): float {
        if($damage > 0) {
            return $damage/2;
        } else {
            return $damage;
        }
    }

    private function displaySkill(string $skillName): void {
        echo "{$this->name} has used {$skillName}<br>";
    }
}

