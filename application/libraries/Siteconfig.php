<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Siteconfig {

    public function text()
    {
        
        $texts= array(
            "title" => "WinJob",
            "url" => "winjob.com",
            "developer" => "http://www.canvasdevelopers.com",
            "fblink" => "https://www.facebook.com",
            "twlink" => "https://www.twitter.com",
            "gplink" => "https://plus.google.com",
            "facebook" => "",
        );
                
                
		return $texts;
    }

}
