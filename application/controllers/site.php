<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller
{
	public function __construct( )
	{
		parent::__construct();

		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function viewhomeslide()
	{
			$access = array('1');
			$this->checkaccess($access);
			$data['page'] = 'viewhomeslide';
			$data['base_url'] = site_url('site/viewhomeslidejson');
			$data['title'] = 'View homeslide';
			$this->load->view('template', $data);
	}
	public function viewhomeslidejson()
	{
			$elements = array();
			$elements[0] = new stdClass();
			$elements[0]->field = '`fynx_homeslide`.`id`';
			$elements[0]->sort = '1';
			$elements[0]->header = 'ID';
			$elements[0]->alias = 'id';
			$elements[1] = new stdClass();
			$elements[1]->field = '`fynx_homeslide`.`name`';
			$elements[1]->sort = '1';
			$elements[1]->header = 'Name';
			$elements[1]->alias = 'name';
			$elements[2] = new stdClass();
			$elements[2]->field = '`fynx_homeslide`.`link`';
			$elements[2]->sort = '1';
			$elements[2]->header = 'Link';
			$elements[2]->alias = 'link';
			$elements[3] = new stdClass();
			$elements[3]->field = '`fynx_homeslide`.`sorder`';
			$elements[3]->sort = '1';
			$elements[3]->header = 'Order';
			$elements[3]->alias = 'sorder';
			$elements[4] = new stdClass();
			$elements[4]->field = '`fynx_homeslide`.`status`';
			$elements[4]->sort = '1';
			$elements[4]->header = 'Status';
			$elements[4]->alias = 'status';
			$elements[5] = new stdClass();
			$elements[5]->field = '`fynx_homeslide`.`image`';
			$elements[5]->sort = '1';
			$elements[5]->header = 'Image';
			$elements[5]->alias = 'image';
			$elements[6] = new stdClass();
			$elements[6]->field = '`fynx_homeslide`.`template`';
			$elements[6]->sort = '1';
			$elements[6]->header = 'Template';
			$elements[6]->alias = 'template';
			$elements[7] = new stdClass();
			$elements[7]->field = '`fynx_homeslide`.`class`';
			$elements[7]->sort = '1';
			$elements[7]->header = 'Class';
			$elements[7]->alias = 'class';
			$elements[8] = new stdClass();
			$elements[8]->field = '`fynx_homeslide`.`text`';
			$elements[8]->sort = '1';
			$elements[8]->header = 'Text';
			$elements[8]->alias = 'text';
			$elements[9] = new stdClass();
			$elements[9]->field = '`fynx_homeslide`.`centeralign`';
			$elements[9]->sort = '1';
			$elements[9]->header = 'Center Align';
			$elements[9]->alias = 'centeralign';
			$search = $this->input->get_post('search');
			$pageno = $this->input->get_post('pageno');
			$orderby = $this->input->get_post('orderby');
			$orderorder = $this->input->get_post('orderorder');
			$maxrow = $this->input->get_post('maxrow');
			if ($maxrow == '') {
					$maxrow = 20;
			}
			if ($orderby == '') {
					$orderby = 'id';
					$orderorder = 'ASC';
			}
			$data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `fynx_homeslide`');
			$this->load->view('json', $data);
	}

	public function createhomeslide()
	{
	$access=array("1");
	$this->checkaccess($access);
	$data["page"]="createhomeslide";
	  // $data['collection'] = $this->collectioncat_model->getdropdown();
	$data["title"]="Create homeslide";
	$this->load->view("template",$data);
	}
	public function createhomeslidesubmit()
	{
	$access=array("1");
	$this->checkaccess($access);
	$this->form_validation->set_rules("name","name","trim");
	$this->form_validation->set_rules("image","image","trim");
	if($this->form_validation->run()==FALSE)
	{
	$data["alerterror"]=validation_errors();
	$data["page"]="createhomeslide";
	$data["title"]="Create homeslide";
	$this->load->view("template",$data);
	}
	else
	{

	$sorder=$this->input->get_post("sorder");
	$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					$this->load->library('upload', $config);
					$filename = 'image';
					$image = '';
					if ($this->upload->do_upload($filename)) {
							$uploaddata = $this->upload->data();
							$image = $uploaddata['file_name'];
					}
	if($this->homeslide_model->create($sorder,$image)==0)
	$data["alerterror"]="New collection could not be created.";
	else
	$data["alertsuccess"]="homeslide created Successfully.";
	$data["redirect"]="site/viewhomeslide";
	$this->load->view("redirect",$data);
	}
	}
	public function edithomeslide()
	{
			$access = array('1');
			$this->checkaccess($access);
			$data['page'] = 'edithomeslide';
			// $data['status'] = $this->user_model->getstatusdropdown();
			$data['title'] = 'Edit homeslide';
			$data['before'] = $this->homeslide_model->beforeedit($this->input->get('id'));
			$this->load->view('template', $data);
	}
	public function edithomeslidesubmit()
	{
			$access = array('1');
			$this->checkaccess($access);
			$this->form_validation->set_rules('id', 'ID', 'trim');
			$this->form_validation->set_rules('image', 'Image', 'trim');
			if ($this->form_validation->run() == false) {
					$data['alerterror'] = validation_errors();
					$data['page'] = 'edithomeslide';
					// $data['status'] = $this->user_model->getstatusdropdown();
					$data['title'] = 'Edit homeslide';
					$data['before'] = $this->homeslide_model->beforeedit($this->input->get('id'));
					$this->load->view('template', $data);
			} else {
					$id = $this->input->get_post('id');
					$sorder = $this->input->get_post('sorder');
					$image = $this->input->get_post('image');
					$config['upload_path'] = './uploads/';
					            $config['allowed_types'] = 'gif|jpg|png';
					            $this->load->library('upload', $config);
					            $filename = 'image';
					            $image = '';
					            if ($this->upload->do_upload($filename)) {
					                $uploaddata = $this->upload->data();
					                $image = $uploaddata['file_name'];
					            }
					            if ($image == '') {
					                $image = $this->homeslide_model->getimagebyid($id);
					                    // print_r($image);
					                     $image = $image->image;
					            }
		if ($this->homeslide_model->edit($id, $sorder, $image) == 0) {
	$data['alerterror'] = 'New homeslide could not be Updated.';
} else {
	$data['alertsuccess'] = 'homeslide Updated Successfully.';
}
					$data['redirect'] = 'site/viewhomeslide';
					$this->load->view('redirect', $data);
			}
	}
	public function deletehomeslide()
	{
			$access = array('1');
			$this->checkaccess($access);
			$this->homeslide_model->delete($this->input->get('id'));
			$data['redirect'] = 'site/viewhomeslide';
			$this->load->view('redirect', $data);
	}

    public function getOrderingDone()
    {
        $orderby=$this->input->get("orderby");
        $ids=$this->input->get("ids");
        $ids=explode(",",$ids);
        $tablename=$this->input->get("tablename");
        $where=$this->input->get("where");
        if($where == "" || $where=="undefined")
        {
            $where=1;
        }
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $i=1;
        foreach($ids as $id)
        {
            //echo "UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = `$id` AND $where";
            $this->db->query("UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = '$id' AND $where");
            $i++;
            //echo "/n";
        }
        $data["message"]=true;
        $this->load->view("json",$data);

    }
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data['gender']=$this->user_model->getgenderdropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)
		{
			$data['alerterror'] = validation_errors();
            $data['gender']=$this->user_model->getgenderdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $phone=$this->input->post('phone');
            $billingaddress=$this->input->post('billingaddress');
            $billingcity=$this->input->post('billingcity');
            $billingstate=$this->input->post('billingstate');
            $billingcountry=$this->input->post('billingcountry');
            $billingpincode=$this->input->post('billingpincode');
            $billingcontact=$this->input->post('billingcontact');

            $shippingaddress=$this->input->post('shippingaddress');
            $shippingcity=$this->input->post('shippingcity');
            $shippingstate=$this->input->post('shippingstate');
            $shippingcountry=$this->input->post('shippingcountry');
            $shippingpincode=$this->input->post('shippingpincode');
            $shippingcontact=$this->input->post('shippingcontact');
            $shippingname=$this->input->post('shippingname');
            $currency=$this->input->post('currency');
            $credit=$this->input->post('credit');
            $companyname=$this->input->post('companyname');
            $registrationno=$this->input->post('registrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');

            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];

                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }

			}

			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$firstname,$lastname,$phone,$billingaddress,$billingcity,$billingstate,$billingcountry,$billingpincode,$billingcontact,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$shippingcontact,$shippingname,$currency,$credit,$companyname,$registrationno,$vatnumber,$country,$fax,$gender)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");

		$data['title']='View Users';
		$this->load->view('template',$data);
	}
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);


        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";


        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";

        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";

        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";

        $elements[4]=new stdClass();
        $elements[4]->field="`user`.`logintype`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";

        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";

        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";

        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";


        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }

        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }

        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");

		$this->load->view("json",$data);
	}


	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
        $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data['gender']=$this->user_model->getgenderdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('templatewith2',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);

		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data['gender']=$this->user_model->getgenderdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{

            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
//            $category=$this->input->get_post('category');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $phone=$this->input->post('phone');
            $billingaddress=$this->input->post('billingaddress');
            $billingcity=$this->input->post('billingcity');
            $billingstate=$this->input->post('billingstate');
            $billingcountry=$this->input->post('billingcountry');
            $billingpincode=$this->input->post('billingpincode');
            $billingcontact=$this->input->post('billingcontact');

            $shippingaddress=$this->input->post('shippingaddress');
            $shippingcity=$this->input->post('shippingcity');
            $shippingstate=$this->input->post('shippingstate');
            $shippingcountry=$this->input->post('shippingcountry');
            $shippingpincode=$this->input->post('shippingpincode');
            $shippingcontact=$this->input->post('shippingcontact');
            $shippingname=$this->input->post('shippingname');
            $currency=$this->input->post('currency');
            $credit=$this->input->post('credit');
            $companyname=$this->input->post('companyname');
            $registrationno=$this->input->post('registrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];

                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }

			}

            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }

			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$firstname,$lastname,$phone,$billingaddress,$billingcity,$billingstate,$billingcountry,$billingpincode,$billingcontact,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$shippingcontact,$shippingname,$currency,$credit,$companyname,$registrationno,$vatnumber,$country,$fax,$gender)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";

			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);

		}
	}

	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    public function viewcart()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcart";
    $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
$data['page2']='block/userblock';
$data["base_url"]=site_url("site/viewcartjson?id=").$this->input->get('id');
$data["title"]="View cart";
$this->load->view("templatewith2",$data);
}
function viewcartjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`fynx_cart`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`fynx_cart`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`fynx_cart`.`quantity`";
$elements[2]->sort="1";
$elements[2]->header="Quantity";
$elements[2]->alias="quantity";
$elements[3]=new stdClass();
$elements[3]->field="`fynx_cart`.`product`";
$elements[3]->sort="1";
$elements[3]->header="Product";
$elements[3]->alias="product";
$elements[4]=new stdClass();
$elements[4]->field="`fynx_cart`.`timestamp`";
$elements[4]->sort="1";
$elements[4]->header="Timestamp";
$elements[4]->alias="timestamp";

$elements[5]=new stdClass();
$elements[5]->field="`fynx_cart`.`size`";
$elements[5]->sort="1";
$elements[5]->header="Size";
$elements[5]->alias="size";

$elements[6]=new stdClass();
$elements[6]->field="`fynx_cart`.`color`";
$elements[6]->sort="1";
$elements[6]->header="Color";
$elements[6]->alias="color";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `fynx_cart`","WHERE `fynx_cart`.`user`='$id'");
$this->load->view("json",$data);
}
    public function viewwishlist()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewwishlist";
    $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
$data['page2']='block/userblock';
$data["base_url"]=site_url("site/viewwishlistjson?id=".$this->input->get('id'));
$data["title"]="View wishlist";
$this->load->view("templatewith2",$data);
}
function viewwishlistjson()
{
    $user=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`fynx_wishlist`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`fynx_wishlist`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`fynx_wishlist`.`product`";
$elements[2]->sort="1";
$elements[2]->header="Product";
$elements[2]->alias="product";
$elements[3]=new stdClass();
$elements[3]->field="`fynx_wishlist`.`timestamp`";
$elements[3]->sort="1";
$elements[3]->header="Timestamp";
$elements[3]->alias="timestamp";

$elements[4]=new stdClass();
$elements[4]->field="`fynx_product`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Product Name";
$elements[4]->alias="productname";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `fynx_wishlist` LEFT OUTER JOIN `fynx_product` ON `fynx_product`.`id`=`fynx_wishlist`.`product`","WHERE `fynx_wishlist`.`user`='$user'");
$this->load->view("json",$data);
}



    public function viewcontact()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcontact";
$data["base_url"]=site_url("site/viewcontactjson");
$data["title"]="View contact";
$this->load->view("template",$data);
}
function viewcontactjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`nayabackend_contact`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`nayabackend_contact`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`nayabackend_contact`.`email`";
$elements[2]->sort="1";
$elements[2]->header="email";
$elements[2]->alias="email";
$elements[3]=new stdClass();
$elements[3]->field="`nayabackend_contact`.`phone`";
$elements[3]->sort="1";
$elements[3]->header="phone";
$elements[3]->alias="phone";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `nayabackend_contact`");
$this->load->view("json",$data);
}

public function createcontact()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcontact";
$data["title"]="Create contact";
$this->load->view("template",$data);
}
public function createcontactsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("email","email","trim");
$this->form_validation->set_rules("phone","phone","trim");
$this->form_validation->set_rules("message","message","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcontact";
$data["title"]="Create contact";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$phone=$this->input->get_post("phone");
$message=$this->input->get_post("message");
if($this->contact_model->create($name,$email,$phone,$message)==0)
$data["alerterror"]="New contact could not be created.";
else
$data["alertsuccess"]="contact created Successfully.";
$data["redirect"]="site/viewcontact";
$this->load->view("redirect",$data);
}
}
public function editcontact()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcontact";
$data["title"]="Edit contact";
$data["before"]=$this->contact_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcontactsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("email","email","trim");
$this->form_validation->set_rules("phone","phone","trim");
$this->form_validation->set_rules("message","message","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcontact";
$data["title"]="Edit contact";
$data["before"]=$this->contact_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$phone=$this->input->get_post("phone");
$message=$this->input->get_post("message");
if($this->contact_model->edit($id,$name,$email,$phone,$message)==0)
$data["alerterror"]="New contact could not be Updated.";
else
$data["alertsuccess"]="contact Updated Successfully.";
$data["redirect"]="site/viewcontact";
$this->load->view("redirect",$data);
}
}
public function deletecontact()
{
$access=array("1");
$this->checkaccess($access);
$this->contact_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcontact";
$this->load->view("redirect",$data);
}
public function viewcollection()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcollection";
$data["base_url"]=site_url("site/viewcollectionjson");
$data["title"]="View collection";
$this->load->view("template",$data);
}
function viewcollectionjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`nayabackend_collection`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`nayabackend_collection`.`collection`";
$elements[1]->sort="1";
$elements[1]->header="collection";
$elements[1]->alias="collection";
$elements[2]=new stdClass();
$elements[2]->field="`nayabackend_collection`.`name`";
$elements[2]->sort="1";
$elements[2]->header="name";
$elements[2]->alias="name";
$elements[3]=new stdClass();
$elements[3]->field="`nayabackend_collection`.`image`";
$elements[3]->sort="1";
$elements[3]->header="image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`nayabackend_collection`.`description`";
$elements[4]->sort="1";
$elements[4]->header="description";
$elements[4]->alias="description";
$elements[5]=new stdClass();
$elements[5]->field="`nayabackend_collection`.`facebook`";
$elements[5]->sort="1";
$elements[5]->header="facebook";
$elements[5]->alias="facebook";
$elements[6]=new stdClass();
$elements[6]->field="`nayabackend_collection`.`instagram`";
$elements[6]->sort="1";
$elements[6]->header="instagram";
$elements[6]->alias="instagram";
$elements[7]=new stdClass();
$elements[7]->field="`nayabackend_collection`.`pinterest`";
$elements[7]->sort="1";
$elements[7]->header="pinterest";
$elements[7]->alias="pinterest";
$elements[8]=new stdClass();
$elements[8]->field="`nayabackend_collectioncat`.`name`";
$elements[8]->sort="1";
$elements[8]->header="collectioncat";
$elements[8]->alias="collectioncat";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `nayabackend_collection` LEFT OUTER JOIN `nayabackend_collectioncat` ON `nayabackend_collection`.`collection` = `nayabackend_collectioncat`.`id`");
$this->load->view("json",$data);
}

public function createcollection()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcollection";
  $data['collection'] = $this->collectioncat_model->getdropdown();
$data["title"]="Create collection";
$this->load->view("template",$data);
}
public function createcollectionsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("collection","collection","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("description","description","trim");
$this->form_validation->set_rules("facebook","facebook","trim");
$this->form_validation->set_rules("instagram","instagram","trim");
$this->form_validation->set_rules("pinterest","pinterest","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcollection";
$data["title"]="Create collection";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$collection=$this->input->get_post("collection");
$name=$this->input->get_post("name");
// $image=$this->input->get_post("image");
$description=$this->input->get_post("description");
$facebook=$this->input->get_post("facebook");
$instagram=$this->input->get_post("instagram");
$pinterest=$this->input->get_post("pinterest");
$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->load->library('upload', $config);
				$filename = 'image';
				$image = '';
				if ($this->upload->do_upload($filename)) {
						$uploaddata = $this->upload->data();
						$image = $uploaddata['file_name'];
				}
if($this->collection_model->create($collection,$name,$image,$description,$facebook,$instagram,$pinterest)==0)
$data["alerterror"]="New collection could not be created.";
else
$data["alertsuccess"]="collection created Successfully.";
$data["redirect"]="site/viewcollection";
$this->load->view("redirect",$data);
}
}
public function editcollection()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcollection";
$data["title"]="Edit collection";
  $data['collection'] = $this->collectioncat_model->getdropdown();
$data["before"]=$this->collection_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcollectionsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("collection","collection","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("description","description","trim");
$this->form_validation->set_rules("facebook","facebook","trim");
$this->form_validation->set_rules("instagram","instagram","trim");
$this->form_validation->set_rules("pinterest","pinterest","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcollection";
$data["title"]="Edit collection";
$data["before"]=$this->collection_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$collection=$this->input->get_post("collection");
$name=$this->input->get_post("name");
// $image=$this->input->get_post("image");
$description=$this->input->get_post("description");
$facebook=$this->input->get_post("facebook");
$instagram=$this->input->get_post("instagram");
$pinterest=$this->input->get_post("pinterest");
$config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            }
            if ($image == '') {
                $image = $this->collection_model->getimagebyid($id);
                    // print_r($image);
                     $image = $image->image;
            }
if($this->collection_model->edit($id,$collection,$name,$image,$description,$facebook,$instagram,$pinterest)==0)
$data["alerterror"]="New collection could not be Updated.";
else
$data["alertsuccess"]="collection Updated Successfully.";
$data["redirect"]="site/viewcollection";
$this->load->view("redirect",$data);
}
}
public function deletecollection()
{
$access=array("1");
$this->checkaccess($access);
$this->collection_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcollection";
$this->load->view("redirect",$data);
}
public function viewpress()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewpress";
$data["base_url"]=site_url("site/viewpressjson");
$data["title"]="View press";
$this->load->view("template",$data);
}
function viewpressjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`nayabackend_press`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`nayabackend_press`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`nayabackend_press`.`description`";
$elements[2]->sort="1";
$elements[2]->header="description";
$elements[2]->alias="description";
$elements[3]=new stdClass();
$elements[3]->field="`nayabackend_press`.`image`";
$elements[3]->sort="1";
$elements[3]->header="image";
$elements[3]->alias="image";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `nayabackend_press`");
$this->load->view("json",$data);
}

public function createpress()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createpress";
$data["title"]="Create press";
$this->load->view("template",$data);
}
public function createpresssubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("description","description","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("video","video","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createpress";
$data["title"]="Create press";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$description=$this->input->get_post("description");
// $image=$this->input->get_post("image");
$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->load->library('upload', $config);
				$filename = 'image';
				$image = '';
				if ($this->upload->do_upload($filename)) {
						$uploaddata = $this->upload->data();
						$image = $uploaddata['file_name'];
				}
$video=$this->input->get_post("video");
if($this->press_model->create($name,$description,$image,$video)==0)
$data["alerterror"]="New press could not be created.";
else
$data["alertsuccess"]="press created Successfully.";
$data["redirect"]="site/viewpress";
$this->load->view("redirect",$data);
}
}
public function editpress()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editpress";
$data["title"]="Edit press";
$data["before"]=$this->press_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editpresssubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("description","description","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("video","video","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editpress";
$data["title"]="Edit press";
$data["before"]=$this->press_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$description=$this->input->get_post("description");
// $image=$this->input->get_post("image");
$config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            }
            if ($image == '') {
                $image = $this->press_model->getimagebyid($id);
                    // print_r($image);
                     $image = $image->image;
            }
$video=$this->input->get_post("video");
if($this->press_model->edit($id,$name,$description,$image,$video)==0)
$data["alerterror"]="New press could not be Updated.";
else
$data["alertsuccess"]="press Updated Successfully.";
$data["redirect"]="site/viewpress";
$this->load->view("redirect",$data);
}
}
public function deletepress()
{
$access=array("1");
$this->checkaccess($access);
$this->press_model->delete($this->input->get("id"));
$data["redirect"]="site/viewpress";
$this->load->view("redirect",$data);
}
public function viewcollectioncat()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcollectioncat";
$data["base_url"]=site_url("site/viewcollectioncatjson");
$data["title"]="View collectioncat";
$this->load->view("template",$data);
}
function viewcollectioncatjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`nayabackend_collectioncat`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `nayabackend_collectioncat`");
$this->load->view("json",$data);
}

public function createcollectioncat()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcollectioncat";
$data["title"]="Create collectioncat";
$this->load->view("template",$data);
}
public function createcollectioncatsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcollectioncat";
$data["title"]="Create collectioncat";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$description=$this->input->get_post("description");
$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->load->library('upload', $config);
				$filename = 'image';
				$image = '';
				if ($this->upload->do_upload($filename)) {
						$uploaddata = $this->upload->data();
						$image = $uploaddata['file_name'];
				}
if($this->collectioncat_model->create($name,$description,$image)==0)
$data["alerterror"]="New collectioncat could not be created.";
else
$data["alertsuccess"]="collectioncat created Successfully.";
$data["redirect"]="site/viewcollectioncat";
$this->load->view("redirect",$data);
}
}
public function editcollectioncat()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcollectioncat";
$data["title"]="Edit collectioncat";
$data["before"]=$this->collectioncat_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcollectioncatsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcollectioncat";
$data["title"]="Edit collectioncat";
$data["before"]=$this->collectioncat_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$description=$this->input->get_post("description");
$config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            }
            if ($image == '') {
                $image = $this->collectioncat_model->getimagebyid($id);
                    // print_r($image);
                     $image = $image->image;
            }
if($this->collectioncat_model->edit($id,$name,$description,$image)==0)
$data["alerterror"]="New collectioncat could not be Updated.";
else
$data["alertsuccess"]="collectioncat Updated Successfully.";
$data["redirect"]="site/viewcollectioncat";
$this->load->view("redirect",$data);
}
}
public function deletecollectioncat()
{
$access=array("1");
$this->checkaccess($access);
$this->collectioncat_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcollectioncat";
$this->load->view("redirect",$data);
}

public function viewstockist()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewstockist";
$data["base_url"]=site_url("site/viewstockistjson");
$data["title"]="View Stockist";
$this->load->view("template",$data);
}
function viewstockistjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`stockist`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`stockist`.`city`";
$elements[1]->sort="1";
$elements[1]->header="city";
$elements[1]->alias="city";
$elements[2]=new stdClass();
$elements[2]->field="`stockist`.`title`";
$elements[2]->sort="1";
$elements[2]->header="title";
$elements[2]->alias="title";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `stockist`");
$this->load->view("json",$data);
}

public function createstockist()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createstockist";
  $data['city'] = $this->stockist_model->getdropdown();
$data["title"]="Create stockist";
$this->load->view("template",$data);
}
public function createstockistsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("title","title","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createstockist";
$data["title"]="Create Stockist";
$this->load->view("template",$data);
}
else
{
$city=$this->input->get_post("city");
$citytxt=$this->input->get_post("citytxt");
if(!empty($citytxt))
{
	$cityname = $citytxt;
}
else {
	$cityname = $city;
}
$title=$this->input->get_post("title");
// $image=$this->input->get_post("image");
$address=$this->input->get_post("address");
$phone=$this->input->get_post("phone");
$fax=$this->input->get_post("fax");
if($this->stockist_model->create($cityname,$title,$address,$phone,$fax)==0)
$data["alerterror"]="New stockist could not be created.";
else
$data["alertsuccess"]="stockist created Successfully.";
$data["redirect"]="site/viewstockist";
$this->load->view("redirect",$data);
}
}
public function editstockist()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editstockist";
$data["title"]="Edit stockist";
  $data['city'] = $this->stockist_model->getdropdown();
$data["before"]=$this->stockist_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editstockistsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editstockist";
$data["title"]="Edit stockist";
$data["before"]=$this->stockist_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$city=$this->input->get_post("city");
$title=$this->input->get_post("title");
// $image=$this->input->get_post("image");
$address=$this->input->get_post("address");
$phone=$this->input->get_post("phone");
$fax=$this->input->get_post("fax");
if($this->stockist_model->edit($id,$city,$title,$address,$phone,$fax)==0)
$data["alerterror"]="New stockist could not be Updated.";
else
$data["alertsuccess"]="stockist Updated Successfully.";
$data["redirect"]="site/viewstockist";
$this->load->view("redirect",$data);
}
}
public function deletestockist()
{
$access=array("1");
$this->checkaccess($access);
$this->stockist_model->delete($this->input->get("id"));
$data["redirect"]="site/viewstockist";
$this->load->view("redirect",$data);
}

}
?>
