<?php

class Controller_Cabinet extends Controller{

    var $model_cabinet=null;

    public function __construct($way)
    {
        parent::__construct($way);
        $this->model_cabinet=new Model_user();
    }

    function action_listaccess(){
        $data=$this->model_cabinet->list_invite();
    }

    function action_upaccess(){
        $this->model_cabinet->take_invite();
        $data=$this->model_cabinet->list_invite();
    }

    function action_denaccess(){
        $this->model_cabinet->cancel_invite();
        $data=$this->model_cabinet->list_invite();
    }

    function action_memberlist(){
        $data=$this->model_cabinet->list_member('YES');
    }

    function action_memberadd(){
        $this->model_cabinet->change_invite($this->way[START_POSITION + 2]);
        $data=$this->model_cabinet->list_member('YES');
    }

    function action_notmemberlist(){
        $data=$this->model_cabinet->list_member('NOT');
    }

    function action_notmemberadd(){
        $data=$this->model_cabinet->change_invite($this->way[START_POSITION + 2]);
        $data=$this->model_cabinet->list_member('NOT');
    }


    function action_view(){
        $data['settings']=0;
        if(isset($this->way[START_POSITION + 2])&&($_SESSION['RULES']==3))
            $object=$this->way[START_POSITION + 2];
        else{
         if(isset($_SESSION['RULES']))
            $object=null;
            else
            header("location:".URL_BASE."/404");
        }
        $data['person']=$this->model_cabinet->find_person($object);
        $this->view->generate('view_cabinet.php', 'view_form.php', $data);
    }

    function action_change(){
        $data['settings']=1;
        if(isset($this->way[START_POSITION + 2])&&($_SESSION['RULES']==3))
            $object=$this->way[START_POSITION + 2];
        else{
         if(isset($_SESSION['RULES']))
            $object=null;
            else
            header("location:".URL_BASE."/404");
        }
        $data['profile']=$this->model_cabinet->find_person(null);
        $data['person']=$this->model_cabinet->find_person($object);
        $this->view->generate('view_cabinet.php', 'view_form.php', $data);
    }

    function action_save(){
        if($_SESSION['RULES']<3){
            $data['profile']=$this->model_cabinet->find_person(null);
            if($this->way[START_POSITION + 2]==$data['profile'][0])
                $data['error']=$this->model_cabinet->save_person($this->way[START_POSITION + 2]);
            else
                header("location:".URL_BASE."/404");
        }
        else
            $data['error']=$this->model_cabinet->save_person($this->way[START_POSITION + 2]);

        $data['settings']=1;
        if(isset($this->way[START_POSITION + 2])&&($_SESSION['RULES']==3))
            $object=$this->way[START_POSITION + 2];
        else{
            if(isset($_SESSION['RULES']))
                $object=null;
            else
                header("location:".URL_BASE."/404");
        }
        $data['profile']=$this->model_cabinet->find_person(null);
        $data['person']=$this->model_cabinet->find_person($object);
        $this->view->generate('view_cabinet.php', 'view_form.php', $data);
    }

    function action_index()
    {
        $data=null;
        $this->view->generate('view_cabinet.php', 'view_form.php', $data);
    }
}