<?php
require_once("class/DBController.php");

class User
{
    private $db_handle;

    function __construct()
    {
        $this->db_handle = new DBController();
    }
    //insert
    function addUser($name, $email,$mobile_number)
    {
        $query = "INSERT INTO users (name,email,mobile_number) VALUES (?, ?, ?)";
        $paramType = "sss";
        $paramValue = array(
            $name,
            $email,
            $mobile_number
        );

        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
     //view
     function getAlluser() 
     {
             $sql = "SELECT * FROM users";
             $result = $this->db_handle->runBaseQuery($sql);
             return $result;
     }
 
     //delete
      function deleteuser($user_id) 
      {
         $query = "DELETE FROM users WHERE id = ?";
         $paramType = "i";
         $paramValue = array($user_id);
         $this->db_handle->update($query, $paramType, $paramValue);
     }
 
     //edit
        function getuserById($user_id) {
         $query = "SELECT * FROM users WHERE id = ?";
         $paramType = "i";
         $paramValue = array($user_id);
         
         $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
         return $result;
     }
 
 
     //update
 
      
     function edituser($name,$email,$mobile_number,$user_id) {
         $query = "UPDATE users SET name = ?,email = ?,mobile_number = ? WHERE id = ?";
         $param_type = "sssi";
         $param_value_array = array(
            $name,
            $email,
            $mobile_number,
            $user_id

         );
         
         $this->db_handle->update($query, $param_type, $param_value_array);
     }
     
 }

