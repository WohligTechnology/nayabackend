<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class collection_model extends CI_Model
{

public function getcollections($id)
{
  if(!empty($id))
  {
$query= $this->db->query("SELECT `id`, `collection`, `name`, `image`, `description`, `facebook`, `instagram`, `pinterest` FROM `nayabackend_collection` WHERE `collection`=$id")->result();
  }
  else {
  $query= $this->db->query("SELECT `id`, `name`, `image` FROM `nayabackend_collectioncat` WHERE 1")->result();
  }

  return $query;
}
public function create($collection,$name,$image,$description,$facebook,$instagram,$pinterest)
{
$data=array("collection" => $collection,"name" => $name,"image" => $image,"description" => $description,"facebook" => $facebook,"instagram" => $instagram,"pinterest" => $pinterest);
$query=$this->db->insert( "nayabackend_collection", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("nayabackend_collection")->row();
return $query;
}
function getsinglecollection($id){
$this->db->where("id",$id);
$query=$this->db->get("nayabackend_collection")->row();
return $query;
}
public function edit($id,$collection,$name,$image,$description,$facebook,$instagram,$pinterest)
{
if($image=="")
{
$image=$this->collection_model->getimagebyid($id);
$image=$image->image;
}
$data=array("collection" => $collection,"name" => $name,"image" => $image,"description" => $description,"facebook" => $facebook,"instagram" => $instagram,"pinterest" => $pinterest);
$this->db->where( "id", $id );
$query=$this->db->update( "nayabackend_collection", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `nayabackend_collection` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `nayabackend_collection` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `nayabackend_collection` ORDER BY `id`
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
