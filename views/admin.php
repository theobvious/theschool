<?php
require_once 'models/AdminM.php'; // make sql connections available
    
Class Render {

    function columnView() { //render two columns every time
        $render = new AdminM(); 
        echo '<div class="container-fluid">
                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                <h4>Administrators
                <a href="'.DIR.'index.php?page=admin&action=add-admin"><i class="far fa-plus-square"></a></i>
                </h4><br>';
                    
        $displayAdmins = $render->getAllAdmins();
            foreach ($displayAdmins as $row) {
            echo '<div class="box"><a href="'.DIR.'index.php/?page=admin&action=admin-details&id='.$row['id'].'">'
                . $row['name'] . '</a>, ' . $row['phone'] . '</div>';
        };

		echo '</div>
            <div class="col-md-7">';
    }

    function mainView() {
        $render = new adminM();
        $show = $this->columnView(); 
        $display = $render->getNumbers();

        echo 'Total administrators: '.$display['total'];

    }

    function footer() {
        echo '</div>
        </div>
        </div>';
    }
}

Class Admin extends Render {

    function detailsView($id) { //when admin name is clicked show admin details
        $render = new adminM();

        $show = $this->columnView();

        $displayOneAdmin = $render->getOneAdmin($id);
        foreach ($displayOneAdmin as $row) {
            echo '<div class="displaydiv"><img src="'.DIR.$row['image'].'" class="bigicon"><h2>'.$row['name'].' ('
            .$row['role'].')';
            
            if ((($_SESSION['role'] == 'owner') && ($row['role'] == 'sales' || 'admin'))
            || (($_SESSION['role'] == 'admin') && ($row['role'] == 'sales'))) {
                echo ' <a href="'.DIR.'index.php?page=admin&action=edit&id='.$id.'"><i class="far fa-edit"></i></a>';
            } 

            echo '</h2><br>'
            .$row['phone'].'<br>'
            .$row['email'].'<br>';
        }
        $this->footer();
    }

    function addView() {
        $render = new AdminM();
        $show = $this->columnView();

        echo '
        <div class="displaydiv">
        <h2>Add an administrator</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Name: <input type="text" name="name"></input></label><br>
            <label>Phone: <input type="text" name="phone"></input></label><br>
            <label>Email: <input type="text" name="email"></input></label><br>
            <input type="file" name="image"';
            
            if ($_SESSION['role']=='owner') {
                echo '<label>Role: <select name="role">
                            <option value="sales">Sales</option>
                            <option value="admin">Admin</option>
                        </select> </label><br>';
            }

            echo '<input type="submit" name="submit">
            </form>';

        $this->footer();
    }

    function editView($id) {
        $render = new AdminM();
        $show = $this->columnView();

        $a = $render->getOneAdmin($id);

        foreach ($a as $row) {
            echo '
            <div class="displaydiv">
            <h2>Edit '.$row['role'].' '.$row['name'];

            if ($_SESSION['role']=='owner') {
                echo ' <a href="'.DIR.'index.php?page=admin&action=admin-delete&id='.$row['id'].'"><i class="far fa-trash-alt"></i></a></h2>';
            } else echo '</h2>';
            
            echo '<form id="form" action="" method="POST">
                <label>Name: <input type="text" name="name" value="';
                if (isset($_POST['name'])) {
                    echo $_POST['name'];
                } else echo $row['name'];
            
            echo '"></label><br>
                <label>Phone: <input type="text" name="phone" value="';
                if (isset($_POST['phone'])) {
                    echo $_POST['phone'];
                } else echo $row['phone'];
            
            echo '"></label><br>
                <label>Email: <input type="text" name="email" value="';
                if (isset($_POST['email'])) {
                    echo $_POST['email'];
                } else echo $row['email'];
            
            echo '"></input></label><br>';
                
                if ($_SESSION['role']=='owner') {
                    echo '<label>Role: <select name="role">
                                <option value="sales">Sales</option>
                                <option value="admin">Admin</option>
                            </select> </label><br>';
                }

                echo '<input type="submit" name="submit"></form>';
            }

        $this->footer();
    }
}  

?>