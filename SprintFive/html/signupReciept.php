<?php
require 'isLogged.php';
$isAdminVar = $_SESSION['isAdmin'];

?>
<!doctype html>
<html lang="en" data-bs-theme="dark" id="htmlTag">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <!--CDN IMPORTS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="../scripts/scripts.js"></script>
    <link href="../styles/styles.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/dacf05fad1.js" crossorigin="anonymous"></script>
    <link href="https://fonts.cdnfonts.com/css/bignoodletitling" rel="stylesheet">
</head>



<?php
if ($isAdminVar == 1) {
    echo " <body onload = \"AfterLoginonloadGroup('receipt', 1)\">";
} else {
    echo " <body onload = \"AfterLoginonloadGroup('receipt', 0)\"> ";
}
?>
<nav id="navbarTarget"></nav>
<!--NAVBAR ENDS HERE, NO ELEMENTS ABOVE THIS LINE-->


<div class="container-fluid col-lg-8 col-sm-8 col-xs-8 mt-3 overall border rounded-4 border-3 border-dark ">
    <div class="row">
        <div id = "signupShared" class="container-fluid">

            <div class="container-fluid  signupContainer mt-3">
                <div id="signupShared" class="rounded-4 ">
                    <?php
                    if($_POST['name'] != "" && $_POST['cohortnumber'] != "" && $_POST['email'] != ""&& $_POST['textmsgsignup'] != "")
                    {
                        echo '<h1 class="font-weight-bold">Username:</h1>';
                        echo '<h3 class="bg-white">'.$_POST["uName"]."</h3>";

                        echo '<h1 class="font-weight-bold">Password:</h1>';
                        echo '<h3 class="bg-white">'.$_POST["pWord"]."</h3>";

                        echo '<h1 class="font-weight-bold">Name:</h1>';
                        echo '<h3 class="bg-white">'.$_POST["name"]."</h3>";

                        echo '<h1 class="font-weight-bold">E-mail:</h1>';
                        echo '<h3 class="bg-white">'.$_POST["email"]."</h3>";

                        echo '<h1 class="font-weight-bold">Cohort Number:</h1>';
                        echo '<h3 class="bg-white">'.$_POST["cohortnumber"]."</h3>";

                        echo '<h1 class="font-weight-bold">Current Status:</h1>';
                        echo '<h3 class="bg-white">'.$_POST["status"]."</h3>";

                        echo '<h1 class="font-weight-bold">Message:</h1>';
                        echo '<h3 class="bg-white">'.$_POST["textmsgsignup"]."</h3>";

                        $uName = filter_var($_POST['uName'],FILTER_SANITIZE_STRING);
                        $pWord = hash('sha256', $_POST['pWord']);
                        $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
                        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                        $cohort = filter_var($_POST['cohortnumber'],FILTER_SANITIZE_NUMBER_INT);

                        if($_POST['status'] == "Seeking Internship") {
                            $status = "Seeking Internship";
                        }
                        if ($_POST['status'] == "Seeking Job") {
                            $status = "Seeking Job";
                        }
                        if ($_POST['status'] == "Not Actively Searching") {
                            $status = "Not Actively Searching";
                        }

                        $roles = $_POST['textmsgsignup'];

                        require 'db.php';

                        $sql = "insert into User (name, email, cohort, status, roles, username, password) values ('$name', '$email', '$cohort', '$status', '$roles','$uName', '$pWord')";

                        $result = @mysqli_query($cnxn, $sql);

                    }
                    else
                    {
                        echo '<h1 class="font-weight-bold">Please fill out the form!</h1>';
                    }

                    if ($result) {
                        echo "Success!";
                        echo "<br><p>We have received your request. Thank you! </p>";
                    } else {
                        echo mysqli_error($cnxn);
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

</div>


<!--FOOTER STARTS HERE, NO ELEMENTS BELOW THIS LINE-->
<footer id="footerTarget" class="container-fluid text-center"></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>