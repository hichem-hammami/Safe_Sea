<?php
require('../vendor/autoload.php');
$con=mysqli_connect('localhost','root','','pepiniere');
$res=mysqli_query($con,"select * from panier");
if(mysqli_num_rows($res)>0){
	
	$html.='<table border="1" style="border-collapse:collapse ;
 border: 3px solid black;
 width: 700px;
 height: 100px;
 color: blue;

" align="center">';

		$html.='<tr><td>Article</td><td>Quantite</td></tr>';
		while($row=mysqli_fetch_assoc($res)){
			$html.='<tr><td>'.$row['idArticle'].'</td><td>'.$row['quantiteArticle'].'</td></tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S
?>