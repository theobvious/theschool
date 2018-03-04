<?php
include 'views/main.php';
include 'validations.php';

$renderS = new Student();
$renderC = new Course();

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
        $renderS->mainView();      
    break;

    case 'student-details':
        $renderS->detailsView($id);
    break;

    case 'course-details':
        $renderC->detailsView($id);
    break;
    
    case 'course-delete':
        $del = new MainM();
        $del->deleteOne("courses", "course_id", $id);
        $renderC->mainView();
    break;

    case 'student-delete':
        $del = new MainM();
        $del->deleteOne("students", "student_id", $id);
        $renderS->mainView();
    break;

    case 'course-edit':
        $renderC->editView($id);
        $val = new Validation();

        if(isset($_POST['submit'])) {
            if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
                $val->showError('Enter course title.');
            } elseif ((!isset($_POST['description'])) || ($_POST['description'] == null)) {
                $val->showError('Enter course description.');
            } else {
                $name = $val->validate($_POST['name']);
                $description = $val->validate($_POST['description']);

                $data = new MainM();
                $edit = $data->editCourse($id, $name, $description);
                $val->noError('Edits successfully submitted!');
            }
        }    
    break;

    case 'student-edit':
        $renderS->editView($id);
        $val = new Validation();  

        if(isset($_POST['submit'])) {
            if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
                $val->showError('Enter student name.');
            } elseif ((!isset($_POST['phone'])) || ($_POST['phone'] == null)) {
                $val->showError('Enter student phone number.');
            } elseif ((!isset($_POST['email'])) || ($_POST['email'] == null)) {
                $val->showError('Enter student email.');
            } else {
                $name = $val->validate($_POST['name']);
                $phone = $val->validate($_POST['phone']);
                $email = $val->validate($_POST['email']);
                    
                $data = new MainM();
                $edit = $data->editStudent($id, $name, $phone, $email);
                $data->clearStudentCourses($id);

                $checked = array();
                    foreach ($_POST['course'] as $checkbox) {
                        array_push($checked, $checkbox);
                } 

                for ($i=0; $i<count($checked); $i++) {
                    $data->updateStudentCourses($id, $checked[$i]);
                }
                
                $val->noError('Edits successfully submitted!');
            }   
        }
    break;

    case 'course-add': // render the form, check that it's filled, send it out
        $renderC->addView(); 
        $val = new Validation();
        
        if (isset($_POST['submit'])) {
            if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
                $val->showError('Enter course name.');
            } elseif ((!isset($_POST['description'])) || ($_POST['description'] == null)) {
                $val->showError('Enter course description.');
            } else {
                $name = $val->validate($_POST['name']);
                $description = $val->validate($_POST['description']);
                
                $image = $_FILES['image'];
                $imageName = $val->validate($image['name']);
                $imageTmpName = $image['tmp_name'];
                $imageSize = $image['size'];
                $imageError = $image['error'];

                if ($imageError === UPLOAD_ERR_OK) {
                    $imageDestination = 'upload/';
                    move_uploaded_file($imageTmpName, $imageDestination.$imageName);
                    $data = new MainM();
                    $add = $data->addCourse($name, $description, 'upload/'.$imageName);
                    $val->noError('Course successfully added!');
                } else {
                    $err = $val->uploadError($imageError);
                    $val->showError($err);
                }
            }
            };
    break;

    case 'student-add': // render form, check filled, submit
        $renderS->addView();
        $val = new Validation();

        if (isset($_POST['submit'])) {
            if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
                $val->showError('Enter student name.');
            } elseif ((!isset($_POST['phone'])) || ($_POST['phone'] == null)) {
                $val->showError('Enter student phone number.');
            } elseif ((!isset($_POST['email'])) || ($_POST['email'] == null)) {
                $val->showError('Enter student email.');
            } else {
                $name = $val->validate($_POST['name']);
                $phone = $val->validate($_POST['phone']);
                $email = $val->validate($_POST['email']);
               
                $image = $_FILES['image'];
                $imageName = $val->validate($image['name']);
                $imageTmpName = $image['tmp_name'];
                $imageSize = $image['size'];
                $imageError = $image['error'];

                if ($imageError === UPLOAD_ERR_OK) {
                    $imageDestination = 'upload/';
                    move_uploaded_file($imageTmpName, $imageDestination.$imageName);
                    $data = new MainM();
                    $id = $data->addStudent($name, $phone, $email, 'upload/'.$_FILES['image']['name']);

                    $checked = array();
                    foreach ($_POST['course'] as $checkbox) {
                        array_push($checked, $checkbox);
                    } 

                    for ($i=0; $i<count($checked); $i++) {
                        $data->updateStudentCourses($id, $checked[$i]);
                    }

                    $val->noError('Student successfully submitted!');
                } else {
                    $err = $val->uploadError($imageError);
                    $val->showError($err);
                }
                }
    
        };
    break;

}
?>