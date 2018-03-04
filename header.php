<?php
require('config.php');
echo '
<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title> PROJECT</title>
            <link href="'.DIR.'style.css" rel="stylesheet" type="text/css">
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
            <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        </head>
        
        <body>
        <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            <li><a href="'.DIR.'index.php"><img src="'.DIR.'upload/logo.png" height="40px"></a></li>
';

if (empty($_SESSION)) {
    echo '';
    } elseif (($_SESSION['role'] == 'owner') || ($_SESSION['role'] == 'admin')) {
        echo '<li><a href="'.DIR.'index.php?page=main">School</a></li>
        <li><a href="'.DIR.'index.php?page=admin">Administration</a></li>';
    } else echo '<li><a href="'.DIR.'index.php?page=main">School</a></li>';
              
echo '
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li>';
                              
if (empty($_SESSION)) {
    echo '';
} else echo '<div class="sideimg"><img src="'.DIR.$_SESSION['image'].'" class="navbaricon"> </div>'.$_SESSION['name'] . ',<br>' . $_SESSION['role'] . '<br/>' //. $_SESSION['image'] . '<br/>' 
. '<a href="'.DIR.'controllers/logoutC.php">LOG OUT</a>';
                
echo '</li>
            </ul>
            </div>
          </div>
        </div>
        </nav>';
?>