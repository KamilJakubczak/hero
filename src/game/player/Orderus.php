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
    
    /**
     * __construct
     *
     * @param  array $properties
     * @return void
     */
    public function __construct(array $properties=null) {
        $this->name = self::name;
        if(is_null($properties)){
            $properties = self::properties;
        }
        $this->setProperties($properties);
    }
        
    /**
     * Return if skill can be used at current turn
     *
     * @param  int $luck
     * @param  int $chance
     * @return void
     */
    private function isSkillUsable(int $luck, int $chance) {
        if($luck <= $chance) {
            return true;
        } else {
            return false;
        }
    }

        
    /**
     * Calculate and return damage taken damage
     *
     * @return int
     */
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
        
    /**
     * Calculate and return given damage
     *
     * @param  mixed $damage
     * @return float
     */
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
        
    /**
     * Return rapid strike extra damage
     *
     * @return int
     */
    private function rapidStrike(): int {
           
        return $this->strength;
    }
        
    /**
     * Return decreased damage by magic shield skill
     *
     * @param  mixed $damage
     * @return float
     */
    private function magicShield(int $damage): float {
        if($damage > 0) {
            return $damage/2;
        } else {
            return $damage;
        }
    }
    
    /**
     * Display who used what kind of skill
     *
     * @param  string $skillName
     * @return void
     */
    private function displaySkill(string $skillName): void {
        echo "{$this->name} has used {$skillName}<br>";
    }
}

