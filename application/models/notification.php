<?php


class Notification extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

  

   function addNotification($userID,$notification,$type)
   {
        $params['UserID'] = $userID;
        $params['Status']  = '1';
        $params['Text']    = $notification;
        $params['Type']    = $type;


        $query = $this->db->insert_string('notification', $params);
        $query = $this->db->query($query);

        return ($this->db->affected_rows() != 1) ? false : true; 
   }


  




   
    
}