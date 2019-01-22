
<?php  
	   session_start();
	   include 'header.php'; 
 	   include 'sidebar.php';
	  include 'baglan.php';
 	   if (!isset($_SESSION['username'])) {

 	    	header('Location: login.php');
 	    } 
		ob_start();
?><head>
  <style>

table{ border-collapse: collapse;width:50%; }
 
table, td ,th{border: 1px solid black; text-align:center; padding:5px;font-size:20px}
th{  background-color:#dddddd;font-size:20px}

</style>
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  
</head>

<!--Index-->

  <div id="page-wrapper">
     <div id="page-inner">
        <div class="row">
           <div class="col-md-12">
             <h3 class="page-head-line">ÜRÜN BİLGİSİ</h3>
			 <center>
                <h2> Ürünler <h2>
				
				
			<table>

<tr><th>No</th><th>Bayi Adı</th><th>İşlem</th></tr>
<?php 
$i=1;
foreach($db->query('SELECT * FROM products where status="1"') as $listele) {
    $id = $listele['id'];
	$name = $listele['name'];
	
	echo '<tr><td><form action="" method="POST">'.$i.'</td><td>'.$name.'</td><td><input type="text" name="id" style="display:none; width:30px;" value="'.$id.'"><input type="submit" class="btn btn-danger" value="Sil"></td></tr></form>';
	$i++; ;
	}
	?>
</table>
			  	
			

<?php ob_end_flush(); ?>	


				      <form action=""  method="post"> 
						<label style="font-size: 25px"><br><br>Ürün Adı :</label>  <input style="font-size: 20px; text-align: center " type="text" name="ürün"> 
						<input  class="btn btn-primary" style="font-size: 20px;width:150px;height:40px "type="submit" value="Ürün Ekle">
					</center>
					<?php 
					
if(isset($_POST['id'])){	
$id = $_POST['id'];
$_SESSION['id']=$id;
echo   '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script type="text/javascript">
                     swal({ 
					 title:"Ürün Silmek İstediğinize Eminmisiniz ? ",
					 icon :"warning",
					 buttons:true,
					 dangerMode:true,	 
					 })
					 .then((sil) => { 
					 if (sil)
					 { 
						  window.location.href = "urun.php?deleted=1"  ;
				 }
				 
					 });
                    </script>	';
				
					
}		?>		

		<?php			if(isset($_GET["deleted"]))
					{
						$id = $_SESSION['id'];
							$silme = $db->exec("Update products SET status='0' WHERE id='$id'");
							header('Location:urun.php');
							
							}
					 
					?>
 <?php 
if(isset($_POST['ürün'])){
	$name=$_POST['ürün'];
 $sql = "select name from products";
     $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
     $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
	 if(!empty($_POST["ürün"])) {
		
             while ( $row = $sonuckod->fetch() )
             {
				 if($row['name'] ==$name)
				 { echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script type="text/javascript">
var baslik="HATA";
var icerik="Aynı Ürün Zaten Var! ";
swal(baslik,icerik,"error");
</script>' ; goto end ;} 
	            
             }
		if($db->exec("INSERT INTO products (name,status) VALUES ('$name',1)"))

		{
			header("Location:urun.php");    

         }

         else

         {

          echo 'Kayıt İşlemi Başarısız Olmuştur.';
           header("Location:urun.php");
         }
	}
	else { echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script type="text/javascript">
var baslik="HATA";
var icerik="Lütfen Ürün İsmini Giriniz ! ";
swal(baslik,icerik,"error");
</script>';}
}
     
		  end :		 
		  
		
?>

							
				</div>
                </div>
            </div>
        </div>

<?php  include 'footer.php'; ?>
