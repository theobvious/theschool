<?php 

require_once 'data.php';

Class AdminM extends DAL {

    function getNumbers() {
        $sql = "SELECT count(*) as total FROM users";
        $users = $this->fetch($sql);
        $resultArray = $users->fetch(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    function getAllAdmins() {
        $sql = "SELECT * FROM users";
        $users = $this->fetch($sql);
        $resultArray = $users->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    function getOneAdmin($id) {
        $sql = "SELECT * FROM users WHERE id='".$id."'";
        $admins = $this->fetch($sql);
        $resultArray = $admins->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    function addAdmin($name, $phone, $email, $role, $image) {
        $sql = "INSERT INTO `users`(`name`, `phone`, `email`, `role`, `image`) VALUES ('".$name."','".$phone."','".$email."','".$role."','".$image."')";
        $edit = $this->send($sql);
    }

    function editAdmin($id, $name, $phone, $email, $role) {
        $sql = "UPDATE `users` SET `name`='".$name."',`phone`='".$phone."',`email`='".$email."',`role`='".$role."' WHERE id='".$id."'";
        $edit = $this->send($sql);
    }

    function deleteAdmin($id) {
        $sql = "DELETE FROM `users` WHERE `id`='".$id."'";
        $delete = $this->send($sql);
    }

}
?>