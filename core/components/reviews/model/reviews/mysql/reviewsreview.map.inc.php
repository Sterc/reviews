<?php
/**
 * @package reviews
 */
$xpdo_meta_map['ReviewsReview']= array (
  'package' => 'reviews',
  'version' => '1.1',
  'table' => 'reviews_review',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'resource_id' => 0,
    'name' => '',
    'email' => '',
    'city' => NULL,
    'content' => NULL,
    'active' => 1,
    'createdon' => NULL,
    'editedon' => NULL,
  ),
  'fieldMeta' => 
  array (
    'resource_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '75',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'email' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'city' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => NULL,
    ),
    'content' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
    ),
    'active' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 1,
    ),
    'createdon' => 
    array (
      'dbtype' => 'timestamp',
      'attributes' => 'ON UPDATE CURRENT_TIMESTAMP',
      'phptype' => 'timestamp',
      'null' => true,
      'default' => NULL,
    ),
    'editedon' => 
    array (
      'dbtype' => 'timestamp',
      'attributes' => 'ON UPDATE CURRENT_TIMESTAMP',
      'phptype' => 'timestamp',
      'null' => true,
      'default' => NULL,
    ),
  ),
  'composites' => 
  array (
    'Rating' => 
    array (
      'class' => 'ReviewsReviewRating',
      'local' => 'id',
      'foreign' => 'review_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'Resource' => 
    array (
      'class' => 'modResource',
      'local' => 'resource_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
