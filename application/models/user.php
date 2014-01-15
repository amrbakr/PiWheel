<?php


class User extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
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

   function getUserByID($ID)
   {
        $q = $this
                  ->db
                  ->where('UserID',$ID)
                  ->limit(1)
                  ->get('User');

               if($q->num_rows >0){
                  return $q->row();
               } 

               return false; 
   }


   function preLoginCheck($user){
      $output = array('result'=>true,'message'=>'');

      // if($user->IsActive == '0'){
      //   $output['result']  = false;
      //   $output['message'] = $lang['error_login_failed_notActive'];
      //   return $output; 
      // }

      if($user->IsLoggedIn == '1'){
        $output['result']  = false;
        $output['message'] = 'You are already logged in'; 
        return $output; 
      }

      return $output;

   }

   function preLogoutSettings($email)
   {  
      $user = $this->getUser($email);
      $data = array(
               'IsLoggedIn' => 0
            );

      $this->db->where('UserID', $user->UserID);
      $this->db->update('User', $data);
   }

   function preLoginSettings($user){
      $timestamp = date('Y-m-d H:i:s');
      $data = array(
               'IsLoggedIn' => 1,
               'LastLoginDate' => $timestamp
            );

      $this->db->where('UserID', $user->UserID);
      $this->db->update('User', $data); 
   }

   function startSession($user,$object){
      $this->preLoginSettings($user);
      $notification = $this->getNotifications($user->UserID);
      $user->notifications = $notification;
      $object->session->set_userdata($user);
   }

   function getNotifications($userID)
   {
      $q = $this
                  ->db
                  ->where('UserID',$userID)
                  ->where('Status','1')
                  ->get('notification');

               if($q->num_rows >0){
                  return $q->result();
               } 

               return false; 
   }

   function loggedIsAdmin($object)
   {
      $user = $this->getUser($object->session->userdata['Username']);
      if($user->RoleID == 1)
        return true;

      return false;
   }

   function loggedIsStudent($object)
   {
      $user = $this->getUser($object->session->userdata['Username']);
      if($user->RoleID == 2)
        return true;
      
      return false;
   }

   function loggedIsInstructor($object)
   {
     $user = $this->getUser($object->session->userdata['Username']);
      if($user->RoleID == 3)
        return true;
      
      return false;
   }

   function isAdmin($roleID)
   {
    if(trim($roleID) ==  "1" )
        return true;
    else
        return false;
   }

   function studentReg($params){
      $params['Pass_Salt'] = saltGenerator();
      $params['Username']  = $params['email'];
      $params['IsActive']  = 0;
      $params['RoleID']    = '2';
      $params['Fullname']  = $params['fullname']; 
      $params['Gender']    = $params['gender'];
      $params['Birthdate'] = modifyBirthDate($params['birth-day'],$params['birth-month'],$params['birth-year']);
      $params['Password']  = passwordEncryption($params['password'],$params['Pass_Salt']);
      $params['UserID']    = uniqid();
      $params['IsLoggedIn'] = 1;
      unset($params['type']);
      unset($params['email']);
      unset($params['password']);
      unset($params['fullname']);
      unset($params['gender']);
      unset($params['birth-day']);
      unset($params['birth-month']);
      unset($params['birth-year']);

      $query = $this->db->insert_string('User', $params);
      $query = $this->db->query($query);

      if($this->db->affected_rows() != 1){
        return false;
      }

      $token_params['UserID'] = $params['UserID'];
      $token_params['Token']  =  tokenGenerator($params['Username']);
      $token_params['status'] = 1;
      
      $query_token = $this->db->insert_string('activationTokens', $token_params);
      $query_token = $this->db->query($query_token); 

      return ($this->db->affected_rows() != 1) ? false : true;
   }


   function createToken($userID,$Username)
   {
      $token_params['UserID'] = $userID;
      $token_params['Token']  =  tokenGenerator($Username);
      $token_params['status'] = 1;
      
      $query_token = $this->db->insert_string('activationTokens', $token_params);
      $query_token = $this->db->query($query_token); 

      return ($this->db->affected_rows() != 1) ? false : true;
   }


   function instructorReg($params){
      $params['RoleID']    = "3";
      $params['Username']  = $params['email'];
      $params['Pass_Salt'] = saltGenerator();
      $params['Password']  = passwordEncryption($params['password'],$params['Pass_Salt']);
      $params['Prefix']    = $params['prefix'];
      $params['Fullname']  = $params['fullname'];
      $params['Title']     = $params['title'];

      unset($params['title']);
      unset($params['fullname']);
      unset($params['prefix']);
      unset($params['password']);
      unset($params['email']);
      unset($params['type']);

      $query = $this->db->insert_string('User', $params);
      $query = $this->db->query($query);

      if($this->db->affected_rows() != 1){
        return false;
      }

      $token_params['UserID'] = $params['UserID'];
      $token_params['Token']  =  tokenGenerator($params['Username']);
      $token_params['status'] = 1;
      
      $query_token = $this->db->insert_string('activationTokens', $token_params);
      $query_token = $this->db->query($query_token); 

      return ($this->db->affected_rows() != 1) ? false : true;
   }

   function getUsernameByToken($token)
   {
       $q = $this
            ->db
            ->where('Token',$token)
            ->limit(1)
            ->get('activationTokens');

         if($q->num_rows >0){
            $user = $q->result()[0];
            $userId = $user->UserID;
            $user = $this->getUserByID($userId);
            return $user->Username;
         }
   }

   function activateUser($token)
   {
        $q = $this
            ->db
            ->where('Token',$token)
            ->limit(1)
            ->get('activationTokens');

         if($q->num_rows >0){
            $user = $q->result()[0];
            $userId = $user->UserID;
            $dbUser = $this->getUserByID($userId);
            $tmp_email = $dbUser->tmp_email;

           
            if($user->status == 1){
                
                $data = array(
                         'IsActive' => 1
                      );

                if($tmp_email != "")
                 {
                  $data['Username'] = $tmp_email;
                  $data['tmp_email']="";
                 }

                $this->db->where('UserID', $user->UserID);
                $this->db->update('User', $data);

                $data = array(
                         'status' => 0
                      );

                $this->db->where('UserID', $user->UserID);
                $this->db->update('activationTokens', $data);  

                return true;
            }
         }


         return false; 
   }


   function checkUserSubscription($userID,$CourseID)
   {
        $q = $this
                  ->db
                  ->where('CourseID',$CourseID)
                  ->where('StudentID',$userID)
                  ->where('active',"1")
                  ->limit(1)
                  ->get('Enrollment');

               if($q->num_rows >0){
                return true;
               } 

               return false; 
               // This function need to be tested 
   }


   function stopUserSubscription($userID,$courseID)
   {
      $data = array(
                         'active' => 0, 
                   );

      $q =      $this->db
                ->where('CourseID', $courseID)
                ->where('StudentID', $userID);
                $this->db->update('Enrollment', $data);

               // This function needs to be tested 
   }


   function changeEmail($userID,$newMail)
   {
      $data = array(
                         'IsActive' => 0,
                         'tmp_email'=>$newMail 
                   );

      $q =      $this->db
                ->where('UserID', $userID);
                $this->db->update('User', $data);

      return ($this->db->affected_rows() != 1) ? false : true;
   }

   function changePassword($userID,$password,$passSalt)
   {
      $data = array(
                         'Password' => $password,
                         'Pass_Salt'=> $passSalt 
                   );

      $q =      $this->db
                ->where('UserID', $userID);
                $this->db->update('User', $data);

      return ($this->db->affected_rows() != 1) ? false : true;
   }
  
    
}


