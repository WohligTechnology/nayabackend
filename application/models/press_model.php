<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class press_model extends CI_Model
{
public function create($name,$description,$image,$video)
{
$data=array("name" => $name,"description" => $description,"image" => $image,"video" => $video);
$query=$this->db->insert( "nayabackend_press", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("nayabackend_press")->row();
return $query;
}
function getsinglepress($id){
$this->db->where("id",$id);
$query=$this->db->get("nayabackend_press")->row();
return $query;
}
public function edit($id,$name,$description,$image,$video)
{
if($image=="")
{
$image=$this->press_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"description" => $description,"image" => $image,"video" => $video);
$this->db->where( "id", $id );
$query=$this->db->update( "nayabackend_press", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `nayabackend_press` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `nayabackend_press` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `nayabackend_press` ORDER BY `id` 
                    ASC")->row();
$return=array(
"" => "Select Option"
);
foreach($query as $row)
{
$return[$row->id]=$row->name;
}
return $return;
}
}
?>
