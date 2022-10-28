<?php
use Bitrix\Main\Loader;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */


if (!Loader::includeModule('nbm.magazine')) {
    ShowError("MODULE NOT INSTALLED");
    return false;
}

$namespase = "Nbm\Magazine\\";
$entity = $namespase.$arParams["ENTITY_NAME"];


$rsData = $entity::getList(array(
    "select" => array("*", "OPTIONS", "MODEL", "MODEL.BRAND",),
    "filter" => array("CODE" => $arParams["ELEMENT_CODE"]),
    "order" => array('ID' => 'DESC'),
));

if (!$arElement = $rsData->fetchObject()) {
    if (!defined("ERROR_404")) {
        define("ERROR_404", "Y");
    }

    CHTTP::setStatus("404 Not Found");

    if ($APPLICATION->RestartWorkarea()) {
        $APPLICATION->SetTitle("404 звиняйте хлопцы бананьев нема");
        die();
    }
}

$arResult["ITEM"]=array(
    "NAME"=>$arElement->getName(),
    "PRICE"=>number_format($arElement->getPrice(), 0, '', ' '),
    "BRAND"=>$arElement->getModel()->getBrand()->getName(),
    "MODEL"=>$arElement->getModel()->getName(),
    "YEAR"=>$arElement->getYear(),
);
foreach ($arElement->getOptions() as $option) {
    $arResult["ITEM"]["OPTIONS"][]=$option->getName();
}

$APPLICATION->AddChainItem(
    $arElement->getModel()->getBrand()->getCode(),
    $arParams["SEF_FOLDER"].$arElement->getModel()->getBrand()->getCode()."/"
);
$APPLICATION->AddChainItem(
    $arElement->getModel()->getName(),
    $arParams["SEF_FOLDER"].$arElement->getModel()->getBrand()->getCode()."/".$arElement->getModel()->getCode()."/"
);

$APPLICATION->SetTitle($arElement->getName());

$arResult["ELEMENT"] = $arElement;

$this->includeComponentTemplate();
