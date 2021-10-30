<!DOCTYPE html>
<html>

<head>

	<style>
		.error {
			font-size: 15px;
			color: red;
		}
	</style>
</head>

<body>
	<?php
	$namaErr = $emailErr = $genderErr = $websiteErr = "";
	$nama = $email = $gender = $komentar = $website = "";

	$flag = true;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["nama"])) {
			$namaErr = "Nama harus diisi";
			$flag = false;
		} else {
			$nama = test_input($_POST["nama"]);
		}

		if (empty($_POST["email"])) {
            $emailErr = "Email harus diisi";
			$flag = false;
            }else {
                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Email tidak sesuai format"; 
                }
            }

		if (empty($_POST["website"])) {
			$website = "";
			$flag = false;
		} else {
			$website = test_input($_POST["website"]);
		}

		if (empty($_POST["komentar"])) {
			$komentar = "";
			$flag = false;
		} else {
			$komentar = test_input($_POST["komentar"]);
		}

		if (empty($_POST["gender"])) {
			$genderErr = "Gender harus dipilih";
		}else {
			$gender = test_input($_POST["gender"]);
		}

		// form disubmit ketika telah berhasil di validasi
		if ($flag) {

			$conn = new mysqli("localhost","root","","admin");

			if ($conn->connect_error) {
				die("connection failed error: " . $conn->connect_error);
			}
			
			$sql = "INSERT INTO mahasiswa (nama, email, website, komentar, gender) VALUES('$nama', '$email', '$website','$komentar', '$gender') ";
			// execute sql insert
			if ($conn->query($sql) === TRUE) {
				echo "<script> alert('Data Tersimpan');</script>";
			}
		}
	}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	?>
	<form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<h2>Posting Komentar </h2>
		<table>
                <tr>
                    <td>Nama : </td>
					<td><input type="text" name="nama" placeholder="Nama">
					<span class="error">* <?= $namaErr; ?></span>
					</td>
				</tr>
				<tr>
					<td>E-mail : </td>
					<td><input type="text" name="email" placeholder="Email">
					<span class="error">* <?= $emailErr; ?></span>
					</td>
				</tr>
				<tr>
					<td>Website : </td>
					<td><input type="text" name="website" placeholder="Website">
					<span class="error"> <?= $websiteErr; ?></span>
					</td>
				</tr>
				<tr>
					<td>Komentar : </td>
					<td><textarea name="komentar" rows = "5" cols = "40"></textarea></td>
				</tr>
				<tr>
					<td>Gender:</td>
				    <td>
                    <input type = "radio" name = "gender" value = "L">Laki-Laki
                    <input type = "radio" name = "gender" value = "P">Perempuan
                    <span class = "error">* <?php echo $genderErr;?></span>
                    </td>
				</tr>
				<td>
				<input class="button btn btn-primary" type="submit" name="button">
				</td>
		</table>
	</form>
	</body>
</html>