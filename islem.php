

<?php  //veritabanı ile haberleşme

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bitirme";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// --------------LOGIN KONTROLU-----------------

	if (isset($_GET['loggin'])) {

		$username=$_GET['username'];  //
		$password=$_GET['password'];


			if ($username && $password)  { //Eğer şifre ve k.adı varsa sorgula

				$sorgula=("select * from users where username=\"".$username."\" and password=\"".$password."\"" );
				$result = mysqli_query($conn, $sorgula);


				$verisay=mysqli_num_rows($result);
				if ($verisay>0) {
					session_start();
					$_SESSION['username']=$username; //Bu session ile oturum açmış oluyoruz tarayıcıyı kapatana kadar duracak

					header("Location:index.php?username=".$username);  //göndereceğimiz linki yazıyoruz
				} else{ // Veri say dan büyük değilse db kaydında yok buraya yönlenecek
					$_SESSION['check']=false;
					header("Location: login.php?check=false");//Get uygulamak için ? koy
				}
			}
		
	}


 ?>



 