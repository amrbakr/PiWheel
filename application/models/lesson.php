<?php


class lesson extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

     function getByName($name,$chapterID)
   {
        $q = $this
            ->db
            ->where('Name',$name)
            ->where('ChapterID',$chapterID)
            ->limit(1)
            ->get('Chapter_Lesson');

         if($q->num_rows >0){
            return $q->row();
         } 

         return false;  
   }
    
    
    function insertLesson($params){
      
      if($this->getByName($params['Name'],$params['ChapterID']))
        return false;
      
      $query = $this->db->insert_string('Chapter_Lesson', $params);
      $query = $this->db->query($query);

      if($this->db->affected_rows() != 1){
        return false;
      }

      return true; 

    }

    
    
}