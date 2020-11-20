<?php
namespace app\controllers;

use simplemvc\base\Controller;
use app\models\User;

class LoginController extends Controller
{
    public function login(){
//
//        $userid = $_POST['userid'];
        session_start();
        if(!isset($_SESSION['userid'])){
            if(isset($_POST['username'])){
                $user = (new User())->where(['name'=> $_POST['username']])->fetch();
                if($user && $user['password'] == sha1($_POST['password']) && $user['is_active'] == 1){
                    $_SESSION['userid'] = $user['user_id'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['username'] = $user['name'];
                    if($user['role'] == 1){
                        $this->rediect('admin', 'index');
                    }else{
                        $this->rediect('index', 'index');
                    }
                }else{
                    $this->assign('message', 'No such user or Wrong password.');
                }
            }
            $this->render();
        }else{
            $this->rediect('index', 'index');
        }
    }

    public function register(){
        if(!isset($_SESSION['userid'])) {
            if (isset($_POST['username'])) {
                if ($_POST['password'] !== $_POST['check_password']) {
                    $this->assign('message', 'The password you sent is not same');
                } else {
                    $exist = (new User())->where(['name= ?'], [$_POST['username']])->fetch();
                    if($exist && !empty($exist)){
                        $this->assign('message', 'The username has been taken.');
                    }else{
                        $user = (new User())->add(['name' => $_POST['username'], 'password' => sha1($_POST['password']), 'phone' => $_POST['phone'], 'role' => 0]);
                        $this->rediect('login', 'login');
                    }
                }
            }
            $this->render();
        }else{
            $this->rediect('index', 'index');
        }
    }

    public function logout(){
        session_start();
        if(!isset($_SESSION['userid'])) {
            $this->rediect('index', 'index');
        }else{
            unset($_SESSION['userid']);
            unset($_SESSION['role']);
            unset($_SESSION['username']);
            session_destroy();
            $this->rediect('index', 'index');
        }

    }
}