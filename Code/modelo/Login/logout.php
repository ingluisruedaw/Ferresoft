<?php
	if (!isset($_SESSION)) session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		session_unset();
		session_destroy();
		header('Location: ../../vista/home');
	} else {
		header('Location: ../../vista/home');
		exit;
	}
?>
