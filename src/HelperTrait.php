<?php

namespace App;

trait HelperTrait
{
    public static function get_next_page_url($request, $total,$limit,$page)
    {
        $current_page_link = $request->getSchemeAndHttpHost().$request->getPathInfo() ;
        $is_next_page_exist = (ceil($total / $limit) > $page) ?  true : false ;

        return  $is_next_page_exist ?
                $current_page_link.'?page='.(1+$page) :
                null;
    }

    public static function number_of_pages($total,$limit)
    {
        return ceil($total / $limit);
    }
}