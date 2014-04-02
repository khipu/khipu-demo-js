<?php
include('khipu-lib.php');
if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
	header('Location: index.php?invalid=true');
	return;
}

$json = khipu_get_new_payment($_REQUEST['email'], $_REQUEST['bankId']);
header('Location: process.php?data=' . urlencode($json));
