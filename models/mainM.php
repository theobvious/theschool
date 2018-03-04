<?php 

require_once 'data.php';

Class MainM extends DAL {
    
    function getNumbers() {
        $sql1 = "SELECT count(*) as total FROM students";
        $sql2 = "SELECT count(*) as total FROM courses";
        $students = $this->fetch($sql1);
        $courses = $this->fetch($sql2);

        $results = array (
            's' => $students->fetch(PDO::FETCH_ASSOC)['total'],
            'c' => $courses->fetch(PDO::FETCH_ASSOC)['total'],
        );

        return $results;
    }

    function getAll($table) {
        $sql = "SELECT * FROM ".$table;
        $all = $this->fetch($sql);
        $resultArray = $all->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    function getOne($table, $id) {
        $sql = "SELECT * FROM ".$table." WHERE id='".$id."'";
        $item = $this->fetch($sql);
        $resultArray = $item->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    function deleteOne($table, $variable, $id) {
        $sql = "DELETE FROM `courses_students` WHERE ".$variable."='".$id."'";
        $delete = $this->send($sql);

        $sql1 = "DELETE FROM ".$table." WHERE id='".$id."'";
        $delete1 = $this->send($sql1);
    }

    // student-specific functions (CRUD)

    function showStudentCourses($id) {
        $courseList = array ();
        
        $sql = "SELECT * FROM courses_students WHERE student_id='".$id."'";
        $studCourses = $this->fetch($sql);
        $courses = $studCourses->fetchAll(PDO::FETCH_ASSOC);

        foreach ($courses as $row) {
            array_push($courseList, $row['course_id']);
        };

        for ($i=0; $i<count($courseList); $i++) {        
            $sql1 = "SELECT * FROM courses WHERE id='".$courseList[$i]."'";
            $showStudCourses = $this->fetch($sql1);
            $resultArray = $showStudCourses->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultArray as $row) {
                echo $row['name'] .'<br>';
            }
        };
    }

    function listStudentCourses($id) {
        $courseList = array ();
        
        $sql = "SELECT * FROM courses_students WHERE student_id='".$id."'";
        $studCourses = $this->fetch($sql);
        $courses = $studCourses->fetchAll(PDO::FETCH_ASSOC);

        foreach ($courses as $row) {
            array_push($courseList, $row['course_id']);
        };

        $allCourses = array ();

        for ($i=0; $i<count($courseList); $i++) {        
            $sql1 = "SELECT * FROM courses WHERE id='".$courseList[$i]."'";
            $showStudCourses = $this->fetch($sql1);
            $resultArray = $showStudCourses->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultArray as $row) {
                array_push($allCourses, $row['name']);
            }
        };
        
        return $allCourses;
        
    }

    function editStudent($id, $name, $phone, $email) {
        $sql = "UPDATE `students` SET `name`='".$name."',`phone`='".$phone."',`email`='".$email."' WHERE id='".$id."'";
        $edit = $this->send($sql);
    }

    function clearStudentCourses($id) {
        $sql = "DELETE FROM `courses_students` WHERE `student_id`='".$id."'";
        $delete = $this->send($sql);
    }

    function updateStudentCourses($student_id, $course) {
        $sql = "SELECT * FROM `courses` WHERE `name`='".$course."'";
        $update = $this->fetch($sql);

        $courses = $update->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($courses as $row) {
            $sql1 = "INSERT INTO `courses_students`(`course_id`, `student_id`) VALUES ('".$row['id']."','".$student_id."')";
            $do = $this->send($sql1);
        }
    }

    function addStudent($name, $phone, $email, $image) {
        $sql = "INSERT INTO `students`(`name`, `phone`, `email`, `image`) VALUES ('".$name."','".$phone."','".$email."','".$image."')";
        $add = $this->send($sql);
        return $add;
    }

    function showCourseStudents($id) {
        $studList = array ();
        
        $sql = "SELECT * FROM courses_students WHERE course_id='".$id."'";
        $c = $this->fetch($sql);
        $students = $c->fetchAll(PDO::FETCH_ASSOC);

        foreach ($students as $row) {
            array_push($studList, $row['student_id']);
        };

        for ($i=0; $i<count($studList); $i++) {        
            $sql1 = "SELECT * FROM students WHERE id='".$studList[$i]."'";
            $showStuds = $this->fetch($sql1);
            $resultArray = $showStuds->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultArray as $row) {
                echo $row['name'] .'<br>';
            }
        };
    }

    //course-specific functions (CRUD)
    function editCourse($id, $name, $description) {
        $sql = "UPDATE `courses` SET `name`='".$name."',`description`='".$description."' WHERE id='".$id."'";
        $edit = $this->send($sql);
    }

    function addCourse($name, $description, $image) {
        $sql = "INSERT INTO `courses`(`name`, `description`, `image`) VALUES ('".$name."','".$description."','".$image."')";
        $edit = $this->send($sql);
    }

    function courseStudentNumber($id) {
        $sql = "SELECT count(*) as total FROM `courses_students` WHERE `course_id`='".$id."'";
        $students = $this->fetch($sql);
        $total = $students->fetch(PDO::FETCH_ASSOC)['total'];
        return $total;
    }
}

?>