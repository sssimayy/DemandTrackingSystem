
<?php
//call the FPDF library
require('fpdf181/fpdf.php');
if(isset($_POST['bayiler'])){
$pdf = new FPDF('L','mm',array(140.50,100.20));
$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'bitirme');
 $bayiler = $_POST['bayiler'];
  foreach($bayiler as $bayi){
$düzdate=$_POST['dday'];
$date = new DateTime($düzdate);
$düzdate=$date->format('d.m.Y'); // 31.07.2012
$sevk=$_POST['sday'];
$date = new DateTime($sevk);
$sevkdate=$date->format('d.m.Y');
$query=mysqli_query($con,"Select * from dealers where name='$bayi'");
$row=mysqli_fetch_array($query);
$id=$row['id'];
$sql=mysqli_query($con,"Select SUM(amount) as valuesum from tradelogs where dealer_id='$id' and date='$sevkdate'");
$sonuc=mysqli_fetch_assoc($sql);
$sum=$sonuc['valuesum'];
 
 
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
//create pdf object

//$pdf = new FPDF('p','mm','A4');
//add new page
$pdf->AddPage();
//output the result
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',10);

//Cell(width , height , text , border , end line , [align] )

//$pdf->Cell(130 ,5,'GEMUL APPLIANCES.CO',0,0);
//$pdf->Cell(59 ,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',10);

//$pdf->Cell(130 ,5,'[Street Address]',0,0);
//$pdf->Cell(59 ,5,'',0,1);//end of line

//$pdf->Cell(130 ,5,'[City, Country, ZIP]',0,0);
//$pdf->Cell(25 ,5,'Date',0,0);
//$pdf->Cell(34 ,5,'[dd/mm/yyyy]',0,1);//end of line

//$pdf->Cell(130 ,5,'Phone [+12345678]',0,0);
//$pdf->Cell(25 ,5,'Invoice #',0,0);
//$pdf->Cell(34 ,5,'[1234567]',0,1);//end of line

//$pdf->Cell(130 ,5,'Fax [+12345678]',0,0);
//$pdf->Cell(25 ,5,'Customer ID',0,0);
//$pdf->Cell(34 ,5,'[1234567]',0,1);//end of line

//make a dummy empty cell as a vertical spacer

$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address



$pdf->Cell(10 ,5,'',0,0);
$pdf->Ln();
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$row['name'],0,1);
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$row['address'],0,1);
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(10 ,5,'tel',0,0);
$pdf->Ln();
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'ANKARA',0,1);
$pdf->Ln();

$pdf->Cell(20,5,'',0,0);
$pdf->Cell(90,5,$row['taxnumber'],0,0);

$pdf->Cell(59 ,5,$düzdate,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(100,5,'',0,0);
$pdf->Cell(59 ,5,$sevkdate,0,1);
//make a dummy empty cell as a vertical spacer
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(25,5,'',0,0);
$pdf->Cell(40,5,'Ekmek',0,0);
$pdf->Cell(59 ,5,'20',0,1);//sum
//invoice contents
$pdf->SetFont('Arial','B',10);

  }
$pdf->Output();
}
else 
{ echo "<br><br><br><br><br><br><br><br><br><center><h2><font color='red'>Lütfen İşlem Yapılcak Bayi ve Tarihi Seçtiğinizden Emin Olun !</h2></center></font>";
	header("Refresh:2; url=print.php");
}
 
?>