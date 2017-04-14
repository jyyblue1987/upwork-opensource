<?php

class Admintheme extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function loadview($page,$data){
        $text = $this->siteconfig->text();
        $data['text']=$text;

        $this->load->view('admin/layout/header.php',$data, false);
        $this->load->view('admin/layout/afterheader.php',$data, false);
        $this->load->view('admin/layout/menu.php',$data, false);
        $this->load->view('admin/'.$page,$data, false);
        $this->load->view('admin/layout/footer.php',$data, false);
     }
     
    function webview($page,$data){
        $text = $this->siteconfig->text();
        $data['text']=$text;

        $this->load->view('webview/layout/header.php',$data, false);
        $this->load->view('webview/layout/afterheader.php',$data, false);
        $this->load->view('webview/layout/menu.php',$data, false);
        $this->load->view('webview/'.$page,$data, false);
        $this->load->view('webview/layout/footer.php',$data, false);
     }     

    function custom_webview($page,$data){
        $text = $this->siteconfig->text();
        $data['text']=$text;

        $this->load->view('webview/layout/header4.php',$data);
        $this->load->view('webview/layout/afterheader.php',$data, false);
        $this->load->view('webview/layout/menu.php',$data, false);
        $this->load->view('webview/'.$page,$data, false);
        $this->load->view('webview/layout/footer.php',$data, false);
     }
     
     function no_auth_view($page,$data){
        $text=$this->siteconfig->text();
        $data['text']=$text;

        $this->load->view('webview/layout/header.php',$data, false);
        $this->load->view('webview/layout/no_auth_header.php',$data, false);
        $this->load->view('webview/layout/menu.php',$data, false);
        $this->load->view('webview/'.$page,$data, false);
        $this->load->view('webview/layout/footer.php',$data, false);
     }
     
    function webview2($page,$data){
        $text = $this->siteconfig->text();
        $data['text']=$text;

        $this->load->view('webview/layout/header.php',$data, false);
        $this->load->view('webview/layout/afterheader.php',$data, false);
        $this->load->view('webview/layout/menu.php',$data, false);
        $this->load->view('webview/'.$page,$data, false);
        $this->load->view('webview/layout/footer.php',$data, false);
    }
	 
	 // added by (Donfack Zeufack Hermann) start load models
    function webview_2($page,$data){
	$text = $this->siteconfig->text();
        $data['text']=$text;
        
        $this->load->view('webview/layout/header.php',$data, false);
        $this->load->view('webview/layout/afterheader.php',$data, false);
        $this->load->view('webview/layout/menu.php',$data, false);
        $this->load->view('webview/'.$page,$data, false);
        $this->load->view('webview/layout/footer2.php',$data, false);
        $this->load->view('webview/layout/afterfooter.php',$data, false); 
     }
	 // added by (Donfack Zeufack Hermann) end

    //added by Sergey start
    function webview3($page,$data){
        $text=$this->siteconfig->text();
        $data['text']=$text;

        $this->load->view('webview/layout/header.php',$data, false);
        $this->load->view('webview/layout/afterheader.php',$data, false);
        $this->load->view('webview/layout/menu.php',$data, false);
        $this->load->view('webview/'.$page,$data, false);
        $this->load->view('webview/layout/footer.php',$data, false);
    }
    //added by Sergey end

    function webviewx($page,$data){
        $text=$this->siteconfig->text();
        $data['text']=$text;

        $this->load->view('webview/layout/header.php',$data, false);
        $this->load->view('webview/layout/afterheader.php',$data, false);
        $this->load->view('webview/layout/menu.php',$data, false);
        $this->load->view('webview/'.$page,$data, false);
        $this->load->view('webview/layout/footer.php',$data, false);
    }
	 
    function loadviewwf($page,$data,$footer){
        $text = $this->siteconfig->text();
        $data['text'] = $text;

        $this->load->view('admin/layout/header.php',$data, false);
        $this->load->view('admin/layout/afterheader.php',$data, false);
        $this->load->view('admin/layout/menu.php',$data, false);
        $this->load->view('admin/'.$page,$data, false);
        $this->load->view('admin/layout/footer.php',$data, false);
        $this->load->view('admin/'.$footer,$data, false);
    }

    function xx(){
        $this->load->view('admin/layout/h.php',$data, false);
        $this->load->view('admin/layout/ah.php');
        $this->load->view('admin/layout/m.php');
        $this->load->view('admin/layout/am.php');
        $this->load->view('admin/homepage/dashboard.php');
        $this->load->view('admin/layout/f.php');
        $this->load->view('admin/homepage/dashboardf.php');
        $this->load->view('admin/layout/e.php');
    }

    //added by Ralfh 3/23/2017 start 
    function employer_help_webview($page,$data){
        $text = $this->siteconfig->text();
        $data['text']=$text;

        $this->load->view('webview/layout/header.php',$data, false);
        $this->load->view('webview/layout/afterheader.php',$data, false);
        $this->load->view('webview/layout/employer-help-menu.php',$data, false);
        $this->load->view('webview/'.$page,$data, false);
        $this->load->view('webview/layout/footer.php',$data, false);
     }       

    function freelancer_help_webview($page,$data){
        $text = $this->siteconfig->text();
        $data['text']=$text;

        $this->load->view('webview/layout/header.php',$data, false);
        $this->load->view('webview/layout/afterheader.php',$data, false);
        $this->load->view('webview/layout/freelancer-help-menu.php',$data, false);
        $this->load->view('webview/'.$page,$data, false);
        $this->load->view('webview/layout/footer.php',$data, false);
     } 

    //added by Ralfh 3/23/2017 end
}

?>