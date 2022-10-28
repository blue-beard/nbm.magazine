<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentDescription = [
  "NAME"        => GetMessage("D_LAPTOP_DETAIL_NAME"),
  "DESCRIPTION" => GetMessage("D_LAPTOP_DETAIL_DESC"),
  "SORT"        => 30,
  "CACHE_PATH"  => "Y",
  "PATH"        => [
    "ID"    => "content",
    "CHILD" => [
      "ID"    => "laptops",
      "NAME"  => GetMessage("D_LAPTOP_DETAIL_LAPTOPS_DESC"),
      "SORT"  => 10,
      "CHILD" => [
      ],
    ],
  ],
];
