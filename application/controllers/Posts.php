<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends CI_Controller
{

    public function index()
    {
        $token = $_GET["token"];
        
        $url = "https://api.instagram.com/v1/users/self/?access_token=" . $token;
        
        $httphead = array(
            'Accept-Language: en-us,en;q=0.7,de-de;q=0.3',
            'Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5'
        );
        $agent = "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36";
        
        $post = "submit=submit&message=das&sss=ff";
        $post = false;
        
        $logcheck = $this->Forms->curlthis($url, $agent, $httphead, $post, false, false, true, false, true, false, false, false);
        
        $res = json_decode($logcheck, 1);
        // var_dump($res);
        
        $username = $res['data']['username'];
        $picture = $res['data']['profile_picture'];
        $name = $res['data']['full_name'];
        $media = $res['data']['counts']['media'];
        $followedby = $res['data']['counts']['followed_by'];
        $follows = $res['data']['counts']['follows'];
        
        $add_data = array(
            'instagramtoken_usertoken' => $token,
            'instagramtoken_name' => $name,
            'instagramtoken_picture' => $picture,
            'instagramtoken_username' => $username,
            'instagramtoken_media' => $media,
            'instagramtoken_followedby' => $followedby,
            'instagramtoken_follows' => $follows
        );
        
        $this->db->where('instagramtoken_usertoken', $token);
        $this->db->update('instagramtoken', $add_data);
        
        $data = array(
            'title' => $name,
            'page' => "posts",
            'res' => $res,
            'js' => array(),
            'jsf' => array(
                "assets/js/layerslider.transitions.js",
                "assets/js/layerslider.kreaturamedia.jquery.js",
                "assets/js/owl.carousel.min.js",
                "assets/js/homepage.js"
            ),
            'css' => array(
                "assets/css/layerslider.css",
                "assets/css/owl.carousel.css",
                "assets/css/owl.theme.css"
            )
        );
        $this->Admintheme->webview("posts", $data);
    }
}
