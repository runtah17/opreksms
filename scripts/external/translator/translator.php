<?php
/**
 * Translator
 * Transform Kalkun into mobile dictionary app using gtranslate-api-php <http://code.google.com/p/gtranslate-api-php/>
 *
 * @author		Azhari Harahap <azhari@harahap.us>
 * @link		http://azhari.harahap.us/2011/04/howto-turn-kalkun-into-awesome-mobile-dictionary-app/
 */

// ------------------------------------------------------------------------
 
//define('GTranslate_path', "/path/to/gtranslate-api-php/GTranslate.php");
define('Kalkun_API_path', "../../cURL/Kalkun_API.php");

$arg_list = $_SERVER['argv'];
$arg_count = count($arg_list);

if($arg_count > 2)
{
	$phone_number = $arg_list[1];
	unset($arg_list[0]);
	unset($arg_list[1]);
	
	// build the text
	$translate_string = implode(' ',$arg_list);
	
	// Send translated text by SMS
		include_once(Kalkun_API_path);
		$config['base_url'] = "http://localhost/opreksms/index.php/";
		$config['session_file'] = "/tmp/cookies.txt";
		$config['username'] = "kalkun";
		$config['password'] = "kalkun";
		$config['phone_number'] = $phone_number;
		$config['message'] = 'Lalala yeeye';
		$sms = new Kalkun_API($config);
		$sms->run();
}
?>
