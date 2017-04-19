<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct($username=null) {
        parent::__construct('');
        $this->load->model(array('common_mod', 'Category', 'profile/ProfileModel'));
        $this->load->model(array('timezone'));
    }

     public function index($username=null) {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }
            
            $this->load->model('webuser_model');
            
            $user_id = $this->session->userdata('id');

            $sql = "SELECT cropped_image FROM webuser WHERE webuser_id =  " . $user_id;
            $params['userimg'] = $this->db->query($sql)->row();

            $this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
            $this->db->from('job_accepted');
            //  $this->db->join('job_feedback', 'job_feedback.feedback_job_id=job_accepted.job_id', 'inner');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            //  $this->db->where('job_feedback.feedback_userid',$user_id);
            //  $this->db->where('job_feedback.sender_id !=',$user_id);
            $this->db->where('job_accepted.fuser_id', $user_id);
            // $this->db->where('job_bids.jobstatus', '1' );

            $query = $this->db->get();
            $params['accepted_jobs'] = $query->result();

            $params['current_user_rating'] = $this->webuser_model->get_total_rating( $user_id );
                    
            //get webuser info//
            $cols = array("webuser_fname", "webuser_lname", "webuser_picture", "webuser_country");
            $condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
            $data = $this->common_mod->getColsVal(WEB_USER_TABLE, $cols, $condition);

            $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
            if (empty($this->timezone->get((int)$webUserContactDetails['rows'][0]['timezone'])))
            {
                $gmt = 'GMT'.date('P');

                $timezone = $this->timezone->getByGMT($gmt);
            }
            else
                $timezone = $this->timezone->get((int)$webUserContactDetails['rows'][0]['timezone']);

            if (!empty($data['rows'][0])) {
                //get country//
                $sql = " AND country_id = " . $data['rows'][0]['webuser_country'] . " ";
                $data['rows'][0]['webuser_country_name'] = $this->common_mod->getSpecificColVal(COUNTEY_TABLE, "country_name", $sql);
                $params['webUserInfo'] = $data['rows'][0];
                //get basic information//
                $data2 = $this->common_mod->get(WEB_USER_BASIC_PROFILE_TABLE, null, $condition);
                if (!empty($data2['rows'][0])) {
                    $title = "";
                    if (strlen($data['rows'][0]["webuser_fname"]) > 0) {
                        $title = $data['rows'][0]["webuser_fname"];
                    }
                    if (strlen($data2['rows'][0]["tagline"]) > 0) {
                        $title .= " | " . $data2['rows'][0]["tagline"];
                    }
                    $params['title'] = $title;
                    // added by Armen start

                    $this->db->select("skill_name");
                    $this->db->from("webuser_skills");
                    $this->db->where("webuser_id = ", $this->session->userdata(USER_ID));
                    $query = $this->db->get();
                    $user_skills = $query->result_array();

                    // added by Armen end
                    $params['basicDetails'] = $data2['rows'][0];
                    $params['basicDetails']['user_skills'] = $user_skills;

                    //get protfolio details//
                    $portfolioDetails = $this->common_mod->get(WEB_USER_PORTFOLIO_TABLE, null, $condition . " AND visibility_status='yes'");
                    if (!empty($portfolioDetails['rows'][0])) {
                        $params['portfolios'] = $portfolioDetails['rows'];
                    }

                    $this->db->select('*');
                    $this->db->from('freelancer_education');
                    $this->db->where('fuser_id', $user_id);
                    $query = $this->db->get();
                    $educations = $query->result();

                    $profileExp = $this->ProfileModel->getExp($user_id);
                    $params['experience'] = $profileExp;

                    $params['educations'] = $educations;

                    //$this->load->view("webview/profile/freelancer-profile", $params);

                   /* echo phpinfo();
                    die();*/
                    if (!empty($timezone)) {
                        $date =  new \DateTime(date('Y-m-d h:i:s',time()), new DateTimezone('UTC'));
                        $date->setTimezone(new \DateTimezone($timezone['gmt']));
                      /*  print_r($timezone['gmt']);
                        echo "<br>";
                        print_r($date);
                        die();*/
                        $params['localtime'] = $date->format('h:i A');
                    } else {
                        $params['localtime'] = date('h:i A');
                    }

                    $this->Admintheme->custom_webview("profile/freelancer-profile", $params);
                } else {
                    redirect(site_url("profile/basic"));
                }
            }
        } else {
            redirect(site_url("signin"));
        }
    }

     public function manageaccount() {
         if ($this->Adminlogincheck->checkx()) {
             $data=array();
             $data = array(
                'title' => "Manage Accounts",
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
            );
             $this->Admintheme->webview("profile/manageaccount", $data);
         }
    }
    public function searchFreelancer() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

                $fieldCheck = array(
                    'field' => 'keywords',
                    'label' => "Keywords",
                    'rules' => "trim|xss_clean|requried"
                );
                $this->form_validation->set_rules($fieldCheck);
                if ($this->form_validation->run() == FALSE) {
                    $response['msg'] = validation_errors();
                } else {
                    $data = array(
                        'title' => "Freelancer Profile",
                        'page' => "Freelancer Profile",
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
                    );
                }

                if ($this->input->is_ajax_request()) {

                } else {
                    $data['searchWord'] = "";
                    $keywords = $this->input->get("q");
                    if (strlen($keywords) > 0) {
                        $data['searchWord'] = $keywords;
                        $freelancers = $this->ProfileModel->getFreelancerSearch($keywords);
                        if (!empty($freelancers) && sizeof($freelancers) > 0) {
                            $data['freelancers'] = $freelancers;
                        }
                    }
                }
                $this->Admintheme->webview("jobs/freelancers", $data);
        } else {
            redirect(site_url("signin"));
        }
    }

    public function basic() {

        if ($this->Adminlogincheck->checkx()) {
            $condition = " AND webuser_id=" . $this->session->userdata(USER_ID) . " ";
            $data = $this->common_mod->get(WEB_USER_BASIC_PROFILE_TABLE, null, $condition);
            if (!empty($data['rows'][0])) {
                $data['open'] = "profile";
                $data['openSub'] = "profile-basic";
                $this->session->set_userdata("experienceYear", $data['rows'][0]['work_experience_year']);
                $this->session->set_userdata("experienceMonth", $data['rows'][0]['work_experience_month']);
                // Added by Armen start
                // Get job skills
                $this->db->select("skill_name");
                $this->db->from("webuser_skills");
                $this->db->where("webuser_id = ", $this->session->userdata(USER_ID));
                $query = $this->db->get();
                $user_skills = $query->result_array();

                // Get all skills
                $this->db->select("skill_name");
                $this->db->from("skills");
                $query_files = $this->db->get();
                $skillList = $query_files->result();
                $repeated = array();
                foreach ($skillList as $key => $value) {
                    foreach ($user_skills as $index => $skill) {
                        if($value->skill_name == $skill['skill_name']){
                            array_push($repeated,$value->skill_name);
                        }
                    }
                }
                $data['rows'][0]['repeated'] = $repeated;
                $data['rows'][0]['user_skills'] = $user_skills;
                $data['rows'][0]['skillList'] = $skillList;
                // added by Armen end
                $this->session->set_userdata(ACTION_DATA, $data['rows'][0]);
            } else {
                $this->session->set_flashdata(WARNING_MESSAGE, "Your basic information is not updated. Please complete your profile to get job");
            }
            $this->basicProfilePage();
        } else {
            redirect(site_url("signin"));
        }
    }

    public function basicProfilePage() {
        $sql = "SELECT cropped_image FROM webuser WHERE webuser_id =  " . $this->session->userdata(USER_ID);
        $croppedImage =    $this->db->query($sql)->row();
        $data = array(
            'title' => "Profile Setting",
            'page' => "profilesetting",
            'name' => $this->session->userdata('fname') . " " . $this->session->userdata('lname'),
            'id' => $this->session->userdata('id'),
            'croppedImage' =>$croppedImage, // ad by indsys tech
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
            'open' => 'profile',
            'openSub' => 'profile-basic',
        );
        $this->Admintheme->webview("profile/profile_basic", $data);
    }

    public function add_experience($exp_id = null, $page_from = null) {
        if ($this->Adminlogincheck->checkx()) {
            // print_r($this->input->post());
            // die();

            //save data echo "<pre>"; print_r($data); die;
            if (count($_POST)) {
                try {
                    $data = (object) $this->input->post('inputs', TRUE);
                    $data->curr_working_place = ($data->curr_working_place === 'on') ? 1 : 0;
                    ($data->curr_working_place === 1) and $data->month2 = $data->year2 = 0;
                    //$this->input->post("skills");
                    //echo "<pre>"; print_r($data); die;
                    $err = 0;

                    if ($data->company == '' || $data->title == '' || $data->location == '') {
                        $err = 1;
                        $_SESSION['global_error'] = 'Please enter valid data in all field.';
                    }

                    if ($err == 0) {
                        if ($exp_id != null) {
                            $data->user_id = $this->session->userdata(USER_ID);

                            $this->db->where('id', $exp_id);
                            $this->db->update('user_experience', $data);
                        } else {
                            $data->id = '';
                            $data->user_id = $this->session->userdata(USER_ID);
                            $this->ProfileModel->save_data_experience($data);
                        }

                        //$this->acl_model->insertPageAccessLog('Edit');
                        $_SESSION['success_message'] = "Experience saved successfully";

                        $this->redirectByCondition($page_from);
                    }
                    else {
                        $this->redirectByCondition($page_from);
                    }
                } catch (Exception $ex) {
                    $_SESSION['global_error'] = $ex->getMessage();
                }
            } else {
                redirect(site_url("profile/basic_bio"));
            }

            //$this->load->view("webview/profile/profile_basic_bio", $data);
        } else {
            redirect(site_url("signin"));
        }
    }

    public function add_education($edu_id = null, $page_from = null) {
        if ($this->Adminlogincheck->checkx()) {

            if (count($_POST)) { //save data echo "<pre>"; print_r($data); die;
                $school = $this->input->post('school');
                $dates_attend_from = $this->input->post('year3');
                $dates_attend_to = $this->input->post('year4');
                $degree = $this->input->post('degree');
                $field_of_study = $this->input->post('field_of_study');
                $grade = $this->input->post('grade');
                $activities = $this->input->post('activities');
                $description = $this->input->post('description');
                $user_id = $this->session->userdata('id');
                $data = array(
                    'school' => $school,
                    'fuser_id' => $user_id,
                    'dates_attend_from' => $dates_attend_from,
                    'dates_attend_to' => $dates_attend_to,
                    'degree' => $degree,
                    'field_of_study' => $field_of_study,
                    'grade' => $grade,
                    'activities' => $activities,
                    'description' => $description
                );
                $user_id = $this->session->userdata(USER_ID);

                if ($edu_id != null) {

                    $this->db->where('id', $edu_id);
                    $data = array(
                        'school' => $school,
                        'fuser_id' => $user_id,
                        'dates_attend_from' => $dates_attend_from,
                        'dates_attend_to' => $dates_attend_to,
                        'degree' => $degree,
                        'field_of_study' => $field_of_study,
                        'grade' => $grade,
                        'activities' => $activities,
                        'description' => $description
                    );
                    $this->db->update('freelancer_education', $data);
                } else {
                    $data = array(
                        'school' => $school,
                        'fuser_id' => $user_id,
                        'dates_attend_from' => $dates_attend_from,
                        'dates_attend_to' => $dates_attend_to,
                        'degree' => $degree,
                        'field_of_study' => $field_of_study,
                        'grade' => $grade,
                        'activities' => $activities,
                        'description' => $description
                    );
                    $this->db->insert('freelancer_education', $data);
                }

                $this->redirectByCondition($page_from);
            } else {
                redirect(site_url("profile/basic_bio"));
            }

            //$this->load->view("webview/profile/profile_basic_bio", $data);
        } else {
            redirect(site_url("signin"));
        }
    }

    public function updateContactDetails() {
        $response = array();
        $response['status'] = "error";
        $response['msg'] = "System error! Please refresh page and try again!";

        if ($this->Adminlogincheck->checkx()) {
            if (!empty($_POST) && $this->input->is_ajax_request()) {
                $fieldCheck = array(
                    array(
                        'field' => 'address1',
                        'label' => 'Address Line 1',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[196]'
                    ),
                    array(
                        'field' => 'address2',
                        'label' => 'Address Line 2',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[196]'
                    ),
                    array(
                        'field' => 'city',
                        'label' => 'City',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[196]'
                    ),
                    array(
                        'field' => 'state',
                        'label' => 'state',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[196]'
                    ),
                    array(
                        'field' => 'projectSkillsUsed',
                        'label' => 'Project Skills',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[255]'
                    ),
                    array(
                        'field' => 'zipcode',
                        'label' => 'Zip Code',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'country',
                        'label' => 'country',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'countryCode',
                        'label' => 'Country Code',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'phone',
                        'label' => 'phone Number',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'timeZone',
                        'label' => 'Time Zone',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[255]'
                    )
                );
                $this->form_validation->set_rules($fieldCheck);
                if ($this->form_validation->run() == FALSE) {
                    $response['msg'] = validation_errors();
                } else {
                    //update webuser table//
                    $country = $this->input->post("country");
                    $phone   = $this->input->post("phone");
                    $webuser['webuser_country'] = $country;
                    $webuser['webuser_phone'] = $phone;
                    $formVal['country'] = $country;
                    $formVal['phone_number'] = $phone;
                    $formVal['address'] = $this->input->post("address1");
                    $formVal['address1'] = $this->input->post("address2");
                    $formVal['city'] = $this->input->post("city");
                    $formVal['state'] = $this->input->post("state");
                    $formVal['zipcode'] = $this->input->post("zipcode");
                    $formVal['timezone'] = $this->input->post("timeZone");
                    $condition = " AND webuser_id=" . $this->session->userdata(USER_ID);

                    $condition_on = "webuser_id=" . $this->session->userdata(USER_ID);
                    $hasUpdated = $this->common_mod->updateVal(WEB_USER_TABLE, $webuser, null, $condition);
                    if ($hasUpdated) {
                        if ($this->common_mod->getCount(WEB_USER_ADDRESS, null, $condition_on) > 0) {
                            $hasUpdated = $this->common_mod->updateVal(WEB_USER_ADDRESS, $formVal, null, $condition);
                            if ($hasUpdated) {
                                $this->session->set_userdata('webuser_country', $country);
                                $response['status'] = "success";
                                $response['msg'] = "Your contact details successfully updated";
                            } else {
                                $response['msg'] = "Sorry system error. Please refresh the page and try again";
                            }
                        } else {
                            $formVal['webuser_id'] = $this->session->userdata(USER_ID);
                            $insertedID = $this->common_mod->insert(WEB_USER_ADDRESS, $formVal);
                            if ($insertedID > 0) {
                                $this->session->set_userdata('webuser_country', $country);
                                $response['status'] = "success";
                                $response['msg'] = "Your contact details successfully inserted";
                            } else {
                                $response['msg'] = "Sorry system error. Please refresh the page and try again";
                            }
                        }
                    }
                }
            } else {
                $this->session->set_flashdata(ERROR_MESSAGE, "Invalid input found. Try again");
                $response['msg'] = "Invalid input found. Try again.";
            }
        } else {
            $response['msg'] = "Authentication Failed";
        }
        die(json_encode($response));
    }

    public function updatePortfolio() {
        $response = array();
        $response['status'] = "error";
        $response['msg'] = "";
        //$response['msg'] = "System error! Please refresh page and try again!";
        if ($this->Adminlogincheck->checkx()) {
            if (!empty($_POST)) {
                $fieldCheck = array(
                    array(
                        'field' => 'projectTitle',
                        'label' => 'Project Title',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[196]'
                    ),
                    array(
                        'field' => 'projectOverview',
                        'label' => 'Project Overview',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[1000]'
                    ),
                    array(
                        'field' => 'projectCategory',
                        'label' => 'Project Category',
                        'rules' => 'numeric|greater_than[0]'
                    ),
                    array(
                        'field' => 'projectCompletionDate',
                        'label' => 'Complettion Date',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[10]'
                    ),
                    // array(
                    //     'field' => 'projectSkillsUsed',
                    //     'label' => 'Project Skills',
                    //     'rules' => 'trim|xss_clean|min_length[1]|max_length[255]'
                    // ),
                    array(
                        'field' => 'projectURL',
                        'label' => 'Project URL',
                        'rules' => 'trim|xss_clean|valid_url'
                    )
                );
                $this->form_validation->set_rules($fieldCheck);
                if ($this->form_validation->run() == FALSE) {
                    $response['msg'] = "Check all mandatory fields";
                } else {
                    $insert = true;
                    $formVal['webuser_id'] = $this->session->userdata(USER_ID);
                    $formVal['project_title'] = $this->input->post("projectTitle");
                    $formVal['project_overview'] = $this->input->post("projectOverview");
                    $formVal['project_category'] = $this->input->post("projectCategory");
                    $formVal['project_url'] = $this->input->post("projectURL");
                    $formVal['completion_date'] = $this->input->post("projectCompletionDate");
                    $formVal['completion_date'] = date('Y-m-d', strtotime($formVal['completion_date']));
                    $formSkills = $this->input->post("projectSkillsUsed");
                    $formVal['creation_time'] = date('Y-m-d');
                    //check skill//
                    // $last = substr($formVal['skills'], strlen($formVal['skills']) - 1, strlen($formVal['skills']));
                    // if (strcmp($last, ",") == 0) {
                    //     $formVal['skills'] = substr($formVal['skills'], 0, strlen($formVal['skills']) - 1);
                    //     if (sizeof(explode(",", $formVal['skills'])) > 10) {
                        if(count($formSkills) > 10){
                            $response['msg'] = "Maximum 10 skills are allowed to insert. Please check";
                            $insert = false;
                        // }
                        }
                    // }
                    if (substr($formVal['project_url'], 0, 5) != "https") {
                        if (substr($formVal['project_url'], 0, 4) != "http") {
                            $formVal['project_url'] = "http://" . $formVal['project_url'];
                        }
                    }
                    $isUploaded = $this->doUpload("portfolioFile");
                    if (strcmp($isUploaded, "success") == 0) {
                        $insert = true;
                        $formVal['thumnail_image'] = $this->upload->data("file_name");
                    } else {
                        if (strcmp($isUploaded, "You did not select a file to upload.") == 0) {
                            $insert = true;
                        } else {
                            $insert = false;
                            $response['msg'] = $isUploaded;
                        }
                    }
                    $id = $this->input->post('id');
                    if (strlen($id) && base64_decode($id) > 0) {
                        $insert = false;
                        $img = base64_decode($this->input->post("img"));
                        $id = base64_decode($id);
                        $condition = " AND id=" . $id . " AND webuser_id=" . $this->session->userdata(USER_ID);
                        $formVal['last_updated_time'] = date('Y-m-d');

                        // added by Armen start
                        $this->db->where('portfolio_id', $id);
                        $this->db->delete('webuser_portfolio_skills');
                        $skills = array();
                        $skills['portfolio_id'] = $id;
                        foreach ($formSkills as $key => $value) {
                          $skills['skill_name'] = $value;
                          $this->db->insert('webuser_portfolio_skills', $skills);
                        }

                        // added by Armen end
                        $hasUpdated = $this->common_mod->updateVal(WEB_USER_PORTFOLIO_TABLE, $formVal, null, $condition);
                        if ($hasUpdated) {
                            $response['status'] = "success";
                            $response['msg'] = "success";
                            if (strlen($img) > 0) {
                                $this->load->helper("file");
                                delete_files(base_url() . "uploads/portfolio/" . $img);
                            }
                        }
                    }
                    if ($insert) {
                        $insertedID = $this->common_mod->insert(WEB_USER_PORTFOLIO_TABLE, $formVal);

                        // added by Armen start
                        $skills = array();
                        $skills['portfolio_id'] = $insertedID;
                        foreach ($formSkills as $key => $value) {
                            $skills['skill_name'] = $value;
                            $insertedID = $this->common_mod->insert(webuser_portfolio_skills, $skills);
                        }

                        // added by Armen end

                        if ($insertedID > 0) {
                            $response['status'] = "success";
                            $response['msg'] = "success";
                        } else {
                            $response['msg'] = "System error. Please try again";
                        }
                    }
                }
            } else {
                //$response['msg'] = "Invalid input found.";
            }
        } else {
            $response['msg'] = "Authentication Failed";
        }
        $msg = $response['msg'];
        echo '<script type="text/javascript">window.parent.afterUpload("' . $msg . '");</script>';
    }

    public function editPortfolio() {

        if ($this->Adminlogincheck->checkx() && $this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $key = $this->input->post("key");
                if (strlen($key) > 0) {
                    $id = base64_decode($key);
                    // Get all skills
                    $this->db->select("skill_name");
                    $this->db->from("skills");
                    $query_files = $this->db->get();
                    $skillList = $query_files->result();

                    $params['skillList'] = $skillList;
                    $params['port_skills'] = array();
                    $params['repeated'] = array();

                    if (intval($id) > 0) {
                        $condition = " AND id=" . $id . " AND webuser_id=" . $this->session->userdata(USER_ID);
                        $data = $this->common_mod->get(WEB_USER_PORTFOLIO_TABLE, null, $condition);
                        if (!empty($data['rows']) && is_array($data['rows'])) {
                            $row = $data['rows'][0];

                            foreach ($row as $key => $value) {
                                $params[$key] = $value;
                            }

                            empty($params['completion_date']) or $params['completion_date'] = date('m/d/Y', strtotime($params['completion_date']));
                            $params['projectCateList'] = $this->Category->get_categories();
                            // added by Armen start

                            $this->db->select("skill_name");
                            $this->db->from("webuser_portfolio_skills");
                            $this->db->where("portfolio_id = ", $id);
                            $query = $this->db->get();
                            $port_skills = $query->result_array();

                            $repeated = array();
                            foreach ($skillList as $key => $value) {
                                foreach ($port_skills as $index => $skill) {
                                    if($value->skill_name == $skill['skill_name']){
                                        array_push($repeated,$value->skill_name);
                                    }
                                }
                            }

                            $params['port_skills'] = $port_skills;
                            $params['repeated'] = $repeated;

                            // Added by Armen end
                        }
                    } else {
                        $params['id'] = 0;
                        $params['projectCateList'] = $this->Category->get_categories();
                    }
                }
            }
        }
        // print_r($params);
        echo $this->load->view("webview/profile/edit-portfolio", $params, true);
    }

    public function editExpProfile($exp_id = null) {
        if ($exp_id != null) {
            $this->db->select('*');
            $this->db->from('user_experience');
            $this->db->where('id', $exp_id);
            $query = $this->db->get();
            $exp = $query->result();
            $params['experience'] = $exp[0];
            $params['exp_id'] = $exp_id;
            $params['page_from'] = "profile";
        } else {
            $params = array();
        }

        echo $this->load->view("webview/profile/edit-exp", $params, true);
    }

    public function addExp($exp_id = null) {

        if ($exp_id != null) {
            $this->db->select('*');
            $this->db->from('user_experience');
            $this->db->where('id', $exp_id);
            $query = $this->db->get();
            $exp = $query->result();
            $params['experience'] = $exp[0];
            $params['exp_id'] = $exp_id;
            $params['page_from'] = "settings";
        } else {
            $params = array();
        }

        echo $this->load->view("webview/profile/edit-exp", $params, true);
    }

    public function addedu($edu_id = null) {

        if ($edu_id != null) {
            $this->db->select('*');
            $this->db->from('freelancer_education');
            $this->db->where('id', $edu_id);
            $query = $this->db->get();
            $edu = $query->result_array();
            $params['education'] = $edu[0];
            $params['edu_id'] = $edu_id;
            $params['page_from'] = "settings";
        } else {
            $params = array();
        }

        echo $this->load->view("webview/profile/edit-edu", $params, true);
    }

    public function removePortfolio() {
        $response = array();
        $response['status'] = "error";
        $response['msg'] = "System error! Please refresh page and try again!";
        if ($this->Adminlogincheck->checkx() && $this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $key = $this->input->post("key");
                if (strlen($key) > 0) {
                    $id = base64_decode($key);
                    if (intval($id) > 0) {
                        $data = array(
                            'id' => $id,
                            'webuser_id' => $this->session->userdata(USER_ID)
                        );
                        $hasDeleted = $this->common_mod->delete(WEB_USER_PORTFOLIO_TABLE, $data);
                        if ($hasDeleted) {
                            $response['status'] = "success";
                            $response['msg'] = "Your portfolio has been successfully removed";
                        } else {
                            $response['msg'] = "Failed to remove! Please try again";
                        }
                    } else {
                        $response['msg'] = "Refference missing! Please refresh page and try again!";
                    }
                } else {
                    $response['msg'] = "Refference missing! Please refresh page and try again!";
                }
            } else {
                $response['msg'] = "System error! Please refresh page and try again!";
            }
        } else {
            $response['msg'] = "Illigal request found! Please refresh page and try again!";
        }
        echo json_encode($response);
    }

    public function doUpload($filepath) {
        $config['upload_path'] = './uploads/portfolio/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
        $config['max_size'] = 1024 * 5;
        $config['max_width'] = 600;
        $config['max_height'] = 400;
        $config['file_name'] = time() . ".jpg";
        $this->load->library('upload', $config);
        $this->upload->display_errors('', '');
        $this->form_validation->set_error_delimiters('', '');
        if (!$this->upload->do_upload($filepath)) {
            return $this->upload->display_errors();
        } else {
            return "success";
        }
    }

    public function updateBasicProfile() {
        $response = array();
        $response['status'] = "error";
        $response['msg'] = "System error! Please refresh page and try again!";
        if ($this->Adminlogincheck->checkx()) {
            if (!empty($_POST) && $this->input->is_ajax_request()) {
                $fieldCheck = array(
                    array(
                        'field' => 'tagline',
                        'label' => 'Tagline',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[55]'
                    ),
                    array(
                        'field' => 'hourlyRate',
                        'label' => 'Hourly Rate',
                        'rules' => 'required|numeric|greater_than[0]'
                    ),
                    array(
                        'field' => 'hourlyRate',
                        'label' => 'Hourly Rate',
                        'rules' => 'required|numeric|greater_than[0]'
                    ),
                    array(
                        'field' => 'experienceYear',
                        'label' => 'Experience',
                        'rules' => 'required|numeric|greater_than[0]|less_than[21]'
                    ),
                    array(
                        'field' => 'experienceMonth',
                        'label' => 'Experience',
                        'rules' => 'required|numeric|greater_than[0]|less_than[12]'
                    ),
                    // array(
                    //     'field' => 'skills',
                    //     'label' => 'Skills',
                    //     'rules' => 'trim|required|xss_clean|min_length[0]|max_length[255]'
                    // ),
                    array(
                        'field' => 'overview',
                        'label' => 'overview',
                        'rules' => 'trim|required|xss_clean|min_length[0]|max_length[100]'
                    ),
                );
                $this->form_validation->set_rules($fieldCheck);
                if ($this->form_validation->run() == FALSE) {
                    // die('["ok"]');
                    //$this->basicProfilePage();
                    $response['msg'] = validation_errors();
                } else {
                    $formVal['tagline'] = $this->input->post("tagline");
                    $formVal['hourly_rate'] = $this->input->post("hourlyRate");
                    $formVal['work_experience_year'] = $this->input->post("experienceYear");
                    $formVal['work_experience_month'] = $this->input->post("experienceMonth");
                    $formVal['skills'] = $this->input->post("skills");
                    $formVal['overview'] = $this->input->post("overview");
                    $formVal['last_updated_time'] = round(microtime(true) * 1000);
                    //check skill//
                    // $last = substr($formVal['skills'], strlen($formVal['skills']) - 1, strlen($formVal['skills']));
                    // if (strcmp($last, ",") == 0) {
                    //     $formVal['skills'] = substr($formVal['skills'], 0, strlen($formVal['skills']) - 1);
                    //     if (sizeof(explode(",", $formVal['skills'])) > 5) {
                    if(count($formVal['skills']) > 5){
                        $this->session->set_flashdata(ERROR_MESSAGE, "Maximum 5 skills allowed to insert. Please check");
                        echo json_encode(['status' => 'error', 'url' => "basic"]);
                        return;
                        // redirect(site_url("profile/basic#basic-profile-area"));
                        // }
                    // }
                    }
                    $condition = " webuser_id=" . $this->session->userdata(USER_ID) . " ";
                    // added by Armen start

                    if ($this->common_mod->getCount(webuser_skills, null, $condition) > 0) {
                        $this->db->where('webuser_id', $this->session->userdata(USER_ID));
                        $this->db->delete('webuser_skills');
                        $skills = array();
                        $skills['webuser_id'] = $this->session->userdata(USER_ID);
                        foreach ($formVal['skills'] as $key => $value) {
                          $skills['skill_name'] = $value;
                          $this->db->insert('webuser_skills', $skills);
                        }
                    }else{
                        $skills = array();
                        $skills['webuser_id'] = $this->session->userdata(USER_ID);
                        foreach ($formVal['skills'] as $key => $value) {
                            $skills['skill_name'] = $value;
                            $insertedID = $this->common_mod->insert(webuser_skills, $skills);
                        }
                    }
                    $formVal['skills'] = '';
                    // added by Armen end
                    if ($this->common_mod->getCount(WEB_USER_BASIC_PROFILE_TABLE, null, $condition) > 0) {
                        //if exits do update//
                        $hasUpdated = $this->common_mod->updateVal(WEB_USER_BASIC_PROFILE_TABLE, $formVal, null, ' AND ' . $condition);
                        if ($hasUpdated) {
                            //$this->session->set_flashdata(SUCCESS_MESSAGE,"Your profile basic information successfully updated.");
                            $response['status'] = "success";
                            $response['msg'] = "Your profile basic information successfully updated.";
                        }
                    } else {
                        //else insert data//
                        $formVal['webuser_id'] = $this->session->userdata(USER_ID);
                        $insertedID = $this->common_mod->insert(WEB_USER_BASIC_PROFILE_TABLE, $formVal);
                        if ($insertedID > 0) {
                            //$this->session->set_flashdata(SUCCESS_MESSAGE,"Your profile basic information successfully inserted.");
                            $response['status'] = "success";
                            $response['msg'] = "Your profile basic information successfully inserted.";
                        }
                    }
                }
            } else {
                $this->session->set_flashdata(ERROR_MESSAGE, "Invalid input found. Try again");
                $response['msg'] = "Invalid input found. Try again.";
            }
        } else {
            $response['msg'] = "Authentication Failed";
            //redirect(site_url("signin"));
        }
        echo json_encode($response);
    }

    public function freelancerProfile() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }

            $user_id = $this->session->userdata('id');

            $this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
            $this->db->from('job_accepted');
            //  $this->db->join('job_feedback', 'job_feedback.feedback_job_id=job_accepted.job_id', 'inner');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            //  $this->db->where('job_feedback.feedback_userid',$user_id);
            //  $this->db->where('job_feedback.sender_id !=',$user_id);
            $this->db->where('job_accepted.fuser_id', $user_id);
            // $this->db->where('job_bids.jobstatus', '1' );

            $query = $this->db->get();
            $params['accepted_jobs'] = $query->result();


            //get webuser info//
            $cols = array("webuser_fname", "webuser_lname", "webuser_picture", "webuser_country");
            $condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
            $data = $this->common_mod->getColsVal(WEB_USER_TABLE, $cols, $condition);
            if (!empty($data['rows'][0])) {
                //get country//
                $sql = " AND country_id = " . $data['rows'][0]['webuser_country'] . " ";
                $data['rows'][0]['webuser_country_name'] = $this->common_mod->getSpecificColVal(COUNTEY_TABLE, "country_name", $sql);
                $params['webUserInfo'] = $data['rows'][0];
                //get basic information//
                $data2 = $this->common_mod->get(WEB_USER_BASIC_PROFILE_TABLE, null, $condition);
                if (!empty($data2['rows'][0])) {
                    $title = "";
                    if (strlen($data['rows'][0]["webuser_fname"]) > 0) {
                        $title = $data['rows'][0]["webuser_fname"];
                    }
                    if (strlen($data2['rows'][0]["tagline"]) > 0) {
                        $title .= " | " . $data2['rows'][0]["tagline"];
                    }
                    $params['title'] = $title;
                    $params['basicDetails'] = $data2['rows'][0];
                    //get protfolio details//
                    $portfolioDetails = $this->common_mod->get(WEB_USER_PORTFOLIO_TABLE, null, $condition . " AND visibility_status='yes'");
                    if (!empty($portfolioDetails['rows'][0])) {
                        $params['portfolios'] = $portfolioDetails['rows'];
                    }

                    $this->db->select('*');
                    $this->db->from('freelancer_education');
                    $this->db->where('fuser_id', $user_id);
                    $query = $this->db->get();
                    $educations = $query->result();

                    $profileExp = $this->ProfileModel->getExp($user_id);
                    $params['experience'] = $profileExp;

                    $params['educations'] = $educations;

                    //$this->load->view("webview/profile/freelancer-profile", $params);
                    $this->Admintheme->custom_webview("profile/freelancer-profile", $params);
                } else {
                    redirect(site_url("profile/basic"));
                }
            }
        } else {
            redirect(site_url("signin"));
        }
    }

    public function basic_bio() {
        if ($this->Adminlogincheck->checkx()) {
            $value['projectCateList'] = $this->Category->get_categories();
            $data = array(
                'title' => "Profile Setting",
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
                'projectCateList' => $value['projectCateList'],
            );
            //get protfolio details//
            $condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
            $portfolioDetails = $this->common_mod->get(WEB_USER_PORTFOLIO_TABLE, null, $condition . " AND visibility_status='yes'");
            if (!empty($portfolioDetails['rows'][0])) {
                $data['portfolios'] = $portfolioDetails['rows'];
            }
            $user_id = $this->session->userdata('id');
            $profileExp = $this->ProfileModel->getExp($user_id);
            $data['experience'] = $profileExp;
             $this->db->select('*');
                    $this->db->from('freelancer_education');
                    $this->db->where('fuser_id', $user_id);
                    $query = $this->db->get();
                    $educations = $query->result();
            //     print_r($profileExp);die();
                    $data['educations'] = $educations;
           // $this->load->view("webview/profile/profile_basic_bio", $data);
            $this->Admintheme->webview2("profile/profile_basic_bio", $data);

        } else {
            redirect(site_url("signin"));
        }
    }

    public function profile_freelancer() {
        if ($this->Adminlogincheck->checkx()) {
            $user_id = base64_decode($_GET['user']);

            $this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
            $this->db->from('job_accepted');
            //  $this->db->join('job_feedback', 'job_feedback.feedback_job_id=job_accepted.job_id', 'inner');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            //  $this->db->where('job_feedback.feedback_userid',$user_id);
            //  $this->db->where('job_feedback.sender_id !=',$user_id);
            $this->db->where('job_accepted.fuser_id', $user_id);
            $this->db->where('job_bids.jobstatus', '1');

            $query = $this->db->get();
            $params['accepted_jobs'] = $query->result();


            //get webuser info//
            $cols = array("webuser_fname", "webuser_lname", "webuser_picture", "webuser_country");
            $condition = " AND webuser_id=" . $user_id;
            $data = $this->common_mod->getColsVal(WEB_USER_TABLE, $cols, $condition);
            if (!empty($data['rows'][0])) {
                //get country//
                $sql = " AND country_id = " . $data['rows'][0]['webuser_country'] . " ";
                $data['rows'][0]['webuser_country_name'] = $this->common_mod->getSpecificColVal(COUNTEY_TABLE, "country_name", $sql);
                $params['webUserInfo'] = $data['rows'][0];
                //get basic information//
                $data2 = $this->common_mod->get(WEB_USER_BASIC_PROFILE_TABLE, null, $condition);
                if (!empty($data2['rows'][0])) {
                    $title = "";
                    if (strlen($data['rows'][0]["webuser_fname"]) > 0) {
                        $title = $data['rows'][0]["webuser_fname"];
                    }
                    if (strlen($data2['rows'][0]["tagline"]) > 0) {
                        $title .= " | " . $data2['rows'][0]["tagline"];
                    }
                    $params['title'] = $title;
                    $params['basicDetails'] = $data2['rows'][0];
                    //get protfolio details//
                    $portfolioDetails = $this->common_mod->get(WEB_USER_PORTFOLIO_TABLE, null, $condition . " AND visibility_status='yes'");
                    if (!empty($portfolioDetails['rows'][0])) {
                        $params['portfolios'] = $portfolioDetails['rows'];
                    }
                    $this->load->view("webview/profile/profile_freelancer", $params);
                } else {
                    redirect(site_url("profile/basic"));
                }
            }
        }
    }

    /**
     * 2017-02-21 Kalskov Vladimir (spirit@taganlife.ru)
     * @input $id int - Education ID
     **/
    public function removeEdu($id, $page_from = null) {
        $this->ProfileModel->remove_data_education($id);
        $this->redirectByCondition($page_from);
    }

    /**
     * 2017-02-21 Kalskov Vladimir (spirit@taganlife.ru)
     * @input $id int - Experience ID
     **/
    public function removeExp($id, $page_from = null) {
        $this->ProfileModel->remove_data_experience($id);
        $this->redirectByCondition($page_from);
    }

    /**
     * 2017-02-24 Kalskov Vladimir (spirit@taganlife.ru)
     * @input $pageFrom string - There is a page from where user is coming
     **/
     private function redirectByCondition($pageFrom = null) {
        if ($pageFrom != null) {
            if ($pageFrom === "settings") {
                redirect(site_url('profile/basic_bio'));
            }
            elseif ($pageFrom === "profile") {
                redirect(site_url('profile/' . $this->session->userdata('username')));
            }
        }

        redirect(site_url('profile/basic_bio'));
    }
}
