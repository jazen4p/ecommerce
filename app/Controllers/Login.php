<?php

namespace App\Controllers;
use App\Models\Login_model;

class Login extends BaseController
{
    public function __construct(){
        $this->Login_model = new Login_model();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = array(
            'title' => 'Login Dashboard Jaz Computer',
            'prog_title' => "Jaz Computer",
            'succ_msg' => $this->session->getFlashdata('succ_msg'),
            'err_msg' => $this->session->getFlashdata('err_msg')
        );

        return view('admin/login', $data);
    }

    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = $this->Login_model->cek_login($username, md5($password));

        $u_id = '';

        // print_r($query->get()->getResult());
        // exit;

        foreach ($query->get()->getResult() as $row){
            $u_id = $row->id_user;
            $username = $row->username;
            $nama = $row->nama_user;
            $telp = $row->telp;
            $email = $row->email;
            $alamat = $row->alamat;
            $status = $row->status;
            $role = $row->role;
            $profile_pict = $row->profile_pict;
            $last_login = $row->last_login;
        }
        
        if($query->countAllResults() == 0){
            $this->session->setFlashdata('err_msg', "Invalid Username or Password");

            return redirect()->to('Login');
        } 
        elseif($u_id == ''){
            $this->session->setFlashdata('err_msg', "Invalid Username or Password");

            return redirect()->to('Login');
        }
        elseif($status == "deaktif"){
            $this->session->setFlashdata('err_msg', "Account has been deactivated");

            return redirect()->to('Login');
        }
        else {
            $sess_data = array(
                'u_id' => $u_id,
                'username' => $username,
                'nama' => $nama,
                'telp' => $telp,
                'email' => $email,
                'alamat' => $alamat,
                'status' => $status,
                'role' => $role,
                'logged' => TRUE,
                'profile_pict' => $profile_pict
            );

            $this->session->set($sess_data);

            $this->Login_model->update_lastlogin($u_id);

            // $this->load->view('dashboard');
            return redirect()->to(site_url('Admin'));
        }
    }

    public function forgot_password(){
        $data = array(
            'title' => 'Forgot Password Dashboard Jaz Computer',
            'prog_title' => "Jaz Computer"
        );

        return view('admin/forgot_password', $data);
    }

    public function logout(){
        $array_items = array('username', 'email', 'u_id', 'nama', 'telp', 'alamat', 'logged', 'status', 'role', 'profile_pict');
        $this->session->remove($array_items);

        session_destroy();

        return redirect()->to(site_url('Login'));
    }
}
