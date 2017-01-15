<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Call extends CI_Controller {



   function index()
    {

      $page=$this->uri->uri_to_assoc();

    var_dump($page);


  			if(isset($page['page'])){
  				$callpage=$page['page'];
  			}else{
  			exit('Bad Request');
  			}
    			if(isset($page['subpage'])){
    				$callsubpage=$page['subpage'];
    			}else{
    			exit('Bad Request');
    			}

          echo 	$callsubpage;

    }


    }
