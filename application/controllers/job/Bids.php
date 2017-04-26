<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bids
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Bids extends Winjob_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load_language();
        $this->load->model(array('process'));
    }
    
    protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
    public function index() 
    {   
        $this->checkForFreelancer();
        
        $user_id        = $this->session->userdata(USER_ID);
        $bids           = $this->process->get_active_bids($user_id);
        $archived_bids  = $this->process->get_archive_bids($user_id);
        $display        = 'active'; 
        
        $this->twig->display('webview/jobs/twig/my-bids', compact('bids', 'archived_bids', 'display'));
    }
    
    public function archived() 
    {   
        $this->checkForFreelancer();
        
        $user_id        = $this->session->userdata(USER_ID);
        $bids           = $this->process->get_active_bids($user_id);
        $archived_bids  = $this->process->get_archive_bids($user_id);
        $display        = 'archived';
        
        $this->twig->display('webview/jobs/twig/my-bids', compact('bids', 'archived_bids', 'display'));
    }
}
