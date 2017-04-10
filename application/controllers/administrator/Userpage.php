<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userpage extends CI_Controller {

		public function index()
		{
	        $text=$this->siteconfig->text();
		$data = array(
	               'text' => $text,
	               'title' => "Login | ".$text['title'],
	               'message' => 'Locked',
	               'color' => 'fffff'
	          );
		$this->load->view('admin/login/login.php',$data, false);

		}

		public function loadpage() {



		// $this->output->set_header("Access-Control-Allow-Origin: *");
		// $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
		// $this->output->set_status_header(200);


		       $page=$this->uri->uri_to_assoc();
                       
                       $keys = array_keys($page);
                       
                       if( count( $keys ) ==  3){
                           $callpage = $keys[2];
                       }else if(isset($page['subpage'])){
				$callpage=$page['subpage'];
			}else{
				$callpage="loadmain";
			}
			$mod=$page['loadpage'];
                        
			switch ($mod) {

					case "packages":
					$permission=array('lists'=> '24' , 'add'=> '25' , 'edit'=> '26' , 'inactive'=> '27');
					break;
					case "webuser":
					$permission=array('verified'=> '18' , 'notverified'=> '19', 'activeclient'=> '22', 'suspendclient'=> '23', 'activefreelancer'=> '24', 'suspendfreelancer'=> '25');
					break;
					case "instagram":
					$permission=array('token'=> '20' , 'expired'=> '21');
					break;
					case "country":
					$permission=array('lists'=> '1' , 'add'=> '2' , 'edit'=> '3' , 'inactive'=> '4' , 'manage'=> '18' , 'grade'=> '47');
					break;
					case "degree":
					$permission=array('lists'=> '5' , 'add'=> '6' , 'edit'=> '7' , 'inactive'=> '8' , 'manage'=> '23');
					break;
					case "listapi":
					$permission=array('countrylist'=> '17' , 'locationloader'=> '32');
					break;
					case "model":
					$permission=array('lists'=> '28' , 'add'=> '29' , 'edit'=> '30' , 'inactive'=> '31');
					break;
					case "docfolders":
					$permission=array('lists'=> '33' , 'add'=> '34' , 'edit'=> '35' , 'inactive'=> '36');
					break;
					case "secaward":
					$permission=array('lists'=> '37' , 'add'=> '38' , 'edit'=> '39' , 'inactive'=> '40' , 'courses'=> '45');
					break;
					case "highaward":
					$permission=array('lists'=> '41' , 'add'=> '42' , 'edit'=> '43' , 'inactive'=> '44' , 'courses'=> '46');
					break;
					case "fundmangement":
					$permission=array('withdaw-processed'=> '26' , 'withdaw-pending'=> '31' , 'invoices'=> '27' , 'paid-invoices'=> '28', 'failed-invoices'=> '29' );
					break;
					//added Sergey start
					case "contactmanagement":
					$permission=array('contactsupport'=> '30');
					break;
					//added by Sergey end
				}
                                
                                $callpage_update = $callpage;
                                if(in_array($callpage, array("withdaw-processed", "withdaw-pending"))){
                                     $callpage_update = "withdawrequest";
                                }else if(strtolower($callpage) == "paid-invoices"){
                                    $callpage_update = "Transuctionhistory";
                                }else if(strtolower($callpage) == "failed-invoices"){
                                    $callpage_update = "Invoicehourly";
                                }
                                
                                $this->load->model('admin/'.$mod.'/'.$callpage_update);
                                
                                $status = null;
                                
                                $this->$callpage_update->check($permission);
                                
                                switch( strtolower($callpage) ){
                                    case 'invoices':
                                        $status = INVOICE_UNPAID;
                                        $this->$callpage_update->load_transaction($permission,$mod, $status);
                                    break;
                                    case 'failed-invoices':
                                        $status = INVOICE_PROCESSING_PAID;
                                        $this->$callpage_update->load_transaction($permission,$mod, $status);
                                    break;
                                    case 'paid-invoices':
                                        $status = INVOICE_PAID;
                                        $this->$callpage_update->load_transaction($permission,$mod, $status);
                                    break;
                                    case 'withdaw-processed':
                                        $this->$callpage_update->load($permission,$mod, WITHDRAW_PROCESSED);
                                    break;
                                    case 'withdaw-pending':
                                        $this->$callpage_update->load($permission,$mod, WITHDRAW_PENDING);
                                    break;
                                    default:
                                        $this->$callpage->load($permission,$mod);
                                    break;
                                }
		}
		
		
		
		
		
		public function changeactiveTosuspend() {
			$userid = $_POST['id'];
			$sql = "UPDATE webuser SET isactive = if(isactive = '0','1','0') WHERE webuser_id = '".$userid."' ";
			$this->db->query($sql);
			
			$response['success'] = true;
			$response['message'] = 'Well done! You have successfully decline offer.';
			echo json_encode( $response );
			
		
		
		}
		
		


}
