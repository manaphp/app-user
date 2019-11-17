<?php
namespace App\Models;

use ManaPHP\Db\Model;

/**
 * Class App\Models\City
 */
class City extends Model
{
    public $city_id;
    public $city;
    public $country_id;
    public $last_update;

    /**
     * @return string
     */
    public function getTable()
    {
        return 'city';
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return 'city_id';
    }
}