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
 * Member_model Class
 *
 * Handle all member database activity 
 *
 * @package		Kalkun
 * @subpackage	Member
 * @category	Models
 */
class SMS_member_model extends Model {

	/**
	 * Constructor
	 *
	 * @access	public
	 */		
	function SMS_member_model()
	{
		parent::Model();
	}

	// --------------------------------------------------------------------
	
	/**
	 * Get Member
	 *
	 * @access	public   		 
	 * @param	mixed
	 * @return	object
	 */		
	function get_member($option)
	{
		switch($option)
		{
			case 'all':
				$this->db->select('*');
			break;
			
			case 'total':
				$this->db->select('count(*) as count');
		}
		
		$this->db->from('plugin_sms_status');	
		return $this->db->get();
	}

	/**
	 * Add Member
	 *
	 * @access	public   		 
	 * @param	string $number
	 * @return	void
	 */		
	function add_member($number)
	{
		$data = array('status' => $code, 'tgltrouble' => $tgl, 'kdgardu' => $idd, 'tegangan' => $arus, 'trouble' => $sn, 'tegangan' => $arus);
		$this->db->insert('plugin_sms_status', $data);
	}

	/**
	 * Remove Member
	 *
	 * @access	public   		 
	 * @param	string $number
	 * @return	void
	 */	
	function remove_member($number)
	{
		$this->db->where('phone_number', $number);		
		$this->db->delete('plugin_sms_member');			
	}

	/**
	 * Check/ Count Member
	 *
	 * @access	public   		 
	 * @param	string $number
	 * @return	integer
	 */	
	function check_member($number)
	{
		$this->db->from('plugin_sms_member');
		$this->db->where('phone_number', $number);
		return $this->db->count_all_results();    		
	}
}

/* End of file sms_member_model.php */
/* Location: ./application/plugins/sms_member/models/sms_member_model.php */