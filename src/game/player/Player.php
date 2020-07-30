<?php

namespace HERO\game\player;

class Player implements iPlayer {

    private int $health;
    private int $strength;
    private int $defence;
    private int $speed;
    private int $luck;

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

    public function __construct() {
        $this->setProperties();
    }
    public function getLuck():int {
        return $this->luck;
    }
    public function getSpeed():int {
        return $this->speed;
    }
    public function rapidStrike() {

    }
    public function magicShield() {

    }
    private function setProperties() {//check self and other propertioes
        foreach(static::properties as $property=>$values) {
            $this->$property = rand($values['min'], $values['max']);

        }
    }
}
