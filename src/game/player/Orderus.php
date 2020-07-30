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

    public function __construct() {
        parent::__construct();
    }
}

