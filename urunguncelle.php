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
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
						</style>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
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
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>

</head>


        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                       <h3 class="page-head-line">BAYİ İŞLEMLERİ</h3>
					   
					   
					   <?php 
					 
						 $id=$_SESSION['bayikodu'];
						if(isset($_POST['urunguncelle']))
						{
							$productid=$_POST['urunguncelle'];
							$_SESSION['productid']=$_POST['urunguncelle'];
							
							$sql="select name from products where id='$productid'";
							$sonuc = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
                            $sonuc->setFetchMode(PDO::FETCH_ASSOC);
	                        $row = $sonuc->fetch();
							  echo "<br><b> Ürün Adı  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ürün Birim Fiyatı <br><br>";
							  echo "<form action='' method='POST'>".$row['name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' size='5' name='guncelfiyat'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit'  class='btn btn-success' name='guncel' value='Güncelle'></form>";
							
						}
					   
					   ?>
					   <?php
					   
					   if(isset($_POST['guncel'])  )
					   {
						   if(isset($_POST['guncelfiyat'])){
							   $price=$_POST['guncelfiyat'];
							   $pid=$_SESSION['productid'];
						   if( $db->exec("UPDATE dealerprices SET price='$price' WHERE dealer_id='$id' and product_id='$pid' "))
		                           {
			                          header("Location:index.php");

		                           }
					   }
					   }
					   ?>
					   
					   		
                    </div>
                </div>
            </div>
        </div>

<?php  include 'footer.php'; ?>