<?php
class Submenu extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function add()
    {
		$page=$_GET['id'];
		$subpage=$_POST['subpage'];
		$name=$_POST['name'];
		$index=$_POST['index'];
		$icon=$_POST['icon'];



	if($_POST['menu']=="on"){
	  $menu=1;
}else{
	  $menu=2;
}
		if($page==""){
				return "22";
		}elseif($name==""){
				return "22";
		}else{




 $this->db->select('id');
 $this->db->from('usersubpage');
 $this->db->where('page', $page);
 $this->db->where('subpage', $subpage);

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
{
	return "22";
}else{


$data = array(
   'page' => $page ,
   'subpage' => $subpage ,
   'name' => $name ,
   'menu' => $menu ,
   'ind' => $index ,
   'icon' => $icon
);

$this->db->insert('usersubpage', $data);
$id=$this->db->insert_id();

		return "11";
}
}


    }
	  function addby($page,$subpage,$name,$index,$icon,$menu)
    {

		if($page==""){
				return "22";
		}elseif($name==""){
				return "22";
		}else{




 $this->db->select('id');
 $this->db->from('usersubpage');
 $this->db->where('page', $page);
 $this->db->where('subpage', $subpage);

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
{
	return "22";
}else{


$data = array(
   'page' => $page ,
   'subpage' => $subpage ,
   'name' => $name ,
   'menu' => $menu ,
   'ind' => $index ,
   'icon' => $icon
);

$this->db->insert('usersubpage', $data);
$id=$this->db->insert_id();

		return "11";
}
}


    }

	  function addbulk()
    {
$id=$_GET['id'];
$name=$_POST['name'];

if($name==""){
				return "22";
}else{
self::addby($id,"lists",$name." List",1,"fa-list",1);
self::addby($id,"add","Add ".$name,2,"fa-plus",1);
self::addby($id,"edit","Edit ".$name,3,"fa-edit",2);
self::addby($id,"inactive","Inactive ".$name,4,"fa-trash",1);


		return "11";
}
}





	  function edit()
    {


		$id=$_GET['id'];
		$subpage=$_POST['subpage'];
		$name=$_POST['name'];
		$index=$_POST['index'];
		$icon=$_POST['icon'];


if($_POST['menu']=="on"){
	  $menu=1;
}else{
	  $menu=2;
}

		if($subpage==""){
				return "22";
		}elseif($name==""){
				return "22";
		}else{


 $this->db->select('id');
 $this->db->from('usersubpage');
 $this->db->where('subpage', $subpage);

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
{

 $this->db->select('id');
 $this->db->from('usersubpage');
 $this->db->where('subpage', $subpage);
 $this->db->where('id', $id);

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
{

$data = array(
   'name' => $name ,
   'subpage' => $subpage ,
   'ind' => $index,
   'menu' => $menu,
   'icon' => $icon
);

$this->db->where('id', $id);
$this->db->update('usersubpage', $data);



		return "11";

}else{



	$pageid=$this->forms->getdata("page","usersubpage",$id);


 $this->db->select('id');
 $this->db->from('usersubpage');
 $this->db->where('subpage', $subpage);
 $this->db->where('page', $pageid);

   $query = $this -> db -> get();


   if($query -> num_rows() > 0)
{


		return "22";

}else{

$data = array(
   'name' => $name ,
   'subpage' => $subpage ,
   'ind' => $index,
   'menu' => $menu,
   'icon' => $icon
);

$this->db->where('id', $id);
$this->db->update('usersubpage', $data);


  		return "11";
}
}

}else{


$data = array(
   'name' => $name ,
   'subpage' => $subpage ,
   'ind' => $index,
   'menu' => $menu,
   'icon' => $icon
);

$this->db->where('id', $id);
$this->db->update('usersubpage', $data);


		return "11";
}
}


    }


}

?>
