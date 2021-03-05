<?php
// created: 2021-02-24 17:05:23
$dictionary["cgl_functionbutton_aos_products"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'cgl_functionbutton_aos_products' => 
    array (
      'lhs_module' => 'cgl_FunctionButton',
      'lhs_table' => 'cgl_functionbutton',
      'lhs_key' => 'id',
      'rhs_module' => 'AOS_Products',
      'rhs_table' => 'aos_products',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'cgl_functionbutton_aos_products_c',
      'join_key_lhs' => 'cgl_functionbutton_aos_productscgl_functionbutton_ida',
      'join_key_rhs' => 'cgl_functionbutton_aos_productsaos_products_idb',
    ),
  ),
  'table' => 'cgl_functionbutton_aos_products_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'cgl_functionbutton_aos_productscgl_functionbutton_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'cgl_functionbutton_aos_productsaos_products_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'cgl_functionbutton_aos_productsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'cgl_functionbutton_aos_products_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'cgl_functionbutton_aos_productscgl_functionbutton_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'cgl_functionbutton_aos_products_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'cgl_functionbutton_aos_productsaos_products_idb',
      ),
    ),
  ),
);