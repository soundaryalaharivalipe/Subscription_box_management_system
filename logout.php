<?php

	session_start();
   unset($_SESSION['email']);
   header('location:home.php');
?>