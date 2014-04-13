<?php
class bitFunction
{
    public $noPbk="";
    public $bitAgent=array();
    
    function bitCheckPhonebook($kdgd)
    {
        if (!empty($kdgd))
        {
            
            bitConnect();
            $query="SELECT `Name` FROM `pbk` WHERE `Name`='$kdgd' LIMIT 1";
            if ($data=mysql_fetch_array(mysql_query($query)))
                    {
                        return $noPbk=$data['Number'];
                    }
        }
        else return 'FALSE';   
    }
    function bitSendSMS($no)
    {
        if (!empty($kdgd))
        {
            
            bitConnect();
            $query="SELECT `Name` FROM `pbk` WHERE `Name`='$kdgd' LIMIT 1";
            if ($data=mysql_fetch_array(mysql_query($query)))
                    {
                        return $noPbk=$data['Number'];
                    }
        }
        else return 'FALSE';   
    }
    
}
?>