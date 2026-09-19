<h4>Konfirmasi Pembayaran</h4>


  
  
<?php

if (!defined('cms-ADMINISTRATOR')) {
	Header("Location: ../index.php");
	exit;
}

if (!cek_login()){
    warning("Access Denied!.... You Must Login First","index.php", 3, 2);
    exit;
}

//$index_hal = 1;


include 'modul/functions.php';



switch (@$_GET['action']){


default:	
	
	

$user		   = $_SESSION['UserName'];




if (isset ($_POST['submit'])){
	
	


$image_name		=$_FILES['image']['name'];
$image_size		=$_FILES['image']['size'];
$image_type		=$_FILES['image']['type'];
$url=str_replace(" ", "-", $user);
$foto	="$user.jpg";
	$maxsize    = 1000000;
	
	

	
	
	
	
	
	
if (!$image_name){
} else {

$check = getimagesize($_FILES['image']['tmp_name']);

if($check !== false) {
	
   
    $uploadOk = 1;
	

	
} else {
  $error .= '- Ini bukan gambar<br />';
    $uploadOk = 0;
}

}
	
if ($error != ''){
	$content .= '<div class=error>'.$error.'</div>';
}else {
	

	
		$insert = $koneksi_db->sql_query ("UPDATE `mod_data_pmb` SET `foto`='$foto',`statusb`='1' WHERE `nomor` = '$user'");

	if ($insert) {
		$content .= '<div class=sukses>Data berhasil dimasukkan.</div>';
		
			$url=str_replace(" ", "-", $user);
$foto	="$url";
copy($_FILES['image']['tmp_name'], "./files/pembayaran/".$url.".jpg");
		
		}
	

		
		
		

	
}	
	
	
	
	
}

if (!isset ($_POST['submit'])){
$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` WHERE `nomor` = '$user'");
$getdata = mysqli_fetch_assoc($query);

$_POST = $getdata;
}
$statusb = $getdata['statusb'];

if($statusb==1)
{
	$content .= '<div class="sukses">Anda berhasil melakukan konfirmasi pembayaran.</div> ';
} else {
	


$content .= '
<form method="POST" action="" enctype="multipart/form-data" name="input_jabatan">
<table width=100%>
<tr>
<td>Tagihan</td>
<td>:</td>
<td>'.matauang($getdata['biaya']).'</td>
</tr>

<tr>
<td>Upload Bukti Transfer</td>
<td>:</td>
<td><input name="image" type="file" /></td>
</tr>

<tr>
<td></td>
<td></td>
<td><input type="submit" name="submit" value="Kirim"></td>
</tr>

</table>
</form>
';
	
}



break;	

}














/////////////
echo $content;

?> 