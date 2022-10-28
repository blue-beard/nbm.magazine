<?
use Bitrix\Main\Loader;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arCurrentValues */

if (!Loader::includeModule('nbm.magazine')) {
    ShowError("MODULE NOT INSTALLED");
    return false;
}

$arComponentParameters = array(
  "GROUPS"     => array(
  ),
  "PARAMETERS" => array(
      "FILTER_NAME"   => array(
          "PARENT"  => "BASE",
          "NAME"    => GetMessage("P_LAPTOP_LIST_FILTER"),
          "TYPE"    => "STRING",
          "DEFAULT" => "",
      ),
      "SEF_FOLDER"   => array(
          "PARENT"  => "BASE",
          "NAME"    => GetMessage("P_LAPTOP_LIST_SEF_FOLDER"),
          "TYPE"    => "STRING",
          "DEFAULT" => "",
      ),
      "BRAND_URL_TEMPLATE"   => array(
          "PARENT"  => "BASE",
          "NAME"    => GetMessage("P_LAPTOP_LIST_BRAND_URL_TEMPLATE"),
          "TYPE"    => "STRING",
          "DEFAULT" => "",
      ),
      "MODEL_URL_TEMPLATE"   => array(
          "PARENT"  => "BASE",
          "NAME"    => GetMessage("P_LAPTOP_LIST_MODEL_URL_TEMPLATE"),
          "TYPE"    => "STRING",
          "DEFAULT" => "",
      ),
      "DETAIL_URL_TEMPLATE"   => array(
          "PARENT"  => "BASE",
          "NAME"    => GetMessage("P_LAPTOP_LIST_DETAIL_URL_TEMPLATE"),
          "TYPE"    => "STRING",
          "DEFAULT" => "",
      ),
  ),
);
