<?include("./include/config.php");?>
<?include("./include/db.php");?>
<? 

	$db = new db();
	$db->connect();
	
	$action = "";
	if(isset($_POST['action']))
		$action = $_POST['action'];

	$result = $db->execute("SELECT MAX(id) FROM albums");
	$row = $db->row($result);
	$maxid = $row["MAX(id)"];
	$newid = $maxid + 1;	
	$imagename = "image-".$newid.".png";
	
	if($action == "delete") {
		$id = $_POST["id"];
		$query = "DELETE FROM albums WHERE id='".$id."'";
		if(mysql_query($query)) {
			$query = "DELETE FROM pictures WHERE album_id='".$id."'";
			mysql_query($query);
			$data = array();
			$data["action"] = "delete";
			echo json_encode($data);
		}	
	}
	else if($action == "insert") {
		//$file_name = $_FILES['image']['name'];
		$image_tmp = $_FILES['image']['tmp_name'];
		$name = $_POST['name'];
		move_uploaded_file($image_tmp,"albums/$imagename");
		$query = "INSERT INTO albums VALUES('', '".$name."', '".date('m-d-y')."', '".$imagename."')";
		$data = array();
		if(mysql_query($query)) {
			$data['action'] = "insert";
			$data['maxid'] = $newid;
			$data["imagename"] = $imagename;
			echo json_encode($data);			
		}	
		else
			echo "no insert";
	}
	else {
		$query = "SELECT * FROM albums";
		if($result = $db->execute($query)) {
			$data = array();
			$key = 0;
			while($row = $db->row($result)) {
				$data[$key] = array();
				$data[$key]['id'] = $row['id'];
				$data[$key]['name'] = $row['name'];
				$data[$key]['date'] = $row['date'];
				$data[$key]['filename'] = $row['filename'];
				$key++;
			}	
			echo json_encode($data);
		}	
		else
			echo "error";
	}	
?>


