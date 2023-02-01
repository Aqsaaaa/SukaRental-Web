<!-- <?php

//process_data.php

if(isset($_POST["query"]))
{
	$connect = new PDO("mysql:host=localhost; dbname=sukarental", "root", "");

	$data = array();

	if($_POST["query"] != '')
	{
		$condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);
		$condition = trim($condition);
		$condition = str_replace(" ", "%", $condition);

		$sample_data = array(
			':nama'		    =>	'%' . $condition . '%',
			':jenis_mtr'	=>	'%' . $condition . '%',
			':no_plat'		=>	'%' . $condition . '%',
			':alamat'		=>	'%' . $condition . '%',
			':no_telp'		=>	'%' . $condition . '%',
			':harga'		=>	'%' . $condition . '%',
			':image'		=>	'%' . $condition . '%'
		);

		$query = "
		SELECT *
		FROM motor 
		WHERE harga LIKE :harga 
		ORDER BY id DESC
		";

		$statement = $connect->prepare($query);

		$statement->execute($sample_data);

		$result = $statement->fetchAll();

		$replace_array_1 = explode("%", $condition);

		foreach($replace_array_1 as $row_data)
		{
			$replace_array_2[] = '<span style="background-color:#'.rand(100000, 999999).'; color:#fff">'.$row_data.'</span>';
		}

		foreach($result as $row)
		{
			$data[] = array(
				'nama'			=>	str_ireplace($replace_array_1, $replace_array_2, $row["nama"]),
				'jenis_mtr'		=>	str_ireplace($replace_array_1, $replace_array_2, $row["jenis_mtr"]),
				'no_plat'			=>	str_ireplace($replace_array_1, $replace_array_2, $row["no_plat"]),
				'alamat'			=>	str_ireplace($replace_array_1, $replace_array_2, $row["alamat"]),
				'no_telp'			=>	str_ireplace($replace_array_1, $replace_array_2, $row["no_telp"]),
				'harga'			=>	str_ireplace($replace_array_1, $replace_array_2, $row["harga"]),
				'foto'			=>	str_ireplace($replace_array_1, $replace_array_2, $row["foto"])
			);
		}
	}
	else
	{
		$query = "
		SELECT *
		FROM motor 
		ORDER BY id DESC
		";

		$result = $connect->query($query);

		foreach($result as $row)
		{
			$data[] = array(
				'nama'			=>	$row["nama"],
				'jenis_mtr'		=>	$row["jenis_mtr"],
				'no_plat'			=>	$row["no_plat"],
				'alamat'			=>	$row["alamat"],
				'no_telp'			=>	$row["no_telp"],
				'harga'			=>	$row["harga"],
				'image'			=>	$row["image"],
			);
		}
	}

	echo json_encode($data);
}

?>
 -->
