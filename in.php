
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
<!--Index-->

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-head-line">Güzergah islemleri</h3><br><br>
            <center>   
<table>			
    <tr><th colspan="2"> Yeni Güzergah Bilgileri </th></tr>
			 <form action="" method="post">
		<tr><td><img width="50" height="50" src="assets/img/servis.png" ><b> Güzergah Adı </td> <td><input type="text" name="rota"><br></td><tr>
		<tr><td><img width="50" height="50" src="assets/img/söfer.png"><b>Güzergah Şöförü</td><td> <input type="text" name="driver"><br></td></tr>
		<tr><td colspan="2"> <input  class="btn btn-success" style="font-size: 20px; "type="submit" value="Güzergah Ekle"> </td></tr>
			 </form>
			 </table>
</center>

 <?php 
if($_POST){
     $sql = "select name from routes";
     $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
     $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
	 if(!empty($_POST["rota"]) && !empty($_POST["driver"])){
		 $yenirota=$_POST["rota"];
		 $soforadı=$_POST["driver"];
		   while ( $row = $sonuckod->fetch() )
             {
				 if($row["name"]==$yenirota){
					 echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					       <script type="text/javascript">
							var baslik="HATA";
							var icerik="Aynı Güzergahdan zaten var! ";
							swal(baslik,icerik,"error");
							</script>' ; goto end ;
				 }
				
			 }
		 
	 }
	
	if($db->exec("INSERT INTO routes (name,driver) VALUES ('$yenirota','$soforadı')"))

         {

               echo 'Yeni Kayıt Eklendi.';
			    header("Location:guzergah.php");

         }
		 end :
} 	

?>


			</div>
            </div>
            </div>
        </div>
		

<?php  include 'footer.php'; ?>