<?php
class Controller_Theme extends Controller
{
     var $model_mail=NULL;
    public function __construct($way)
    {
        parent::__construct($way);
        $this->model_mail = new Model_theme();
        $this->model_user = new Model_user();
    }

    function action_addlog()
    {
        $this->model_mail->create_chat();
    }

    function action_updatelog()
    {
        $this->model_mail->update_chat();
    }

    function action_dellog()
    {
        $this->model_mail->delete_chat();
    }

    function action_index()
    {

        $data['theme']=$this->model_mail->setting_chat($this->way[START_POSITION + 2]);
        $data['list']=$this->model_user->list_member_s($this->way[START_POSITION + 2]);
        $this->view->generate('view_settchat.php', 'view_form.php',$data);
    }

}