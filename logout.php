<?php 
	session_destroy(); //Destroy session
	//header("Location: login.php");
  if(!isset($_SESSION['username'])){
    header('location:login.php');
}
if (ini_get("session.use_cookies")) { //Kill cookies!!! aww yiss
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

?>