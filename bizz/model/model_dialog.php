<?php
class Model_dialog extends Model
{

    public function find_person()
    {

        $result = $this->db->query("SELECT id_user FROM hash WHERE hash='{$_COOKIE["hash"]}'");
        $myresult = mysqli_fetch_row($result);
        if (isset($myresult)) {
            $myresult = $this->db->query("SELECT * FROM users_chat WHERE id='$myresult[0]'");
        }
        $myresult = mysqli_fetch_row($myresult);
        if (isset($myresult)) {
            return $myresult;
        }
    }

    public function save_mess(){
        $me=$this->find_person();
        $idt=$this->db->real_escape_string($_POST['id']);
        $mess = $this->db->real_escape_string($_POST['mess']);
        $idt=htmlspecialchars($idt);
        $mess=htmlspecialchars($mess);
        $mess="\"".$mess."\"";
        if($mess!=""){
            $date=time();
            $result=$this->db->query("INSERT INTO messages(id_user,id_theme,textik,status,data) VALUES({$me[0]},$idt,$mess,1,$date)");
        }
    }

    public function list_mess(){
        $me=$this->find_person();
        $idt=$this->db->real_escape_string($_POST['id']);
        $idt=htmlspecialchars($idt);
        $result=$this->db->query("SELECT messages.*,users_chat.login,users_chat.img FROM messages,users_chat where messages.id_theme=$idt and users_chat.id=messages.id_user ORDER BY messages.data ASC");
         if (isset($result)) {
          while ( $row = mysqli_fetch_row($result)) {
            $mess[] = $row;
        }}
         for($i=0;$i<count($mess);$i++){
                if($mess[$i][1]==$me[0])
                    $mess[$i]['me']="me";
                else
                    $mess[$i]['me']="";
                $mess[$i][5]=date('H:i:s d.m.y',$mess[$i][5]);
            }
            echo json_encode($mess);
      }
   
}



