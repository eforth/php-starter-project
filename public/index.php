<?php

	session_start();

	require_once("../lib/config.php");
    require_once("../lib/db.php");
    require_once("../lib/func.php");

	// Redirect to login page if user not logged in.
	if (!isset($_SESSION['userID'])) {
        include("../pages/login.php");
		exit;
	}

	// Redirect ot 404 page if the query parameter 'page' is not set.
	if (!isset($_GET['page'])) {
        include("../pages/404.php");
		exit;
	}

	$requested_page = $_GET['page'];

	switch ($requested_page) {
		case 'home':
			include("../pages/home.php");
			break;
		case 'error':
			include("../pages/error.php");
			break;
		case 'login':
			include("../pages/login.php");
			break;
        default:
			include("../pages/404.php");
			break;
	}