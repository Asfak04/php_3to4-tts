<?php
require_once("class/DBController.php");
require_once("class/User.php");
$db_handle = new DBController();

$action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {

    case "user-add":
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile_number = $_POST['mobile_number'];

            $user = new User();
            $insertId = $user->addUser($name, $email, $mobile_number);

            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } else {
                header("Location: index.php");
            }
        }
        require_once "web/user-add.php";
        break;
    case "user-edit":

        $user_id = $_GET["id"];
        $user = new User();
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile_number = $_POST['mobile_number'];

            $user = new User();
            $insertId = $user->editUser($name, $email, $mobile_number,$user_id);
            header("Location: index.php");
        }

        $result = $user->getuserById($user_id);
        require_once "web/user-edit.php";

        break;

    case "user-delete":
        $user_id = $_GET["id"];
        $user = new User();
        $user->deleteuser($user_id);
        $result = $user->getAlluser();
        require_once "web/user.php";
        break;


    default:
    $user = new User();
    $result = $user->getAlluser();
    require_once "web/user.php";
    break;
}
