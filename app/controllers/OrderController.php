<?php
namespace app\controllers;

use app\models\Aircrafts;
use app\models\Flights;
use app\models\Orders;

class OrderController extends BaseController
{
    // Index Controller
    public function index(){
        $orders = (new Orders())->where(['userID = ?'], [$_SESSION['userid']])->fetchAll();
        foreach ($orders as &$order){
            $order['flight'] = (new Flights())->where(['flightID = ?'], [$order['flightID']])->fetch();
            $order['flight']['aircraft'] = (new Aircrafts())->where(['craftID = ?'], [$order['flight']['aircraftID']])->fetch();
        }

        $this->assign('orders', $orders);
        $this->render();
    }

    // Add order
    public function order(){
        if($_SERVER [ 'REQUEST_METHOD' ] == "GET" && $_GET['flightID']){
            $flight = (new Flights())->where(['flightID= ?'], [$_GET['flightID']])->fetch();

            if($flight) {
                $aircraft = (new Aircrafts())->where(['craftId = ?'], [$flight['aircraftID']])->fetch();
                if($aircraft){
                    $orderCount = (new Orders())->where(['flightId= ?', 'departure_date= ?'], [$_GET['flightID'], $_GET['departure_date']])->count();
                }
                if($aircraft['capacity'] > $orderCount){
                    $order = (new Orders())->add(['flightID' => $_GET['flightID'],
                        'userID'=> $_SESSION['userid'],
                        'departure_date'=> $_GET['departure_date']]);
                    $msg = 'Your order is acceptted.';
                    $flight['aircraft'] = $aircraft;
                }else{
                    $flight = null;
                    $msg = 'This Flight is full.Please order another flight';
                }
            }else{
                $msg= 'No such Flight';
            }
            $this->assign('flight', $flight);
            $this->assign('msg', $msg);

            $this->render();
        }else{
            $this->rediect('index','index' );
        }
    }

    // Delete order
    public function delete(){
        $order = (new Orders())->where(['orderID= ?'], [$_GET['orderID']])->fetch();
        if($order['userID'] == $_SESSION['userid']){
            $del = (new Orders())->delete((int)$_GET['orderID']);
        }
        $this->rediect('order','index' );
    }
}