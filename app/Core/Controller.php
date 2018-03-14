<?php
/**
 *  @author Piotr Witos <ptiw@wp.pl>
 *  @version 1.0.0
 * 
 */
class Controller
{

    /**
     * View object
     *
     * @var obj
     */
    protected $view;


    /**
     * Array with data sent to view controller
     *
     * @var array
     */
    protected $data = array();


    public function __construct($controllerName = null) {
        
        $this->view = new View();

        if(isset($controllerName))
        {
            
            $this->view->setCurrentControllerName($controllerName);
        }

    }



}
