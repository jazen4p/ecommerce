<?php

namespace App\Controllers;
use App\Models\Register_model;

class Register extends BaseController
{
    public function __construct(){
        $this->Register_model = new Register_model();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = array(
            'title' => 'Register Account Dashboard Jaz Computer',
            'prog_title' => 'Jaz Computer',
            'err_msg' => $this->session->getFlashdata('err_msg')
        );

        return view('admin/register', $data);
    }

    public function register_acc(){
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['retype_password'];

        if(isset($_POST['terms'])){
            $check_user = $this->Register_model->check_username($username);

            if($check_user > 0){
                $this->session->setFlashdata('err_msg', "Username exist");

                return redirect()->to('Register');
            } else {
                $data = array(
                    'nama_user'=>$full_name,
                    'username'=>$username,
                    'email'=>$email,
                    'password'=>md5($password),
                    'status'=>"deaktif",
                    'acc_created_date'=>date('Y:m:d H:i:sa am/pm'),
                );

                $this->Register_model->add_account($data);

                $this->session->setFlashdata('succ_msg', "Akun telah terdaftar, silahkan menunggu atau mengontak Admin untuk aktivasi akun!");

                return redirect()->to('Login');
            }
        } else {
            $this->session->setFlashdata('err_msg', "You are not agreeing to the terms");

            return redirect()->to('Register');
        }
    }
}
