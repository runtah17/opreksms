<?php
function bitConnect()
{
	

	$conn=mysql_connect('localhost','r17','bitpln');
	mysql_select_db('opreksms',$conn);
}
Class config
{
	public $urikalkun="../../";
	public $reset1="RESET-0";
	public $reset2="RESET-4";
	public $reset3="Status";

	
	function bitCheckPhonebook($kdgd)
	    {
	$noPbk="+6285691046947";    	
	        if (!empty($kdgd))
	        {
	            
	            bitConnect();
	            $query="SELECT `Number` FROM `pbk` WHERE `Name`='$kdgd' LIMIT 1";
	            if ($data=mysql_fetch_array(mysql_query($query)))
	                    {
	                        return $data['Number'];
	                    }
	        }
	        else return $noPbk;   
	    }
}
?>