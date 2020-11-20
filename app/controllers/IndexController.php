<?php
namespace app\controllers;

use app\models\Area;
use app\models\Parklot;
use simplemvc\base\Controller;

class IndexController extends Controller
{
    private $_title = 'Park Lot Finder Online';

    // Index Controller
    public function index()
    {
        // init session
        session_start();
        date_default_timezone_set('Pacific/Auckland');

        $areas = (new Area())->fetchAll();
        foreach ($areas as &$a){
            $a['parklots'] = (new Parklot())->where(['area_id'=> $a['area_id']])->fetchAll();
        }

        $this->assign('areas', $areas);


//        if($_SERVER [ 'REQUEST_METHOD' ] == "POST"){
//            $fromDes = $_POST['fromDes'];
//            $toDes = $_POST['toDes'];
//
//            $outbound_route = (new Routes())->where(['point1 = ?', 'point2 = ?'],[$fromDes, $toDes])->fetch();
//            $return_route =  (new Routes())->where(['point1 = ?', 'point2 = ?'],[$toDes, $fromDes])->fetch();
//            if($outbound_route) {
//                $route = $outbound_route;
//                $route_type= 0;
//            }elseif ($return_route){
//                $route = $return_route;
//                $route_type= 1;
//            } else {
//                $route= null;
//            }
//            $flights = [];
//            if($route){
//                if(isset($_POST['date'])){
//                    $flights = (new Flights())->where(['routeID = ?', 'route_type= ?', 'departure_weekday= ?'], [$route['routeID'], $route_type, date('w', strtotime($_POST['date']))])->fetchAll();
//                }else{
//                    $flights = (new Flights())->where(['routeID = ?', 'route_type= ?'], [$route['routeID'], $route_type])->fetchAll();
//                }
//            }
//            foreach ($flights as &$flight){
//                $aircraft = (new Aircrafts())->where(['craftID= ?'], [$flight['aircraftID']])->fetch();
//                $flight['aircraft'] = $aircraft;
//            }
//            $this->assign('flights', $flights);
//            $this->assign('route', $route);
//
//            $this->assign('fromDes', $fromDes);
//            $this->assign('toDes', $toDes);
//            $this->assign('deaprture_date', $_POST['date']);
//        }
        // render template

//        $des_list = (new Destinations())->fetchAll();
//        $this->assign('des_list', $des_list);
        $this->render();
    }
}