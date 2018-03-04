<?php

session_start();

include 'header.php';

    if (isset ($_GET['page'])){
        $page = $_GET['page'];
    } elseif ((isset($_SESSION)) && (!empty($_SESSION))) {
        $page = 'main';
    } else $page = 'login';

   switch ($page) {

        case 'login':
            include_once 'controllers/loginC.php';      
        break;

        case 'admin':
            include_once 'controllers/adminC.php';
        break;

        case 'main':
            include_once 'controllers/mainC.php';
        break;
    }

echo 
'</body>
</html>';
?>