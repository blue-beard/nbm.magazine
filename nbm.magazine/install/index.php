<?php

use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class nbm_magazine extends CModule{

    public $MODULE_ID = "nbm.magazine";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_GROUP_RIGHTS;
    public $errors;

    public $arEntities = array(
        "BrandTable",
        "ModelTable",
        "LaptopTable",
        "OptionTable",
        "LaptopOptionTable",
      );

    public $namespase;

    public function __construct()
    {
        $this->MODULE_VERSION      = "1.0.0";
        $this->MODULE_VERSION_DATE = "27.10.2022";
        $this->MODULE_NAME         = "Магазин ноутбуков";
        $this->MODULE_DESCRIPTION  = "Модуль решает проблемы хранения и поиска ноутбуков на сайте интернет-магазина";
        $this->namespase = str_replace(".", "\\", $this->MODULE_ID)."\\";
        $this->PARTNER_NAME = "Clever Hands Software";
        $this->PARTNER_URI = "//dobego.ru/";
        $this->MODULE_GROUP_RIGHTS = "Y";
    }

    public function DoInstall()
    {
        global $step, $APPLICATION, $delete_table;

        $step = IntVal($step);
        if ($step < 2) {
            $APPLICATION->IncludeAdminFile(Loc::getMessage("LAPTOPS_INSTALL_TITLE"),__DIR__."/step1.php");
        } elseif ($step == 2) {
            RegisterModule($this->MODULE_ID);
            $this->InstallDB($delete_table);
            $this->InstallEvents();
            $this->InstallFiles();
        }
    }

    public function InstallDB($delete = false)
    {
        if ($delete) {
            $this->UnInstallDB($delete);
        }

        if (Loader::includeModule($this->MODULE_ID)) {
            $connection = Application::getConnection();

            foreach ($this->arEntities as $entity) {
                $nameClass = $this->namespase.$entity;
                if (!class_exists($nameClass)) {
                    return false;
                }

                if (!$this->checkEntity($nameClass)) {
                    $nameClass::getEntity()->createDbTable();
                    $this->installDemo($entity);
                }
            }
        }
    }

    public function UnInstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            $connection = Application::getInstance()->getConnection();
            foreach ($this->arEntities as $entity) {
                $nameClass = $this->namespase.$entity;

                if (!class_exists($nameClass)) {
                    return false;
                }

                if ($this->checkEntity($nameClass)) {
                    $connection->dropTable($nameClass::getTableName());
                }
            }
        }
    }

    public function checkEntity($entityName): bool
    {
        return Application::getConnection()->isTableExists(Base::getInstance($entityName)->getDBTableName());
    }

    public function installDemo($entity)
    {
        $nameClass = $this->namespase.$entity;

        $data = json_decode(file_get_contents(__DIR__."/demo/$entity.json"),true);
        foreach ($data as $element) {
            $entityObject = $nameClass::createObject();

            foreach ($element as $attrName => $value) {
                $entityObject->set($attrName, $value);
            }
            $entityObject->save();
        }
    }

    public function InstallEvents()
    {
        return true;
    }

    public function InstallFiles()
    {
        CopyDirFiles(__DIR__."/components/",$_SERVER["DOCUMENT_ROOT"]."/local/components",true, true);
        return true;
    }

    public function DoUninstall()
    {
        global $step, $APPLICATION, $delete_table;

        $step = IntVal($step);
        if ($step < 2) {
            $APPLICATION->IncludeAdminFile(Loc::getMessage("LAPTOPS_INSTALL_TITLE"), __DIR__."/unstep1.php");
        } elseif ($step == 2) {
            if ($delete_table) {
                $this->UnInstallDB();
            }
            UnRegisterModule($this->MODULE_ID);
        }
    }

    public function UnInstallEvents()
    {
        return true;
    }

    public function UnInstallFiles()
    {
        return true;
    }

    public function GetModuleRightList(): array
    {
        $arr = array(
          "reference_id" => array("D", "R", "W"),
          "reference"    => array(
            "[D] ".Loc::getMessage("LAPTOPS_DENIED"),
            "[R] ".Loc::getMessage("LAPTOPS_OPENED"),
            "[W] ".Loc::getMessage("LAPTOPS_FULL"),
          ),
        );
        return $arr;
    }

}
