<?php

    //valid options for select dropdowns
    $regionsList = ['Αθήνα', 'Θεσσαλονίκη', 'Πάτρα', 'Ηράκλειο'];
    $availabilityList = ['ενοικίαση','πώληση'];

    $users = [
        [0 => [ 
                0 => '$2y$10$QaNOJeryVQG331X4zy08kORn4Vx2x10n6K8wEqbt7mJY/LZCUsFdq', 
                1 => '$2y$10$3Hd6LI6D5nogQtXHBesY.eK.37bI/VPzb.h4aPKutLM7V2pJCktvG'  
            ]
        ],
        [1 => [ 
                0 => '$2y$10$kuupa3KX1xQfwoSs2BXWUutyYgJ7G9QRyqPe2tj7iWAIEHGhyu6Te', 
                1 => '$2y$10$t7En8E6bJ9pIUtoi22hFC.C.FHmLmMdCOdfpQAPu3eB/aDn1saa.G' 
            ]
        ],
        [2 => [ 
                0 => '$2y$10$jBtipj.oInCaCjougMhXBupVw.QrZGKt2e4yR5exjMkEjqfs/YTHm', 
                1 => '$2y$10$Fh4YAW78QT8.nmMOkJh.u.VS3t8aJiXYAYzxpeEpMIWbSuc3oE2XC' 
            ]
        ]
    ];
    //For Demo purposes only
    //user,mypassword
    //user2,mypassword2
    //user3,mypassword3



    //just shows a message with alert
    function showMessage($warning){
        echo '<script type="text/javascript">';
        echo ' alert("'.$warning.'")';
        echo '</script>';
    }

    //ready function to clean user input to prepare for xss attacks
    function xss_clean($data) {
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
                // Remove really unwanted tags
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        return $data;
    }

    //user login function
    function userLogin(){
        global $users;
        //sanitize for XSS Attacks
        $username = $_POST['username'] = xss_clean($_POST['username']);
        $password  = $_POST['password'] = xss_clean($_POST['password']);
        //check for valid username and password
        $warning = validatePassword($password);

        //guard clause
        //disabled strong password for demo purposes
         if (isset($warning)){
        //     showMessage($warning);
        //     return;   
        }

        $itt=0;
        foreach ($users as $user){
            $userT = $user[$itt++];
            if ( password_verify($username,$userT[0]) && password_verify($password,$userT[1]) ){
                //verification complete return true and continue the login precedure
                return true;
            }
        }
        $warning = 'Δεν βρέθηκε ο χρήστης';
        showMessage($warning);
    }

    //validate password for strength
    function validatePassword($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialchars = preg_match('@[^\w]@', $password);
        
        if(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password) < 8) {
            return 'Ο κωδικός δεν είναι ισχυρός';
        }
    }

    //create ad
    function createAd(){
        //validate user input first
        $ad = validateUserInput();

        //if a string is returned means that there is a problem, otherwise i would get the object for insertion
        if ( is_string($ad) ){
            return false;
        }

        //json functionality to output my ad object
        if(file_exists('./AdsList/Ads.json')){  
            $current_data = file_get_contents('./AdsList/Ads.json');  
            $array_data = json_decode($current_data, true);
            $array_data[] = [
                'owner' => $ad->getOwner(),
                'price' => $ad->getPrice(),
                'squares' => $ad->getSquares(),
                'region' => $ad->getRegion(),
                'availability' => $ad->getAvailability()
            ];
            $final_data = json_encode($array_data);
            file_put_contents('./AdsList/Ads.json', $final_data);

        }else{
            showMessage('Δεν γίνεται να αποθηκευτεί η αγγελία');
        }
        showMessage('Επιτυχής καταχώρηση αγγελίας');
        return true;
    }

    // deletes an ad from FILE
    function deleteAd(){
        if(file_exists('./AdsList/Ads.json'))
        {
            $i = 0;
            //i am getting the contents of the file first
            $current_data = file_get_contents('./AdsList/Ads.json'); 
            $array_data = json_decode($current_data, true);
            if ( $array_data != NULL ) 
            {
                //polulate an array with the data i got from the form that the user clicked with the ad together
                $str_arr = explode (",", $_POST['data']); 
                foreach($array_data as $row)
                {  
                    if (count($row) == 5 && ( $row['owner'] == $_SESSION['userName'] )) {
                        if ( $row['price'] == $str_arr[0] && 
                        $row['squares'] == $str_arr[1] && 
                        $row['region'] == $str_arr[2] &&
                        $row['availability'] == $str_arr[3] )
                        {
                            //delete the ad the user wants from the list
                            array_splice($array_data,$i,1); 
                            //save the altered data (without the deleted ad ) to file
                            $final_data = json_encode($array_data);
                            file_put_contents('./AdsList/Ads.json', $final_data);
                        }
                        $i++;
                    }
                }
            }        
        }
    }

    //populate ad list from FILE
    function getAds(){
        if(file_exists('./AdsList/Ads.json')){
            $current_data = file_get_contents('./AdsList/Ads.json'); 
            $array_data = json_decode($current_data, true);
            if ( $array_data != NULL ) {
                foreach($array_data as $row)  
                {  
                    if (count($row) == 5 && ( $row['owner'] == $_SESSION['userName'] )){//if there are ALL the five rows and the username is the same is this' session username
                        $array_dataCSV = $row['price'].','.$row['squares'].','.
                                         $row['region'].','.$row['availability'];
                        //every record we get we create a new item with a button for deletion as well
                        echo 
                        "<li class=\"adList\">
                            <form action=\"\" method=\"POST\">
                                <input type=\"hidden\" name=\"data\" value=\"".$array_dataCSV."\" >
                                <label name=\"data\" for=\"\">".$array_dataCSV."</label>
                                <input type=\"submit\" id=\"btn_delete\" name=\"submit_delete\" value=\"Διαγραφή\">
                            </form>
                        </li>";
                        //the hidden input is to be able to get the data inside $_POST to eventually delete what we want
                    }
                } 
            }else{
                echo "<li>
                    <label for=\"\">Δεν βρέθηκαν αγγελίες</label>
                    </li>";
            }
        }else{
            echo "<li>
                    <label for=\"\">Δεν βρέθηκε το αρχείο με τις αγγελίες</label>
                </li>";
            
        }
    }
    
    function validateUserInput(){
        //validates if session is valid
        if( !isset($_SESSION['userName']) ){
            header("Location: login.php");
            die();
        }

        global $regionsList;
        global $availabilityList;

        //create a new object with POST attributes that i got from the form
        $ad = new Ad($_SESSION['userName'],$_POST['price'],$_POST['squares'],$_POST['region'],$_POST['availability']);
        
        //uses the special filter_var and FILTER_VALIDATE_INT to know if the user gave an integer for input
        if(filter_var( $ad->getPrice(), FILTER_VALIDATE_INT) == false){
            $message='Δώστε αριθμό για την τιμή (ακινήτου)';
            showMessage($message);
            return $message;
        }else if( !checkValidRange( $ad->getPrice(), 10,5000000) ) {
            $message='Δώστε τιμή από 50 έως 5000000 (για το ακίνητο)';
            showMessage($message);
            return $message;
        }
        if(filter_var( $ad->getSquares(), FILTER_VALIDATE_INT) == false){
            $message='Δώστε αριθμό στα τετραγωνικά';
            showMessage($message);
            return $message;
        }else if( !checkValidRange( $ad->getSquares(), 20,1000) ) {
            $message='Δώστε τιμή από 20 έως 1000 στα τετραγωνικά';
            showMessage($message);
            return $message;
        }

        //searches in array with valid options and finds if the user gave us something valid
        if ( searchItem( $regionsList, $ad->getRegion()) == false ) {
            $message='Δώστε επιλογή για πόλη';
            showMessage($message);
            return $message;
        }

        if ( searchItem( $availabilityList, $ad->getAvailability()) == false ) {
            $message='Δώστε επιλογή για διεθεσιμότητα';
            showMessage($message);
            return $message;
        }
        return $ad;
    }

    //searches item in array
    function searchItem($items,$user_input){
        $found=false;
        $i = 0;
        while( $found == false && $i<count($items) ){
            if ( $items[$i] == $user_input ) {
                $found=true;
            }
            $i++;
        }
        return $found;
    }

    //checks for ugger and lower bounds of arrays
    function checkValidRange($item,$lower,$higher){
        return ($item < $lower || $item > $higher) ? false : true;
    }

    //gets username from session
    function getUsername(){
            return $_SESSION['userName'];
    }
 ?>
