<?php 
	include("include/config.php");
	include("include/db.php");
	
function delete_file($file) {
    if (file_exists($file)) {
        unlink($file);
		echo "ok";	
    }	
	else echo "wrong";
}	

if(isset($_GET['del'])){

	$delete_id = $_GET['del'];
	$db = new db();
	$db->connect();
	$delete_query = "DELETE FROM albums WHERE id='$delete_id' ";
	
	if(mysql_query($delete_query)){
		echo "<script>alert('Album Has been Deleted')</script>";
		echo "<script>window.open('menus.php','_self')</script>";
	}
}
?>