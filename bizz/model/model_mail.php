<?php
class Model_mail extends Model
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

    public function search(){
        $id=array();
        $searcher = $this->db->real_escape_string($_POST['search']);
        $result=$this->db->query("SELECT id from users_chat where login like '%$searcher%'");
        while ($row = mysqli_fetch_array($result)) {
            $id[] = $row[0];
        }
        if($id!=null){
            if(count($id)==1)
            header("location:".URL_BASE."/mail/dialog/".$id[0]);
            else
                $result=$this->many_search($id);
        }
        else
            header("location:".URL_BASE."/mail/index/unf");
        return $result;
    }

    public function many_search($mass){
        $me=$this->find_person();
        $all_mess=array();
        $dialogs=array();
        $users=array();
        $form_user=array();
        $ids=implode(', ',$mass);
        $result=$this->db->query("SELECT * from users_chat where id in ($ids)");
        while($row=mysqli_fetch_row($result)){
            $users[]=$row;
        }
        foreach ($users as $value){
            $myresult=$this->db->query("SELECT * FROM message where (id_author='$me[0]' and id_reader='$value[0]') or (id_author='$value[0]' and id_reader='$me[0]') ORDER by mdate DESC LIMIT 1");
            if($myresult){
            while($row=mysqli_fetch_row($myresult)){
                $all_mess[]=$row;
            }}
        }

        foreach ($users as $value){
            $form_user[]=$value;
        }

        for($j=0;$j<count($all_mess);$j++){
            for($i=0;$i<count($all_mess)-1;$i++){
                $wallet=$all_mess[$i+1];
                if($all_mess[$i][5]<$all_mess[$i+1][5]){
                    $all_mess[$i+1]=$all_mess[$i];
                    $all_mess[$i]=$wallet;
                }
            }}
        $users=array();
        foreach ($form_user as $value){
            foreach ($all_mess as $ulue){
                if($ulue[1]==$value[0])
                    $value['aut']=$ulue;
                if($ulue[2]==$value[0])
                    $value['red']=$ulue;
            }
            $users[]=$value;
        }
        $return[]=$me[0];
        $return[]=$users;
        return $return;
    }

    public function theme_list(){

        $me=$this->find_person();
        $themes=array();
        $last_mess=array();
        $myresult=array();
            $result=$this->db->query("SELECT * FROM chat_access where id_user={$me[0]} ORDER by read_status DESC");
            while($row=mysqli_fetch_row($result)){
               $id_thems[]=$row[1];
                 }
            $idt=implode(', ',$id_thems);
            $result=$this->db->query("SELECT * FROM chat_thems where id IN ($idt) and status>1");
            while($row=mysqli_fetch_row($result)){
               $themes[]=$row;
                 }
            $result=$this->db->query("SELECT messages.*,users_chat.login FROM messages,users_chat where id_theme IN ($idt) and users_chat.id=messages.id_user GROUP BY id_theme,data ASC");
            if($result){
             while($row=mysqli_fetch_row($result)){
               $last_mess[]=$row;
                 }}

            for($j=0;$j<count($last_mess);$j++){
                for($i=0;$i<count($themes);$i++){
                   if($themes[$i][0]==$last_mess[$j][2]){
                        $themes[$i]['mess']=$last_mess[$j];
                        $themes[$i]['mess'][5]=date('H:i:s d.m.y',$themes[$i]['mess'][5]);}
                }
            }

                for($i=0;$i<count($themes);$i++){
                    if($themes[$i][1]==$me[0])
                      $themes[$i]['creator']=1;  
                }

            echo json_encode($themes);
        }

}