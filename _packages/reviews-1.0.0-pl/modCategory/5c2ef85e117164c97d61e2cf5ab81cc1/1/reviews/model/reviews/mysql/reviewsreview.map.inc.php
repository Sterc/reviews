<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

$xpdo_meta_map['ReviewsReview'] = [
    'package'       => 'review',
    'version'       => '1.0',
    'table'         => 'reviews_review',
    'extends'       => 'xPDOSimpleObject',
    'fields'        => [
        'id'            => null,
        'resource_id'   => null,
        'rating'        => null,
        'name'          => null,
        'email'         => null,
        'content'       => null,
        'active'        => null,
        'createdon'     => null,
        'editedon'      => null
    ],
    'fieldMeta'     => [
        'id'            => [
            'dbtype'        => 'int',
            'precision'     => '11',
            'phptype'       => 'integer',
            'null'          => false,
            'index'         => 'pk',
            'generated'     => 'native'
        ],
        'resource_id'   => [
            'dbtype'        => 'int',
            'precision'     => '11',
            'phptype'       => 'integer',
            'null'          => false
        ],
        'rating'        => [
            'dbtype'        => 'int',
            'precision'     => '11',
            'phptype'       => 'integer',
            'null'          => false
        ],
        'name'          => [
            'dbtype'        => 'varchar',
            'precision'     => '75',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => ''
        ],
        'email'         => [
            'dbtype'        => 'varchar',
            'precision'     => '255',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => ''
        ],
        'content'       => [
            'dbtype'        => 'text',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => ''
        ],
        'active'        => [
            'dbtype'        => 'int',
            'phptype'       => 'integer',
            'precision'     => '1',
            'null'          => false,
            'default'       => 1
        ],
        'createdon'     => [
            'dbtype'        => 'timestamp',
            'phptype'       => 'timestamp',
            'null'          => false,
            'default'       => '0000-00-00 00:00:00'
        ],
        'editedon'      => [
            'dbtype'        => 'timestamp',
            'phptype'       => 'timestamp',
            'attributes'    => 'ON UPDATE CURRENT_TIMESTAMP',
            'null'          => false,
            'default'       => '0000-00-00 00:00:00'
        ]
    ],
    'indexes'       => [
        'PRIMARY'       => [
            'alias'         => 'PRIMARY',
            'primary'       => true,
            'unique'        => true,
            'columns'       => [
                'id'            => [
                    'collation'     => 'A',
                    'null'          => false
                ]
            ]
        ]
    ],
    'aggregates'    =>  [
        'Resource'      => [
            'local'         => 'resource_id',
            'class'         => 'modResource',
            'foreign'       => 'id',
            'owner'         => 'local',
            'cardinality'   => 'one'
        ]
    ]
];
