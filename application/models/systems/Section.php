<?php
class Section extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function add()
    {


		$name=$_POST['name'];
		$index=$_POST['index'];

    if($name==""){
				return "22";
		}else{


$data = array(
   'name' => $name,
   'ind' => $index
);

$this->db->insert('usersection', $data);
$id=$this->db->insert_id();


		return "11";

}


    }



	  function edit()
    {


		$id=$_GET['id'];
		$name=$_POST['name'];
		$index=$_POST['index'];

if($name==""){
				return "22";
		}else{


$data = array(
   'name' => $name,
   'ind' => $index
);

$this->db->where('id', $id);
$this->db->update('usersection', $data);


		return "11";



}


    }


}

?>
