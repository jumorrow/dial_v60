<?php 
/**
 * MorrowInteractive Helper
 * 
 * This helper includes various methods to help with generating dynamic URLS 
 * throughout the application.
 *
 * @package	CodeIgniter
 * @author	Justin Morrow <jumorrow@protonmail.com>
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_asset_path'))
{
    /**
     * Compile dynamic URLS for use with linking assets in HTML
     *
     * Returns the full URL (including segments) of the page where this
     * function is placed
     *
     * @return	string
     */    
    function get_asset_path($asset_type = null, $file_name = null)
    {
        //define base_url for use in switch statement
        //base_url() is a result of native Code Igniter URL Helper
        $base_url = base_url().'assets/';
        
        switch ($asset_type) {
            
            //used to generate direct path to css directory
            //correlates directly with [Application_Root]/css
            case "css":
                $asset_type = $base_url.'css/';
                break;
            
            //used to generate direct path to css directory
            //correlates directly with [Application_Root]/images
            case "images":
                $asset_type = $base_url.'images/';
                break;
            
            //used to generate direct path to css directory
            //correlates directly with [Application_Root]/css
            case "js":
                $asset_type = $base_url.'js/';
                break;
            
            //used to generate direct path to css directory
            //correlates directly with [Application_Root]/css
            case "assets":
                $asset_type = $base_url.'assets/';
                break;
            
            //default case, no params specified
            default:
                $asset_type = null;
        }
        
        //concatenate and return a complete URL if $file_name specified
        if(isset($file_name)){
            //concatenate complete URL
            $complete_url = $asset_type . $file_name;
            
            return $complete_url;
        } else {
            
            //no $file_name provided, return original URL
            return $asset_type;
        }
    }   
    
}

if (!function_exists('get_linkedin_url'))
{
    /**
     * Return LinkedIn URL for use throughout the application
     *
     * @return	string
     */    
    function get_linkedin_url()
    {
        $linkedin_url = "";
        return $linkedin_url;
    }   
    
}

if (!function_exists('get_current_year'))
{
    /**
     * Return current year (from server) for Copyright Text
     *
     * @return	string
     */    
    function get_current_year()
    {
        $current_year = date("Y");
        return $current_year;
    }   
    
}

if (!function_exists('get_email_address'))
{
    /**
     * Return email address
     *
     * @return	string
     */    
    function get_email_address()
    {
        $email_address = "info@lavillesolutions.com";
        return $email_address;
    }   
    
}
