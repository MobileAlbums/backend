

<html>
	<head>
		<title>Admin Panel</title>
	
	<!--  <link rel="stylesheet" href="admin_style.css" />-->
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
	$edit_query = "select *from pictures where id='$edit_id'";
	$run_edit = mysql_query($edit_query); 
	
	while ($edit_row=mysql_fetch_array($run_edit)){
		$id = $edit_row['id'];
		$photo_id = $edit_row['album_id'];
		$name = $edit_row['name'];
		$file_name = $edit_row['filename'];
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
							<td class="btitle">Edit Picture</td>
						</tr>
					</table><br />
					<form method="post" action="picture_edit.php?edit_form=<?php if(isset($edit_id)) echo $edit_id; ?>" enctype="multipart/form-data">
					<table border="0" cellpadding="5" cellspacing="0" width="55%" class="box">
					   	<tr>	
							<td width="35%" class="td">Name</td>
							<td class="td"><input type="text" name="title"  value="<?php if(isset($name)) echo $name; ?>" class="ip" /><?=REQUIRED?></td>
						</tr>		
						<tr>
					  		<td class="td" width="">Image</td>
					  		<td class="td"><img src="pictures/<?php if(isset($file_name)) echo $file_name;?>" width="150" height="150"></td>
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
	  $name = $_POST['title'];
	  $date = date('m-d-y');	
	?>
	<?
		if($name==''){
			echo "<script>alert('Input correct')</script>";
			exit();
		}else { 
			$update_query = "update pictures set name='$name' where id='$update_id'";		
			if(mysql_query($update_query)){          
				echo "<script>alert('success');</script>";
				echo "<script>window.open('menus.php','_self')</script>";
			}
	
		}
	}



?>