<?php
class Model_Theme extends Model
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

        public function create_chat(){
        $me=$this->find_person();
        $result=$this->db->query("INSERT INTO chat_thems(id_creator,name,status) VALUES({$me[0]},'',1)");
        $myresult=$this->db->query("SELECT * FROM chat_thems ORDER by id DESC LIMIT 1");
            if($myresult){
            while($row=mysqli_fetch_row($myresult)){
                
                $theme=$row;
            }}
        $result=$this->db->query("INSERT INTO chat_access(id_theme,id_user,read_status,status) VALUES({$theme[0]},{$me[0]},0,4)");
        header("Location: ".URL_BASE."/theme/index/".$theme[0]);
    }

    public function setting_chat($itheme){
            $result=$this->db->query("SELECT * FROM chat_thems where id=$itheme");
            if($result){
            while($row=mysqli_fetch_row($result)){
                $theme=$row;
            }}
            $result=$this->db->query("SELECT COUNT(id_user) as a FROM chat_access where id_theme=$theme[0]");
            if($result){
            while($row=mysqli_fetch_row($result)){
                $theme[]=$row[0];
            }}
        return $theme;
    }

    public function update_chat(){
        $theme= array();
        $i=0;
        foreach ($_POST as $value) {
        $theme[$i] = $this->db->real_escape_string($value);
        $theme[$i] =htmlspecialchars($theme[$i]);
        $i++;
        }
        if($_FILES['avatar']!=NULL)
        $theme['avatar']=photo_save($_FILES['avatar']);
            if(!(is_string($theme['avatar'][1]))) {
                if ($_FILES['avatar']['name']!='')
            $myresult = $this->db->query("UPDATE chat_thems SET name='{$theme[1]}',img='{$theme['avatar'][0]}', status=2 where id={$theme[0]}");
                        else
            $myresult = $this->db->query("UPDATE chat_thems SET name='{$theme[1]}', status=2 where id={$theme[0]}");
                    }
        return json_encode($theme);
    }

    public function delete_chat(){
            $myresult = $this->db->query("UPDATE chat_thems SET status=0 where id={$_POST['id']}");
    }
}