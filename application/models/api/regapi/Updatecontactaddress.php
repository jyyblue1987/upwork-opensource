<?php 
class Updatecontactaddress extends CI_Model {
	  function load()
    {
    	
	$webuser_id = $this->session->userdata('id');	
	$address = $_POST['addressfirst'];
	$address1 = $_POST['addresssecond'];
	$city = $_POST['citytown'];
	$state = $_POST['stateprovince'];
	$zipcode = $_POST['zippostalcode'];
	$country = $_POST['country'];
	$phone_number = $_POST['phonecode'] . ' ' . $_POST['phonenumber'];
	$timezone = $_POST['timezone'];
	$data = array(
	   'webuser_id' => $webuser_id ,
	   'address' => $address,
	   'address1' => $address1,
	   'city' => $city,
	   'state' => $state,
	   'zipcode' => $zipcode,
	   'country' => $country,
	   'phone_number' => $phone_number,
	   'timezone' => $timezone
	);
	
	$sql = "SELECT * from webuseraddresses WHERE webuser_id = ?";
	$query = $this->db->query($sql, array($webuser_id));
	$num = $query->num_rows();
	
	if($num>0){
		$this->db->where('webuser_id', $webuser_id);
		$this->db->update('webuseraddresses',$data);
		}
	else{
		$sql = "INSERT INTO webuseraddresses (webuser_id,address, address1 , city , state , zipcode , country , phone_number, timezone) VALUES ('.$webuser_id.', '.$address.','.$address1.', '.$city.','.$state.', '.$zipcode.','.$country.', '.$phone_number.','.$timezone.')";
	$this->db->query($sql);
	}


		
		echo json_encode(array("status"=>"success"));	
	
	
    }	
	
}

?>