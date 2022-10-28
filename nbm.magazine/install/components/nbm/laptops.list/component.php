<?php

use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\PageNavigation;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */


if (!Loader::includeModule('nbm.magazine')) {
    ShowError("MODULE NOT INSTALLED");
    return false;
}

$listID='nbList';

if ($arParams["FILTER_NAME"] == '' || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"])){
    $arrFilter = [];
} else {
    $arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
    if (!is_array($arrFilter)) {
        $arrFilter = [];
    }
}

$namespase = "Nbm\Magazine\\";
$entity = $namespase.'LaptopTable';

$grid_options = new GridOptions($listID);
$sort = $grid_options->GetSorting(array(
        'sort' => ['ID' => 'ASC'],
        'vars' => ['by' => 'by', 'order' => 'order'],
    )
);

$nav_params = $grid_options->GetNavParams();

$nav = new PageNavigation('request_list');
$nav->allowAllRecords(true)
    ->setPageSize($nav_params['nPageSize'])
    ->initFromUri();

$rsData = $entity::getList(array(
    "select" => array("*", "BRAND", "MODEL", "MODEL.BRAND",),
    "filter" => (is_array($arrFilter) ? $arrFilter : array()),
    "count_total" => true,
    'offset'      => $nav->getOffset(),
    'limit'       => $nav->getLimit(),
    'order'       => $sort['sort'],
));

$countElements = $rsData->getCount();
$nav->setRecordCount($countElements);

$columns = array();
//$columns[] = array('id' => 'ID','name' => Loc::getMessage("C_LAPTOPS_LIST_ID"), 'sort'=> 'ID', 'default' => true,); // зачем покупателю id
$columns[] = array('id' => 'BRAND','name' => Loc::getMessage("C_LAPTOPS_LIST_BRAND"), 'sort'=> 'BRAND.NAME', 'default' => true,);
$columns[] = array('id' => 'MODEL','name' => Loc::getMessage("C_LAPTOPS_LIST_MODEL"), 'sort'=> 'MODEL.NAME', 'default' => true,);

$columns[] = array('id' => 'NAME','name' => Loc::getMessage("C_LAPTOPS_LIST_NAME"), 'sort'=> 'NAME', 'default' => true,);
$columns[] = array('id' => 'YEAR','name' => Loc::getMessage("C_LAPTOPS_LIST_YEAR"), 'sort'=> 'YEAR', 'default' => true,);
$columns[] = array('id' => 'PRICE','name' => Loc::getMessage("C_LAPTOPS_LIST_PRICE"), 'sort'=> 'PRICE', 'default' => true,);

$listElements=array();
while($arElement = $rsData->fetchObject()){
    $hrefBrand = $arParams['SEF_FOLDER'].\CComponentEngine::makePathFromTemplate($arParams['BRAND_URL_TEMPLATE'], array(
            "BRAND" => $arElement->getModel()->getBrand()->getCode(),
    ));
    $hrefModel = $arParams['SEF_FOLDER'].\CComponentEngine::makePathFromTemplate($arParams['MODEL_URL_TEMPLATE'], array(
            "BRAND" => $arElement->getModel()->getBrand()->getCode(),
            "MODEL" => $arElement->getModel()->getCode(),
    ));
    $hrefDetail = $arParams['SEF_FOLDER'].\CComponentEngine::makePathFromTemplate($arParams['DETAIL_URL_TEMPLATE'], array(
            "NOTEBOOK" => $arElement->getCode(),
    ));

    $listElements[] = array(
        "data" => array(
            "ID"=>$arElement->getID(),
            "NAME"=>'<a href="'.$hrefDetail.'">'.$arElement->getName().'</a>',
            "PRICE"=>number_format($arElement->getPrice(), 0, '', ' '),
            "BRAND"=>'<a href="'.$hrefBrand.'">'.$arElement->getModel()->getBrand()->getName().'</a>',
            "MODEL"=>'<a href="'.$hrefModel.'">'.$arElement->getModel()->getName().'</a>',
            "YEAR"=>$arElement->getYear(),
        ),
    );
}


$arResult["list"]    = $listElements;
$arResult["list_id"] = $listID;
$arResult["columns"] = $columns;
$arResult["nav"]     = $nav;


$this->includeComponentTemplate();

