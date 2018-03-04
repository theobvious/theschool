<?php
include 'views/admin.php';
include 'validations.php';

$render = new Admin();

if (isset ($_GET['action'])){
    $action = $_GET['action'];
} else {
    $action = '';
}

if (isset ($_GET['id'])){
    $id = $_GET['id'];
}

switch ($action) {

    case '':
        $render->mainView();      
    break;

    case 'admin-details':
        $render->detailsView($id);
    break;
    
    case 'admin-delete':
        $del = new AdminM();
        $del->deleteAdmin($id);
        $render->mainView();
    break;

    case 'edit':
        $render->editView($id);
        $val = new Validation();

        if(isset($_POST['submit'])) {
            if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
                $val->showError('Enter admin name.');
            } elseif ((!isset($_POST['phone'])) || ($_POST['phone'] == null)) {
                $val->showError('Enter admin phone #.');
            } elseif ((!isset($_POST['email'])) || ($_POST['email'] == null)) {
                $val->showerror('Enter admin email.');
            } else {
                $name = $val->validate($_POST['name']);
                $phone = $val->validate($_POST['phone']);
                $email = $val->validate($_POST['email']);
                $role = $_POST['role'];
            
                $data = new AdminM();
                $edit = $data->editAdmin($id, $name, $phone, $email, $role);
                echo '<meta http-equiv="refresh" content="0">';
            }
        }   
      
    break;

    case 'add-admin':
        $render->addView();
        $val = new Validation();
        
      if (isset($_POST['submit'])) {
           if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
                $val->showError('Enter admin name.');
            } elseif ((!isset($_POST['phone'])) || ($_POST['phone'] == null)) {
                $val->showError('Enter admin phone #.');
            } elseif ((!isset($_POST['email'])) || ($_POST['email'] == null)) {
                $val->showError('Enter admin email.');
            } elseif (!isset($_POST['role'])) {
                $val->showError('Select admin role');
            } else {
                $name = $val->validate($_POST['name']);
                $phone = $val->validate($_POST['phone']);
                $email = $val->validate($_POST['email']);
                $role = $_POST['role'];
                
                $image = $_FILES['image'];
                $imageName = $val->validate($image['name']);
                $imageTmpName = $image['tmp_name'];
                $imageSize = $image['size'];
                $imageError = $image['error'];

                if ($imageError === UPLOAD_ERR_OK) {
                    $imageDestination = 'upload/';
                    move_uploaded_file($imageTmpName, $imageDestination.$imageName);
                } else {
                    $err = $val->uploadError($imageError);
                    $val->showError($err);
                }
            }
        
                $data = new AdminM();
                $add = $data->addAdmin($name, $phone, $email, $role, 'upload/'.$_FILES['image']['name']);
                echo '<meta http-equiv="refresh" content="0">';
        };
    break;

}
?>