<?php  
	   session_start();
	   include 'header.php'; 
 	   include 'sidebar.php';
	   include 'baglan.php';
	   
 	   if (!isset($_SESSION['username'])) {

 	    	header('Location: login.php');
 	    } 
?>
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

<!--Index-->


  <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-head-line">SMS</h3>
                        <h2 align="left" > Günlük bakiye bilgileri SMS olarak gönderilsin mi? <br><br></h2>
						<style>
									#my_centered_buttons_older { margin: auto; width: 100px;}
						</style>
						<form action="" method="POST">
						Tarih Seçiniz :<input type="date" name="bday"><br><br>
            <font size="4"><strong> <input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);" />  Tümünü Seç</strong></font><br><br>
					   <div class='scroll'> 
          <?php  
                 $sql = "select * from dealers where status='1'";
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
						<input type="submit" name="sms" Value="Gönder" >  
						
          
              
						</form>
						 

                    </div>
                </div>
              
            

            </div>
        </div>
        
        
        <?php
     
  if(isset($_POST['sms']) && !empty($_POST['bday']) && isset($_POST["bayiler"]))
  {
	      $bayiler=$_POST["bayiler"];
        $date=$_POST['bday'];
	   $datedüze = new DateTime($date);
	  $convertdate=$datedüze->format('d.m.Y');
	// $sql = "select dealers.phone_num,balance_log.daily_balance from dealers,balance_log  where balance_log.Date='$date' and dealers.status='1'";
    foreach($bayiler as $bayi){
                 $sql = "select * from dealers where status=1 and name='$bayi'";
                 $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
                 while ( $row = $sonuckod->fetch() )
				  {
					  $id=$row['id'];
					  $telno=$row['phone_num'];
					 $sql1="select * from balance_log where dealer_id='$id' and Date='$date'";
			           $sonuckod1 = $db->query($sql1);
					  $sonuckod1->setFetchMode(PDO::FETCH_ASSOC);
					   while ( $row1 = $sonuckod1->fetch() )
					   {
						  $balance=$row1['daily_balance'];
						  $sql3="Select SUM(cost) as valuesum from tradelogs where dealer_id='$id' and date='$date'";
						  $sonuckodlast = $db->query($sql3); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
                          $sonuckodlast->setFetchMode(PDO::FETCH_ASSOC);
						   $rowlast=$sonuckodlast->fetch();
							 $amount=$rowlast['valuesum'];
							 
						   $messages = array(
          array(
            "msg" => "Bugün aldığınız ekmek ".$amount." adettir. Kalan borcunuz ".$balance." TL' dir.",
            "dest" => $telno
          ),
         
    );

    $kampanya = array(
        "baslik" => "CANSU EKIN",
        "mesajlar" => $messages,
    );

    $ch = curl_init('https://vairosms.com/Panel/api/v1/SmsGonder?api_key=5c1d1bbb78ca5_fkDtOAT9GoibTQ67');
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        CURLOPT_POSTFIELDS => json_encode($kampanya),
        CURLOPT_SSL_VERIFYPEER => false,
    ));

    $http_response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);  

   // return $http_response;
						   
					   }
					
				  }
                 
		}	
  }
?>
<?php  include 'footer.php'; ?>