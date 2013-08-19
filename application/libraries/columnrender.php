<?php 

class ColumnRender {

    public static function make($input_array)
    {
        $return_arrays = array();
        $now_number = -1;
        $array_length = count($input_array);
        for ($i = 0; $i < $array_length; $i ++)
        {
            if ($i % 3 === 0) {
                $now_number ++;
                $return_arrays[] = array();
            } 
            $return_arrays[$now_number][] = $input_array[$i];
        }
        return $return_arrays;
    }
}
