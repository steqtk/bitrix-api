<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
\Bitrix\Main\Loader::includeModule('highloadblock');

$hlbl = 17; // ID нашего highloadblock блока
$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($hlbl)->fetch();

$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$data = $request->getPostList()->toArray();

if (isset($data['UF_TEXT']) && isset($data['UF_ACTIVE'])) {
// Массив полей для добавления
    $data = [
        'UF_TEXT' => $data['UF_TEXT'],
        'UF_ACTIVE' => $data['UF_ACTIVE'],
    ];

    if ($el = $entity_data_class::add($data)) {
        echo 'New ID: ' . $el->getId();
    } else {
        echo 'Error: ' . $el->getErrors();
    }
} else {
    echo 'недостаточно данных';
}
