<?php


class course extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function selectAll(){
    	$query = $this->db->query("
				SELECT Name,Brief,UniveristyID,Tags,Rating,Level,Duration,Price,InstructorID FROM Course
    		");
        return $query->result();
    }


    


    function selectCourseByName($name){
        $query = $this->db->query("SELECT * FROM Course
                                    where Name = '{$name}'");
        return $query->result();
    }

    function selectCourseByID($id){
        $query = $this->db->query("SELECT * FROM Course
                                    where CourseID = '{$id}'");
        return $query->result();
    }


    function insertCourse($params){
      
      $query = $this->db->insert_string('Course', $params);
      $query = $this->db->query($query);

      if($this->db->affected_rows() != 1){
        return false;
      }

      return true; 

    }

    function insertChapterToCourse($courseID,$Chapter_name){
        $Chapter_name = $this->db->escape($Chapter_name);
        $courseID = $this->db->escape($courseID);  
        $query = "
                INSERT INTO Course_Chapter(CourseID,Name)
                        VALUES({$courseID},{$Chapter_name})
        ";

        $query = $this->db->query($query);
        
        if($query)
            return true;
        else
            return false;
    }


    function selectChaptersByCourseID($courseID){
        $query = $this->db->query("
                SELECT DISTINCT Course_Chapter.Name,Course_Chapter.StartDate,Course_Chapter.EndDate
                FROM Course_Chapter
                INNER JOIN  Course
                ON Course_Chapter.CourseID=Course.CourseID and Course_Chapter.CourseID='{$courseID}' ;
            ");
        return $query->result();
    }

    function selectCoursesHomePage(){
        $query = $this->db->query("
                SELECT Name,Tags,Rating,Level,Duration,Price,Image FROM Course
            ");

        $output = array();
        foreach($query->result() as $course ){
            $tags = explode(',',$course->Tags);
            $course->Tags = $tags;
            $query_level = $this->db->query("
                SELECT Name FROM Level where ID = {$course->Level}
            ");
            $course->Level = $query_level->result()[0]->Name;
            $output[]=$course;
        }
        
        return $output;
    }

    function selectCourseMaterial($courseID)
    {
        $q = $this
            ->db
            ->where('CourseID',$courseID)
            ->get('Course_Chapter');

         if($q->num_rows >0){
            $result = $q->result();
            foreach ($result as $chapter) {
                $q = $this
                    ->db
                    ->where('ChapterID',$chapter->ChapterID)
                    ->get('Chapter_Lesson');
                $chapter->lessons = $q->result();       
            }
            return $result;
         } 

         return false;  
    }


    function courseDone($courseID)
    {
        $data = array(
               'Done' => '1'
            );
      $courseID = trim($courseID);
      $this->db->where('CourseID', $courseID);
      $this->db->update('Course', $data); 


      if($this->db->affected_rows() != 1){
        return false;
      }

      return true;
    }


     function getCourseSubscribers($courseID)
    {

         $q = $this
                  ->db
                  ->where('CourseID',$courseID)
                  ->get('Enrollment');

               if($q->num_rows >0){
                  return $q->result();
               } 

               return false; 
    }



     function myCoursesDone($userID)
   {
              $q = $this
                  ->db
                  ->where('InstructorID',$userID)
                  ->where('Done','1')
                  ->get('Course');

               if($q->num_rows >0){
                foreach ($q->result() as $course ) {
                  $course->subscribers = $this->getCourseSubscribers($course->CourseID);
                }
                  return $q->result();
               } 

               return false; 
   }

   function myCoursesSaved($userID)
   {
              $q = $this
                  ->db
                  ->where('InstructorID',$userID)
                  ->where('Done','0')
                  ->get('Course');

               if($q->num_rows >0){
                  return $q->result();
               } 

               return false; 
   }


   
    
}