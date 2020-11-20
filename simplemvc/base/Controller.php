<?php
namespace simplemvc\base;

/**
 * Controller Base
 */
class Controller
{
    protected $_controller;
    protected $_action;
    protected $_view;

    // Construct function
    public function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View($controller, $action);
    }

    // Assign params
    public function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }

    // Render viewer
    public function render()
    {
        $this->_view->render();
    }

    // Redirect to
    public function  rediect($controller, $action){
        header('location:'.'/'. $controller . '/' .$action);
//        $this->_view = new View($controller, $action);
//        $this->_view->render();
    }
}