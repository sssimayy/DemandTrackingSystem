
<?php  
	   session_start();
	   include 'header.php'; 
 	   include 'sidebar.php';
	   include'baglan.php';
	   
 	   if (!isset($_SESSION['username'])) {

 	    	header('Location: login.php');
 	    } 
?>
<style>
						     table,th,td { 
							 border : 2px solid DimGray;
							 color : black; 
							 padding:10px;
							 font-size:14px
							 
							 }
							 table {width : 50%}
							 td {height: 14px;text-align:left;  color : black; text-align:center ;width : 30% }
							 th { text-align:center ;color :Sienna;  font-size:20px }
</style>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-head-line">Güzergah islemleri</h3>
				<?php 
             if(isset($_POST['id'])){
				 
				 $id=$_POST['id'];
			    $_SESSION['güzergah']=$id;
			 }	
			    $rota=$_SESSION['güzergah'];
                 $sql = "select * from routes where name='$rota'";
                 $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
           
				 $row = $sonuckod->fetch();
					 $name=$row['name'];
					 $driver=$row['driver'];
					 
?>
						<center>
				<table>			
    <br><br><tr><th colspan="2"> Bilgileri Güncelle  </th></tr>
			 <form action="" method="post">
		<tr><td><img width="50" height="50" src="assets/img/servis.png" ><b>Güzergah Adı </td> <td><input type="text" name="rota" value="<?php echo $name  ?>"><br></td><tr>
		<tr><td><img width="50" height="50" src="assets/img/söfer.png"><b>Güzergah Şöförü</td><td> <input type="text" name="driver"value="<?php echo $driver ?>" ><br></td></tr>
		<tr><td colspan="2"> <input  class="btn btn-primary" name="yenigüzergah" style="font-size: 20px; "type="submit" value="Kaydet"> </td></tr>
			 </form>
			 </table>
</center>
<?php 
if(isset($_POST['yenigüzergah']))
{

    	
	if (isset($_POST['rota']))
	{ 
         $name =  $_POST['rota'];
	if (isset($_POST['driver']))
	  { 
          $driver1=  $_POST['driver'];
		  if($name==$rota && $driver != $driver1)
		  {
			 
			  if( $db->exec("UPDATE routes SET driver='$driver1' WHERE name='$rota' "))
		         {
					 echo "sofor değğişti";
			        //   header("Location:guzergah.php");
		           }
		  }
		  else if ( $driver==$driver1 && $name != $rota ) { 
            
		           
					  		 $sql = "select name from routes";
							$sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
							$sonuckod->setFetchMode(PDO::FETCH_ASSOC);
							while ( $row = $sonuckod->fetch() )
								{
									if( $name==$row["name"]){
									echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
									<script type="text/javascript">
									var baslik="HATA";
									var icerik="Aynı Güzergahdan zaten var! ";
									swal(baslik,icerik,"error");
									</script>' ; goto end;
										}
								}
					 
			        //header("Location:guzergah.php");
		             }
		    
		  else if( $name != $rota && $driver != $driver1 ){
			 if( $db->exec("UPDATE routes SET name='$name',driver='$driver' WHERE name='$rota' "))
		     {
			      header("Location:guzergah.php");
		     }
		  }
		  
	}
    
}    end:
}
?>
							 
				 	  
								  
			</div>
            </div>
            </div>
        </div>
		

<?php  include 'footer.php'; ?>