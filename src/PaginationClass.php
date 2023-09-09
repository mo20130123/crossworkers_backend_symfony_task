<?php

namespace App;

class PaginationClass
{
    Private int $limit;
    Private int $page_number;
    Private int $offset;
    Private int $total;

    public function __construct($limit)
    {
        $this->limit = $limit;
        $this->page_number = 1; //set default value
        $this->offset = 1; //set default value
        $this->total = 1; //set default value
    }

    public function get_page_number()
    {
        $this->page_number = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1 ;
        return $this->page_number;
    }

    public function get_offset()
    {
        $this->offset = ($this->page_number-1) * $this->limit;
        return $this->offset;
    }

    public function get_next_page_url($request )
    {
        $current_page_link = $request->getSchemeAndHttpHost().$request->getPathInfo() ;
        $is_next_page_exist = (ceil($this->total / $this->limit) > $this->page_number) ?  true : false ;

        return  $is_next_page_exist ?
            $current_page_link.'?page='.(1+$this->page_number) :
            null;
    }

    public function number_of_pages()
    {
        return ceil($this->total / $this->limit);
    }

    public function set_total($total){
        $this->total = $total;
    }
    public function get_total(){
        return $this->total;
    }

}