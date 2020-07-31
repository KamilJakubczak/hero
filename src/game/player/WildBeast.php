<?php

namespace HERO\game\player;

class WildBeast extends Player {

    public const name = 'Wild Beast';
    public const properties = [
        'health'=>[
            'min'=>60,
            'max'=>90
        ],
        'strength'=>[
            'min'=>60,
            'max'=>90
        ],
        'defence'=>[
            'min'=>40,
            'max'=>60
        ],
        'speed'=>[
            'min'=>20,
            'max'=>60
        ],
        'luck'=>[
            'min'=>25,
            'max'=>40
        ]
    ];
    
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
}

