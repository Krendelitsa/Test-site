<?php
class Controller_Main extends Controller
{
     var $model_mail=NULL;
    public function __construct($way)
    {
        parent::__construct($way);
        $this->model_mail = new Model_mail();
    }

    function action_search(){
        $data['list']=$this->model_mail->search();
        if(isset($this->way[START_POSITION + 2]))
            $data['error']=$this->way[START_POSITION + 2];
            $data['title']='search';
        $this->view->generate('view_mail.php', 'view_form.php',$data);
    }

    function action_dialog()
    {
        $data['mess']=$this->model_mail->take_chat();
        $this->view->generate('view_dialog.php', 'view_form.php',$data);
    }

    function action_updateTheme(){
        $data['list']=$this->model_mail->theme_list();
    }

    function action_index()
    {   
    if(isset($_SESSION['RULES'])&&($_SESSION['RULES']!="")){
        $data['title']='chat';
        $this->view->generate('view_mail.php', 'view_form.php',$data);
    }
        else
            header("location:".URL_BASE."/enter");
    }
}