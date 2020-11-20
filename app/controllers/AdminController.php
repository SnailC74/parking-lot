<?php
namespace app\controllers;

use app\models\Parklot;
use app\models\Area;
use app\models\User;
use app\models\UserParklot;

class AdminController extends BaseController
{
    public function index(){
        $users = (new User())->fetchAll();
        $this->assign('data_list', $users);
        $this->render();
    }

    public function users(){
        $users = (new User())->fetchAll();
        $this->assign('data_list', $users);
        $this->render();
    }

    public function add_user(){

        $this->render();
    }

    public function del_user(){
        if(isset($_GET['userid'])){
            $user = (new User())->delete($_GET['userid']);
            if($user){
                $this->rediect('admin', 'users');
            }
        }
    }

    public function active_user(){
        if(isset($_GET['userid'])){
            $user = (new User())->where(['user_id' => $_GET['userid']])->update(['is_active'=> 1]);
            if($user){
                $this->rediect('admin', 'users');
            }
        }
    }

    public function disable_user(){
        if(isset($_GET['userid'])){
            $user = (new User())->where(['user_id'=> $_GET['userid']])->update(['is_active'=> 0]);
            if($user){
                $this->rediect('admin', 'users');
            }
        }
    }

    public function areas(){
        $areas = (new Area())->fetchAll();
        $this->assign('data_list', $areas);
        $this->render();
    }

    public function add_area(){
        if(isset($_POST['name'])){
            $area = (new Area())->add(['name'=> $_POST['name']]);
            $this->rediect('admin', 'areas');
        }
        $this->render();
    }

    public function del_area(){
        if(isset($_GET['areaid'])){
            $parklots = (new Parklot())->where(['area_id'=> $_GET['areaid']])->fetchAll();
            foreach ($parklots as $p){
                $res = (new Parklot())->delete($p['parklot_id']);
            }
            $area = (new Area())->delete($_GET['areaid']);
            if($area){
                $this->rediect('admin', 'areas');
            }
        }
    }

    public function parklots(){
        if(isset($_GET['areaid'])) {
            $parklots = (new Parklot())->where(['area_id'=> $_GET['areaid']])->fetchAll();
        }else{
            $parklots = (new Parklot())->fetchAll();
        }
        foreach ($parklots as &$p){
            $area = (new Area())->where(['area_id'=> $p['area_id']])->fetch();
            if($area && !empty($area)){
                $p['area_name'] = $area['name'];
            }
        }
        $this->assign('data_list', $parklots);
        $this->render();
    }

    public function add_parklot(){
        if(isset($_POST['name'])){
            $parklot = (new Parklot())->add(['name'=> $_POST['name'],
                'longitude'=> $_POST['longitude'],
                'latitude'=> $_POST['latitude'],
                'area_id'=> $_POST['area'],
                'park_num'=> $_POST['park_num'],
                'usage_begin'=>$_POST['usage_begin'],
                'usage_end'=> $_POST['usage_end'],
                'weekday_usable'=> '']);
            if($parklot){
                $this->rediect('admin', 'parklots');
            }
        }

        $areas = (new Area())->fetchAll();
        $this->assign('areas', $areas);
        $this->render();
    }

    public function del_parklot(){
        if(isset($_GET['parklot_id'])){
            $parklot = (new Parklot())->delete($_GET['parklot_id']);
            if($parklot){
                $this->rediect('admin', 'parklots');
            }
        }
    }

    public function park_history(){
        $history = (new UserParklot())->where(['user_id'=> $_GET['userid']])->fetchAll();
        $this->assign('data_list', $history);
        $this->render();
    }


    public function orders(){
        if(isset($_GET['userid'])){
            $orders = (new Orders)->where(['userID= ?'], [$_GET['userid']])->fetchAll();
        }else{
            $orders = (new Orders)->fetchAll();
        }

        foreach ($orders as &$order){
            $flight = (new Flights())->where(['flightID= ?'], [$order['flightID']])->fetch();
            if($flight) $flight['aircraft'] = (new Aircrafts())->where(['aircraft= ?'], [$flight['aircraftID']])->fetch();
            $order['flight'] = $flight;
        }

        $this->assign('data_list', $orders);
        $this->render();
    }

    public function del_order(){
        if(isset($_GET['orderID'])){
            $del = (new Orders())->delete($_GET['orderID']);
            if($del){
                $this->rediect('admin', 'orders');
            }
        }
    }

}