<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arCurrentValues */


$arComponentParameters = [
  "GROUPS"     => [
  ],
  "PARAMETERS" => [
      "ELEMENT_CODE" => [
          "PARENT"  => "BASE",
          "NAME"    => GetMessage("P_LAPTOP_DETAIL_ELEMENT_CODE"),
          "TYPE"    => "STRING",
          "DEFAULT" => "",
      ],
      "ENTITY_NAME" => [
          "PARENT"  => "BASE",
          "NAME"    => GetMessage("P_LAPTOP_DETAIL_ENTITY_NAME"),
          "TYPE"    => "STRING",
          "DEFAULT" => "",
      ],
      "SEF_FOLDER"   => array(
          "PARENT"  => "BASE",
          "NAME"    => GetMessage("P_LAPTOP_LIST_SEF_FOLDER"),
          "TYPE"    => "STRING",
          "DEFAULT" => "",
      ),

  ],
];