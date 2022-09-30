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
				line-height: 1.5;
			}

            header{
                margin-bottom: 2rem;
				text-align: center;
            }

			footer{
				margin-top: 2rem;
				text-align: center;
			}

			label {
				display: block;
				margin-bottom: 0.5rem;
			}

			p {
				margin-bottom: 2rem;
			}

			select {
				min-width: 10rem;
			}

			ul {
				list-style-type: none;
			}


            .main-page {
				margin: 0 auto;
				padding: 8rem 25rem;
    			text-align: center;
			}

            .contents {
				display: grid;
				grid-template-columns: 1fr 1fr;
				justify-items: center;
                gap: 2rem;
			}

            .house_attr {
                text-align: left;
            }

            .user_ads {
                text-align: left;
            }

            input,
			.button {
				font-family: sans-serif;
				font-size: 18px;
                border-color: black;
				line-height: 1.3;
			}

            input {
				text-align: left;
				border-radius: 5px;
                display: inline-block;
            }
			
			.button {
				display: block;
				border-radius: 10px;
				padding: 1rem;
				font-weight: 700;
                text-decoration: underline;
				text-align: center;
				min-width: 14rem;
			}

			footer .button {
				margin-left: 21rem;
			}
			
			#btn_create {
                margin: 2rem 2rem;
			}

			#btn_get {
                margin-bottom: 2rem;
			}

			#btn_delete {
				border-radius: 10px;
				font-weight: 700;
				margin-top: 1rem;
				padding: 0 1rem;
				min-width: 7rem;
				max-width: 10rem;
                text-decoration: underline;
				text-align: center;
			}
			
			.adList label { 
				display: inline-block;
			}


        </style>
	</head>