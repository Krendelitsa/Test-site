<?php

class Model_user_access extends Model
{
    public function user()
    {
        $hash = createHash(12);
        if (isset($_POST['enter']))
            $data = $this->enter($hash);
        if (isset($_POST['register']))
             $data = $this->register($hash);
        return $data;
    }

    public function enter($hash)
    {

        $err[0]=0;
        if(($_POST['login']!='')&&($_POST['password']!='')){
        $login = $this->db->real_escape_string($_POST['login']);
        $result = $this->db->query("SELECT * FROM users_chat WHERE login='$login'");
        if (isset($result)){
            $result = mysqli_fetch_row($result);
            if ($_POST['password'] == $result['2']) {
                $myresult = $this->db->query("SELECT * FROM hash WHERE id_user={$result['0']}");
                $myresult = mysqli_fetch_row($myresult);
                if (!isset($myresult)) {
                    $id = $result[0];
                    $myresult = $this->db->query("INSERT INTO hash (hash,id_user) VALUES ('$hash','$id')");
                    $myresult = $this->db->query("SELECT * FROM hash WHERE id_user={$result['0']} ");
                    $myresult = mysqli_fetch_row($myresult);
                }
               setcookie("hash", $myresult[2], time()+60*60*24*30,URL_BASE);
                $err[1] = "Добро пожаловать на портал";
                   $_SESSION['RULES']=1;
             header("location: ".URL_BASE."/main");
            } else {
                $err[0]=1;
                $err[1] = "Ошибка! Логин или пароль введены не верно.";
            }
            }
        else {
            $err[0]=1;
            $err[1] = "Ошибка! Логин или пароль введены не верно.";
        }
        }
        else{
            $err[0]=1;
            $err[1]="Ошибка! Логин или пароль введены не верно.";
        }
      return $err[1];
    }

    public function register($hash)
    {
        $err[0]=0;
        if(($_POST['login']!='')&&($_POST['password']!='')){
            $login = $this->db->real_escape_string($_POST['login']);
            $login=htmlspecialchars($login);
            $result = $this->db->query("SELECT * FROM users_chat WHERE login='$login'");
            $result = mysqli_fetch_row($result);
            debug($result);
            if ($result==NULL){
                if (($_POST['password'] == $_POST['pass_repeat'])) {
                    $all = array();
                    foreach ($_POST as $key => $value) {
                        if ($key != "register") {
                            $all[$key] = $this->db->real_escape_string($value);
                        }
                    }
                    $myresult = $this->db->query("INSERT INTO users_chat(login,password,email) VALUES('{$all['login']}','{$all['password']}','{$all['email']}')");
                    debug($this->db->error);
                    $result = $this->db->query("SELECT id FROM users_chat ORDER BY id DESC LIMIT 1");
                    $result = mysqli_fetch_row($result);
                    $id = $result[0];
                    $myresult = $this->db->query("INSERT INTO hash (hash,id_user) VALUES ('$hash','$id')");
                    $myresult = $this->db->query("SELECT * FROM hash WHERE id_user={$result['0']}");
                    $myresult = mysqli_fetch_row($myresult);
                    setcookie("hash", $myresult[2], time()+60*60*24*30,URL_BASE);
                    $err[1] = "Добро пожаловать на портал";
                    $_SESSION['RULES']=1;
                    header("location: ".URL_BASE."/main");
                } else {
                    $err[0]=1;
                    $err[1] = "Ошибка! Пароли не совпадают.";
                }
            }
            else {
                $err[0]=1;
                $err[1] = "Ошибка! Логин уже занят.";
            }
        }
        else{
            $err[0]=1;
            $err[1] = "Ошибка! Не все поля заполнены.";
        }
        return $err[1];
    }

    public function exit_cab()
    {
        $_SESSION["hash"]="";
        setcookie('hash', '', time()-3600,URL_BASE);
        header("location: ".URL_BASE."/enter");
        session_destroy();
    }


}

