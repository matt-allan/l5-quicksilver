<?php
return [
    'Quicksilver\Domain\Delivery' => [
        'type'      => 'entity',
        'table'     => 'deliveries',
        'id'        => [
            'id' => [
                'type'      => 'integer',
                'generator' => [
                    'strategy' => 'auto'
                ]
            ],
        ],
        'embedded'  => [
            'pickup'      => [
                'class'        => 'Quicksilver\Domain\Address',
                'columnPrefix' => 'pickup_'
            ],
            'destination' => [
                'class'        => 'Quicksilver\Domain\Address',
                'columnPrefix' => 'dropoff_'
            ],
        ],
        'fields'    => [
            'priority'  => [
                'type' => 'priority'
            ],
            'signature' => [
                'type' => 'string'
            ],
            'status'    => [
                'type' => 'status'
            ],
        ],
        'manyToOne' => [
            'requester' => [
                'targetEntity' => 'Quicksilver\Domain\Customer',
                'joinColumn'   => [
                    'name'                 => 'requester_id',
                    'referencedColumnName' => 'id'
                ]
            ],
        ],
    ],
    'Quicksilver\Domain\User' => [
        'type' => 'entity',
        'inheritanceType' => 'SINGLE_TABLE',
        'discriminatorColumn' => [
            'name' => 'type',
            'type' => 'string'
        ],
        'discriminatorMap' => [
            'CUSTOMER' => 'Quicksilver\Domain\Customer',
            'COURIER' => 'Quicksilver\Domain\Courier'
        ],
        'id'        => [
            'id' => [
                'type'      => 'integer',
                'generator' => [
                    'strategy' => 'auto'
                ]
            ],
        ],
    ],
    'Quicksilver\Domain\Customer' => [
      'type' => 'entity'
    ],
    'Quicksilver\Domain\Courier' => [
        'type' => 'entity'
    ],
    'Quicksilver\Domain\Address'  => [
        'type'   => 'embeddable',
        'fields' => [
            'name'     => [
                'type' => 'string'
            ],
            'street'   => [
                'type' => 'string'
            ],
            'city'     => [
                'type' => 'string'
            ],
            'state'    => [
                'type' => 'string'
            ],
            'postCode' => [
                'type' => 'string'
            ]
        ]
    ]
];