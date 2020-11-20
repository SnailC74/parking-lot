<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PARK LOCATION MAP</title>
    <link rel="stylesheet" href="/static/css/main.css" type="text/css" />
    <link rel="stylesheet" href="/static/css/bootstrap.css" type="text/css" />
    <script src="/static/js/jquery-3.3.1.min.js"></script>
    <script src="/static/js/bootstrap.js"></script>
    <script src="/static/js/bootstrap.bundle.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA50uE_5DwyD86HAysZwE3HDtUBUkP7JPw&callback=initMap&libraries=&v=weekly" defer></script>
</head>
<body>
<div class="bg-primary top_bar text-white">
    <div class="container text-white">
        <a class='text-white mx-1' href='/index/index'>Home Page</a>
        <?php
            // check the user login state
            if(!isset($_SESSION['userid'])) {
            echo "<span class='login_items float-right'>
                <a class='text-white mx-1' href='/login/login\'>Login</a>
                / <a class='text-white mx-1' href=\"/login/register\">Register</a>
            </span>";
        }else{
            echo "<span class='login_items float-right'>
                    <span class='px-4'>Welcome back, ". $_SESSION['username'] ." !</span>
                    <a class='text-white mx-1' href='/login/logout'>Logout</a>
                </span>";
        }
        ?>
    </div>
</div>
