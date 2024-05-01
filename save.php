<?php
ob_start(); // Start output buffering

		include("includes/connect.php");

		$cat = $_POST['cat'];
		$cat_get = $_GET['cat'];
		$act = $_POST['act'];
		$act_get = $_GET['act'];
		$id = $_POST['id'];
		$id_get = $_GET['id'];

		
				if($cat == "users" || $cat_get == "users") {
					$name = addslashes(htmlentities($_POST["name"], ENT_QUOTES));
$email = addslashes(htmlentities($_POST["email"], ENT_QUOTES));
$password = addslashes(htmlentities($_POST["password"], ENT_QUOTES));
$role = addslashes(htmlentities($_POST["role"], ENT_QUOTES));


				if($act == "add") {
					mysqli_query($link, "INSERT INTO `users` (  `name` , `email` , `password` , `role` ) VALUES ( '".$name."' , '".$email."' , '".md5($password)."', '".$role."' ) ");
				}elseif ($act == "edit") {
					mysqli_query($link, "UPDATE `users` SET  `name` =  '".$name."' , `email` =  '".$email."' , `role` =  '".$role."'  WHERE `id` = '".$id."' "); 
					}elseif ($act_get == "delete") {
						mysqli_query($link, "DELETE FROM `users` WHERE id = '".$id_get."' ");
					}
					header("location:"."users.php");
				}
ob_end_flush(); // Flush the output buffer to the browser
				?>
