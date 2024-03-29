<?php
/**
* Plugin Name: SMS Member
* Plugin URI: http://azhari.harahap.us
* Version: 0.1
* Description: SMS Member a.k.a SMS Content
* Author: Azhari Harahap
* Author URI: http://azhari.harahap.us
*/

/*
|--------------------------------------------------------------------------
| CONFIGURATION
|--------------------------------------------------------------------------
|
| reg_code - Registration code (Don't use space)
| unreg_code - Unregistration code (Don't use space)
|
*/
function sms_member_initialize()
{
	$config['reg_code'] = 'STATUS';
	$config['unreg_code'] = 'UNREG';
	return $config;
}

// Add hook for incoming message
add_action("message.incoming.before", "sms_member", 13);

/**
* Function called when plugin first activated
* Utility function must be prefixed with the plugin name
* followed by an underscore.
* 
* Format: pluginname_activate
* 
*/
function sms_member_activate()
{
    return true;
}

/**
* Function called when plugin deactivated
* Utility function must be prefixed with the plugin name
* followed by an underscore.
* 
* Format: pluginname_deactivate
* 
*/
function sms_member_deactivate()
{
    return true;
}

/**
* Function called when plugin first installed into the database
* Utility function must be prefixed with the plugin name
* followed by an underscore.
* 
* Format: pluginname_install
* 
*/
function sms_member_install()
{
	$CI =& get_instance();
	$CI->load->helper('kalkun');
	// check if table already exist
	if (!$CI->db->table_exists('plugin_sms_status'))
	{
		$db_driver = $CI->db->platform();
		$db_prop = get_database_property($db_driver);
		execute_sql(APPPATH."plugins/sms_member/media/".$db_prop['file']."_sms_status.sql");
	}
    return true;
}

function sms_member($sms)
{
	$config = sms_member_initialize();
	$message = $sms->TextDecoded;
	$number = $sms->SenderNumber;
	
	//list($code) = explode(" ", $message);
	list($code,$sn,$idd,$st,$tgl,$yu,$arus) = explode("*", $message);
	$reg_code = $config['reg_code'];
	$unreg_code = $config['unreg_code'];
	if (strtoupper($code)==strtoupper($reg_code))
	{ 
		register_member($code,$sn,$idd,$st,$tgl,$yu,$arus); 
	}
	else if (strtoupper($code)==strtoupper($unreg_code))
	{
		unregister_member($number);
	}
}

// --------------------------------------------------------------------

/**
 * Register member
 *
 * Register member's phone number
 */
function register_member($number)
{
	$CI =& get_instance();
    $CI->load->model('sms_member/sms_member_model', 'plugin_model');
    	
	//check if number not registered
	//if($CI->plugin_model->check_member($number)==0)
	$CI->plugin_model->add_member($code,$sn,$idd,$st,$tgl,$yu,$arus);
}

// --------------------------------------------------------------------

/**
 * Unregister member
 *
 * Unregister member's phone number
 */	
function unregister_member($number)
{	
	$CI =& get_instance();
    $CI->load->model('sms_member/sms_member_model', 'plugin_model');
    	
	//check if already registered
	if($CI->plugin_model->check_member($number)==1)
	$CI->plugin_model->remove_member($number);
}

/* End of file sms_member.php */
/* Location: ./application/plugins/sms_member/sms_member.php */