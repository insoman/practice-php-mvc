<?php

class Home extends Controller
{

    /**
     * Constructor require current controller name as param
     * 
     * @param $controllerName   Current controllers name such as 'home' or 'posts'
     */
    public function __construct($controllerName) {
        // echo 'We are at home';
        // echo $controllerName;
        parent::__construct($controllerName);

    }

    public function index($params)
    {
        // print_r($params);

        $this->view->render('index');
    }

    public function test($params)
    {

        $this->view->render('test', $params);
    }

    private function getParameters($params) {

        $parameters = array();

    }

}