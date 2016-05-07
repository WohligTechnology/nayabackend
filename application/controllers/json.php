<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller
{function getallcontact()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`nayabackend_contact`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`nayabackend_contact`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`nayabackend_contact`.`email`";
$elements[2]->sort="1";
$elements[2]->header="email";
$elements[2]->alias="email";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`nayabackend_contact`.`phone`";
$elements[3]->sort="1";
$elements[3]->header="phone";
$elements[3]->alias="phone";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`nayabackend_contact`.`message`";
$elements[4]->sort="1";
$elements[4]->header="message";
$elements[4]->alias="message";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `nayabackend_contact`");
$this->load->view("json",$data);
}
public function getsinglecontact()
{
$id=$this->input->get_post("id");
$data["message"]=$this->contact_model->getsinglecontact($id);
$this->load->view("json",$data);
}
function getallcollection()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`nayabackend_collection`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`nayabackend_collection`.`collection`";
$elements[1]->sort="1";
$elements[1]->header="collection";
$elements[1]->alias="collection";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`nayabackend_collection`.`name`";
$elements[2]->sort="1";
$elements[2]->header="name";
$elements[2]->alias="name";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`nayabackend_collection`.`image`";
$elements[3]->sort="1";
$elements[3]->header="image";
$elements[3]->alias="image";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`nayabackend_collection`.`description`";
$elements[4]->sort="1";
$elements[4]->header="description";
$elements[4]->alias="description";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`nayabackend_collection`.`facebook`";
$elements[5]->sort="1";
$elements[5]->header="facebook";
$elements[5]->alias="facebook";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`nayabackend_collection`.`instagram`";
$elements[6]->sort="1";
$elements[6]->header="instagram";
$elements[6]->alias="instagram";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`nayabackend_collection`.`pinterest`";
$elements[7]->sort="1";
$elements[7]->header="pinterest";
$elements[7]->alias="pinterest";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `nayabackend_collection`");
$this->load->view("json",$data);
}
public function getsinglecollection()
{
$id=$this->input->get_post("id");
$data["message"]=$this->collection_model->getsinglecollection($id);
$this->load->view("json",$data);
}
function getallpress()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`nayabackend_press`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`nayabackend_press`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`nayabackend_press`.`description`";
$elements[2]->sort="1";
$elements[2]->header="description";
$elements[2]->alias="description";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`nayabackend_press`.`image`";
$elements[3]->sort="1";
$elements[3]->header="image";
$elements[3]->alias="image";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`nayabackend_press`.`video`";
$elements[4]->sort="1";
$elements[4]->header="video";
$elements[4]->alias="video";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `nayabackend_press`");
$this->load->view("json",$data);
}
public function getsinglepress()
{
$id=$this->input->get_post("id");
$data["message"]=$this->press_model->getsinglepress($id);
$this->load->view("json",$data);
}

public function contactSubmit()
{
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $phone = $data['phone'];
    $email = $data['email'];
    $message = $data['message'];
  $data['message'] = $this->contact_model->contactSubmit($name, $phone, $email, $message);
    $this->load->view('json', $data);
}

public function getcollections()
{
$id=$this->input->get_post("id");
$data["message"]=$this->collection_model->getcollections($id);
$this->load->view("json",$data);
}
public function getpress()
{
$data["message"]=$this->press_model->getpress();
$this->load->view("json",$data);
}
public function getstockist()
{
  $name=$this->input->get_post("name");
$data["message"]=$this->stockist_model->getstockist($name);
$this->load->view("json",$data);
}
public function getslider()
{
$data["message"]=$this->homeslide_model->getslider();
$this->load->view("json",$data);
}
function getallcollectioncat()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`nayabackend_collectioncat`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`nayabackend_collectioncat`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `nayabackend_collectioncat`");
$this->load->view("json",$data);
}
public function getsinglecollectioncat()
{
$id=$this->input->get_post("id");
$data["message"]=$this->collectioncat_model->getsinglecollectioncat($id);
$this->load->view("json",$data);
}
} ?>
