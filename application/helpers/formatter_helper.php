<?php  if (! defined('BASEPATH')) {

     exit('No direct script access allowed');

 }

function format_data($data, $tipe_data = "")
{       
        //vdebug($data);
        $res_data = "";
        if (is_object($data)) {

            $message = '<span class="vayes-debug-badge vayes-debug-badge-object">OBJECT</span>';

        } elseif (is_array($data)) {

            $message = '<span class="vayes-debug-badge vayes-debug-badge-array">ARRAY</span>';

        } elseif (is_string($data)) {

            if ($tipe_data == 'date') {
                if(empty($data)){
                    $res_data =  NULL;
                }else{
                    $res_data =  date("Y-m-d H:i:s",strtotime($data));
                }
                
            }elseif ($tipe_data == 'switch') {
                if($data == "on"){
                    $res_data =  1;
                }else{
                    $res_data =  0;
                }
                
            }elseif ($tipe_data == 'time') {
                if(empty($data)){
                    $res_data =  '1900-01-01 00:00:00.000';
                }else{
                    $res_data =  '1900-01-01 ' . $data;
                }
                
            }elseif ($tipe_data == 'number') {

                if(empty($data)){
                    $res_data =  0;
                }else{
                    $res_data =  implode("", explode(",", $data));
                }
                
            }

        } elseif (is_int($data)) {

            $message = '<span class="vayes-debug-badge vayes-debug-badge-integer">INTEGER</span>';

        // } elseif (is_true($data)) {

        //     $message = '<span class="vayes-debug-badge vayes-debug-badge-true">TRUE [BOOLEAN]</span>';

        } 
        // elseif (is_false($data)) {

        //     $message = '<span class="vayes-debug-badge vayes-debug-badge-false">FALSE [BOOLEAN]</span>';

        // } elseif (is_null($data)) {

        //     $message = '<span class="vayes-debug-badge vayes-debug-badge-null">NULL</span>';

        // } elseif (is_float($data)) {

        //     $message = '<span class="vayes-debug-badge vayes-debug-badge-float">FLOAT</span>';

        // } else {

        //     $message = 'N/A';

        // }

        //echo $res_data;

        return $res_data;

}
function filter_null($data)
{
        if (is_string($data)) {

            if (empty($data)) {
                $data = NULL;
            }

        } 

        echo $data;

        return $data;

}

