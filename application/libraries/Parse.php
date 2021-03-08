<?php 
 class Parse   
 {  
      function anti_injection($data){
        // $filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
        $filter = stripslashes(strip_tags(htmlentities( html_entity_decode($data)	)));

        return $filter;
      }
 }  