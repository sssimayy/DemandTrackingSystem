<?php  
	   session_start();
	   include 'header.php'; 
 	   include 'sidebar.php';
	   include 'baglan.php';
	   
 	   if (!isset($_SESSION['username'])) {

 	    	header('Location: login.php');
 	    } 
?>

<!--Index-->
<style>
.scroll {
    width:575px;
    height:200px;
    overflow: scroll;
}
table{ border-collapse: collapse;width:100%; }
 
table, td ,th{border: 1px solid black; text-align:center; padding:5px;}
th{  background-color:tan;}
tr:nth-child(even) {background:khaki}
tr:nth-child(odd) {background: #FFF}


</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
		function check_uncheck_checkbox(isChecked) {
			if(isChecked) {
				$('input[name="bayiler[]"]').each(function() { 
					this.checked = true; 
				});
			} else {
				$('input[name="bayiler[]"]').each(function() {
					this.checked = false;
				});
			}
		}
</script>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-head-line">Sevk İrsalİyesİ</h3>
						<style>
									#my_centered_buttons_older { margin: auto; width: 100px;}
						</style>
                       <form action="generate_pdf.php"  method="post">
					    <font size="4"><strong>Düzenleme Tarihi: </strong></font><input type="date" name="dday"><?php echo "&nbsp;&nbsp;&nbsp"?>
					   <font size="4"><strong>Sevk Tarihi : </strong></font> <input type="date" name="sday">
					  <br><br>
					   <font size="4"><strong> <input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);" />  Tümünü Seç</strong></font><br><br>
					   <div class='scroll'> 
                           <?php  $sql = "select * from dealers where status='1'";
						    echo "<table><tr><th>Bayi Kodu </th><th> Firma Adı  </th><th> Servis Aracı </th></tr>";
                 $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
				 
				   while ( $row = $sonuckod->fetch() )
				  {
				   echo "<tr class='tr'><td><input type='checkbox' name='bayiler[]' value='".$row['name']."'/>".$row['id']."</td><td>".$row['name']."</td><td>".$row['route']."</td></tr>";
                
				  }
				
				 ?>
				 </table>
				  </div>
				  
                        <br><input  class="btn btn-success" style="font-size: 20px; "type="submit" value="Çıktı Al"> 
                       </form>  
					

				

                    </div>
                </div>
            </div>
        </div>
        <?php  include 'footer.php'; ?>