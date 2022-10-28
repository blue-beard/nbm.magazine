<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;

/** @var array $arCurrentValues */

if (!Loader::includeModule('nbm.magazine')) {
    return false;
}

$namespase   = "Nbm\Magazine\\";
$entityBrand = $namespase.($arCurrentValues["ENTITY_NAME_BRAND"]
    ? $arCurrentValues["ENTITY_NAME_BRAND"] : "BrandTable");

if (!class_exists($entityBrand)) {
    $arPropertyBrand = [];
} else {
    $arMapEntity     = $entityBrand::getMap();
    $arPropertyBrand = [];
    foreach ($arMapEntity as $colomn) {
        if ($colomn->getTypeMask()
            == Bitrix\Main\ORM\Fields\FieldTypeMask::SCALAR
        ) {
            $arPropertyBrand[$colomn->getName()] = GetMessage(
              "P_LAPTOP_".$colomn->getName()
            );
        }
    }
}

$entityModel = $namespase.($arCurrentValues["ENTITY_NAME_MODEL"]
    ? $arCurrentValues["ENTITY_NAME_MODEL"] : "ModelTable");

if (!class_exists($entityModel)) {
    $arPropertyModel = [];
} else {
    $arMapEntity     = $entityModel::getMap();
    $arPropertyModel = [];
    foreach ($arMapEntity as $colomn) {
        if ($colomn->getTypeMask()
            == Bitrix\Main\ORM\Fields\FieldTypeMask::SCALAR
        ) {
            $arPropertyModel[$colomn->getName()] = GetMessage(
              "P_LAPTOP_".$colomn->getName()
            );
        }
    }
}
$entityLaptop = $namespase.($arCurrentValues["ENTITY_NAME_LAPTOP"]
    ? $arCurrentValues["ENTITY_NAME_LAPTOP"] : "LaptopTable");

if (!class_exists($entityLaptop)) {
    $arPropertyLaptop = [];
} else {
    $arMapEntity      = $entityLaptop::getMap();
    $arPropertyLaptop = [];
    foreach ($arMapEntity as $colomn) {
        if ($colomn->getTypeMask()
            == Bitrix\Main\ORM\Fields\FieldTypeMask::SCALAR
        ) {
            $arPropertyLaptop[$colomn->getName()] = GetMessage(
              "P_LAPTOP_".$colomn->getName()
            );
        }
    }
}

$arComponentParameters = [
  "GROUPS"     => [
    "LIST_BRANDS_SETTINGS"  => [
      "NAME" => GetMessage("P_LAPTOPS_LIST_BRANDS_SETTINGS"),
    ],
    "LIST_MODELS_SETTINGS"  => [
      "NAME" => GetMessage("P_LAPTOPS_LIST_MODELS_SETTINGS"),
    ],
    "LIST_LAPTOPS_SETTINGS" => [
      "NAME" => GetMessage("P_LAPTOPS_LIST_LAPTOPS_SETTINGS"),
    ],
    "DETAIL_SETTINGS"       => [
      "NAME" => GetMessage("P_LAPTOPS_DETAIL_SETTINGS"),
    ],
  ],
  "PARAMETERS" => [
    "SEF_MODE"             => [

    ],
    "ENTITY_NAME_BRAND"    => [
      "PARENT"  => "LIST_BRANDS_SETTINGS",
      "NAME"    => GetMessage("P_LAPTOP_LIST_BRAND_ENTITY_NAME"),
      "TYPE"    => "STRING",
      "DEFAULT" => "BrandTable",
      "REFRESH" => "Y",
    ],
    "ENTITY_NAME_MODEL"    => [
      "PARENT"  => "LIST_MODELS_SETTINGS",
      "NAME"    => GetMessage("P_LAPTOP_LIST_MODEL_ENTITY_NAME"),
      "TYPE"    => "STRING",
      "DEFAULT" => "ModelTable",
      "REFRESH" => "Y",
    ],
    "ENTITY_NAME_LAPTOP"   => [
      "PARENT"  => "LIST_LAPTOPS_SETTINGS",
      "NAME"    => GetMessage("P_LAPTOP_LIST_LAPTOP_ENTITY_NAME"),
      "TYPE"    => "STRING",
      "DEFAULT" => "LaptopTable",
      "REFRESH" => "Y",
    ],
    "PROPERTY_CODE_BRAND"  => [
      "PARENT"   => "LIST_BRANDS_SETTINGS",
      "NAME"     => GetMessage("P_LAPTOP_LIST_PROPERTY_CODE_BRAND"),
      "TYPE"     => "LIST",
      "MULTIPLE" => "Y",
      "VALUES"   => $arPropertyBrand,
    ],
    "PROPERTY_CODE_MODEL"  => [
      "PARENT"   => "LIST_MODELS_SETTINGS",
      "NAME"     => GetMessage("P_LAPTOP_LIST_PROPERTY_CODE_MODEL"),
      "TYPE"     => "LIST",
      "MULTIPLE" => "Y",
      "VALUES"   => $arPropertyModel,
    ],
    "PROPERTY_CODE_LAPTOP" => [
      "PARENT"   => "LIST_LAPTOPS_SETTINGS",
      "NAME"     => GetMessage("P_LAPTOP_LIST_PROPERTY_CODE_LAPTOP"),
      "TYPE"     => "LIST",
      "MULTIPLE" => "Y",
      "VALUES"   => $arPropertyLaptop,
    ],
  ],
];
