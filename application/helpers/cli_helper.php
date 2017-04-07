<?php
/**
 * Command Line Helper
 * 
 * functions to assist in writing CLI  scripts
 *
 * @package       cli_hepler
 * @author        Glenn Stovall
 * @version       1.0
 */
 
if( !function_exists('pl')){
    
   /**
    *  print line
    * 
    * @param string
    * @return null
    */  
   function pl($input) 
   {
     echo $input . PHP_EOL;
   }

}


if( !function_exists('pl_array')){
    /**
     * prints an array in a human-readable format
     * 
     * @param array
     * @return null
     * 
     */
    function pl_array($input) 
    {
      if(!empty($input) && is_array($input)) {
        foreach($input as $key => $value) {
          pl("[" .$key. "] => " . json_encode($value, JSON_PRETTY_PRINT, 512) );
        }
      }
    }    
}


if( !function_exists('line_break')){
    /**
     * prints a horizontal line break
     * 
     * @param int
     * @return null
     * 
     */
    function line_break($length = 40) 
    {
      $output = "";
      for($i = 0; $i < $length; $i++) {
        $output .= '-';
      }
      return $output;
    }    
}