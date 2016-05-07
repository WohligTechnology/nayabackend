<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class collectioncat_model extends CI_Model
{
public function create($name,$description,$image)
{
$data=array("name" => $name,"description" => $description,"image" => $image);
$query=$this->db->insert( "nayabackend_collectioncat", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("nayabackend_collectioncat")->row();
return $query;
}
function getsinglecollectioncat($id){
$this->db->where("id",$id);
$query=$this->db->get("nayabackend_collectioncat")->row();
return $query;
}
public function edit($id,$name,$description,$image)
{
if($image=="")
{
$image=$this->collectioncat_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"description" => $description,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "nayabackend_collectioncat", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `nayabackend_collectioncat` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `nayabackend_collectioncat` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `nayabackend_collectioncat` ORDER BY `id`
                    ASC")->result();
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
