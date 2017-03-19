<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// added by (Donfack Zeufack Hermann) start
if ( ! function_exists('home_url'))
{
    /**
     * Home URL
     *
     * Create a home URL based on your basepath.
     *
     * @param	string	$protocol
     * @return	string
     */
    function home_url($protocol = NULL)
    {
        $user_type = get_instance()->session->userdata('type');
        $uri       = '';
        
        switch($user_type){
            case 1: 
                $uri = 'jobs-home';
            break;
            case 2:
                $uri = 'find-jobs';
            break;
        }

        return site_url($uri, $protocol);
    }
}


if ( !function_exists('app_profile_url'))
{
    /**
     * Get current user profil URL
     *
     * @param	string	$protocol
     * @return	string
     */
    function app_profile_url($protocol = NULL)
    {
        $instance  = get_instance();
        $instance->load->model('webuser_model');
        $user_id   = $instance->session->userdata('id');
        
        return site_url('profile/' . $instance->webuser_model->get_username($user_id));
    }
}


if ( ! function_exists('app_header_link_template'))
{
    /**
     * Header Link Template name
     *
     * Return the template link name to use according the user context.
     *
     * @param	string	$view_folder
     * @return	string
     */
    function app_header_link_template($view_folder = 'webview/layout/twig/partials')
    {
        $session   = get_instance()->session;
        $loggedx   = $session->userdata('loggedx');
        $user_type = $session->userdata('type');
        $view      = 'visitor-header-links.twig';
        
        if($loggedx){
           switch($user_type){
                case 1: 
                    $view = 'client-header-links.twig' ;
                break;
                case 2:
                    $view = 'freelancer-header-links.twig' ;
                break;
            }    
        }
        
        return $view_folder . '/' . $view;
    }
}

if ( ! function_exists('app_user_dropdown_template'))
{
    /**
     * Header Link Template name
     *
     * Return the template link name to use according the user context.
     *
     * @param	string	$view_folder
     * @return	string
     */
    function app_user_dropdown_template($view_folder = 'webview/layout/twig/partials')
    {
        $session   = get_instance()->session;
        $loggedx   = $session->userdata('loggedx');
        $user_type = $session->userdata('type');
        $view      = 'visitor-dropdown.twig';
        
        if($loggedx){
           $view      = 'connected-dropdown.twig';
        }
        
        return $view_folder . '/' . $view;
    }
}

if ( ! function_exists('app_user_data'))
{
    /**
     * Get user data from session
     *
     * Return the user data session.
     *
     * @return	array
     */
    function app_user_data()
    {
        return  get_instance()->session->userdata();
    }
}

if ( ! function_exists('app_sub_header_template'))
{
    /**
     * Get right sub header according the user context
     *
     * @return	string
     */
    function app_sub_header_template($view_folder = 'webview/layout/twig/partials')
    {
        
        $session   = get_instance()->session;
        $user_type = $session->userdata('type');
        $view      = 'visitor-sub-header.twig';
        
        switch($user_type){
             case 1: 
                 $view = 'client-sub-header.twig' ;
             break;
             case 2:
                 $view = 'freelancer-sub-header.twig' ;
             break;
         }
        
        return $view_folder . '/' . $view;
    }
}


if ( ! function_exists('app_modular_js'))
{
    /**
     * Help to build url of all file inside asset/modular folder
     *
     * @return	string
     */
    function app_modular_js($js, $asset_js_folder = 'assets/modular/js')
    {        
        return site_url($asset_js_folder . '/' . $js);
    }
}

if( ! function_exists('app_lang')){
    
    /**
     * Helper to fetch language item
     * 
     * @param string $line
     * @param array $data
     * @return string
     */
    function app_lang($line, $data = null){
        $line = get_instance()->lang->line($line);
        
        if($data !== null && is_array( $data )){
            return call_user_func_array('sprintf', $data);
        }
        
        return $line;
    }
}

if( ! function_exists('app_user_img') ){
    
    /**
     * Helper in the view to display a correct user img url
     * 
     * @param type $img_url
     */
    function app_user_img( $img_url ){
        
        if (check_base64_image($img_url))
            return $img_url;
        
        if(!empty( $img_url ) && file_exists( $img_url )){
            return base_url($img_url);
        }else{
            return site_url("assets/user.png");
        }
    }
}

if( !function_exists('check_base64_image')){
    
    function check_base64_image($base64) {
        $matches = array();
        $pattern = '#^data(\W){1}([-\w]+/[-\w]+)(\W){1}base64(\W){1}(.*)$#';
        $result  = preg_match($pattern, $base64, $matches);
        if($result){
           return $matches[1] == ':' &&
                  $matches[3] == ';' &&
                  $matches[4] == ',' &&
                  base64_decode($matches[5], true) !== false;
        }  
        return false;
    }

}

if( ! function_exists('app_date')){
    
    
    /**
     * Helper to format the date in twig template
     * 
     * @param string $date (It should be compatible with strtotime php function
     * @param string $format
     * @return string
     */
    function app_date($date, $format ){
        return date($format, strtotime($date));
    }
}

if( ! function_exists('app_substr')){
    
    
    /**
     * Helper truncate the string inside a twig template
     * 
     * @param string $string
     * @param int $limit
     * @param string $end_with
     * @return string
     */
    function app_substr($string, $limit, $end_with ){
        if(strlen($string) > $limit){
            return substr($string, 0, $limit - strlen($end_with)) . $end_with;
        }
        return $string;
    }
}

if( ! function_exists('dump') ){
    function dump( $data , $die = false ){
        echo '<pre>';
        if(is_array( $data) || is_object($data)){
            $data = json_encode($data, JSON_PRETTY_PRINT);
        }
        var_dump( $data );
        echo '</pre>';
        
        if($die)
            die();
    }
}

if( !function_exists('has_flash') ){
    function has_flash( $key ){
        $flash_keys = get_instance()->session->get_flash_keys();
        return in_array($key , $flash_keys);
    }
}

if( !function_exists('flashdata') ){
    function flashdata( $key ){
        return get_instance()->session->flashdata( $key );
    }
}

if( !function_exists('back') ){
    function back( ){
        return get_instance()->session->userdata('redirect_back');
    }
}

if( !function_exists('csrf_name')){
    function csrf_name(){
        return get_instance()->security->get_csrf_token_name();
    }
}

if( !function_exists('csrf_token')){
    function csrf_token(){
        return get_instance()->security->get_csrf_hash();
    }
}

// added by (Donfack Zeufack Hermann) end
