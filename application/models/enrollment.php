<?php


class Enrollment extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

  

   function getStudentEnrollments($userID)
   {
        $q = $this
            ->db
            ->where('StudentID',$userID)
            ->where('active','1')
            ->get('Enrollment');

         if($q->num_rows >0){
            return $q->result();
         } 

         return false;  
   }


   function enrollStudentToCourse($userID,$courseID)
    {   
        $params['StudentID'] = $userID;
        $params['CourseID']  = $courseID;
        $params['active']    = '1';

        $query = $this->db->insert_string('Enrollment', $params);
        $query = $this->db->query($query); 

        return ($this->db->affected_rows() != 1) ? false : true; 
    }




   
    
}