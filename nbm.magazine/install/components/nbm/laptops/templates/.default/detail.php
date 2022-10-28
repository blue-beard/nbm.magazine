<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$APPLICATION->AddChainItem(Loc::getMessage("T_LAPTOPS_DETAIL_BRAND"), $arResult["FOLDER"]);

$ElementID = $APPLICATION->IncludeComponent("nbm:laptops.detail", "",
  array(
    "ELEMENT_CODE" => $arResult["VARIABLES"]["NOTEBOOK"],
    "ENTITY_NAME"  => $arParams["ENTITY_NAME_LAPTOP"],
    "SEF_FOLDER"=>$arParams["SEF_FOLDER"],
  ),
  $component
);
