<?php


class University extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

  

   function getUni($ID)
   {
        $q = $this
            ->db
            ->where('ID',$ID)
            ->limit(1)
            ->get('University');

         if($q->num_rows >0){
            return $q->row();
         } 

         return false;  
   }


   function getUniByName($name)
   {
        $q = $this
                ->db
                ->where('description',$name)
                ->limit(1)
                ->get('University');

             if($q->num_rows >0){
                return $q->row();
             } 

             return false; 
   }

   function getUnis()
    {
        $q = $this
                ->db
                ->get('University');

             if($q->num_rows >0){
                return $q->result();
             } 

             return false;  
    }


    function insertUni($params)
    {
      $query = $this->db->insert_string('University', $params);
      $query = $this->db->query($query);

      if($this->db->affected_rows() != 1){
        return false;
      }

      return true;
    }


   
    
}