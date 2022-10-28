<?php

namespace Nbm\Magazine;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;


Loc::loadMessages(__FILE__);

class BrandTable extends Entity\DataManager {

    public static function getTableName(){
        return 'nbm_magazine_brand';
    }

    public static function getMap(){
        return array(
          new Entity\IntegerField(
                'ID', array(
                    'primary' => true,
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
          new Entity\StringField(
            'CODE', array(
                    'required'   => true,
                    'unique'     => true,
                    'validation' => function () {
                        return array(new Entity\Validator\Length(null, 255),);
                    },
                ),
          ),
          (new OneToMany('MODELS', ModelTable::class, 'MODEL'))->configureJoinType('left'),
        );
    }

}