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


$APPLICATION->AddChainItem(Loc::getMessage("T_LAPTOPS_MODELS_BRAND"), $arResult["FOLDER"]);
$APPLICATION->AddChainItem( $arResult["VARIABLES"]["BRAND"],  $arResult["FOLDER"].$arResult["VARIABLES"]["BRAND"]."/");

$APPLICATION->SetTitle($arResult["VARIABLES"]["BRAND"]);

global $arrFilter;
$arrFilter = array("BRAND.CODE" => $arResult["VARIABLES"]["BRAND"]);

$APPLICATION->IncludeComponent("nbm:laptops.list", "",
  array(
      "SEF_FOLDER"=>$arParams["SEF_FOLDER"],
      "BRAND_URL_TEMPLATE"=>$arResult['URL_TEMPLATES']['models'],
      "MODEL_URL_TEMPLATE"=>$arResult['URL_TEMPLATES']['modellaptops'],
      "DETAIL_URL_TEMPLATE"=>$arResult['URL_TEMPLATES']['detail'],
      "FILTER_NAME" => "arrFilter",
  ),
  $component
);
