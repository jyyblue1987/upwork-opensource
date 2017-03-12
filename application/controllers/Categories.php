<?php

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category', 'category_model');
    }
    
    public function choose()
    {
        if ($this->Adminlogincheck->checkx()) {
            
            if($this->session->userdata('type') != 2){
            redirect(site_url("jobs-home"));
        }
            $data = [];
            $data = array( 
                'page' => "profilesetting",
                'name' => $this->session->userdata('fname') . " " . $this->session->userdata('lname'),
                'id' => $this->session->userdata('id'),
                'js' => array(),
                'jsf' => array(
                    "assets/js/layerslider.transitions.js",
                    "assets/js/layerslider.kreaturamedia.jquery.js",
                    "assets/js/owl.carousel.min.js",
                    "assets/js/homepage.js",
                    "assets/js/jqiery-ui.js"
                ),
                'css' => array(
                    "assets/css/layerslider.css",
                    "assets/css/owl.carousel.css",
                    "assets/css/owl.theme.css"
                ),
                'open' => "profile",
                'openSub' => "profile-bio",
                'skillList' => array(
                    "Java", "PHP", "HTML", "CSS", "Javascript", "Jquery"
                ),
               // 'projectCateList' => $value['projectCateList'],
            );
            $data['categories'] = $this->category_model->get_categories();
            $user_categories = $this->category_model->get_user_subcategories($this->session->userdata('id'));
            $user_cats = [];
            
            if($user_categories) {
                $i=1;
                foreach ($user_categories as $cats) {
                    $user_cats[$i] = $cats->subcat_id;
                    $i++;
                }
            }
            $data['user_categories'] = $user_cats;
            $data['title'] = 'Manage Categories - Winjob';
            //echo '<pre>categories data: '; print_r($user_cats); echo '</pre>';
            //echo '<pre>categories data: '; print_r($data['categories']); echo '</pre>';
            
            $this->Admintheme->webview("categories/choose", $data);
        }else{
            redirect(site_url("signin"));
        }
    }
    
    public function add()
    {
        if ($this->Adminlogincheck->checkx()) {
             //echo '<pre>data: '; print_r($this->input->post()); echo '</pre>';
            if($this->input->post('subcats')) {
                $update_data = [];
                foreach($this->input->post('subcats') as $subcat) {
                    $update_data[] = [
                        'user_id' => $this->session->userdata('id'),
                        'subcat_id' => $subcat
                    ];
                }
                if(sizeof($update_data) <=5){
                    $this->category_model->delete_user_categories($this->session->userdata('id'));
                    $is_created = $this->category_model->create_user_subcategories($update_data);
                    if($is_created) {
                        $this->session->set_flashdata('action_msg_success', 'Categories saved successfully');
                    }else {
                        $this->session->set_flashdata('action_msg_error', 'Unable to save Categories, Please try again');
                    }
                    //echo '<pre>'; print_r($update_data);
                }else{
                    $this->session->set_flashdata("action_msg_error","Please select maximum 5 Categories");
                }
                redirect('categories/choose');
            }
        }else{
            redirect(site_url("signin"));
        }
    }
}