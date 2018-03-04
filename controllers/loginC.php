<?php
include './models/data.php';
includE './models/loginM.php';
require_once './views/login.php';


$render = new LoginView;
$render->show();
    
if (isset($_POST['submit'])) {
    if ((!isset($_POST['email'])) || ($_POST['email'] == null)) {
        echo 'Enter email.';
    } elseif ((!isset($_POST['password'])) || ($_POST['password'] == null)) {
        echo 'Enter password.';
    } else {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $data = new LoginM();
        $results = $data->setQuery($email, $pass);
        
        if (empty($results)) {
            echo 'No such user.';
        } else {
            $_SESSION['name'] = $results['name'];
            $_SESSION['role'] = $results['role'];
            $_SESSION['image'] = $results['image'];
            header("location: ../theschool/index.php?page=main");
        };
    };
};

?>