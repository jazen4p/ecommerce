<?php

namespace App\Controllers;

class Shop extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'Catalogue - Jaz Computer Store'
        );

        return view('store/catalogue', $data);
    }
}
