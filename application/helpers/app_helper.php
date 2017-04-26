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

if( !function_exists('app_workdiary_capture')){
    
    function app_workdiary_capture( $img_url ){
        
        if (check_base64_image($img_url))
            return $img_url;
        
        if(!empty( $img_url ) && file_exists( $img_url )){
            return base_url($img_url);
        }else{
            return site_url("assets/img/BOTTOM_HEADER.png");
        }
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
        print_r( $data );
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

if( ! function_exists('app_time_elapsed_string') ){
    
    function app_time_elapsed_string($ptime, $user_timezone = null){
        
        if($user_timezone === null)
            $user_timezone = date_default_timezone_get ();
        
        $utc_date = new DateTime(NULL, new DateTimeZone( $user_timezone ));
        $etime    = $utc_date->getTimestamp() - $ptime;
        
        if ($etime < 1) {
            return '0 seconds';
        }
        $a = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        $a_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }
    
}

if( ! function_exists('verify_date') ){
    
    function verify_date($date, $strict = true)
    {
        $dateTime = DateTime::createFromFormat('m/d/Y', $date);
        if ($strict) {
            $errors = DateTime::getLastErrors();
            if (!empty($errors['warning_count'])) {
                return false;
            }
        }
        return $dateTime !== false;
    }
}

if( !function_exists('is_get')){
    
    function is_get(){
        $input =& get_instance()->input;
        return $input->method() == 'get';
    }
}

if( !function_exists('is_post')){
    
    function is_post(){
        $input =& get_instance()->input;
        return $input->method() == 'post';
    }
}

if( !function_exists('array_key_value_exists'))
{   
    function array_key_value_exists($key_name, $key_value, $haystack)
    {   
        if(empty($haystack) || !is_array($haystack))
            return false;
        
        foreach( $haystack as $key => $item)
        {
            if(is_object($item))
            {
                if( $item->{$key_name} == $key_value) return true;
            }
            else 
            {
                if( $item[$key_name] == $key_value) return true;
            }
        }
        
        return false;
    }
}

function current_user_datetime( $app_date_time, $user_timezone )
{
    $app_timezone = new DateTimeZone(date_default_timezone_get());
    $gmtTimezone  = new DateTimeZone('GMT');
    $date         = new DateTime( $app_date_time, $app_timezone );
    $date->setTimezone($gmtTimezone);
    $date->setTimezone($user_timezone);
    return $date;
}

function get_right_timezone( $name )
{
    $all_timezones = DateTimeZone::listIdentifiers();
    
    $name = str_replace('St. ', 'St ', $name);
    $name = str_replace(' ', '_', $name);
    $name = str_replace(', ', '/', $name);
    
    foreach($all_timezones as $timezone)
    {
        if(strpos($timezone, $name) !== false ) 
        {
            return $timezone;
        }
    }
    return date_default_timezone_get();
}

function get_all_timezone_regions()
{
    return array(
        'Africa' => DateTimeZone::AFRICA,
        'America' => DateTimeZone::AMERICA,
        'Antarctica' => DateTimeZone::ANTARCTICA,
        'Aisa' => DateTimeZone::ASIA,
        'Atlantic' => DateTimeZone::ATLANTIC,
        'Europe' => DateTimeZone::EUROPE,
        'Indian' => DateTimeZone::INDIAN,
        'Pacific' => DateTimeZone::PACIFIC
    );
}

function get_all_php_timezones()
{
    $regions = get_all_timezone_regions();
    
    $timezones = array();
    foreach ($regions as $name => $mask)
    {
        $zones = DateTimeZone::listIdentifiers($mask);
        foreach($zones as $timezone)
        {   
            // Remove region name and add a sample time
            $timezones[$name][$timezone] = format_timezone($timezone, $name);
        }
    }
    
    return $timezones;
}

function format_timezone( $timezone, $name)
{
    // Lets sample the time there right now
    $time = new DateTime(NULL, new DateTimeZone($timezone));
    // Us dumb Americans can't handle millitary time
    $ampm = $time->format('H') > 12 ? ' ('. $time->format('g:i a'). ')' : '';
    
    return format_timezone_name(substr($timezone, strlen($name) + 1)) . ' - ' . $time->format('H:i') . $ampm;
}

function display_friendly_timezone( $timezone )
{
    $regions = get_all_timezone_regions();
    
    foreach ($regions as $name => $mask)
    {
        if(strpos($timezone, $name) !== null){
            return format_timezone($timezone, $name);
        }
    }
    return null;
}

function timezone_list() {
    static $timezones = null;

    if ($timezones === null) {
        $timezones = [];
        $offsets = [];
        $now = new DateTime('now', new DateTimeZone('UTC'));

        foreach (DateTimeZone::listIdentifiers() as $timezone) {
            $now->setTimezone(new DateTimeZone($timezone));
            $offsets[] = $offset = $now->getOffset();
            $timezones[$timezone] = '(' . format_GMT_offset($offset) . ') ' . format_timezone_name($timezone);
        }

        array_multisort($offsets, $timezones);
    }

    return $timezones;
}

function format_GMT_offset($offset) {
    $hours = intval($offset / 3600);
    $minutes = abs(intval($offset % 3600 / 60));
    return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
}

function format_timezone_name($name) {
    $name = str_replace('/', ', ', $name);
    $name = str_replace('_', ' ', $name);
    $name = str_replace('St ', 'St. ', $name);
    return $name;
}

function app_convert_date_in_local($date_string, $timezone)
{
    try{
        $local_timezone = new DateTimeZone($timezone);
    }
    catch(\Exception $e)
    {
        $local_timezone = new DateTimeZone(date_default_timezone_get());
    }
    
    $_date = new DateTime($date_string, new DateTimeZone('UTC'));
    $_date->setTimezone($local_timezone);
    $convert_date = \Carbon\Carbon::createFromTimestamp($_date->getTimestamp(), $local_timezone);
    return $convert_date;
}

function validate_user_timezone( $user_timezone )
{
    $valid_user_timezone = $user_timezone;
    
    try{
        $local_timezone = new DateTimeZone($timezone);
    }
    catch(\Exception $e)
    {
        $valid_user_timezone = date_default_timezone_get();
    }
    
    return $valid_user_timezone;
}

// added by (Donfack Zeufack Hermann) end
