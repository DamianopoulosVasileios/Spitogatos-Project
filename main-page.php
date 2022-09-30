<?php
    session_start();
    if (!isset($_SESSION['userName']))  //if the session is not with the valid username then return to login page
    {
        header("Location: login.php");
        die();
    }

    include('./include/header_main-page.php');
    require_once('./Models/Ad.php');
    require_once('./include/functions.php');

    if($_SERVER['REQUEST_METHOD'] == "POST" )   //if there is a POST Request
    {
        if (isset($_POST["submit_get"]))    //if get button was pressed
        {
            $myads = true;
        }
        else if (isset($_POST["submit_create"]))   //if create button was pressed
        {
            createAd();
        }
        else if (isset($_POST["submit_delete"]))   //if delete button was pressed
        {
            deleteAd();
        }
        else if (isset($_POST["submit_logout"]))   //if logout button was pressed
        {
            $_SESSION['userName'] = NULL;       // nullify session that user cannot go back
            header("Location: login.php");
            die();
        }
    }
?>

<body>
    <section class="main-page">
        <header>
            <p>Σύστημα διαχείρισης αγγελιών (καλώς ήλθες <?= getUsername() ?>)</p>
        </header>
        
        <section class="contents">
            <div class="house_attr">
                <form action="" method="POST">
                    <label for="price">Τιμή: 
                        <input name="price" id="price" type="text" autofocus autocomplete placeholder="50-5000000">
                    </label>

                    <label for="region">Περιοχή: 
                        <select name="region" id="region">
                            <?php
                                $i=0;
                            ?>
                            <option value="<?=$regionsList[$i]?>"><?=$regionsList[$i++]?></option>
                            <option value="<?=$regionsList[$i]?>"><?=$regionsList[$i++]?></option>
                            <option value="<?=$regionsList[$i]?>"><?=$regionsList[$i++]?></option>
                            <option value="<?=$regionsList[$i]?>"><?=$regionsList[$i++]?></option>
                        </select>
                    </label>

                    <label for="availability">Διαθεσιμότητα: 
                        <select name="availability" id="availability" >
                            <?php
                                $i=0;
                            ?>
                            <option value="<?=$availabilityList[$i]?>"><?=$availabilityList[$i++]?></option>
                            <option value="<?=$availabilityList[$i]?>"><?=$availabilityList[$i++]?></option>
                        </select>
                    </label>

                    <label for="squares">Τετραγωνικά: 
                        <input name="squares" id="squares" type="text" placeholder="20-1000">
                    </label>

                    <input type="submit" class="button" id="btn_create" name="submit_create" value="Καταχώρηση Αγγελίας">
                </form>
            </div>

            <div class="user_ads">
                <form action="" method="POST">
                    <input type="submit" class="button" id="btn_get" name="submit_get" value="Λίστα αγγελιών">

                    <div class="ads">
                        <?php
                            if (isset($myads)){
                        ?>
                                <div class="ads">
                                    <ul>
                                        <?=getAds()?>
                                    </ul>
                                </div>
                        <?php 
                            } 
                        ?>
                    </div>
                </form>
                
            </div>
        </section>

        <footer>
            <p>All rights reserved</p>           
            <form action="" method="POST">
                <input type="submit" class="button" id="btn_logout" name="submit_logout" value="Αποσύνδεση">
            </form>
        </footer>
    </section>

<?php include('./include/footer.php'); ?>