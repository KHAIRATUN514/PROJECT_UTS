<?php
	//Koneksi
	$koneksi = mysqli_connect('localhost','root','','UTS');
	if (mysqli_connect_error()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
	}

	//tombol simpan diklik
	if (isset($_POST['bsimpan'])) {
		$simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim, nama, alamat, prodi)
										  VALUES ('$_POST[tnim]', 
										  		  '$_POST[tnama]',
										  		  '$_POST[talamat]',
										  		  '$_POST[tprodi]')
										  ");
	if ($simpan) {
		echo "<script>alert('Berhasil Menambahkan Data');document.location='index.php';</script>";
	}else
	{
		echo "<script>alert('Gagal Menambahkan Data');document.location='index.php';</script>";
	}
	}

//Jika tombol edit/hapus di klik
	if (isset($_GET['hal'])) {
// jika edit data
		if ($_GET['hal'] == "edit") 
		{
//tampilkan data yg akan di edit
			$tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if ($data) {
//jika dta ditemukan, data d tampung ke variabel
				$vnim = $data['nim'];
				$vnama = $data['nama'];
				$valamat = $data['alamat'];
				$vprodi = $data['prodi'];
			}
		}
		elseif ($_GET['hal'] == "hapus") {
			//hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_mhs = '$_GET[id]' ");
			if ($hapus) {
				echo "<script>alert('Berhasil menghapus data');document.location='index.php';</script>";
			}
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Project UTS</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h2 class="text-center">Project UTS - Khairatun Hi'isan</h2>
	<h3 class="text-center">CRUD PHP + MySQL</h3>
	 
	 <!--Pembuka dari form -->
	 <div class="card">
	  <div class="card-header bg-primary text-white">
	    Form Input Data Mahasiswa
	  </div>
	  <div class="card-body">
	    <form method="post" action="">
	    	<div class="form-group">
	    		<label>Nim</label>
	    		<input type="text" name="tnim" value="<?=@$vnim?>" class="form-control" placeholder="Masukkan NIM anda" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Nama</label>
	    		<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Masukkan Nama anda" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Alamat</label>
	    		<textarea name="talamat"  class="form-control" placeholder="Masukkan Alamat anda"><?=@$valamat?></textarea>
	    	</div>
	    	<div class="form-group">
	    		<label>Program Studi</label>
	    		<select name="tprodi" class="form-control">
	    			<option value="<?=@$vprodi?>"><?=@$vprodi?></option>
	    			<option value="S1-Manajemen Informasi">S1-Manajemen Informasi</option>
	    			<option value="S1-Sistem Informasi">S1-Sistem Informasi</option>
	    			<option value="S1-Teknik Informatika">S1-Teknik Informatika</option>
	    		</select>
	    	</div>
	    	<button name="bsimpan" class="btn btn-success" type="submit">Simpan</button>
	    	<button name="breset" class="btn btn-danger" type="reset">Hapus</button>
	    </form>
	 </div>
	 <!--Penutup dari Form -->

<!--Pembuka dari Tabel Siswa -->
	 <div class="card">
	  <div class="card-header bg-success text-white">
	    Daftar Inputan Data Mahasiswa
	  </div>
	  <div class="card-body">
	  	<table class="table table-bordered table-striped">
	  		<tr>
	  			<th>NO.</th>
	  			<th>Nim</th>
	  			<th>Nama</th>
	  			<th>Alamat</th>
	  			<th>Program Studi</th>
	  			<th>AKsi</th>
	  		</tr>
	  		<?php
	  			$no = 1;
	  			$tampil = mysqli_query($koneksi, "SELECT * from tmhs order by id_mhs desc");
	  			while ($data = mysqli_fetch_array($tampil)) : 
	  		?>
	  		<tr>
	  			<td><?=$no++;?></td>
	  			<td><?=$data['nim']?></td>
	  			<td><?=$data['nama']?></td>
	  			<td><?=$data['alamat']?></td>
	  			<td><?=$data['prodi']?></td>
	  			<td>
	  				<a href="index.php?hal=edit&id=<?=$data['id_mhs']?>" class="btn btn-warning">Edit</a>
	  				<a href="index.php?hal=hapus&id=<?=$data['id_mhs']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
	  			</td>
	  		</tr>
	  	<?php endwhile; //--- ?>





	  	</table>
	 </div>
	 <!--Penutup dari Tbel Siswa-->
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>