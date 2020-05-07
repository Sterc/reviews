<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

$xpdo_meta_map['ReviewsReviewRating'] = [
    'package'       => 'review',
    'version'       => '1.0',
    'table'         => 'reviews_review_rating',
    'extends'       => 'xPDOSimpleObject',
    'fields'        => [
        'id'            => null,
        'review_id'     => null,
        'rating_id'     => null,
        'value'         => null
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
        'review_id'     => [
            'dbtype'        => 'int',
            'precision'     => '11',
            'phptype'       => 'integer',
            'null'          => false
        ],
        'rating_id'     => [
            'dbtype'        => 'int',
            'precision'     => '11',
            'phptype'       => 'integer',
            'null'          => false
        ],
        'value'          => [
            'dbtype'        => 'int',
            'precision'     => '5',
            'phptype'       => 'integer',
            'null'          => false,
            'default'       => 1
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
        'Review'        => [
            'local'         => 'review_id',
            'class'         => 'ReviewsReview',
            'foreign'       => 'id',
            'owner'         => 'local',
            'cardinality'   => 'one'
        ],
        'Rating'        => [
            'local'         => 'rating_id',
            'class'         => 'ReviewsRating',
            'foreign'       => 'id',
            'owner'         => 'local',
            'cardinality'   => 'one'
        ]
    ]
];
