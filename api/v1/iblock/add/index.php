<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
\Bitrix\Main\Loader::includeModule('iblock');

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$data = $request->getPostList()->toArray();
$file = $request->getFileList()->toArray();

if (!empty($data) && isset($data['PROPERTY_TEXT']) && isset($data['PROPERTY_IS_TURNED_ON']) && !empty($file)) {

    move_uploaded_file($file['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/upload/pics/' . $file['file']['name']);
    $arPict = CFile::MakeFileArray('/upload/pics/' . $file['file']['name']);
    $fid = CFile::SaveFile($arPict, 'pics');
    unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/pics/' . $file['file']['name']);
    if ((int)$fid > 0) {
        $picture = CFile::MakeFileArray($fid);
    }

    $el = new CIBlockElement;
    $PROP = [];
    $PROP['PROPERTY_TEXT'] = $data['PROPERTY_TEXT'];
    $PROP['PROPERTY_IS_TURNED_ON'] = 139; // ID единственного эл-та справочника PROPERTY_IS_TURNED_ON

    $arLoadProductArray = [
        'IBLOCK_SECTION_ID' => false, // элемент лежит в корне раздела
        'IBLOCK_ID' => 53,
        'PROPERTY_VALUES' => $PROP,
        'NAME' => 'Элемент',
        'ACTIVE' => 'Y',
        'DETAIL_PICTURE' => $picture,
    ];

    if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
        echo 'New ID: ' . $PRODUCT_ID;
    } else {
        echo 'Error: ' . $el->LAST_ERROR;
    }

} else {
    echo 'Недостаточно данных.';
}