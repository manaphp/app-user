<?php
namespace App\Models;

use ManaPHP\Db\Model;

/**
 * Class App\Models\Country
 */
class Country extends Model
{
    public $country_id;
    public $country;
    public $last_update;

    /**
     * @return string
     */
    public function getTable()
    {
        return 'country';
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return 'country_id';
    }
}