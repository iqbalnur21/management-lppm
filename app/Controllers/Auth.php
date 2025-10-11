<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{
    private $users;
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->users = new User();
    }
    public function index()
    {
        if (session('user_id')) {
            return redirect()->to(site_url('/'));
        }
        $data['assetsPath'] = (strpos(current_url(), 'balrafa.tech') !== false) ? env('app.assetsPath') : base_url();
        return view('login', $data);
    }
    public function loginProcess()
    {
        helper('custom');
        
        $post = $this->request->getPost();
        $query = $this->users->getWhere(['username' => $post['username']]);
        $user = $query->getRow();
        if ($user) {
            if (password_verify($post['password'], $user->password)) {
                $params = ['user_id' => $user->user_id, 'username' => $user->username, 'role_id' => $user->role_id];
                session()->set($params);
                return redirect()->to(site_url('dashboard'));
            } else {
                return redirect()->back()->with('error', 'Username atau Password Salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau Password Salah');
        }
    }
    public function logout()
    {
        session()->remove('user_id');
        return redirect()->to(site_url('/'));
    }
}
