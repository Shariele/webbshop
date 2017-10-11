<!--Dena sida fungerar som en funktionssida fast är en web sida. Här kallas funktioner vid behov, olika beräkningar
och dirigeringar händer också här. 
Det kan sägas att denna sida är till för de stora funktionerna som finns på bloggen, därefter tas hjälp från funktioner 
vid behov.
Ersätts av phpScripts.php egentligen, orkar bara inte flytta över dessa funktioner nu.
-->

<?php
//Klasser skall inkluderas innan sessionen startar.
include "include/classes/user.php";
session_start();
session_name("webshop");

$action = 0;

if(isset($_GET['action'])){
    $action = $_GET['action'];
}
if(isset($_POST['action'])){
    $action = $_POST['action'];
}

include "include/connect_db.php";
include "include/log.php";
include "include/functions.php";

switch($action){

	case'log_out':
        $log_out = 0;
        $user_log_out = 0;

        if(isset($_GET['log_out'])){
            $log_out = $_GET['log_out'];
        }
        
        if($log_out == 1){
            log_to_file("log.log", "User " . $_SESSION['user']->Get_name() . " logged out");
            session_unset("webshop");
            session_destroy("webshop");

            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
        break;

    case'login':
        $username = $_POST['username'];
        $str = $_POST['password'];

        //Krypterar lösenordet med md5
        $password = md5($str);

        $sql = "SELECT * FROM account WHERE username = '$username' AND BINARY password='$password'";
        $sth = $pdo->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();
        if(!empty($result)){
            log_to_file("log.log", "User $username logged in");

            foreach($result as $i){
                $_SESSION['user'] = new User($i['username'], $i['user_type'], $i['acc_id'], $i['email'], $i['full_name'], $i['residental_adress'], $i['zip_code'], 
                    $i['country'], $i['mobile_number'], $i['city'], $i['region']);
            }
            header('location: index.php');
        }else{
            echo "Login failed, please try again";
            log_to_file("log.log", "Login failed by user $username");

            $_SESSION['wrong_pass_name'] = "Wrong username or password!";
            $_SESSION['wrong'] = '1';
            header('Location: index.php');
        }
        break;

    case'register':
		
        $username = $_POST['username'];
        $str = $_POST['password'];
        $email = $_POST['email'];

        //Krypterar lösenordet med md5
        $password = md5($str);
        
        $adr = $_SERVER['REMOTE_ADDR'];

        $sql = "SELECT * FROM account WHERE username = '$username'";
        $sth = $pdo->prepare($sql);
		$sth->execute();

		$result = $sth->fetchAll();
		if(!empty($result)){
			$_SESSION['existing_username'] = "There is already an user with that username, please try another username";
            header('location: register.php?');
		}else{
			$sql = "INSERT INTO account(username, email, password, ip) VALUES('$username','$email','$password','$adr')";
	        $sth = $pdo->prepare($sql);
			$sth->execute();

			header('location: register.php');
        	log_to_file("log.log", "Account $username has been created");
            $_SESSION['success'] = "Your account has been successfully created!";
		}


        break;

        default:
        	echo "<h1>Error 404 page not found. Please try again!</h1>";
        break;


}
        unset($action);