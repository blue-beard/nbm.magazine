<?php

namespace Nbm\Magazine;


use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\Relations\ManyToMany;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;

Loc::loadMessages(__FILE__);

class LaptopTable extends Entity\DataManager{

    public static function getTableName(){
        return 'nbm_magazine_laptop';
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
          new Entity\StringField(
            'CODE', array(
                    'required'   => true,
                    'unique'     => true,
                    'validation' => function () {
                        return array(new Entity\Validator\Length(null, 255),);
                    },
                ),
          ),
          new Entity\IntegerField(
            'YEAR', array(
                    'required'   => true,
                    'validation' => function () {
                        return array(new Entity\Validator\RegExp('/[\d]{4}/'),);
                    },
                ),
          ),
          new Entity\IntegerField(
            'PRICE', array(
                     'required'   => true,
                     'validation' => function () {
                         return array(new Entity\Validator\RegExp('/[\d]{1,30}/'),);
                     },
              ),
          ),
          new Entity\IntegerField(
                'MODEL_ID', array(
                    'required'   => true,
                    'validation' => function () {
                        return array(new Entity\Validator\RegExp('/[\d]{1,11}/'),);
                    },
                ),
            ),
            new Entity\IntegerField(
                'BRAND_ID', array(
                    'required'   => true,
                    'validation' => function () {
                        return array(new Entity\Validator\RegExp('/[\d]{1,11}/'),);
                    },
                ),
            ),
            (new Reference('MODEL', ModelTable::class, Join::on('this.MODEL_ID', 'ref.ID')))->configureJoinType('left'),
            (new Reference('BRAND', BrandTable::class, Join::on('this.BRAND_ID', 'ref.ID')))->configureJoinType('left'),
            (new ManyToMany('OPTIONS', OptionTable::class))->configureTableName('nbm_magazine_laptop_option'),
        );
    }

}