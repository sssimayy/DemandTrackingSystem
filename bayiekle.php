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
							 th { text-align:center ;color :Black;  font-size:20px }
						</style>
						<?php 
						
						
					
if(isset($_POST['gname']))
{   	
    $gname=$_POST['gname'];
	$_SESSION['gname']=$gname;
}
						
						?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <center>   <h3 class="page-head-line"><?php echo "" .$_SESSION['gname']."'NİN BAYİ FORMU"?></h3><br></center>
            <center> 
<table>			
    <tr><th colspan="2" ><img width="50" height="50" src="assets/img/form.png"> BAYI BILGI FORMU </th></tr>
			 <form action="" method="post">
		<tr><td><b><img width="50" height="50" src="assets/img/bayiadi.png"> Firma Adı </td> <td><input type="text" name="yenibayi"><br> </h4></td><tr>
		<tr><td><img width="50" height="50" src="assets/img/sahibi.png"><b> Yetkili Adı </td><td> <input type="text" name="yetkili"><br></h4></td></tr>
			 	<tr><td> <img width="50" height="50" src="assets/img/adres.png"><b>Bayi Adresi  </td><td> <input type="text" name="adres"><br></td></tr>
				<tr><td><img width="50" height="50" src="assets/img/bakiye.png"><b>Bakiyesi  </td><td> <input type="text" name="bakiye" value="0"><br></td></tr>
				<tr><td><img width="50" height="50" src="assets/img/telefon.png"><b>Yetkili Tel No </td><td> <input type="text" name="telno"><br></td></tr>
				<tr><td><img width="50" height="50" src="assets/img/vergino.png"><b>Vergi Numarası  </td><td> <input type="text" name="vergi"><br></td></tr>
				<tr><td><img width="50" height="50" src="assets/img/vergidairesi.png"><b> Vergi Dairesi Adı </b></td><td><input type="text" name="vergiadi"></td></tr>
		<tr><td colspan="2"> <input  class="btn btn-success" style="font-size: 20px; "type="submit" value="Bayi Ekle" name="Ekle"> </td></tr>
			 </form>
			 </table>
</center> 
<?php 
if(isset($_POST['Ekle'])){
	if (isset($_POST['bakiye']))
	{ 
        $bakiye =  $_POST['bakiye'];
		
	}
	$servis=$_SESSION['gname'];
	if(!empty($_POST['yenibayi']) && !empty($_POST['yetkili']) && !empty($_POST['adres']) && !empty($_POST['vergi']) && !empty($_POST['telno']) && !empty($_POST['vergiadi']) ){
	  $_SESSION['gname'];
	$bayi=$_POST['yenibayi'];
	$yetkili=$_POST['yetkili'];
	$servis=$_SESSION['gname'];
	$adres=$_POST['adres'];
	$vergino=$_POST['vergi'];
	$telno=$_POST['telno'];
	$verginame=$_POST['vergiadi'];
	
     	if( $db->exec("INSERT INTO dealers (name,address,balance,route,authorizedPerson,taxnumber,status,phone_num,tax_address)  VALUES ('$bayi','$adres','$bakiye','$servis','$yetkili','$vergino','1','$telno','$verginame') "))
		   {?>
			   					<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script type="text/javascript">
                      var baslik="Tebrikler !";
                  var icerik="Yeni Bayi Eklendi. ";
                   swal(baslik,icerik,"success");
                    </script>
				
		   <?php }
	}
	else 
	{
		echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script type="text/javascript">
var baslik="HATA";
var icerik="Boş Alan Bırakmayınız ! ";
swal(baslik,icerik,"error");
</script>';
	}
	
}
?>


			</div>
            </div>
            </div>
        </div>
		

<?php  include 'footer.php';?>