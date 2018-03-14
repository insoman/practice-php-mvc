<?php

class Posts extends Controller
{

    public function __construct($controllerName) {
        // echo 'We are at home';
        parent::__construct($controllerName);

    }

    public function index($params)
    {
        $data = array('posts1','posts2');

        $this->view->render('index', $data);
    }

    public function edit($params)
    {
        $data = array('edit1','edit12');

        $this->view->render('edit', $data);
    }



}