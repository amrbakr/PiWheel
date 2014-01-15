<?php


class Student extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insertStudent($params){
      // UserID, Username, Password, Pass_Salt, IsActive, LastLoginDate, RoleID, StartDate,
      // Fullname, Gender, Birthdate, IsLoggedIn
      
      $this->db->insert('User',$params);
    }

   function verifyUser($email,$password)
   {    
        $user = $this->getUser($email);
        if(!$user){
          return false;
        }
        $password_salt = $user->Pass_Salt;
        $password = passwordEncryption($password,$password_salt);

        $q = $this
             ->db
             ->where('Username',$email)
             ->where('Password',$password)
             ->limit(1)
             ->get('User');

        if( $q->num_rows > 0){
            return $q->row();
        }

        return false;     
   }

   function getUser($email)
   {
        $q = $this
            ->db
            ->where('Username',$email)
            ->limit(1)
            ->get('User');

         if($q->num_rows >0){
            return $q->row();
         } 

         return false;  
   }

      function getCourses($id)
   {
        $q = $this
            ->db
            ->where('StudentID',$id)
            ->get('Enrollment');

         if($q->num_rows >0){
            return $q->result();
         } 

         return false;  
   }


  
    
}