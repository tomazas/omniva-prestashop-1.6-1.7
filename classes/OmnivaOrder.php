<?php

class OmnivaOrder extends ObjectModel
{
    public $id;

    public $packs;

    public $cod;

    public $cod_amount;

    public $manifest;

    public $weight;

    public $tracking_numbers;

    public $error;

    /** @var string Object creation date */
    public $date_add;

    /** @var string Object last modification date */
    public $date_upd;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'omniva_order',
        'primary' => 'id',
        'fields' => [
            'packs' =>               ['type' => self::TYPE_INT, 'size' => 10],
            'cod' =>                 ['type' => self::TYPE_BOOL, 'validate' => 'isBool'],
            'cod_amount' =>          ['type' => self::TYPE_FLOAT, 'size' => 10],
            'manifest' =>            ['type' => self::TYPE_INT, 'size' => 10],
            'weight' =>              ['type' => self::TYPE_FLOAT, 'size' => 10],
            'tracking_numbers' =>    ['type' => self::TYPE_STRING, 'size' => 512],
            'error' =>               ['type' => self::TYPE_STRING, 'size' => 256],
            'date_add' =>            ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
            'date_upd' =>            ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
        ],
    ];

    public static function getCurrentManifestOrders()
    {
        $query = (new DbQuery())
            ->select("id")
            ->from(self::$definition['table'])
            ->where('manifest = ' . (int) Configuration::get('omnivalt_manifest'));

        return array_map(function($order) {
            return $order['id'];
        }, Db::getInstance()->executeS($query));
    }

}
