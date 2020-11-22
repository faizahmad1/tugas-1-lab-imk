<!--	TAMBAHAN	-->

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once 'process.php'; ?>

	<?php

	if (isset($_SESSION['message'])): ?>

	<div class="alert alert-<?=$_SESSION['msg_type']?>">

		<?php
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		?>
	</div>
	<?php endif ?>	

	<div class="container">
	<?php
		$mysqli = new mysqli('localhost', 'root', '', 'labimk') or die(mysqli_error($mysqli));
		$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error); 
	?>
<br>
<br>
<h2>Daftar Anggota Inazuma Eleven FC</h2>
<br>
<br>


	<div class="row justify-content-center">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Nomor Punggung</th>
					<th>Posisi</th>
					<th>Asal Negara</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
	<?php
		while ($row = $result->fetch_assoc()): ?>
			<tr>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['nomor_punggung']; ?></td>
				<td><?php echo $row['posisi']; ?></td>
				<td><?php echo $row['asal_negara']; ?></td>
				<td>
					<a href="anggota.php?edit=<?php echo $row['id']; ?>"
						class="btn btn-info">Edit</a>
					<a href="process.php?delete=<?php echo $row['id'];?>"
						class="btn btn-danger">Delete</a>

				</td>
			</tr>
		<?php endwhile; ?>
	</table>
	</div>
	<?php

		function pre_r( $array ) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
	?>

	<div class="row justify-content-center">
	<form action="process.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>">

		<div class="form-group">
			<label>Name</label>
				<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Masukkan Nama">
		</div>
		<div class="form-group">
			<label>Nomor Punggung</label>
			<input type="number" name="nomor_punggung" class="form-control" value="<?php echo $nomor_punggung; ?>" placeholder="Masukkan Nomor Punggung">
		</div>
		<div class="form-group">
			<label>Posisi</label>
			<input type="text" name="posisi" class="form-control" value="<?php echo $posisi; ?>" placeholder="Masukkan Posisi">
		</div>
		<div class="form-group">
			<label>Asal Negara</label>
			<input type="text" name="asal_negara" class="form-control" value="<?php echo $asal_negara; ?>" placeholder="Masukkan Asal Negara">
		</div>
		<div class="form-group">
			<?php 
			if ($update == true):
			?>
				<button type = "submit" class="btn btn-info" name="update">Update</button>
			<?php else: ?>
				<button type = "submit" class="btn btn-primary" name="save">Tambah</button>
			<?php endif ;?>
		</div>
	</form>
	</div>
	</div>
</body>
</html>
