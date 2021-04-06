<?php
class Model_user extends Model
{

    function find_person($object)
    {

        if($object!=null){
            $myresult = $this->db->query("SELECT * FROM users_chat WHERE id='$object'");
        }
        else{
        $result = $this->db->query("SELECT id_user FROM hash WHERE hash='{$_COOKIE["hash"]}'");
        $myresult = mysqli_fetch_row($result);
        if (isset($myresult)) {
            $myresult = $this->db->query("SELECT * FROM users_chat WHERE id='$myresult[0]'");
        }}

        $myresult = mysqli_fetch_row($myresult);
        if (isset($myresult)) {
            return $myresult;
        }
    }

    public function save_person($object){
        $err[0]=0;
        $all = array();
        if(($_POST['login']!='')&&($_POST['password']!='')){
            $login = $this->db->real_escape_string($_POST['login']);
                    foreach ($_POST as $key => $value) {
                        if ($key != "enter") {
                            $all[$key] = $this->db->real_escape_string($value);
                        }
                    }

          $id=$this->find_person($object);
            $all['avatar']=photo_save($_FILES['avatar']);
            if(!(is_string($all['avatar'][1]))) {
                if ($_FILES['avatar']['name'] != '')
                    $myresult = $this->db->query("UPDATE users_chat SET login='{$all['login']}',password='{$all['password']}',
                 email='{$all['mail']}',img='{$all['avatar'][0]}' where id=$id[0]");
                else
                    $myresult = $this->db->query("UPDATE users_chat SET login='{$all['login']}',password='{$all['password']}',
                 email='{$all['mail']}' where id=$id[0]");
                    $err[1] = "Добро пожаловать на портал";
                     header("location: ".URL_BASE."/cabinet/view/".$object);
            }
            else{
                $err[0]=1;
                $err[1] =$all['avatar'][1];
            }
        }
        else{
            $err[0]=1;
            $err[1] = "Ошибка! Минимум одно из полей не заполнено.";
        }

        return $err;
    }

    public function change_invite($option){
        $theme=(int)$_POST['id'];
        $user=(int)$_POST['oid'];
        if($option==0)
            $result=$this->db->query("INSERT INTO chat_access(id_theme,id_user,read_status,status) values($theme,$user,0,1)");
        else{
            if($option==1)
                $result=$this->db->query("UPDATE chat_access SET status=3 WHERE id_user=$user and id_theme=$theme");
            else{
                if($option==2)
                    $result=$this->db->query("UPDATE chat_access SET status=2 WHERE id_user=$user and id_theme=$theme");
            }
        }
    }

    public function take_invite(){
        $me=$this->find_person(null);
        $theme=$_POST['id'];
        $result=$this->db->query("UPDATE chat_access SET status=2 WHERE id_user={$me[0]} and id_theme=$theme");
    }

    public function cancel_invite(){
        $me=$this->find_person(null);
        $theme=$_POST['id'];
        $result=$this->db->query("UPDATE chat_access SET status=0 WHERE id_user={$me[0]} and id_theme=$theme");
    }

    public function list_invite(){
         $me=$this->find_person(null);
         $result=$this->db->query("SELECT chat_access.*,users_chat.login,chat_thems.name,chat_thems.img from chat_access,chat_thems,users_chat where chat_access.id_user={$me[0]} and chat_thems.id=chat_access.id_theme and users_chat.id=chat_thems.id_creator");
         if($result){
            while($row=mysqli_fetch_row($result)){
                $themes[]=$row;
            }}

            echo json_encode($themes);
    }

    public function list_member_s($idt){
         $result=$this->db->query("SELECT * from users_chat,chat_access where chat_access.id_theme=$idt and users_chat.id=chat_access.id_user");
         if($result){
            while($row=mysqli_fetch_row($result)){
                $members[]=$row;
            }}
        return $members;
    }

    public function list_member($option){
        $idt=$_POST['id'];
        if($option=="NOT"){
            $myresult=$this->db->query("SELECT id_user from chat_access where id_theme=$idt");
            while($row=mysqli_fetch_row($myresult)){
                $ids[]=(int)$row[0];
            }
            $idis=implode(', ',$ids);
            $result=$this->db->query("SELECT * from users_chat where users_chat.id NOT IN ($idis)");
        }
        else{
         $result=$this->db->query("SELECT * from users_chat,chat_access where chat_access.id_theme=$idt and chat_access.status>0 and users_chat.id=chat_access.id_user");
     }
         if($result){
            while($row=mysqli_fetch_row($result)){
                $members[]=$row;
            }}
        echo json_encode($members);
    }

}