<?php
	if(!isset($title)){
		$title = 'title';
	}
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Web Project for Spitogatos</title>

		<style>
			/* Reset */
			* {
				box-sizing: border-box;
				padding: 0;
				margin: 0;
			}

			/* Typography */
			html {
				font-size: 18px;
			}

			body {
				font-family: sans-serif;
				line-height: 1.50;
			}
			h1 {
				font-size: 2rem;
				margin-bottom: 3rem;
				font-weight: 900;
				letter-spacing: -2px;
			}	

			/* Container */
			section {
				margin: 0 auto;
				padding: 13rem 0;
    			text-align: center;
			}

			form input,
			.btn {
				border-radius: 10px;
				font-family: sans-serif;
				font-size: 18px;
				line-height: 1.5;
			}
			.btn {
				background-color: #7C48BF;
				color: white;
				padding: 1rem 2rem;
				border-radius: 15px;
				font-weight: 700;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				width: 200px;
				min-width: 200px;
			}

			form label {
				display: block;
				margin-bottom: 0.5rem;
			}
			form div {
				margin-bottom: 2rem;
			}


		</style>
	</head>

	<body>