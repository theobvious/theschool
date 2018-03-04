<?php
require_once 'models/mainM.php'; // make sql connections available
    
Class Render { 

    function columnView() { //render three columns every time
        $render = new mainM(); 
        echo '<div class="container-fluid">
                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                <h3>Students
                <a href="'.DIR.'index.php?page=main&action=student-add"><i class="far fa-plus-square"></a></i>
                </h3><br>';
                    
        $displayStudents = $render->getAll("students"); // show list of students
            foreach ($displayStudents as $row) {
                echo '<div class="displaydiv"><img class="icon" src="'.DIR.$row['image'].'"> <a href="'.DIR.'index.php/?page=main&action=student-details&id='.$row['id'].'">'
                . $row['name'] . '</a>, ' . $row['phone'] . '</div>';
            };

		echo '</div>
                <div class="col-md-3">
                <h3>Courses';
        if (empty($_SESSION)) {
            echo '';
        } elseif (($_SESSION['role'] == 'owner') || ($_SESSION['role'] == 'admin')) {
            echo ' <a href="'.DIR.'index.php?page=main&action=course-add"><i class="far fa-plus-square"></i></a>';
        };
        
        echo '</h3><br>';

        $displayCourses = $render->getAll("courses"); // show list of courses
            foreach ($displayCourses as $row) {
                echo '<div class="displaydiv"><div class="sideimg"><img class="icon" src="'.DIR.$row['image'].'"></div> <b><a href="'.DIR.'index.php/?page=main&action=course-details&id='.$row['id'].'">'
                .$row['name'].'</a></b><br>'.$row['description'].'</div>';
            };

		echo '</div>
            <div class="col-md-5">';
    }

    function mainView() { // default view with # of students and courses
        $render = new mainM();
        
        $show = $this->columnView();

        $display = $render->getNumbers();
            
        echo '<div class="displaydiv"><h2>Total students: '.$display['s']
            . '<br>' 
            . 'Total courses: '.$display['c']
            .'</h2>';                 
    }

    function footer() { //close the display html
        echo '</div>
        </div>
        </div>
        </div>';
    }
}

Class Course extends Render {

    function detailsView($id) { //when course name is clicked show course details
        $render = new mainM();

        $show = $this->columnView();

        $displayOneCourse = $render->getOne("courses", $id);
        foreach ($displayOneCourse as $row) {
            echo '<div class="displaydiv"><img src="'.DIR.$row['image'].'" class="bigicon"><h2>'.$row['name'];
            if (empty($_SESSION)) {
                echo '';
            } elseif (($_SESSION['role'] == 'owner') || ($_SESSION['role'] == 'admin')) {
                echo ' <a href="'.DIR.'index.php?page=main&action=course-edit&id='.$id.'"><i class="far fa-edit"></i></a>';
            }
            echo '</h2><br>This course is all about:<br>'.$row['description'].'<br><br><h4>Enrolled students:</h4><br>';
            $render->showCourseStudents($id);
        }

        $this->footer();
    }

    function addView() { //when + is clicked to add new course
        $render = new mainM();
        $show = $this->columnView();
        
        echo '
        <h2>Add a course</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            Name:<br>
            <input type="text" name="name"><br>
            Description:<br>
            <input type="text" name="description"><br>
            <input type="file" name="image">
            <input type="submit" name="submit">
        </form>';
        
        $this->footer();

    }

    function editView($id) { //when edit button is clicked
        $render = new mainM();
        $show = $this->columnView();
        $c = $render->getOne("courses", $id);

        foreach ($c as $row) {
            $n = $render->courseStudentNumber($id);

            echo 
            '<div>
            <form action="" method="post"> 
            <h2>Edit course '.$row['name'];

            if ($n==0) {
                echo ' <a href="'.DIR.'index.php?page=main&action=course-delete&id='.$row['id'].'"><i class="far fa-trash-alt"></i></a></h2>';
            } else echo '</h2>';

            echo '<label>Name: <input type="text" name="name" value="';
            if (isset($_POST['name'])) {
                echo $_POST['name'];
            } else echo $row['name'];
            
            echo '"></label><br>
                <label>Description: <input type="text" name="description" value="';
                if (isset($_POST['description'])) {
                    echo $_POST['description'];
                } else echo $row['description'];
            
            echo '"></label><br>
                <input type="submit" name="submit" value="Save changes">
            </form><br>
            </div>
            <div>
                <b>Total students attending: '.$n.'</b>
            </div>
            ';

            $this->footer();

        }
    }
}

Class Student extends Render {

    function detailsView($id) { //when student name is clicked
        $render = new mainM();
        $show = $this->columnView();

        $displayOneStudent = $render->getOne("students", $id);
        foreach ($displayOneStudent as $row) {
            echo '<div class="displaydiv"><img src="'.DIR.$row['image'].'" class="bigicon"><h2>'.$row['name'].' <a href="'.DIR.'index.php?page=main&action=student-edit&id='.$id.'"><i class="far fa-edit"></i></a></h2><br>'
                .$row['phone'].'<br>'
                .$row['email'].'<br>'
                .'<h4>Courses:</h4>';
                $render->showStudentCourses($id);
        }
        $this->footer();
    }

    function addView() { //when + is clicked to add student
        $render = new mainM();

        $show = $this->columnView();
        
        echo '
        <h2>Add a student</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label>Name: 
            <input type="text" name="name"></label><br>
            <label>Phone:
            <input type="text" name="phone"></label><br>
            <label>Email:
            <input type="text" name="email"></label><br>
            <input type="file" name="image">
            <div>';

            $c = $render->getAll("courses");
            foreach ($c as $row) {
                echo '<input type="checkbox" name="course[]" id="'.$row['name'].'" value="'.$row['name'].'">'.$row['name'].'<br>';
            }

            echo '</div><input type="submit" name="submit">
        </form>
        ';

        $this->footer();
    }

    function editView($id) { //when edit button is clicked
        $render = new mainM();
        $show = $this->columnView();
        $s = $render->getOne("students", $id);

        foreach ($s as $row) {
            echo 
            '<form action="" method="post">
                <h2>Edit student '.$row['name'].' <a href="'.DIR.'index.php?page=main&action=student-delete&id='
                .$row['id'].'"><i class="far fa-trash-alt"></i></a></h2>
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
            
            echo '"></label><br>
                <div>';
            }

            $list = $render->listStudentCourses($id);
            $c = $render->getAll("courses");
            foreach ($c as $row) {
                if (!in_array($row['name'], $list)) {
                    echo '<input type="checkbox" name="course[]" id="'.$row['name'].'" value="'.$row['name'].'">'.$row['name'].'<br>';
                } else echo '<input type="checkbox" name="course[]" id="'.$row['name'].'" checked="checked" value="'.$row['name'].'">'.$row['name'].'<br>';
            }

            echo '</div>
            <input type="submit" name="submit" value="Save changes">
            </form>';

            $this->footer();

    }


}
    

?>