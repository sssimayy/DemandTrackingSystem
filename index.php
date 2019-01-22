
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
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	width:30%;
	text-align:center;
}
th, td {
    padding: 10px;
    text-align:center; 
	
}


</style>
<?php

$tab_query = "SELECT * FROM routes";
$sonuckod = $db->query($tab_query);
$sonuckod->setFetchMode(PDO::FETCH_ASSOC);
$tab_menu = '';
$tab_content = '';
$i = 0;
	
while ( $row = $sonuckod->fetch() )
{
	$id = $row['id'];
    $name = $row['name'];
	
 if($i == 0)
 {
  $tab_menu .= '
   <li class="active"><a href="#'.$row["id"].'" data-toggle="tab">'.$row["name"].'</a></li>
  ';
   
  $tab_content .= '
   <div id="'.$row["id"].'" class="tab-pane fade in active">
 
  ';
   
 }
 else
 {
  $tab_menu .= '
   <li><a href="#'.$row["id"].'" data-toggle="tab">'.$row["name"].'</a></li>
  ';
  $tab_content .= '
   <div id="'.$row["id"].'" class="tab-pane fade">
  ';
 }

 $product_query = "SELECT * FROM dealers WHERE route= '".$row["name"]."'  ";
 $sonuc = $db->query($product_query);
$sonuc->setFetchMode(PDO::FETCH_ASSOC);
  $tab_content .= '
  <table  > 
			   		    <tr style="background-color:#dddddd;" >
                        <th>Bayi Kodu</th> 
                        <th>Bayi Adı</th>   
						<th>Bayi Bilgisi </th>	
						
                       	';
 while($sub_row = $sonuc->fetch() )
 {  
	  $id = $sub_row['id'];
	  $name = $sub_row['name'];
	  $gname=$sub_row['route'];
	
  $tab_content .= '

   				
                        </tr> <form action="bayibilgileri.php" method="POST">
						<tr><td>'.$sub_row['id'].'</td><td>'.$name.'</td><td>
						<input type="text" name="id" style="display:none; width:30px;" value="'.$id.'">
						<input type="submit" class="btn btn-primary" value="Bayi Bilgisi"></td></form></td>
						
  
  ';
 }
  $tab_content .= '</tr><tr><td colspan="3"><form action="bayiekle.php" method="POST"><input type="text" name="gname" style="display:none; width:30px;" value="'.$gname.'"> <input  class="btn btn-success" style="font-size: 20px; "type="submit" value="Yeni Bayi Ekle" name="ekle"></form></td></tr>
						</table>';
 $tab_content .= '<div style="clear:both"></div></div>';

 $i++;
}
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
    
    <div class="container">
   <br />
   <ul class="nav nav-tabs">
   <?php
   echo $tab_menu;
   ?>
   </ul>
   <div class="tab-content">
   <br />
   <?php
   echo $tab_content;
   
   ?>
   </div>
  </div>


			
                    </div>
                </div>
            </div>
        </div>

<?php  include 'footer.php'; ?>