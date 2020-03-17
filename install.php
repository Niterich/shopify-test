<?php

// Set variables for our request
$shop = $_GET['shop'];
$api_key = "1a761bc607e7c5f8f9318994d7b842ce";
$scopes = "read_orders,write_products";
$redirect_uri = "http://localhost/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();