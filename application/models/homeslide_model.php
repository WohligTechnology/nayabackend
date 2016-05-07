<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class homeslide_model extends CI_Model
{

  public function getslider()
  {
    $query = $this->db->query("select `image` as 'img', `sorder` as 'order' from `fynx_homeslide` ORDER BY `sorder`")->result();
    return $query;
  }

  public function subscribe($email)
  {
  $data=array("email" => $email);
  $query=$this->db->insert( "subscribe", $data );
  $id=$this->db->insert_id();
  if(!$query)
  return  0;
  else
  return  $id;
  }



public function create($sorder,$image)
{
$data=array("sorder" => $sorder,"image" => $image);
$query=$this->db->insert( "fynx_homeslide", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("fynx_homeslide")->row();
return $query;
}
function getsinglehomeslide($id){
$this->db->where("id",$id);
$query=$this->db->get("fynx_homeslide")->row();
return $query;
}
public function edit($id,$sorder,$image)
{
                    if($image=="")
						{
						$image=$this->homeslide_model->getimagebyid($id);
						   // print_r($image);
							$image=$image->image;
						}
$data=array("sorder" => $sorder,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "fynx_homeslide", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `fynx_homeslide` WHERE `id`='$id'");
return $query;
}
    public function getImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `fynx_homeslide` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
}
?>
