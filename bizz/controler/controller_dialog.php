<?php
class Controller_Dialog extends Controller
{
     var $model_mail=NULL;
    public function __construct($way)
    {
        parent::__construct($way);
        $this->model_mail = new Model_dialog();
    }

    function action_send(){
        $data['mess']=$this->model_mail->save_mess();
    }

    function action_updateDialog(){
       $data['mess']=$this->model_mail->list_mess();
    }
    

    function action_index()
    {   
    if(isset($_SESSION['RULES'])&&($_SESSION['RULES']!="")){
        $data['idm']=$this->way[4];
        $this->view->generate('view_dialog.php', 'view_form.php',$data);
    }
        else
            header("location:".URL_BASE."/enter");
    }
}