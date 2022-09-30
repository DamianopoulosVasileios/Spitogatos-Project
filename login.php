<?php 
    include('./include/header_login.php');
    require_once('./include/functions.php');

    if($_SERVER['REQUEST_METHOD'] == "POST" ) {
        //if user authenticates successfully then i redirect to main-page 
        //and i start the session in order to give the session username required by the other form
        if ( userLogin() == true ){
            session_start();
            $_SESSION['userName'] = $_POST['username'];
            header("Location: main-page.php", TRUE, 301);
            exit();
        }else{
            //nullifies the session
            $_SESSION['userName'] = NULL;
        }

    }

?>
    <section class="login-form">
        <h1>Sign in with your credentials</h1>

        <form action="" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="" placeholder="'user' <-for demo" autofocus autocomplete>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="" placeholder="'mypassword' <-for demo" autocomplete="off">
            </div>
            <input type="submit" class="btn" value="Sing In">
        </form>

	</section>
<?php  include('./include/footer.php'); ?>
