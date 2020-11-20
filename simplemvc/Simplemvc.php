<?php

namespace simplemvc;

// Framework core folder
defined('CORE_PATH') or define('CORE_PATH', __DIR__);

/**
 * SimpleMVC Kernel
 */
class Simplemvc
{
    // config array
    protected $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    // run the application
    public function run()
    {
        spl_autoload_register(array($this, 'loadClass'));
        $this->setReporting();
        $this->removeMagicQuotes();
        $this->unregisterGlobals();
        $this->setDbConfig();
        $this->route();
    }

    // router
    public function route()
    {
        $controllerName = $this->config['defaultController'];
        $actionName = $this->config['defaultAction'];
        $param = array();

        $url = $_SERVER['REQUEST_URI'];
        // clean up the string after ?
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);

        // to make 'index.php/{controller}/{action}' work
        $position = strpos($url, 'index.php');
        if ($position !== false) {
            $url = substr($url, $position + strlen('index.php'));
        }

        // delete the “/” first/last in the url
        $url = trim($url, '/');

        if ($url) {
            // split the url by '/' and store in array
            $urlArray = explode('/', $url);
            // delete empty array
            $urlArray = array_filter($urlArray);

            // get the control name
            $controllerName = ucfirst($urlArray[0]);

            // get the action name
            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;

            // get the param
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();
        }

        // find the control and action
        $controller = 'app\\controllers\\'. $controllerName . 'Controller';
        if (!class_exists($controller)) {
            exit($controller . ' Controller not exist');
        }
        if (!method_exists($controller, $actionName)) {
            exit($actionName . ' Action not exist.');
        }

        $dispatch = new $controller($controllerName, $actionName);

        call_user_func_array(array($dispatch, $actionName), $param);
    }

    // set up the debug mode
    public function setReporting(){
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
        }
    }

    // delete the slashes
    public function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);
        return $value;
    }

    // delete magic quotes
    public function removeMagicQuotes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = isset($_GET) ? $this->stripSlashesDeep($_GET ) : '';
            $_POST = isset($_POST) ? $this->stripSlashesDeep($_POST ) : '';
            $_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
            $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
        }
    }

    // unset global params
    public function unregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    // set up database config
    public function setDbConfig()
    {
        if ($this->config['db']) {
            define('DB_HOST', $this->config['db']['host']);
            define('DB_NAME', $this->config['db']['dbname']);
            define('DB_USER', $this->config['db']['username']);
            define('DB_PASS', $this->config['db']['password']);
        }
    }

    // autoload the class needed
    public function loadClass($className)
    {
        $classMap = $this->classMap();

        if (isset($classMap[$className])) {
            $file = $classMap[$className];
        } elseif (strpos($className, '\\') !== false) {
            $file = APP_PATH . str_replace('\\', '/', $className) . '.php';
            if (!is_file($file)) {
                return;
            }
        } else {
            return;
        }

        include $file;
    }

    // set the map of kernel
    protected function classMap()
    {
        return [
            'simplemvc\base\Controller' => CORE_PATH . '/base/Controller.php',
            'simplemvc\base\Model' => CORE_PATH . '/base/Model.php',
            'simplemvc\base\View' => CORE_PATH . '/base/View.php',
            'simplemvc\db\Db' => CORE_PATH . '/db/Db.php',
            'simplemvc\db\Sql' => CORE_PATH . '/db/Sql.php',
        ];
    }
}