<?php

class View
{

    /**
     * Header file path
     *
     * @var string
     */
    protected $headerPath = '../app/views/layout/header.php';
    
    /**
     * Footer file path
     *
     * @var string
     */
    protected $footerPath = '../app/views/layout/footer.php';

    /**
     * Stores name of current controller i.e. "home"
     * It is used to select catalog name of current controller
     *
     * @var string
     */
    protected $currentControllerName = DEFAULT_CONTROLLER;


    public function render($view, $data = array())
    {  
        // Path to requested file with controller/method system i.e. "../app/views/home/index.php"
        $file = '../app/views/' . $this->currentControllerName . '/' . $view . '.php'; 
        
        if(file_exists($file))
        {
            
            require $this->headerPath;
            require $file;
            require $this->footerPath;
            
        } else {
            throw new Exception("$file not found");
        }

    }

    /**
     * Sets current controller name
     *
     * @param string $name      Required name of controller
     * @return void
     */
    public function setCurrentControllerName($name)
    {
        $this->currentControllerName = $name;
    }

    /**
     * Gets current contro ller name
     *
     * @return string
     */
    public function getCurrentControllerName()
    {
        return $this->currentControllerName;
    }


}