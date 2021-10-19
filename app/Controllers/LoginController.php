<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
class LoginController extends BaseController
{
    protected $username;
    protected $password;
    protected $level;
    protected $login;
    protected $sesi;
    public function __construct(){
        $this->login = new LoginModel();
        $this->sesi = session();
    }
    public function index()
    {
        //menampilkan form login
        echo "halaman login";
    }
    public function check(){
        //memeriksa user 
        $this->username = $this->request->getVar('username'); //$_POST['username']
        $this->password = $this->request->getVar('password'); //$_POST['password']
        $check = $this->login
                    ->where(array( 'username'=>$this->username,'password'=>$this->password))
                    ->first();
        if($check > 0){
            //simpan sesi
            $msg = [
                'sudah_login'   => true,
                'id_user'       => $check['id_user'],
                'nama'          => $check['nama'],
                'level'         => $check['level'],
                'pesan'         => 'Login Berhasil'
            ];
            // Men-SET Sesi
            $this->sesi->set($msg);
        }else{
            $msg = [
                'sudah_login'   => false,
                'pesan'         => 'Login Gagal'
            ];
        }
        return $this->response->setJSON($msg);
    }

    //===============================================
    public function logout(){
        //menghapus sesi login
    }
}
