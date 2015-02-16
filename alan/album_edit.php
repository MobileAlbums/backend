

<html>
	<head>
		<title>Admin Panel</title>
	
	<!--  <link rel="stylesheet" href="admin_style.css" />-->
	<script>
		function setImage() {
			//var img = document.getElementById("imageid").src="sdfsf";
			//document.write("DSFSDFAFDSAFAFDSAFSAFSDFSAFSDFS");
			//alert(document.getElementById("imageid").src);
			//document.getElementByName("title").value="xxx";
		}
	</script>
	</head>
	
<body>
<?include("./include/config.php");?>
<?include("./include/db.php");?>
<?include("./include/functions.php");?>
<?include("./include/validation.php");?>
<?include("./include/listing.php");?>
<? $db= new db();$db->connect(); $valid = new validation();?>

<?
if(isset($_GET['edit'])){ 

	$edit_id = $_GET['edit'];
	$db = new db();
	$db->connect();
	$query = "SELECT * FROM albums WHERE id='".$edit_id."'";
	$result = $db->execute($query); 
	
	while ($row=$db->row($result)){
		$id = $row['id'];
		$name = $row['name'];
		$image = $row['filename'];
	}
}
?>

<? include("./include_member/header.php");?>
<tr>
<td align="center" coslpan="">
	<table border="0" cellpadding="0" cellspacing="0" width="60%">
		<tr>
			<td align="center"><? $valid->show();?></td>
			
		</tr>
	</table>
</td>
</tr>
<tr>
<td with="" align="center" colspan="2">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="" align="center">&nbsp;<? include("./include_member/displayerror.php"); ?></td>
			
		</tr>
	</table>
</td>
</tr>
<tr>
	<td colspan="2">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			    <td width="20" align="left" valign="top"></td>
				<td width="200" valign="top">
					<? include("navigationcall.php");?>
				</td>
				<td width="100"><? // Seperator --------?> </td>
				<td valign="top">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td class="btitle">Edit Album</td>
						</tr>
					</table><br />
					<form method="post" action="album_edit.php?edit_form=<?php if(isset($edit_id)) echo $edit_id; ?>" enctype="multipart/form-data">
					<table border="0" cellpadding="5" cellspacing="0" width="55%" class="box">
					   	<tr>	
							<td width="35%" class="td">Name</td>
							<td class="td"><input type="text" name="name"  value="<?php if(isset($name)) echo $name; ?>" class="ip" /><?=REQUIRED?></td>
						</tr>
						<tr>
					  		<td class="td" width="">Image</td>
					  		<td class="td"><img src="albums/<?php if(isset($image)) echo $image;?>" width="150" height="150"></td>
				  		</tr>						
				 		<tr>
					  		<td colspan="2" align="center">
							<input type="submit" name="update" value="Update Now" class="ip2" />
							</td>
						</tr>
					</table>
					</form>
				</td>
				<td width="15%" align="left" valign="top"></td>
			</tr>
		</table>
	</td>
</tr>

<? include("./include_member/footer.php");?>
<?php	
	if(isset($_POST['update'])){	
	  $update_id = $_GET['edit_form'];
	  $name = $_POST['name'];
	  $date = date('m-d-y');
	  
		if($name==''){
			echo "<script>alert('Any of the fields is empty')</script>";
			exit();
		}else { 
			$update_query = "UPDATE albums SET name='".$name."', date='".$date."' WHERE id='".$update_id."'";
			if(mysql_query($update_query)){           
				//echo "<script>alert('success');</script>";
				echo "<script>window.open('menus.php','_self')</script>";
			}
		}
	}



?>