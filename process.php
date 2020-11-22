<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'labimk') or die (mysqli_error($mysqli));


$id = 0;
$update = false;
$name = '';
$nomor_punggung = '';
$posisi = '';
$asal_negara = '';

if (isset($_POST['save'])){
	$name = $_POST['name'];
	$nomor_punggung = $_POST['nomor_punggung'];
	$posisi = $_POST['posisi'];
	$asal_negara = $_POST['asal_negara'];

	$mysqli->query("INSERT INTO data (name, nomor_punggung, posisi, asal_negara) VALUES('$name', '$nomor_punggung', '$posisi', '$asal_negara')") or die($mysqli->error());


	$_SESSION['message'] = "Data berhasil ditambah!";
	$_SESSION['msg_type'] = "success";

	header("location: anggota.php");
}

if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());


	$_SESSION['message'] = "Data telah dihapus";
	$_SESSION['msg_type'] = "danger";

	header("location: anggota.php");
}

if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->errror());
	if (!empty($result)==1){
		$row = $result->fetch_array();
		$name = $row['name'];
		$nomor_punggung = $row['nomor_punggung'];
		$posisi = $row['posisi'];
		$asal_negara = $row['asal_negara'];

	}
}

if (isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$nomor_punggung = $_POST['nomor_punggung'];
	$posisi = $_POST['posisi'];
	$asal_negara = $_POST['asal_negara'];


	$mysqli->query("UPDATE data SET name='$name', nomor_punggung='$nomor_punggung', posisi='$posisi', asal_negara='$asal_negara' WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Data berhasil diubah!";
	$_SESSION['msg_type'] = "warning";

	header('location: anggota.php');
}
