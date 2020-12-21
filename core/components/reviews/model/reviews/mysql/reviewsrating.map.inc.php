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
    'active' => NULL,
    'menuindex' => 60,
    'createdon' => NULL,
    'editedon' => NULL,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '11',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'active' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'menuindex' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 60,
    ),
    'createdon' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'attributes' => 'ON UPDATE CURRENT_TIMESTAMP',
      'null' => true,
      'default' => NULL,
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
