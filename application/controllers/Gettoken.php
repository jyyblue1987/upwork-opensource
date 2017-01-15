<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gettoken extends CI_Controller {

	public function index()
	{

?>



<html>
<head>
<title></title>
<script src="<?php echo site_url("assets/js/vendor/jquery-2.2.3.min.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/sample.js"); ?>"></script>

</head>
<body>


<div style="display:none;"><iframe id="video" src="https://www.instagram.com/accounts/logout/"></iframe></div>
<div style="width:128px;height:128px;margin:auto;position:absolute;top:50%;margin-top:-64px;left:50%;margin-left:-64px;"><img src="<?php echo site_url("assets/loader.gif"); ?>"></div>
<script>

accessToken = location.hash.slice(14); 

createCookie("accessToken",accessToken, acctokenlive);	
var myarr = accessToken.split(".");
var userid = myarr[0];
createCookie("userid",userid, acctokenlive);	
				
createCookie("accessToken"+userid,accessToken, acctokenlive);	


   $.ajax({
                type: "GET",
                url: '<?php echo site_url("addtoken"); ?>/?instagramid=' + userid + "&token=" + accessToken,
                success: function (_d) {

opener.kick(userid,accessToken,_d);

setTimeout(function(){ window.close(); }, 1000);
                }
            }).fail(function (_d) {
			
setTimeout(function(){ window.close(); }, 1000);
            });






</script>
</body>
</html>

<?php

	}
}
