<?php 
/**
 * MorrowInteractive Helper
 * 
 * This helper includes various methods to help with mathematics and number
 * formatting throughout the application.
 *
 * @package	CodeIgniter
 * @author	Justin Morrow <jumorrow@protonmail.com>
 * @author Travers La Ville
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('nearest_tenth'))
{
    /**
     * Round number to nearest tenth
     *
     * @return	int
     */    
    function nearest_tenth($ugly_number)
    {
        //determine smaller multiple
        $smaller_number = (int)($ugly_number / 10) * 10;  

        //determine larger multiple  
        $larger_number = ($smaller_number + 10);  

        //return the value closest to the two
        return ($ugly_number - $smaller_number > $larger_number - $ugly_number) ? $larger_number : $smaller_number;  
    }   
    
}
