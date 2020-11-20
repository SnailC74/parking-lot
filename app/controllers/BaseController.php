<?php
namespace app\controllers;

use simplemvc\base\Controller;

class BaseController extends Controller{
    // construct function
    public function __construct($controller, $action)
    {
        // init session
        session_start();
        // check the userid in session
        if(isset($_SESSION['userid'])){
            // check the role of user
            if($controller == 'admin' && $_SESSION['usertype'] !== 1){
                parent::__construct('index', 'index');
            }else{
                parent::__construct($controller, $action);
            }
        }else{
            // redirect back to login page
            parent::__construct('login', 'login');
            $this->render();
            exit();
        }
    }
}