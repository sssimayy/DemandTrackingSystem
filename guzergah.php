
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
							 border : 1px solid gray;
							
							 color : black; 
							 padding:10px;
							 font-size:14px
							 
							 }
							 table {width : 50%}
							 td {height: 14px;text-align:left;  color : black; text-align:center ;width : 30%  }
							 th { text-align:center ;color : red; }
						</style>
<!--Index-->

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-head-line">Güzergah islemleri</h3>
                          
<center>				
              <h2> Güzergah İşlemleri<h2> 
			<table cellpadding="4" cellspacing="0" border="0" width="300" style="font-family:Tahoma; font-size:14px; border:solid; border-color:#999999; border-width:1px;">

<tr style="background-color:#dddddd;"><td>Şoför Adı</td><td>Güzergah Adı</td><td colspan=2 >İşlem</td></tr>
<?php 

foreach($db->query('SELECT * FROM routes') as $listele) {
	 $id = $listele['id'];
	$name = $listele['name'];
	$driver=$listele['driver'];
	echo '<tr><td>'.$driver.'</td><td>'.$name.'</td><form action="guzduz.php" method="POST"><td><input type="text" name="id" style="display:none; width:30px;" value="'.$name.'"><input type="submit" class="btn btn-primary" value="Düzenle"></td></tr></form>';

	
	}
	?>
</table>
                            <form action="in.php"  method="post">
						<br><input  class="btn btn-success" style="font-size: 20px; "type="submit" value="Güzergah Ekle"> 
							</form>
							<?php
if(isset($_POST['guzsil'])){

$id = $_POST['guzsil'];
$_SESSION['sil']=$id;

echo   '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script type="text/javascript">
                     swal({ 
					 title:"Güzergahı Tamamen Silmek İstediğinize Eminmisiniz ? ",
					 icon :"warning",
					 buttons:true,
					 dangerMode:true,	 
					 })
					 .then((sil) => { 
					 if (sil)
					 { 
						  window.location.href = "guzergah.php?deleted=1"  ;
				 }
				 
					 });
                    </script>	';
				
					
}		?>		

</center>
			</div>
            </div>
            </div>
        </div>
		

<?php  include 'footer.php'; ?>