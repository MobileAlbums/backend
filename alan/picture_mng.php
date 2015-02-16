<?include("./include/config.php");?>
<?include("./include/db.php");?>
<? 

	$db = new db();
	$db->connect();
	
	$action = "";
	$data = "";
	if(isset($_POST['action'])) {
		$action = $_POST['action'];
		$album_id = $_POST["album_id"];
	}	
	
	$result = $db->execute("SELECT MAX(id) FROM pictures");
	$row = $db->row($result);
	$maxid = $row["MAX(id)"];
	$newid = $maxid + 1;	
	$imagename = "image-".$album_id."-".$newid.".png";
	
	if($action == "insert") {		//print_r($_POST);
		$file_name = $_FILES['image']['name'];
		$image_tmp = $_FILES['image']['tmp_name'];
		$name = $_POST['name'];
		$album_id = $_POST["album_id"];
		move_uploaded_file($image_tmp,"pictures/$imagename");
		$query = "INSERT INTO pictures VALUES('', '".$album_id."', '".$name."', '".date('m-d-y')."', '".$imagename."')";
		if(mysql_query($query)) {
			$data['action'] = "insert";
			$query =  "SELECT MAX(id) FROM pictures";
			$result = $db->execute($query);
			$row = $db->row($result);
			$data['maxid'] = $row['MAX(id)'];
			$data['new_picture'] = $imagename;
			echo json_encode($data);
		}	
		else
			echo "no insert";
	}
	else if ($action == "delete") {		
		$id = $_POST["id"];
		$query = "DELETE FROM pictures WHERE id='".$id."'";
		if(mysql_query($query)) {
			$data = array();
			$data["action"] = "delete";
			echo json_encode($data);
		}	
		else
			echo "no delete";
	}
	else if ($action == "alldelete") {	
		$album_id = $_POST["album_id"];
		$query = "DELETE FROM pictures WHERE album_id='".$album_id."'";
		if(mysql_query($query)) {
			$data = array();
			$data["action"] = "alldelete";
			echo json_encode($data);
		}				
		else 
			echo "no alldelete";
	}
	else if ($action == "update") {
		$id = $_POST["id"];
		$name = $_POST["name"];
		$query = "UPDATE pictures SET name='".$name."' WHERE id='".$id."'";
		if(mysql_query($query)) {
			$data = array();
			$data["action"] = "update";
			echo json_encode($data);
		}	
		else
			echo "no update";		
	}
	else {
		$album_id = $_POST["album_id"];
		$query = "SELECT * FROM pictures WHERE album_id='".$album_id."'";
		if($result = $db->execute($query)) {
			$data = array();
			$key = 0;
			while($row = $db->row($result)) {
				$data[$key] = array();
				$data[$key]['id'] = $row['id'];
				$data[$key]['album_id'] = $row['album_id'];
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
	// }	
?>


