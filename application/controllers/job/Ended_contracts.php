<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Ended_contracts
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Ended_contracts extends Winjob_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load_language();
    }
    
    protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
    public function index() {
       $this->display_ended_contracts( );
    }
    
}
