<?php
/**
 * @package reviews
 */
$xpdo_meta_map['ReviewsRating']= array (
  'package' => 'reviews',
  'version' => '1.1',
  'table' => 'reviews_rating',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'name' => '',
    'active' => 1,
    'menuindex' => 0,
    'createdon' => 'CURRENT TIMESTAMP',
    'editedon' => NULL,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '75',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
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
    'menuindex' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'createdon' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'null' => true,
      'default' => 'CURRENT TIMESTAMP',
    ),
    'editedon' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'attributes' => 'ON UPDATE CURRENT_TIMESTAMP',
      'null' => true,
      'default' => NULL,
    ),
  ),
  'composites' => 
  array (
    'Review' => 
    array (
      'class' => 'ReviewsReviewRating',
      'local' => 'id',
      'foreign' => 'rating_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
