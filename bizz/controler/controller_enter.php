<?php

class Controller_Enter extends Controller
{
    var $model_user = NULL;

    function __construct($way)
    {
        parent::__construct($way);
        $this->model_user = new Model_user_access();

    }


    function action_exit(){
        $data=$this->model_user->exit_cab();
        $this->load_view($data);
    }

    function action_action()
    {
        $data['error'] = $this->model_user->user();
        $data['mode']='ent';
        $this->load_view($data);
    }

    function action_index()
    {
        $way = $this->way;
        $data['mode'] = 'ent';
        if(isset($way[4])){
        if ($way[4] == 'reg')
                $data['mode'] = 'reg';}
        $this->load_view($data);
    }

    function load_view($data)
    {
        $this->view->generate('view_enter.php', 'view_form.php', $data);
    }
}