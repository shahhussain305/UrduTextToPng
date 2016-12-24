<?php 
if(isset($_POST['data'])){
$img = $_POST['data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
//saving
$fileName = date('Ymdhisa').'.png';
file_put_contents("img/".$fileName, $fileData);
	echo('<hr>Created Image is: <br><img src="pages/img/'.$fileName.'">');
}
?>
