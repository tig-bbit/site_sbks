<?php
/**
 * Created by PhpStorm.
 * User: ojiepermana
 * Date: 12/19/2016
 * Time: 12:20 PM
 */

namespace App\Helpers;
use DB;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class Query
{

    public static $Perpage = 100;

    public static function getSite()
    {

        return (Object)array("id"=> 1, "code_site"=>"JKT");

    }

    public static function getPosisi()
    {

        return  (object)array("id"=> 1, "position"=>"MPC");
    }

    public static function getUser()
    {
        return  (object)array("id"=> 1, "name"=>"Mumahammad Arifin");
    }


    public static function pagination($data,$request)
    {
        $paginate = Query::$Perpage;
        $page = $request->input('page', 1);

        $offSet = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($data, $offSet, $paginate, true);
        $paginatedResults= new LengthAwarePaginator($itemsForCurrentPage, count($data),$paginate,$page,['path'=>$request->url(),'query'=>$request->query()]);

        return $paginatedResults;
    }

    public static function filter($path,$request)
    {
        $sql="";
        foreach($request->input() as $key => $value)
        {
            $parsing_cari = explode("kode1", $value);
            $parsing_not = explode("not1", $value);
            $parsing_in = explode("in|", $value);
            if(count($parsing_cari) > 1)
            {
                $sql.= " and ".$path.".".$key." like '%".$parsing_cari[1]."%' ";
            }
            else if(count($parsing_not) > 1)
            {
                $sql.= " and ".$path.".".$key." is not ".$parsing_not[1]." ";
            }
            else if(count($parsing_in) > 1)
            {
                $sql.= " and ".$path.".".$key." in ( ".$parsing_in[1]." )";
            }
            elseif ($key=='page')
            {
                $page = $value;
            }
            elseif ($key=='ispage')
            {
                 //jika di piliah paginantion
            }
            elseif ($key=='id_site')
            {
                 if($value=='mysite')
                 {
                     $sql.= " and ".$path.".".$key." = ".Query::getSite()->id."";
                 }
                 else
                 {
                     $sql.= " and ".$path.".".$key." = ".$value."";
                 }
            }
            else
            {

                $sql.= " and LOWER(".$path.".".$key.") = LOWER('".$value."')";
            }


        }
        return $sql;
    }



    public static function newPagination($sql, $request)
    {
        $page=1;
        if($request->input('page'))
        {
            $page=$request->input('page');
        }


        $total = " Select count(id) as total from (".$sql.")  ";
        $total = DB::select($total)[0]->total;

        $sql = " Select b.*, ROWNUM as rn from (".$sql.")  b where ROWNUM <= ".Query::$Perpage * ($page)." ";
        $sql = " Select x.* from (".$sql.") x where x.rn > ".Query::$Perpage * ($page-1)." ";


        //Ambil Data
        $data['total'] = $total;
        $data['data'] = DB::select($sql);
        $data['perpage'] = Query::$Perpage;
        $data['current_page'] = $page;
        $roun = round($total / Query::$Perpage, 0, PHP_ROUND_HALF_DOWN);
        $data['last_page'] = ($total > self::$Perpage ? 1:0) + $roun;


        return $data;
    }


}
