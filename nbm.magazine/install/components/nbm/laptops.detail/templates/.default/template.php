<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
Bitrix\Main\UI\Extension::load('ui.bootstrap4');
Bitrix\Main\UI\Extension::load("ui.vue3");

?>
<div id="nbItem" class="row row-cols-1 row-cols-md-3 mb-3 text-center">
    <div class="col">
        <div class="card shadow-sm border-primary">
            <div class="card-header text-white bg-primary border-primary">
                <h1>{{nbItem.NAME}}</h1>
            </div>
            <div class="card-body">
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <div><h6><?=Loc::getMessage("T_LAPTOP_DETAIL_BRAND")?></h6></div>
                        <span class="text-muted">{{nbItem.BRAND}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div><h6><?=Loc::getMessage("T_LAPTOP_DETAIL_MODEL")?></h6></div>
                        <span class="text-muted">{{nbItem.MODEL}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div><h6><?=Loc::getMessage("T_LAPTOP_DETAIL_PRICE_NAME")?></h6></div>
                        <span class="text-muted">{{nbItem.PRICE}} <?=Loc::getMessage("T_LAPTOP_DETAIL_PRICE_CURRENCY")?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div><h6><?=Loc::getMessage("T_LAPTOP_DETAIL_YEAR")?></h6></div>
                        <span class="text-muted">{{nbItem.YEAR}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div><h6><?=Loc::getMessage("T_LAPTOP_DETAIL_OPTIONS")?></h6></div>
                        <span>
                          <span v-for="option in nbItem.OPTIONS" class="badge bg-primary mr-2">{{option}}</span>
                        </span>
                    </li>
                </ul>
                <button type="button" class="w-100 btn btn-lg btn-primary">В корзину</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    vueApp=BX.Vue3.BitrixVue.createApp( {
        data : function()  {
        return {
            nbItem: <?=json_encode($arResult['ITEM'])?>,
        }
      },
    }).mount('#nbItem');
</script>
