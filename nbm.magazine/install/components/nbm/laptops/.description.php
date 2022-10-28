<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentDescription = [
  "NAME"        => GetMessage("D_LAPTOPS_NAME"),
  "DESCRIPTION" => GetMessage("D_LAPTOPS_DESCRIPTION"),
    //"ICON" => "/images/news_all.gif",
  "COMPLEX"     => "Y",
  "PATH"        => [
    "ID"    => "content",
    "CHILD" => [
      "ID"    => "laptops",
      "NAME"  => GetMessage("D_LAPTOPS_DESC"),
      "SORT"  => 10,
      "CHILD" => [
      ],
    ],
  ],
];
