<?php
/**
 * Kalkun
 * An open source web based SMS Management
 *
 * @package		Kalkun
 * @author		Kalkun Dev Team
 * @license		http://kalkun.sourceforge.net/license.php
 * @link		http://kalkun.sourceforge.net
 */

// ------------------------------------------------------------------------

/**
 * status Class
 *
 * @package		Kalkun
 * @subpackage	Plugin
 * @category	Controllers
 */
include_once(APPPATH.'plugins/Plugin_Controller.php');

class SMS_status extends Plugin_Controller {

	/**
	 * Constructor
	 *
	 * @access	public
	 */		
	function SMS_status()
	{
		parent::Plugin_Controller();
		$this->load->model('sms_status_model', 'plugin_model');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Index
	 *
	 * Display list of all status
	 *
	 * @access	public   		 
	 */		
	function index()
	{
		$data['main'] = 'index';
		$data['title'] = 'SMS status';
		$data['total_status'] = $this->plugin_model->get_status('total')->row('count');
		$data['status'] = $this->plugin_model->get_status('all')->result_array();
		$data['gdinduxs'] = $this->plugin_model->get_garduindux()->result_array();
		$data['ttrouble'] = $this->plugin_model->get_status($id)->result_array();
		$this->load->view('main/layout', $data);
	}
	function add_contact()
	{
		$this->load->helper('form');
		//$data['pbkgroup'] = $this->Phonebook_model->get_phonebook(array('option' => 'group'));
		$type = $this->input->post('type');
		
		if ($type=='edit')
		{
			$id_gardu = $this->input->post('param1');
		 	$data['contact']=$this->Phonebook_model->get_phonebook(array('option' => 'by_idpbk', 'id_pbk' => $id_pbk));
		}
		
		$this->load->view('main/sms_status/add_contact');	
	}
	function add_gardu()
	{
		$this->load->helper('form');
		//$data['pbkgroup'] = $this->Phonebook_model->get_phonebook(array('option' => 'group'));
		$type = $this->input->post('type');
		
		if ($type=='edit')
		{
			$id_gardu = $this->input->post('param1');
		 	$data['contact']=$this->Phonebook_model->get_phonebook(array('option' => 'by_idpbk', 'id_pbk' => $id_pbk));
		}
		
		$this->load->view('main/sms_status/add_gardu');	
	}
	/**
	 * Add contact process
	 *
	 * Process the submitted add/update contact form
	 *
	 * @access	public   		 
	 */		
	function add_gardu_process()
	{
		$gardu['kdgardu'] = trim($this->input->post('kdgardu'));
		$gardu['kdindux'] = trim($this->input->post('kdindux'));
		//$gardu['GroupID'] = $this->input->post('groupvalue');
        $gardu['nama'] = $this->input->post('nama');
		$gardu['ket'] = $this->input->post('ket');
		
		$this->plugin_model->add_gardu($gardu);
		if($this->input->post('editid_gardu'))
		{
			$gardu['id_gardu'] = $this->input->post('editid_gardu');
			$msg = "<div class=\"notif\">Contact has been updated.</div>";
		}
		else 
		$msg = "<div class=\"notif\">Contact has been added.</div>";
			
		
		echo $msg;
	}
	/**
	 * Add contact process
	 *
	 * Process the submitted add/update contact form
	 *
	 * @access	public   		 
	 */		
	function add_garduindux_process()
	{
		$gardu['kdgardu'] = trim($this->input->post('kdgardu'));
        $gardu['nama'] = $this->input->post('nama');
		$gardu['ket'] = $this->input->post('ket');
		
		$this->plugin_model->add_garduindux($gardu);
		if($this->input->post('editid_gardu'))
		{
			$gardu['id_gardu'] = $this->input->post('editid_gardu');
			$msg = "<div class=\"notif\">Contact has been updated.</div>";
		}
		else 
		$msg = "<div class=\"notif\">Contact has been added.</div>";
			
		
		echo $msg;
	}

}

/* End of file sms_status.php */
/* Location: ./application/plugins/sms_status/controllers/sms_status.php */