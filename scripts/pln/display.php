<?php
class bitDisplay
{
    public $garduindux="";
    public $modalgardu="";
    public $body="";

    function bitContent()
    {
            bitConnect();
            $query="SELECT * FROM `tgarduindux`";
            $action=mysql_query($query) or die($query."<br/><br/>".mysql_error());;
            while ($data=mysql_fetch_array($action))
            {   
                echo $data['id']."<br />";
                
                $this->modalgardu="
                <!--  Modal content for the mixer image example -->
                  <div class=\"modal fade pop-up-".$data['id'] ." \" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myLargeModalLabel-1\" aria-hidden=\"true\">
                    <div class=\"modal-dialog modal-lg\">
                      <div class=\"modal-content\">

                        <div class=\"modal-header\">
                          <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                          <h4 class=\"modal-title\" id=\"myLargeModalLabel-1\">Mixer Board</h4>
                        </div>
                        <div class=\"modal-body\">
                        <img src=\"http://i.imgur.com/YZ7AGyF.jpg.jpg\" class=\"img-responsive img-rounded center-block\" alt=\"\">
                        </div>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal mixer image -->
                  ";
            }
            
        $this->body= foreach ($data as $datas) {
             $a="<a href=\"#\" data-toggle=\"modal\" data-target=\".pop-up-".$datas['id']."\">
        <img src=\"http://i.imgur.com/YZ7AGyF.jpg\" width=\"150\" class=\"img-responsive img-rounded center-block\" alt=\"lala\">
        </a>
        <hr>
        "
            }.$this->modalgardu;

        $body=$this->body;
        return $body;
    }
}

?>