<?php
$arUrlRewrite=array (
   0 => 
  array (
    'CONDITION' => '#^/api/v1/highload/([0-9]+)#',
    'RULE' => 'ROW_ID=$1',
    'ID' => '',
    'PATH' => '/api/v1/highload/detail.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/api/v1/iblock/([0-9]+)#',
    'RULE' => 'ELEMENT_ID=$1',
    'ID' => '',
    'PATH' => '/api/v1/iblock/detail.php',
    'SORT' => 100,
  ),
);
