<?php


class chapter extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    
    function getByName($name,$courseID)
   {
        $q = $this
            ->db
            ->where('Name',$name)
            ->where('CourseID',$courseID)
            ->limit(1)
            ->get('Course_Chapter');

         if($q->num_rows >0){
            return $q->row();
         } 

         return false;  
   }

    function getByID($id)
   {
        $q = $this
            ->db
            ->where('ChapterID',$id)
            ->limit(1)
            ->get('Course_Chapter');

         if($q->num_rows >0){
            return $q->row();
         } 

         return false;  
   }

   function getCourseChapterCount($id)
   {
       $q = $this
            ->db
            ->where('CourseID',$id)
            ->get('Course_Chapter');
     
     //showThis($this->db->last_query());
     $count = $q->num_rows;
     return $count++;

   }


    
    function insertChapter($params)
    {
      
      if($this->getByName($params['Name'],$params['CourseID']))
        return false;

      if($this->getByID($params['ChapterID']))
        return false;

      $params['count'] = $this->getCourseChapterCount($params['CourseID']);
      $query = $this->db->insert_string('Course_Chapter', $params);
      $query = $this->db->query($query);

      if($this->db->affected_rows() != 1){
        return false;
      }

      return true; 

    }


    function saveChapter($chapterID)
    {
      $data = array(
               'saved' => '1'
            );
      $chapterID = trim($chapterID);
      $this->db->where('ChapterID', $chapterID);
      $this->db->update('Course_Chapter', $data); 


      if($this->db->affected_rows() != 1){
        return false;
      }

      return true;

    }

    
    
}