<?php

global $APPLICATION;

use Bitrix\Main\Localization\Loc; ?>
<form action="<?= $APPLICATION->GetCurPage() ?>" name="form1">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
    <input type="hidden" name="id" value="form">
    <input type="hidden" name="install" value="Y">
    <input type="hidden" name="step" value="2">
    <input type="hidden" name="id" value="nbm.magazine">
    <p>
        <input type="checkbox" name="delete_table" value="Y" id="id_delete_table" onClick="ChangeInstallPublic(this.checked)">
        <label for="id_delete_table"><?= Loc::getMessage("DELETE_TABLE_AND_CREATE_NEW") ?></label>
    </p>
    <input type="submit" name="inst" value="<?= Loc::getMessage("MOD_INSTALL") ?>">
</form>