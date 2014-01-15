<?php


class Level extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

  

   function getLevel($levelID)
   {
        $q = $this
            ->db
            ->where('ID',$levelID)
            ->limit(1)
            ->get('Level');

         if($q->num_rows >0){
            return $q->row();
         } 

         return false;  
   }

   function getLevels()
    {
        $q = $this
                ->db
                ->get('Level');

             if($q->num_rows >0){
                return $q->result();
             } 

             return false;  
    }


   
    
}