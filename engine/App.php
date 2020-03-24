<?php


namespace app\engine;


use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UsersRepository;
use app\models\repositories\FeedbackRepository;
use app\models\repositories\OrdersRepository;
use app\traits\TSingletone;
use app\controllers\ProductController;

/**
 * Class App
 * @property Request $request
 * @property CartRepository $cartRepository
 * @property UsersRepository $usersRepository
 * @property ProductRepository $productRepository
 * @property FeedbackRepository $feedbackRepository
 * @property OrdersRepository $ordersRepository
 * @property SimpleImage $simpleImage
 * @property Db $db
 */
class App
{
    use TSingletone;
    public $config;

    /** @var  Storage */
    //хранилище компонентов-объектов
    private $components;

    private $controller;
    private $action;

    /**
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    public function runController()
    {

        $this->controller = $this->request->getControllerName() ?: 'product';
        $this->action = $this->request->getActionName();

        $controllerClass = $this->config['controller_namespace'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new Render());
            $controller->runAction($this->action);
        } else {
//            echo "Не правильный контроллер";
            $controller = new ProductController(new Render());
            echo $controller->render('error');
        }
    }


    //создание компонента при обращении, возвращает объект для хранилища
    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                //воспользуемся библиотекой ReflectionClass для создания класса
                //просто return new $class нельзя
                // т.к. не будут переданы параметры для конструктора v
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);

            }
        }
        return null;
    }

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    //Чтобы обращаться к компонентам как к свойствам, переопределим геттер
    function __get($name)
    {
        return $this->components->get($name);
    }

}