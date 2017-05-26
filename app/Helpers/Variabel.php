<?php
/**
 * Created by PhpStorm.
 * User: ojiepermana
 * Date: 12/24/2016
 * Time: 3:22 PM
 */

namespace App\Helpers;


use App\Models\M_Aircraft;
use App\Models\M_Ata;
use App\Models\M_LifeTimeLimit;
use App\Models\M_PartCategory;
use App\Models\M_PartId;
use App\Models\M_Site;
use App\Models\T_PurVendor;

class Variabel
{
    Public static function getTsnTsoVariabel()
    {
        $data = array();
        $data[] = "hours";
        $data[] = "days";
        $data[] = "weeks";
        $data[] = "years";

        return $data;
    }



    public static function time_unit()
    {
        $data = array();
        $data[] = "MTHS";
        $data[] = "WKS";
        $data[] = "YRS";

        return $data;

    }

}