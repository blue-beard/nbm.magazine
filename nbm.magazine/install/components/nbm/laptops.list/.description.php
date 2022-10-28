<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentDescription = [
  "NAME"        => GetMessage("D_LAPTOP_LIST_LIST_NAME"),
  "DESCRIPTION" => GetMessage("D_LAPTOP_LIST_LIST_DESCRIPTION"),
  "ICON"        => "/images/news_list.gif",
  "SORT"        => 20,
  "CACHE_PATH"  => "Y",
  "PATH"        => [
    "ID"    => "content",
    "CHILD" => [
      "ID"    => "laptops",
      "NAME"  => GetMessage("D_LAPTOP_LIST_LAPTOPS_DESC"),
      "SORT"  => 10,
      "CHILD" => [
      ],
    ],
  ],
];
