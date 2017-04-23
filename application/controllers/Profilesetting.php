<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profilesetting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('common_mod'));
        $this->load->model(array('timezone'));
    }

	public function index()
	{
		$profile = $_GET['profile'];
            if($this->Adminlogincheck->checkx()){
                //webuser details//
                $condition = " AND webuser_id=".$this->session->userdata(USER_ID);
                // add by indsys tech start
                $sql = "SELECT cropped_image FROM webuser WHERE webuser_id =  " . $this->session->userdata(USER_ID);
                $croppedImage =    $this->db->query($sql)->row();
                // add by indsys tech end
                $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);

                if(!empty($webUserContactDetails)){

			    $country_id = $webUserContactDetails['rows'][0]['country'];
				$countrydailing = $this->common_mod->get_record_by_id(COUNTEY_TABLE,$country_id);
				}

                if(empty($webUserContactDetails['rows'])){
                    $webUserContactDetails['rows'][0] = "";
                }

                //webuser contact details//
                $webuserCountry = $this->common_mod->getSpecificColVal(COUNTEY_TABLE,"country_name"," AND country_id  =".$this->session->userdata('webuser_country'));

                $countryList = $this->common_mod->get(COUNTEY_TABLE,null," AND country_status=1");
                $timezones   = get_all_php_timezones(); /*$this->timezone->get_timezones(); the old timezone system do not handle Daylight Saving Time*/

                $user_timezone = $webUserContactDetails['rows'][0]['timezone'];
                if (empty($user_timezone))
                {
                    $user_timezone = date_default_timezone_get();
                }
                
                try{
                    $date_time_zone = new DateTimeZone($user_timezone);
                }catch(\Exception $e){
                    $user_timezone = date_default_timezone_get();
                    $date_time_zone = new DateTimeZone($user_timezone);
                }
                
                $time_offset    = format_GMT_offset( $date_time_zone->getOffset(new DateTime(NULL, $date_time_zone)) );
                
                $data = array(
                    'title' => "Profile Setting",
                    'page' => "profilesetting",
                    'name' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
                    'username' => $this->session->userdata('username'),
                    'id' => $this->session->userdata('id'),
                    'croppedImage' =>$croppedImage, // ad by indsys tech
                    'js' =>array(),
                    'jsf' =>array(
                        "assets/js/layerslider.transitions.js",
                        "assets/js/layerslider.kreaturamedia.jquery.js",
                        "assets/js/owl.carousel.min.js","assets/js/homepage.js"),
                    'css' =>array(
                        "assets/css/layerslider.css",
                        "assets/css/owl.carousel.css",
                        "assets/css/owl.theme.css"),
                    'countryList' => $countryList['rows'],
                    'open' => 'account',
                    'openSub' =>'profile-basic',
                    'webuserContactDetails' =>$webUserContactDetails['rows'][0],
                    'webuserCountry'=>$webuserCountry,
                    'user_timezone' => $user_timezone,
                    'time_offset' => $time_offset,
                    'timezones' => $timezones,
					'profile'=>$profile,
					'country_code_dailing' =>$countrydailing->country_dialingcode,
                    'country_name'=> $countrydailing->country_name
                );

                    $this->Admintheme->webview("profilesetting",$data);
                }else{
                    redirect(site_url("signin"));
                }
	}

	/***************Indsys Technologies 23/02/2017  country_dialingcode***************/
	public function getcountry_dialingcode(){
		$result = array();
		if($_POST['country_dialingcode']){
			$this->db->select('country_id,country_dialingcode');
			$this->db->from(COUNTEY_TABLE);
			$this->db->where('country_id',$_POST['country_dialingcode']);
			$country_dialingcode = $this->db->get()->row();
             if($country_dialingcode){
				$Country_code = $country_dialingcode->country_dialingcode;
				$key ='sucsses';
			 }
			}else{
			$key ='faild';

			}
			$result = array('key' =>$key,'country_dialingcode'=>$Country_code);
			echo json_encode($result);



		}

		/****************************************************************/
}

