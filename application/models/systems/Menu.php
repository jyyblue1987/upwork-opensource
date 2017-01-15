<?php
class Menu extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function add()
    {


    $section=$_GET['section'];
    $page=$_POST['page'];
		$name=$_POST['name'];
		$index=$_POST['index'];
		$icon=$_POST['icon'];

		if($page==""){
				return "22";
		}elseif($name==""){
				return "22";
		}else{




 $this->db->select('id');
 $this->db->from('userpage');
 $this->db->where('page', $page);

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
{
	return "22";
}else{

$data = array(
   'section' => $section,
   'page' => $page,
   'name' => $name,
   'ind' => $index,
   'icon' => $icon
);

$this->db->insert('userpage', $data);
$id=$this->db->insert_id();


		return "11";
}
}


    }



	  function edit()
    {


		$id=$_GET['id'];
		$page=$_POST['page'];
		$name=$_POST['name'];
		$index=$_POST['index'];
		$icon=$_POST['icon'];

		if($page==""){
				return "22";
		}elseif($name==""){
				return "22";
		}else{


 $this->db->select('id');
 $this->db->from('userpage');
 $this->db->where('page', $page);

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
{

 $this->db->select('id');
 $this->db->from('userpage');
 $this->db->where('page', $page);
 $this->db->where('id', $id);

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
{


$data = array(
   'name' => $name ,
   'page' => $page ,
   'ind' => $index ,
   'icon' => $icon
);

$this->db->where('id', $id);
$this->db->update('userpage', $data);


		return "11";

}else{
  		return "22";
}

}else{


$data = array(
   'name' => $name ,
   'page' => $page ,
   'ind' => $index,
   'icon' => $icon
);

$this->db->where('id', $id);
$this->db->update('userpage', $data);


		return "11";
}
}


    }


}

?>
