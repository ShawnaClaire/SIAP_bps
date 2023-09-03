<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index(): string
    {
        
        $data = [
            'title' => "Login"
        ];
        return view('Auth/login', $data);
    }

    public function login(){
        $userModel = new \App\Models\UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $userModel->where('email', $email)->first();
        if($user){
            if($user['password'] != $password){ 
                $error_msg = '<div class="alert alert-danger mt-2" role="alert"> email atau password salah</div>';
                session()->setFlashdata('error_msg', $error_msg);
                return redirect()->to('/auth');
            } else{
                $user_data = [
                    'user_id' => $user['iduser'],
                    'user_email' => $user['email']
                ];
                session()->set($user_data);
                return redirect()->to('/');
            }
        } else {
            $error_msg = '<div class="alert alert-danger mt-2" role="alert"> email atau password salah</div>';
            session()->setFlashdata('error_msg', $error_msg);
            return redirect()->to('/auth');
        }
        
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/auth');
    }
}
