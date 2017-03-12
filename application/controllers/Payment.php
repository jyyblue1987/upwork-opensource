<?php
class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('common_mod'));
    }

    public function methods()
    {
        if ($this->Adminlogincheck->checkx()) {

            $params = array(
                'title' => 'Payment Methods - Winjob',
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
            $condition = " AND webuser_id=".$this->session->userdata(USER_ID)." AND current_status='active'";
            $data = $this->common_mod->get(WB_PAYMENT_METHODS,null,$condition);
            if(!empty($data) && sizeof($data['rows']) > 0){
                $params['data'] = $data['rows'];
            }
            $this->Admintheme->webview2("payment/methods",$params);
        }else{
            redirect(site_url("signin"));
        }
    }

    public function removeAccount(){
        if ($this->Adminlogincheck->checkx()) {
            $response['status'] = "error";
            $response['msg'] = "error";
            if(!empty($_POST) && $this->input->is_ajax_request()){
                $type = trim($this->input->post("type"));
                if(strlen($type) > 0){
                    $conditionArry = array(
                        'webuser_id'=>$this->session->userdata(USER_ID),
                        'current_status'=>'active',
                        'payment_method_name'=>$type,
                        'account_id'=>$this->session->userdata("email")
                    );
                    if($this->common_mod->getCount(WB_PAYMENT_METHODS,$conditionArry,null) == 1){
                        $updateArry = array(
                            'webuser_id'=>$this->session->userdata(USER_ID),
                            'current_status'=>'deactive',
                            'payment_method_name'=>$type,
                            'account_id'=>$this->session->userdata("email"),
                            'last_update_time'=>round(microtime(true)*1000)
                        );

                        $hasUpdated = $this->common_mod->updateVal(WB_PAYMENT_METHODS,$updateArry,$conditionArry,null);
                        if($hasUpdated){
                            $response['status'] = "success";
                            $response['msg'] = "success";
                        }else{
                           $response['msg'] = "System error!Please try again";
                        }
                    }else{
                        $response['msg'] = "No Match Found";
                    }
                }else{
                    $response['msg'] = "incorrect parameters found!";
                }
            }else{
                $response['msg'] = "invalid request!";
            }
            echo json_encode($response);
        }else{
            redirect(site_url("signin"));
        }
    }
    // added by jeison arenales start
    public function exist_account(){
        if ($this->Adminlogincheck->checkx()) {
            $type = $this->input->post("type", true);

            $conditionArry = array(
                'webuser_id' => $this->session->userdata(USER_ID),
                'payment_method_name' => $type,
                'account_id' => $this->session->userdata("email")
            );
            if($this->common_mod->getCount(WB_PAYMENT_METHODS,$conditionArry,null) == 0)
                $response['status'] = "success";
            else
                $response['status'] = "error";

            echo json_encode($response);
        }
        else {
            redirect(site_url("signin"));
        }
    }
    // added by jeison arenales end

    public function addPaymentMethodAcc(){
        if ($this->Adminlogincheck->checkx()) {
            $response['status'] = "error";
            $response['msg'] = "error";
            if(!empty($_POST) && $this->input->is_ajax_request()){
                $type = trim($this->input->post("type"));
                if(strlen($type) > 0){
                    $conditionArry = array(
                        'webuser_id'=>$this->session->userdata(USER_ID),
                        // 'current_status'=>'active',
                        'payment_method_name'=>$type,
                        'account_id'=>$this->session->userdata("email")
                    );
                    if($this->common_mod->getCount(WB_PAYMENT_METHODS,$conditionArry,null) == 0){
                        $updateArry = array(
                            'webuser_id'=>$this->session->userdata(USER_ID),
                            'current_status'=>'active',
                            'payment_method_name'=>$type,
                            'account_id'=>$this->session->userdata("email"),
                            'creation_time'=>round(microtime(true)*1000)
                        );
                        $inserted = $this->common_mod->insert(WB_PAYMENT_METHODS,$updateArry);
                        if($inserted > 0){
                            $response['status'] = "success";
                            $response['msg'] = "success";
                        }else{
                           $response['msg'] = "System error!Please try again";
                        }
                    }else{
                       $response['msg'] = "You have already account added for ".$type;
                    }
                }else{
                    $response['msg'] = "Incorrect parameters found!";
                }
            }else{
                $response['msg'] = "invalid request!";
            }
            echo json_encode($response);
        }else{
            redirect(site_url("signin"));
        }
    }

    public function taxInformation(){
        if ($this->Adminlogincheck->checkx()) {
            //tax details//
            $condition = " AND webuser_id=".$this->session->userdata(USER_ID);
            $webUserTaxdetails = $this->common_mod->get(WB_TAX_INFO,null,$condition);
            if(empty($webUserTaxdetails['rows'])){
                $webUserTaxdetails['rows'][0] = "";
            }
             //webuser contact details//
            $webuserCountry = $this->common_mod->getSpecificColVal(COUNTEY_TABLE,"country_name"," AND country_id  =".$this->session->userdata('webuser_country'));

            //get country//
            $condition = " AND country_id=".$this->session->userdata("webuser_country");
            $params['country'] = $this->common_mod->getSpecificColVal(COUNTEY_TABLE,"country_name",$condition);
            //all country//
            $country= $this->common_mod->getSpecificColVal(COUNTEY_TABLE,"country_name",$condition);

            $condition = " AND country_id != 0";
            $data = $this->common_mod->get(COUNTEY_TABLE,null,$condition);
            if(!empty($data) && sizeof($data) > 0){
                $params['countryList'] = $data['rows'];
                $countryList = $data['rows'];
            }
            //var_dump($params['countryList']);die();
            $params['webUserTaxdetails'] = $webUserTaxdetails['rows'][0];
            $params['title'] = "Tax Information";
            $params['webuserCountry'] = $webuserCountry;


            $condition = " AND webuser_id=".$this->session->userdata(USER_ID);
            $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
            if(empty($webUserContactDetails['rows'])){
                $webUserContactDetails['rows'][0] = "";
            }

            //webuser contact details//
           // $webuserCountry = $this->common_mod->getSpecificColVal(COUNTEY_TABLE,"country_name"," AND country_id  =".$this->session->userdata('webuser_country'));
          //  $countryList = $this->common_mod->get(COUNTEY_TABLE,null," AND country_status=1");
           // print_r($webUserTaxdetails);die();
            $params = array(
                    'title' => 'Tax Information - Winjob',
                    'country_name' => $country,
                  //  'page' => "profilesetting",
                    'name' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
                    'id' => $this->session->userdata('id'),
                    'js' =>array(),
                    'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
                    'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
                    'countryList' => $countryList,
                    'open' => 'account',
                    'openSub' =>'profile-basic',
                    'webuserContactDetails' =>$webUserContactDetails['rows'][0],
                'webUserTaxdetails' =>$webUserTaxdetails['rows'][0],

                );
            $this->Admintheme->webview("payment/tax-information",$params);
        }else{
            redirect(site_url("signin"));
        }
    }

    public function updateTaxInformation(){

        if ($this->Adminlogincheck->checkx()) {
            $response['status'] = "error";
            $response['msg'] = "error";
            if(!empty($_POST) && $this->input->is_ajax_request()){
                $fieldCheck = array(
                    array(
                        'field' => 'legalName',
                        'label' => 'Legal name',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[165]'
                    ),
                    array(
                        'field' => 'taxno',
                        'label' => 'Tax No',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[64]'
                    ),
                    array(
                        'field' => 'country',
                        'label' => 'Country',
                        'rules' => 'required|trim|xss_clean|min_length[1]|max_length[132]'
                    ),
                    array(
                        'field' => 'taxAddress',
                        'label' => 'Address line 1',
                        'rules' => 'required|trim|xss_clean|min_length[1]|max_length[155]'
                    ),
                    array(
                        'field' => 'taxAddressLine2',
                        'label' => 'Address line 2',
                        'rules' => 'required|trim|xss_clean|min_length[1]|max_length[155]'
                    ),
                     array(
                        'field' => 'city',
                        'label' => 'City',
                        'rules' => 'required|trim|xss_clean|min_length[1]|max_length[155]'
                    ),
                    array(
                        'field' => 'state',
                        'label' => 'State',
                        'rules' => 'required|trim|xss_clean|min_length[1]|max_length[155]'
                    ),
                    array(
                        'field' => 'zipcode',
                        'label' => 'Zip Code',
                        'rules' => 'required|trim|xss_clean|numeric'
                    ),
                );
                $this->form_validation->set_rules($fieldCheck);
                if($this->form_validation->run() == FALSE){
                    //$this->basicProfilePage();
                    $response['msg'] = validation_errors();
                }else{
                    $formVal['legal_name'] = $this->input->post("legalName");
                    $formVal['tax_no'] = $this->input->post("taxno");
                    $formVal['country'] = $this->input->post("country");
                    $formVal['address'] = $this->input->post("taxAddress");
                    $formVal['address_line1'] = $this->input->post("taxAddressLine2");
                    $formVal['city'] = $this->input->post("city");
                    $formVal['zip'] = $this->input->post("zipcode");
                    $formVal['created_time'] = round(microtime(true)*1000);
                    $formVal['state'] = $this->input->post("state");

                    $condition = " AND webuser_id=".$this->session->userdata(USER_ID)." ";
                    if($this->common_mod->getCount(WB_TAX_INFO,null,$condition) > 0){
                        $updated = $this->common_mod->updateVal(WB_TAX_INFO,$formVal,null,$condition);
                        if($updated){
                            $response['status'] = "success";
                            $response['msg'] = "Your tax information successfully updated.";
                        }
                    }else{
                        //else insert data//
                        $formVal['webuser_id'] = $this->session->userdata(USER_ID);
                        $insertedID = $this->common_mod->insert(WB_TAX_INFO,$formVal);
                        if($insertedID > 0){
                            $response['status'] = "success";
                            $response['msg'] = "Your tax information successfully inserted.";
                        }
                    }
                }
            }else{
                $response['msg'] = "Iligal request found!";
            }
            echo json_encode($response);
        }else{
            redirect(site_url("signin"));
        }
    }
}
