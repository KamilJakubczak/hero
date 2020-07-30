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

    public function __construct() {
        parent::__construct();
    }
}

