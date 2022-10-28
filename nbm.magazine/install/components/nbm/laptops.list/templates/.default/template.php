<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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


$APPLICATION->IncludeComponent(
  'bitrix:main.ui.grid',
  '',
  [
    'GRID_ID'                   => $arResult["list_id"],
    'COLUMNS'                   => $arResult["columns"],
    'ROWS'                      => $arResult["list"],
    'SHOW_ROW_CHECKBOXES'       => false,
    'NAV_OBJECT'                => $arResult["nav"],
    'AJAX_MODE'                 => 'Y',
    'AJAX_ID'                   => CAjax::getComponentID(
      'bitrix:main.ui.grid',
      '.default',
      ''
    ),
    'PAGE_SIZES'                => [
      ['NAME' => '1', 'VALUE' => '1'],
      ['NAME' => '2', 'VALUE' => '2'],
      ['NAME' => '5', 'VALUE' => '5'],
      ['NAME' => '10', 'VALUE' => '10'],
      ['NAME' => '20', 'VALUE' => '20'],
    ],
    'AJAX_OPTION_JUMP'          => 'N',
    'SHOW_CHECK_ALL_CHECKBOXES' => false,
    'SHOW_ROW_ACTIONS_MENU'     => true,
    'SHOW_GRID_SETTINGS_MENU'   => true,
    'SHOW_NAVIGATION_PANEL'     => true,
    'SHOW_PAGINATION'           => true,
    'SHOW_SELECTED_COUNTER'     => true,
    'SHOW_TOTAL_COUNTER'        => true,
    'SHOW_PAGESIZE'             => true,
    'SHOW_ACTION_PANEL'         => true,
    'ALLOW_COLUMNS_SORT'        => true,
    'ALLOW_COLUMNS_RESIZE'      => true,
    'ALLOW_HORIZONTAL_SCROLL'   => true,
    'ALLOW_SORT'                => true,
    'ALLOW_PIN_HEADER'          => true,
    'AJAX_OPTION_HISTORY'       => 'N',
  ]
);