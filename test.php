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

						     table,th,td { 
							 border : 2px solid DimGray;
							 color : black; 
							 padding:5px;
							 font-size:14px
							 
							 }
							 table {width : 40%}
							 td {height: 14px;text-align:left;  color : black; text-align:center ;width : 30% }
							 th { text-align:center ;color :Black;  font-size:20px; background-color:#dddddd; }

	
						</style>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-head-line">Günlük Bakiyeler</h3><center>
						<table><th> Bayi Adı </th><th> Güncel Bakiye </th>
						<?php  
						
						$rota=$_SESSION['rota'];
						 $newdate=$_SESSION['date']; 
						  $date = new DateTime($newdate);
                      $convertdate=$date->format('d.m.Y');
						 echo "<h4><b>".$convertdate." Tarihinde ki ".$rota." 'e Ait Bayilerin Güncel Bakiye Bilgileri</h4><br>" ;
						 $sonuckod = $db->query("Select * from dealers where status='1' and route='$rota'");
				         $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
						 
						 while ( $row = $sonuckod->fetch() ){
							 $id=$row['id'];
							 $sonuckod1 = $db->query("select daily_balance from balance_log where dealer_id='$id' and date=' $newdate' ");
							 $sonuckod1->setFetchMode(PDO::FETCH_ASSOC);
							 $row1 = $sonuckod1->fetch();
							 echo  "<tr><td ><b><font color='darkorange'>".$row['name']." </font></td><td>".$row1['daily_balance']."</td></tr>";
							 
							 
						 }
						
						?>
</table>
</center>
                    </div>
                </div>
            </div>
        </div>

<?php  include 'footer.php'; ?>
</html>