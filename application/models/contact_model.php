<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class contact_model extends CI_Model
{
public function create($name,$email,$phone,$message)
{
$data=array("name" => $name,"email" => $email,"phone" => $phone,"message" => $message);
$query=$this->db->insert( "nayabackend_contact", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("nayabackend_contact")->row();
return $query;
}
function getsinglecontact($id){
$this->db->where("id",$id);
$query=$this->db->get("nayabackend_contact")->row();
return $query;
}
public function edit($id,$name,$email,$phone,$message)
{
if($image=="")
{
$image=$this->contact_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"email" => $email,"phone" => $phone,"message" => $message);
$this->db->where( "id", $id );
$query=$this->db->update( "nayabackend_contact", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `nayabackend_contact` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `nayabackend_contact` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `nayabackend_contact` ORDER BY `id` 
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
