<!DOCTYPE html>
<html>

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
					table{ border-collapse: collapse;width:50%; }
 
table, td{border: 1px solid black; text-align:center; padding:10px;font-size:15px}
th{background-color:#dddddd; font-size:20px; text-align:center;padding:10px;}
							 input[type=submit] {
  background-color: #0693cd;
  border: 0;
  border-radius: 5px;
  cursor: pointer;
  color: #fff;
  font-size:16px;
  font-weight: bold;
  line-height: 1.4;
  padding: 5px;
  width: 180px
}
						</style>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-head-line">Günlük Bakiyeler</h3>
<center>
<form action="gunlukbakiyeler.php" method="POST">
 <b><font size="4"> Tarih Seçiniz : </b></font><input type="date" name="bday">
 <?php
                 $sql = "select * from routes";
                 $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
				 echo '&nbsp;&nbsp;&nbsp;&nbsp; <b><font size="4">Güzergah seçiniz :</b></font> <select name="secim" >'; 
				echo ' <option disabled selected value> -- Güzergah Seçiniz -- </option>';
				 while ( $row = $sonuckod->fetch() )
             {
                echo '<option value="'.$row['name'].'">'.$row['name'].'</option>'; 
             }
			 
				  echo '</select>';
				  echo "&nbsp;&nbsp;";
				 ?>
  <input type="submit" value="Bakiyeleri Göster">
</form>
<table>
           <?php 
		  
		        if(isset ($_POST['bday']) && isset($_POST['secim']))
				{
				    $route=$_POST['secim'];
					$_SESSION['rota']=$route;
					$bakiyedate=$_POST['bday'];
					$_SESSION['date']=$bakiyedate;
					$date = new DateTime($bakiyedate);
                    $convertdate=$date->format('d.m.Y');
					 
                  
				 $sql="select * from dealers where  dealers.route='$route' and status='1'";
                 $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
				if($sonuckod->rowCount())
				{					
			   
				echo "<form action='' method='POST'>";
				echo "<font size='4' color='dodgerblue';><b><br>".$route."&nbsp; için&nbsp;". $convertdate."&nbsp;tarihindeki bakiye bilgileri</font></b><br><br>";
                
				 $route1="";
				 $bayi="";
				 echo "<th colspan='4'>".$route."</th>";
				  echo "<tr><td style='color:limegreen' ><b> Bayi Adı </td><td style='color:limegreen' ><b> Bakiyesi </td><td style='color:limegreen'> <b>Tahsilat</b> </td><td style='color:limegreen'> <b>Guncel Borc</b> </td><tr>";
				  while ( $row = $sonuckod->fetch() )
				  {  
			            $dealerid=$row['id'];
			  $sonuckod1 = $db->query("select SUM(cost) AS costtotal from tradelogs where dealer_id='$dealerid' and date='$bakiyedate'");
			  $sonuckod1->setFetchMode(PDO::FETCH_ASSOC);
		       $row1=$sonuckod1->fetch();       
			            if($route1==$route)
					{
						echo "<tr><td>".$row['name']."</td><td>".$row1['costtotal']."  TL</td><td><input type='text' name='bakiye[]'  size='10' > </td>";
						$sonuckod2= $db->query("select daily_balance from balance_log where dealer_id='$dealerid' and date='$bakiyedate'");
						$sonuckod2->setFetchMode(PDO::FETCH_ASSOC);
						$balance=$sonuckod2->fetch();
						$total=$row1['costtotal']+$balance['daily_balance'];
						if( $db->exec("UPDATE balance_log SET daily_balance='$total' WHERE dealer_id='$dealerid' and Date='$bakiyedate' ")){}
						echo "<td>".$total."</td></tr>";
						$route1=$route;
					}
					else
					{
						echo "<tr><td>".$row['name']."</td><td>".$row1['costtotal']."  TL</td><td><input type='text' name='bakiye[]' size='10' ></td>";
						$sonuckod2= $db->query("select daily_balance from balance_log where dealer_id='$dealerid' and date='$bakiyedate'");
						$sonuckod2->setFetchMode(PDO::FETCH_ASSOC);
						$balance=$sonuckod2->fetch();
						$total=$row1['costtotal']+$balance['daily_balance'];
						echo "<td>".$total."</td></tr>";
						$route1=$route;
					}
				        					   
				  }
				 
				}
				else 
				{
					?>
					<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script type="text/javascript">
var baslik="HATA";
var icerik="Şuan Bakiye Bigilerini Göremezsiniz ! ";
swal(baslik,icerik,"error");
</script><?php
					
				}
				
				}
				
			               
		   ?>
		  
		   </table>
		  <br> <input type='submit' name='guncelbakiye' value='Bakiyeleri Güncelle'></form>
		    <?php 
		 
		  if (isset($_POST['guncelbakiye'])){
			  
			  
			 $bakiye=$_POST['bakiye'];
			$rota=$_SESSION['rota'];
		  $i=0;
			
			$sonuckod = $db->query("Select * from dealers where route='$rota' and status='1'"); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);

				   while ( $row = $sonuckod->fetch() ){
			           $cost=$bakiye[$i];
					   $balancedate=$_SESSION['date'];
					   $sonuckod6 = $db->query("select daily_balance from balance_log where dealer_id='".$row['id']."' and date='$balancedate'");
					    $sonuckod6->setFetchMode(PDO::FETCH_ASSOC);
						$balancetot=$sonuckod6->fetch();
						//echo $balancetot['daily_balance'];
						$newbalance=$balancetot['daily_balance']-$bakiye[$i];
                //echo $newbalance."  id: ".$row['id'].'<br />';
				if( $db->exec("UPDATE balance_log SET daily_balance='$newbalance' WHERE dealer_id='".$row['id']."' and Date='$balancedate' ")){}
                     $i++;
                }
				header("Location:test.php");
		   }
		  
		  ?>
                    </div>
                </div>
            </div>
        </div>

<?php  include 'footer.php'; ?>
</html>