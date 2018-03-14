<?php

class Application
{

    /**
     * Current url
     *
     * @var string
     */
    private $url;

    /**
     * Current controller
     *
     * @var string
     */
    private $controller;

    /**
     * Current action to call controller
     *
     * @var string 
     */
    private $action;

    /**
     * Requested method
     *
     * @var string
     */
    private $method;

    /**
     * Optional parameters
     *
     * @var array
     */
    private $parameters = array();

    private $defaultClass = DEFAULT_CONTROLLER;
    private $defaultMethod = DEFAULT_METHOD;


    public function __construct() {
        
        
        $this->url = $this->getUrl();

        $this->splitUrl($this->url);

        // Check if file with requested controller class exists
        if(file_exists('../app/controllers/' . $this->action . '.php'))
        {

            require '../app/controllers/' . $this->action . '.php';

            // Check if requested controller class exists in required file
            if(class_exists($this->action)) {
                
                // Instantiation of requested controller with its name as param
                // and assining it to $controller variable
                // Ex: $this->controller = new Posts('posts');
                $this->controller = new $this->action($this->action);

                // Check for method: if method exist in class
                if(method_exists($this->controller, $this->method)) {

                    // method is called with optional parameters from URL
                    // Ex: $this->controller->index(array('param1', 'param2'));
                    $this->controller->{$this->method}($this->parameters);

                } else {
                    // if method doesn't exist, default method is called
                    $this->controller->index($this->parameters);
                }

            } else {
                throw new Exception("{$this->action} class doesn't exist");
            }

        } else {

            /**
             * TODO
             * 
             * Create 404 redirection if there is no page
             */

            // If file of requested controller does not exists
            // system calls default controller (from config) and instantiatiate it
            // with default method (index)
            require '../app/controllers/' . DEFAULT_CONTROLLER . '.php';

            $this->controller = new $this->defaultClass($this->defaultClass);
            $this->controller->{$this->defaultMethod}($this->parameters);
            
        }
        
        // echo '<br>';
        // echo $this->action;
        // echo '<br>';
        // echo $this->method;
        // echo '<br>';
        // print_r($this->parameters);
        // echo '<br>';

    }


    /**
     * Function gets current URL and assings to variable $url
     * If url empty, function sets default controller from config
     *
     * @return string $url
     */
    private function getUrl()
    {

        return $url = !empty($_GET['url']) ? $_GET['url'] : DEFAULT_CONTROLLER;
        
    }


    private function splitUrl($url)
    {
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        $this->action       = !empty($url[0]) ? $url[0] : DEFAULT_CONTROLLER;
        $this->method       = !empty($url[1]) ? $url[1] : DEFAULT_METHOD;

        unset($url[0], $url[1]);

        $this->parameters = !empty($url[2]) ? array_values($url) : array();


    }

}