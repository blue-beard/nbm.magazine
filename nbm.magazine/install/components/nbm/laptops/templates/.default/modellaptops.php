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


global $arrFilter;

$APPLICATION->SetTitle($arResult["VARIABLES"]["BRAND"]." ".$arResult["VARIABLES"]["MODEL"]);

$APPLICATION->AddChainItem(Loc::getMessage("T_LAPTOPS_MODELLAPTOPS_BRAND"), $arResult["FOLDER"]);
$APPLICATION->AddChainItem( $arResult["VARIABLES"]["BRAND"],  $arResult["FOLDER"].$arResult["VARIABLES"]["BRAND"]."/");
$APPLICATION->AddChainItem( $arResult["VARIABLES"]["MODEL"],
    $arResult["FOLDER"].$arResult["VARIABLES"]["BRAND"]."/" .$arResult["VARIABLES"]["MODEL"]."/"
);

$arrFilter = array("MODEL.CODE" => $arResult["VARIABLES"]["MODEL"]);

$APPLICATION->IncludeComponent(
  "nbm:laptops.list",
  "",
  array(
      "SEF_FOLDER"=>$arParams["SEF_FOLDER"],
      "BRAND_URL_TEMPLATE"=>$arResult['URL_TEMPLATES']['models'],
      "MODEL_URL_TEMPLATE"=>$arResult['URL_TEMPLATES']['modellaptops'],
      "DETAIL_URL_TEMPLATE"=>$arResult['URL_TEMPLATES']['detail'],
      "FILTER_NAME" => "arrFilter",
  ),
  $component
);
