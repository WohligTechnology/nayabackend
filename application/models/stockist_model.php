<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class stockist_model extends CI_Model
{

public function getstockist($name)
{
  if(!empty($name))
  {
$query= $this->db->query("SELECT `id`, `city`, `title`, `address`, `phone`, `fax` FROM `stockist` WHERE  `city`='$name'")->result();
  }
  else {
  $query= $this->db->query("SELECT DISTINCT `city` FROM `stockist` WHERE 1")->result();
  }

  return $query;
}
public function create($cityname,$title,$address,$phone,$fax)
{
$data=array("city" => $cityname,"title" => $title,"address" => $address,"phone" => $phone,"fax" => $fax);
$query=$this->db->insert( "stockist", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("stockist")->row();
return $query;
}

public function edit($id,$city,$title,$address,$phone,$fax)
{
$data=array("city" => $city,"title" => $title,"address" => $address,"phone" => $phone,"fax" => $fax);
$this->db->where( "id", $id );
$query=$this->db->update( "stockist", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `stockist` WHERE `id`='$id'");
return $query;
}

public function getdropdown()
{
$query=$this->db->query("SELECT DISTINCT `city` FROM `stockist` ORDER BY `id`
                    ASC")->result();
$return=array(
"" => "Select Option"
);
foreach($query as $row)
{
$return[$row->city]=$row->city;
}
return $return;
}
}
?>
