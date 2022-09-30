<?php

require_once('./Models/Ad.php');

function insertAd($user_ad){
    $servername = "localhost";
    $username = "username";
    $password = "password"; //for demo purposes
    $dbname = "myDB";
    //get hashed password from configuration file
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    // prepare and bind
    $ad = new Ad($user_ad['owner'],$user_ad['price'],$user_ad['squares'],$user_ad['region'],$user_ad['availability']);
    
    $stmt = $conn->prepare("INSERT INTO ads (userName, price, squares, region, available) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sss", $owner, $price, $squares,$region,$availability);
    
    // set parameters and execute
    $owner = $ad->getOwner();
    $price = $ad->getPrice();
    $squares = $ad->getSquares();
    $region = $ad->getRegion();
    $availability = $ad->getAvailability();
    $stmt->execute();
    
    echo "New records created successfully";
    
    $stmt->close();
    $conn->close();
}


?>