<?php 
session_start();
if(isset($_GET['check']))
	echo "<script>alert('Kullanıcı bilgileri yanlış')</script>";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kullanıcı Paneli</title>


  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  
  <link href="assets/css/font-awesome.css" rel="stylesheet" />

  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  <style>


body{

  background-image: url("assets/img/lale5.jpg");
  background-size: cover;
}


  </style>
</head>
<body >
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
           
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                <div class="panel-body" method="POST">
                    <form action="islem.php">
                        <hr />
						
                     <center><h3>Üye Girişi</h3></center> 
                        <br />
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Kullanıcı Adı " />
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                            <input type="password" class="form-control" name="password"  placeholder="Parola" />
                        </div>
                        

                    
                 <button style="width:100%" type="submit" name="loggin" class="btn btn-primary">Giriş Yap</button>
                     <hr />
                     
                 </form>
             </div>

         </div>


     </div>
 </div>

</body>
</html>
