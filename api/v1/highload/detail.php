<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$data = $request->getQueryList()->toArray();

$APPLICATION->IncludeComponent(
    'bitrix:highloadblock.view',
    '',
    [
        'BLOCK_ID' => 17,
        'ROW_ID' => $_REQUEST['ROW_ID'],
        'LIST_URL' => 'list.php?IBLOCK_ID=#IBLOCK_ID#'
    ]
);