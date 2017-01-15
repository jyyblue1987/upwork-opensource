<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addtoken extends CI_Controller {


    function generateRandomString($length = 16) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
//        echo "<pre>";print_r($randomString);exit;
        return $randomString;
    }
	
	
    public function index() {
		
		
		$instid=$_GET["instagramid"];
		$token=$_GET["token"];
		$url="https://api.instagram.com/v1/users/self/?access_token=".$token;
		
		

	
	
	$httphead=array('Accept-Language: en-us,en;q=0.7,de-de;q=0.3','Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5');
$agent="Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36";

$post="submit=submit&message=das&sss=ff";
$post=false;

$logcheck=$this->Forms->curlthis($url,$agent,$httphead,$post,false,false,true,false,true,false,false,false);

$res= json_decode($logcheck ,1);

$username=$res['data']['username'];
$picture=$res['data']['profile_picture'];
$name=$res['data']['full_name'];
$media=$res['data']['counts']['media'];
$followedby=$res['data']['counts']['followed_by'];
$follows=$res['data']['counts']['follows'];

	
		if($this->Adminlogincheck->checkx()){
			$owner=$this->session->userdata('id');
		}else{
			$owner="na";
		}
		
	   $mkt=$_SERVER["REQUEST_TIME"];
		
	 $this->db->select('instagramtoken_id');
 $this->db->from('instagramtoken');
 $this->db->where('instagramtoken_userid', $instid);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() > 0)
   {
	   
	$stud=$query->result()[0];
	   
	
	
		
	       $add_data = array(
                        'instagramtoken_owner' => $owner,
                        'instagramtoken_userid' => $instid,
                        'instagramtoken_usertoken' => $token,
                        'instagramtoken_name' => $name,
                        'instagramtoken_picture' => $picture,
                        'instagramtoken_username' => $username,
                        'instagramtoken_media' => $media,
                        'instagramtoken_followedby' => $followedby,
                        'instagramtoken_follows' => $follows,
                        'instagramtoken_status' => "1",
                        'instagramtoken_updated' => $mkt,
                    );

 $this->db->where('instagramtoken_userid', $instid);
$this->db->update('instagramtoken', $add_data); 


echo $stud->instagramtoken_id;

   }else{
   
		
	       $add_data = array(
                        'instagramtoken_owner' => $owner,
                        'instagramtoken_userid' => $instid,
                        'instagramtoken_usertoken' => $token,
                        'instagramtoken_name' => $name,
                        'instagramtoken_picture' => $picture,
                        'instagramtoken_username' => $username,
                        'instagramtoken_media' => $media,
                        'instagramtoken_followedby' => $followedby,
                        'instagramtoken_follows' => $follows,
                        'instagramtoken_status' => "1",
                        'instagramtoken_added' => $mkt,
                    );

$this->db->insert('instagramtoken', $add_data); 
$id=$this->db->insert_id();

echo $id;

   }
			
    }

	
	
	
}
