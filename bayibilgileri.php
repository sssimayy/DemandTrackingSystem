<!DOCTYPE html>
<?php  
	   session_start();
	   include 'header.php'; 
 	   include 'sidebar.php';
	      include'baglan.php';
 	   if (!isset($_SESSION['username'])) {

 	    	header('Location: login.php');
 	    } 
?>
<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->

<style>
						     table,th,td { 
							 border : 2px solid DimGray;
							 color : black; 
							 padding:10px;
							 font-size:14px
							 
							 }
							 table {width : 50%}
							 td {height: 14px;text-align:left;  color : black; text-align:center ;width : 30% }
							 th { text-align:center ;color :Chocolate;  font-size:20px }

							

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid dimgray;
    background-color:#555;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color:#000;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color:#4CAF50;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid dimgray;
    border-top: none;
}
</style>



        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                       <h3 class="page-head-line">BAYİ İŞLEMLERİ</h3>
                          
                   
	
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'GenelBilgi')"><font color="white">Bayi Genel Bilgileri</button>
  <button class="tablinks" onclick="openCity(event, 'Ürünbilgisi')">Bayi Ürün Bilgileri</button>
  <button class="tablinks" onclick="openCity(event, 'Durum')">Durum</button>
  <button class="tablinks" onclick="openCity(event, 'Ürünfiyati')">Ürün Fiyatı</button></font>
</div>

<div id="GenelBilgi" class="tabcontent">
<center>
<table width="400" border="0" cellpadding="0" cellspacing="0">
  <tr>
    
    <td width="500" valign="ceter" colspan="2" ><h4><b><img width="50" height="50" src="assets/img/form.png">BAYİ BİLGİ FORMU </b></h4></td>
  </tr>
<br>
<?php 
             if(isset($_POST['id'])){
				 
				 $id=$_POST['id'];
			    $_SESSION['bayikodu']=$id;
			 }	
			    $kod=$_SESSION['bayikodu'];
                 $sql = "select * from dealers where id='$kod'";
                 $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
           
				 $row = $sonuckod->fetch();
				     $dealersid=$row['id'];
					 $name=$row['name'];
					 $adres=$row['address'];
					 $balance=$row['balance'];
					 $rota=$row['route'];
					 $yetkili=$row['authorizedPerson'];
					 $status=$row['status'];
					 $telno=$row['phone_num'];
					 $taxnumber=$row['taxnumber'];
					 $taxname=$row['tax_address'];
					
?>

<form action="" method="post">

 <tr><td><img width="50" height="50" src="assets/img/bayi.png"><b>Bayi Kodu </b></td><td> <?php echo $kod ?> </td></tr>
 <tr><td><img width="50" height="50" src="assets/img/bayiadi.png"><b>Firma Adı  </b></td><td><input type="text" name="bayiadi" value="<?php echo $name ?>" ></td></tr>
 <tr><td><img width="50" height="50" src="assets/img/sahibi.png"><b>Yetkili Adı </b> </td><td><input type="text" name="yetkili" value="<?php echo $yetkili ?>" ></td></tr>
 <tr><td><img width="50" height="50" src="assets/img/servis.png" ><b> Servisi </b></td> <?php 
                
                 $sql = "select * from routes";
                 $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
				 
				 echo '<td><select name="servis" style="width:175px; height:28px;">';
				 
				  while ( $row = $sonuckod->fetch() )
            {
				 if($rota==$row['name'])
				{
					echo '<option value="'.$row['name'].'" selected>'.$row['name'].'</option>'; 
				}
				else{
                echo '<option value="'.$row['name'].'">'.$row['name'].'</option>'; }
			}
 
             echo '</select></td></tr>';
 
 ?><br>
 <tr><td><img width="50" height="50" src="assets/img/adres.png"><b>Bayi Adresi </b></td><td><input type="text" name="adres" value="<?php echo $adres  ?>"></td></tr>
<tr><td><img width="50" height="50" src="assets/img/bakiye.png"><b> Bakiyesi </b></td><td><input type="text" name="balance" value="<?php  echo $balance ?>"></td></tr>
<tr><td><img width="50" height="50" src="assets/img/telefon.png"><b> Yetkili Tel. No. </b> </td><td><input type="text" name="telno" value="<?php  echo $telno ?>"></td></tr>
<tr><td><img width="50" height="40" src="assets/img/vergino.png"><b> Vergi Numarası </b></td><td><input type="text" name="vergino" value="<?php  echo $taxnumber ?>"></td></tr>
<tr><td><img width="50" height="50" src="assets/img/vergidairesi.png"><b> Vergi Dairesi Adı </b></td><td><input type="text" name="vergidairesi" value="<?php  echo $taxname ?>"></td></tr>
<tr><td colspan="2" >  <input type="submit" name="kaydet" class="btn btn-success" value="Değişiklikleri Kaydet"></td></tr>
 </form>
 </table>
</center>
<br><br>
</div>
<?php 
if(isset($_POST['kaydet']))
{

    	if (isset($_POST['yetkili']))
	{ 
        $yetkili =  $_POST['yetkili'];
		
	}
	if (isset($_POST['bayiadi']))
	{ 
        $name =  $_POST['bayiadi'];
		
	}
	if (isset($_POST['adres']))
	{ 
        $adres =  $_POST['adres'];
	}
	if (isset($_POST['balance']))
	{ 
        $balance =  $_POST['balance'];
	}
	if (isset($_POST['servis']))
	{ 
        $rota =  $_POST['servis'];
		echo $rota;
		
	}
	if (isset($_POST['telno']))
	{ 
        $telno =  $_POST['telno'];
		echo $telno;
		
	}
	if (isset($_POST['vergino']))
	{ 
        $vergino =  $_POST['vergino'];
		
		
	}
	if (isset($_POST['vergidairesi']))
	{ 
        $vergidairesi =  $_POST['vergidairesi'];
	
	}
		
		  if( $db->exec("UPDATE dealers SET name='$name',address='$adres',route='$rota',balance='$balance',taxnumber='$vergino',authorizedPerson='$yetkili',phone_num='$telno',tax_address=' $vergidairesi' WHERE id='$kod' "))
			 {
				  header("Location:bayibilgileri.php");
			 }
				 else 
			 {    header("Location:bayibilgileri.php");}
}
?>

<div id="Ürünbilgisi" class="tabcontent">
  <?php 
  
	 $date=date('Y.m.d ');
   $sql="select dealers.name,products.name,tradelogs.tour_no,tradelogs.amount from dealers,products,tradelogs where dealers.id=".$_SESSION['bayikodu']." and dealers.id=tradelogs.dealer_id and products.id=tradelogs.product_id and tradelogs.date='$date' order by tradelogs.tour_no";
     $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
   $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
   $lasttour=0;
   echo "<ul>";
	 while ( $row = $sonuckod->fetch() )
	 { 
		 if($lasttour==$row['tour_no']){
       
		echo " <li> <b>" . $row['name']. " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".$row['amount']."</li> " ;
		
		}
		 else
		{
			echo "<font size='3' color=Chocolate><b>".$row['tour_no'].". Servis</b></font> ";
		    echo "<font color=Goldenrod ><br><b>Ürün Adı &nbsp;&nbsp;&nbsp;&nbsp;  Adeti </b></font>";
		echo " <b><li> " . $row['name']. " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".$row['amount']." </li>";
	
		 $lasttour=$row['tour_no'];
		 }	 
		
	 }
	echo "</ul>";
	
 ?>
</div>

<div id="Durum" class="tabcontent">



   <?php 
   
  if ($status==1) 
  { 
echo '<form action="" method="get"><br>
<input type="checkbox" name="aktif" Value="Akif" checked > Halen Bu Firma ile Çalışılmakta (Aktif)  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img width="30" height="40" src="assets/img/tik.png"><b> Bayi Şuan Aktif </b><br><br>
<input type="checkbox" name="pasif" Value="Pasif" > Artık Bu Firma ile Çalışılmamaktda (Pasif)<br><br>
<input type="submit" class="btn btn-success" name="durum" value="Kaydet">
</form> ';

    }
     else if($status==0)
	 {  
  echo ' <form action="" method="get"><br>
 <input type="checkbox" name="aktif" Value="Akif" > Halen Bu Firma ile Çalışılmakta (Aktif)<br><br>
<input type="checkbox" name="pasif" Value="Pasif" checked > Artık Bu Firma ile Çalışılmamaktda (Pasif) &nbsp;&nbsp;
<img width="30" height="30"  src="assets/img/carpı.png"><b> Bayi Şuan Pasif</b> <br><br> 

<input type="submit" class="btn btn-success" name="durum" value="Kaydet">
	 </form>';
	
	}
	 echo "</table><br>";
?>

<?php
if(isset($_GET['durum']))
{  
   if(isset($_GET['aktif']))
   { 
     if( $db->exec("UPDATE dealers SET name='$name',address='$adres',balance='$balance',route='$rota',taxnumber='0',authorizedPerson='$yetkili',status='1' WHERE id='$kod' "))
					   {
						      header("Location:bayibilgileri.php");
					   }
   }
   
    if(isset($_GET['pasif']))
   { 
          if( $db->exec("UPDATE dealers SET name='$name',address='$adres',balance='$balance',route='$rota',taxnumber='0',authorizedPerson='$yetkili',status='0' WHERE id='$kod' "))
					   {
						      header("Location:bayibilgileri.php");
					   }				  
	
   } 
}
?>
</div>

<div id="Ürünfiyati" class="tabcontent"> 
<center>
<?php 
$id=$_SESSION['bayikodu'];
echo "<br><table ><th>Ürün Adı </th><th> Birim Fiyatı </th><th>İşlem</th>";
$sql="select distinct product_id from tradelogs where dealer_id='$id' ";
$sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
$sonuckod->setFetchMode(PDO::FETCH_ASSOC);
while( $row = $sonuckod->fetch())
{
	$productid=$row['product_id'];
	$sql1="select name from products where id='$productid' ";
    $sonuc = $db->query($sql1); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
    $sonuc->setFetchMode(PDO::FETCH_ASSOC);
	$row1 = $sonuc->fetch();
	$productname=$row1['name'];
	 $sqlson="Select price from dealerprices where dealer_id='$id' and product_id='$productid'";
	 $sonucson = $db->query($sqlson); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
    $sonucson->setFetchMode(PDO::FETCH_ASSOC);
	$row2 = $sonucson->fetch();
	
	echo "<form action='urunguncelle.php' method='POST'><tr><td><b><font color=orange>".$productname."</font></td><td><b>".$row2['price']."</td><td><input type='text' name='urunguncelle' style='display:none; width:30px;' value='".$productid."'><input type='submit' class='btn btn-info' value='Fiyat Güncelle'></form> </td></tr>";
	 //<input type="text" name="id" style="display:none; width:30px;" value="'.$name.'">
}
?>
</table>
</center><br>
</div>
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>


			
                    </div>
                </div>
            </div>
        </div>

<?php  include 'footer.php'; ?>