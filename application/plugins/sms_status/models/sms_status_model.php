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
 * status_model Class
 *
 * Handle all status database activity 
 *
 * @package		Kalkun
 * @subpackage	status
 * @category	Models
 */
class SMS_status_model extends Model {

	/**
	 * Constructor
	 *
	 * @access	public
	 */		
	function SMS_status_model()
	{
		parent::Model();
	}

	// --------------------------------------------------------------------
	
	/**
	 * Get status
	 *
	 * @access	public   		 
	 * @param	mixed
	 * @return	object
	 */		
	function get_status($option)
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
	function get_ttrouble($id)
	{
		$this->db->select('*');	
		$this->db->from('plugin_sms_status');	
		$this->db->where('kdgardu',$id);
		$this->db->where('status','TRIP');
		$this->db->where('action',Null);
		$this->db->limit(1);
		$this->db->order_by('tgltrouble','desc');
		return $this->db->get();
	}
function get_garduindux()
	{
		$this->db->select('*');
		$this->db->from('tgarduindux');	
		//$this->db->where('kdgardu',$id);
		return $this->db->get();
	}

function get_garduidx()
	{
		$this->db->select('*');
		$this->db->from('tgarduindux');	
		$this->db->select_as('Nama','GroupName');
		$this->db->order_by('Nama');
		//$this->db->where('kdgardu',$id);
		return $this->db->get();
	}

function get_garduanak($id)
	{
		$this->db->select('*');
		$this->db->from('tgarduanak');	
		$this->db->where('kdindux',$id);
		return $this->db->get();
	}

	/**
	 * Add status
	 *
	 * @access	public   		 
	 * @param	string $number
	 * @return	void
	 */		
	function add_status($code,$sn,$idd,$st,$tgl,$yu,$arus)
	{
		$data = array('status' => $code, 'tgltrouble' => $tgl, 'kdgardu' => $idd, 'tegangan' => $arus, 'trouble' => $sn, 'tegangan' => $arus);
		$this->db->insert('plugin_sms_status', $data);
	}

	/**
	 * Remove status
	 *
	 * @access	public   		 
	 * @param	string $number
	 * @return	void
	 */	
	function remove_status($number)
	{
		$this->db->where('phone_number', $number);		
		$this->db->delete('plugin_sms_status');			
	}

	/**
	 * Check/ Count status
	 *
	 * @access	public   		 
	 * @param	string $number
	 * @return	integer
	 */	
	function check_status($number)
	{
		$this->db->from('plugin_sms_status');
		$this->db->where('phone_number', $number);
		return $this->db->count_all_results();    		
	}

	// --------------------------------------------------------------------
	
	/**
	 * Add Gardu
	 *
	 * @access	public   		 
	 * @param	mixed $param
	 * @return
	 */		
	function add_gardu($param)
	{
      
		$this->db->set('kdgardu', $param['kdgardu']);
		$this->db->set('kdindux', $param['kdindux']);
		$this->db->set('nama', $param['nama']);
		$this->db->set('ket', $param['ket']);
		
		// edit mode
		if(isset($param['id_gd'])) 
		{
			$this->db->where('ID', $param['id_gd']);
			$this->db->update('tgarduanak');
		}
		else $this->db->insert('tgarduanak');
        
        
        
        //delete past groups
       // $this->db->delete('tgarduanak', array('ID' => $gd_id)); 
        
        // now insert the lastest
    
        
	}
	function add_garduindux($param)
	{
      
		$this->db->set('kdgardu', $param['kdgardu']);
		$this->db->set('nama', $param['nama']);
		$this->db->set('ket', $param['ket']);
		
		// edit mode
		if(isset($param['id_gd'])) 
		{
			$this->db->where('ID', $param['id_gd']);
			$this->db->update('tgarduanak');
		}
		else $this->db->insert('tgarduindux');
	}
}

/* End of file sms_status_model.php */
/* Location: ./application/plugins/sms_status/models/sms_status_model.php */