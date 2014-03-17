<?php
session_start();
require_once 'config.inc.php';

Class Admin_login {

    private $user_id;
    private $password;

    public function __construct($user, $pass) {
        $this->user_id = $user;
        $this->password = md5($pass);
        if ($this->Check_user() == true) {
            return true;
        } else {
            return false;
        }
    }

    public function Check_user() {
        $query = "select id from users where usuari = '" . $this->user_id . "' and clau = '" . $this->password . "'";
        mysql_select_db($GLOBALS['dbname']);
        $query_run = mysql_query($query);
        $query_num_rows = mysql_num_rows($query_run);
        if ($query_num_rows == 0) {
            return false;
        } else if ($query_num_rows == 1) {
            $_SESSION['user_id'] = mysql_result($query_run, 0, 'id');
            return true;
        }
    }

    public function loggedin() {
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            header('Location: index_calendari.php');
        } else {
            return false;
        }
    }
}

if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    
    $log = new Admin_login($username = $_POST['username'], $password = $_POST['password']); 
    
    if ($log->Check_user()  == true) {
        $log->loggedin();
    } else {
        echo 'Nom d\'usuari o contransenya incorrectes.';
    }
}
?>
<!--al action del form hi havia  php? $current_file; ? en comptes del hash-->
<div>
    <form action="#" method="POST">
        Nom d'usuari:<input type="text" name="username"/> Contrassenya:<input type="password" name="password"/>
        <input type="submit" value="Log in"/>
    </form>
</div>