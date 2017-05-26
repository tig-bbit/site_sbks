<?php
/**
 * Created by PhpStorm.
 * User: ojiepermana
 * Date: 12/24/2016
 * Time: 3:22 PM
 */

namespace App\Helpers;


class Role
{
    Public static function getPosii($path,$request) // login
    {
        $page=0;
        $sql=" ";
        foreach($request as $key => $value)
        {
            $parsing = explode("kode1", $value);
            if(count($parsing) > 1)
            {
                $sql.= " and ".$path.".".$key." like '%".$parsing[1]."%' ";
            }
            elseif ($key=='page')
            {
                $page = $value;
            }
            else
            {
                $sql.= " and ".$path.".".$key." = '".$value."'";
            }

        }

        return array("sql" => $sql, "page" => $page);
    }

}