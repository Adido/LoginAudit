<?php
/**
 * @package loginaudit
 */
$xpdo_meta_map['auditLog']= array (
  'package' => 'loginaudit',
  'version' => '1.1',
  'table' => 'audit_log',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'user' => 0,
    'actionDate' => '0',
    'action' => 'login',
  ),
  'fieldMeta' => 
  array (
    'user' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'actionDate' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
      'default' => '0',
    ),
    'action' => 
    array (
      'dbtype' => 'enum',
      'phptype' => 'string',
      'precision' => '\'login\',\'logout\'',
      'null' => false,
      'default' => 'login',
    ),
  ),
  'aggregates' => 
  array (
    'User' => 
    array (
      'class' => 'modUser',
      'local' => 'user',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
