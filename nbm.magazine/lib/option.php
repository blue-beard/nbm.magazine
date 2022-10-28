<?php

namespace Nbm\Magazine;


use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\Relations\ManyToMany;

Loc::loadMessages(__FILE__);

class OptionTable extends Entity\DataManager{

    public static function getTableName(){
        return 'nbm_magazine_option';
    }

    public static function getMap(){
        return array(
          new Entity\IntegerField(
                'ID', array(
                    'primary'      => true,
                    'autocomplete' => true,
                ),
          ),
          new Entity\StringField(
            'NAME', array(
                    'required'   => true,
                    'validation' => function () {
                        return array(new Entity\Validator\Length(null, 255),);
                    },
                ),
          ),
          (new ManyToMany('LAPTOPS', LaptopTable::class))->configureTableName('nbm_magazine_laptop_option'),
        );
    }

}