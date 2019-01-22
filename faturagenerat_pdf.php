
<?php
//call the FPDF library
require('fpdf181/fpdf.php');
if(isset($_POST['bayiler'])){
$pdf = new FPDF('L','mm',array(240,100));
$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'bitirme');
$bayiler = $_POST['bayiler'];
  foreach($bayiler as $bayi){
$düzdate=$_POST['dday'];
$date = new DateTime($düzdate);
$düzdate=$date->format('d.m.Y');
$query=mysqli_query($con,"Select * from dealers where name='$bayi'");
$row=mysqli_fetch_array($query);
$id=$row['id'];
$adet=0.8416;

$sql=mysqli_query($con,"Select SUM(amount) as valuesum from tradelogs where dealer_id='$id' and date='$düzdate'");
$sonuc=mysqli_fetch_assoc($sql);
$sum=$sonuc['valuesum'];
$tutar=$sum*$adet;


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
$pdf->AddPage();
$pdf->SetFont('Arial','B',9);
$pdf->SetFont('Arial','',9);

$pdf->Cell(189 ,2,'',0,1);//end of line
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$row['name'],0,1);
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$row['address'],0,1);
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'ANKARA',0,1);
$pdf->Ln();

$pdf->Cell(20,5,'',0,0);
$pdf->Cell(120,5,'vergi no ',0,0);//$row['taxnumber']
$pdf->Ln();
$pdf->Cell(170,5,'',0,0);
$pdf->Cell(59 ,5,$düzdate,0,1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(30,5,'',0,0);
$pdf->Cell(80,5,'Ekmek',0,0);
$pdf->Cell(10 ,5,'986',0,0);//$sum
$pdf->Cell(20 ,5,'Adettttttt',0,0);
$pdf->Cell(40,5,$adet,0,0);
$pdf->Cell(40,5,$tutar,0,1);
$pdf->Ln();

$pdf->Cell(178,5,'',0,0);
$pdf->Cell(150,5,'Tutarrr222',0,0);//tutar
$pdf->Cell(150,5,'Ttarrr111',0,1);//$tutar
$pdf->Cell(142,5,'',0,0);
$pdf->Cell(35,5,'%111111',0,0);
$pdf->Cell(5,5,'1,0111111',0,0);
$pdf->Ln();
$pdf->Cell(178,5,'',0,0);
$pdf->Cell(5,5,'genelllllllll',0,1);
//invoice contents
$pdf->SetFont('Arial','B',9);

  }
$pdf->Output();}
else 
{ echo "<br><br><br><br><br><br><br><br><br><center><h2><font color='red'>Lütfen İşlem Yapılcak Bayi ve Tarihi Seçtiğinizden Emin Olun !</h2></center></font>";
	header("Refresh:2; url=fatura.php");
}
?>