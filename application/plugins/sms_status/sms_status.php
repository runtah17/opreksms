<?php
/**
* Plugin Name: SMS status
* Plugin URI: http://tabahsetyoaji.com
* Version: 0.1
* Description: SMS status a.k.a SMS Content
* Author: r17
* Author URI: http://tabahsetyoaji.com
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
function sms_status_initialize()
{
	$config['reg_code'] = 'TRIP';
	$config['unreg_code'] = 'UNREG';
	return $config;
}

// Add hook for incoming message
add_action("message.incoming.before", "sms_status", 13);

/**
* Function called when plugin first activated
* Utility function must be prefixed with the plugin name
* followed by an underscore.
* 
* Format: pluginname_activate
* 
*/
function sms_status_activate()
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
function sms_status_deactivate()
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
function sms_status_install()
{
	$CI =& get_instance();
	$CI->load->helper('kalkun');
	// check if table already exist
	if (!$CI->db->table_exists('plugin_sms_status'))
	{
		$db_driver = $CI->db->platform();
		$db_prop = get_database_property($db_driver);
		execute_sql(APPPATH."plugins/sms_status/media/".$db_prop['file']."_sms_status.sql");
	}
    return true;
}

function sms_status($sms)
{
	$config = sms_status_initialize();
	$message = $sms->TextDecoded;
	$number = $sms->SenderNumber;
	
	list($code,$sn,$idd,$st,$tgl,$yu,$arus) = explode("*", $message);
	$reg_code = $config['reg_code'];
	$unreg_code = $config['unreg_code'];
	if (strtoupper($code)==strtoupper($reg_code))
	{ 
		register_status($code,$sn,$idd,$st,$tgl,$yu,$arus);
	}
	else if (strtoupper($code)==strtoupper($unreg_code))
	{
		unregister_status($number);
	}
}

// --------------------------------------------------------------------

/**
 * Register status
 *
 * Register status's phone number
 */
function register_status($code,$sn,$idd,$st,$tgl,$yu,$arus)
{
	$CI =& get_instance();
    $CI->load->model('sms_status/sms_status_model', 'plugin_model');
    	
	//check if number not registered
	//if($CI->plugin_model->check_status($number)==0)
	$CI->plugin_model->add_status($code,$sn,$idd,$st,$tgl,$yu,$arus);
}

// --------------------------------------------------------------------

/**
 * Unregister status
 *
 * Unregister status's phone number
 */	
function unregister_status($number)
{	
	$CI =& get_instance();
    $CI->load->model('sms_status/sms_status_model', 'plugin_model');
    	
	//check if already registered
	if($CI->plugin_model->check_status($number)==1)
	$CI->plugin_model->remove_status($number);
}

/* End of file sms_status.php */
/* Location: ./application/plugins/sms_status/sms_status.php */