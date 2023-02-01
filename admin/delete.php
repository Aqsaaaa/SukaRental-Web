<?php 
include '../dbconnect.php';
if (isset($_GET['idproduk'])) {
	if ($_GET['idproduk'] != "") {
		
		$idproduk = $_GET['idproduk'];

		$get_foto = "SELECT gambar FROM produk WHERE idproduk='$idproduk'";
		$data_foto = mysqli_query($conn, $get_foto); 
		$foto_lama = mysqli_fetch_array($data_foto);

		unlink("produk/".$foto_lama['gambar']);    
		$query = mysqli_query($conn,"DELETE FROM produk WHERE idproduk='$idproduk'");
		if ($query) {
			header("location:produk.php?pesan=hapus");
		}else{
			header("location:produk.php?pesan=gagal hapus");
		}
		
	}else{
		header("location:produk.php");
	}
}else{
	header("location:produk.php");
}

?>