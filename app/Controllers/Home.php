<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'Jaz Computer Store'
        );

        return view('store/homepage', $data);
    }
}
