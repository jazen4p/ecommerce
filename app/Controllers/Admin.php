<?php

namespace App\Controllers;
use App\Models\Admin_model;

class Admin extends BaseController
{
    protected $helpers = ['url', 'form', 'counter'];

    public function __construct()
    {
        $this->Admin_model = new Admin_model();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = array(
            'title' => 'Dashboard Jaz Computer',
            'logged' => $this->session->get('username'),
            'count_user' => $this->Admin_model->get_CountUser()
        );

        return view('admin/dashboard', $data);
    }

    public function dashboard(){

    }
}
