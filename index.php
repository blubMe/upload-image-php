<?php
$conn = mysqli_connect('localhost', 'root', '', 'percobaan');

function add_image ($dest, $pict){
		if (!(file_exists("$dest/$pict")))
		{
			$uploaddir = "$dest/"; //
			$uploadfile = $uploaddir . basename($pict['name']);
			if (move_uploaded_file($pict['tmp_name'], $uploadfile))
			{
				$pesan = "File was successfully uploaded.\n";
			}
			else $pesan = "File tidak bisa di upload";
		}
}

if(isset($_POST['input'])){
  $judul = $_POST['judul'];
	//untuk mengambil nama file gambar
  $gambar = basename($_FILES['gambar']['name']);
	//query untuk menginputkan data ke tabel di database
  mysqli_query($conn, "insert into coba values ('','$judul','$gambar')");

	//fungsi untuk memindah gambar ke server
  add_image('./uploadgambar', $_FILES['gambar']);

	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
        <form method="post" enctype="multipart/form-data">
          <table >
              <tr>
                  <td>Judul </td>
                  <td>:</td>
                  <td><input type="text" name="judul" value=""></td>
              </tr>
              <tr>
                  <td>Gambar</td>
                  <td>:</td>
                  <td><input type="file" name="gambar" value=""></td>
              </tr>
              <tr>
                  <td colspan=3><input type="submit" name="input" value="Submit"></td>
              </tr>
          </table>
        </form>
<?php
	$tampil = mysqli_query($conn, "select * from coba");
	while($rec = mysqli_fetch_array($tampil)){
?>
			<div style="float : left; width : 200px; height : 200px;
			 border: solid black 1px; margin : 2px; overflow: hidden; padding:2px;">
			 <img src="./uploadgambar/<?php echo $rec['gambar']; ?>" style="
			 width: 100%; height: auto; overflow: hidden" />
			</div>
		<?php } ?>
  </body>
</html>
