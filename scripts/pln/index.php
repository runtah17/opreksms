<?php
//session_start();
require_once("config.php");
require_once("function.php");
$aa1=new config();
//require_once("display.php");
//include_once("action.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Gardu PLN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootswatch/3.1.0/yeti/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
            </style>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">

function show_notification(text)
{
  $('.notification_area').text(text).fadeIn().delay(1500).fadeOut('slow');
}

</script>
</head>
<body>
  <div class="notification_container" align="center"><span class="notification_area hidden"><?php // echo lang('tni_loading');?>...</span>
      <span class="notification_area"></span>
      </div>
   <div class="container">

      <div class="row-fluid" onload="JavaScript:timedRefresh(3000);">   
        <div class="span12">
          <div class="box-content" id="ajax">
            <table class="table table-bordered table-striped table-condensed table-hover">
              <thead>
                <tr>
                 
                  <th width="150" style="text-align: center;"></th>
              
                </tr>
              </thead>   
              <tbody>
                <tr valign="middle">
  <?php
  bitConnect();
            $query="SELECT * FROM `tgarduindux`";
            $action=mysql_query($query) or die($query."<br/><br/>".mysql_error());;
            while ($datas=mysql_fetch_array($action))
            {   ?>
         
            <td valign="middle" style="text-align: center;"><strong><?php
              echo $datas['id']."<br>";
              $kode=$datas['kdgardu'];
                $query1 = "SELECT * FROM `plugin_sms_status` WHERE `kdgardu`='$kode'";
                $hsl=mysql_query($query1) or die($query1."<br/><br/>".mysql_error());;
                $details0=mysql_fetch_array($hsl);
                $row=mysql_num_rows($hsl);
                if($row>0)
                {
                ?>
                  <a href="#" data-toggle="modal" data-target=".pop-up-<?php echo $datas['id'] ;?>">
                    <img src="assets/img/118.gif">
                  </a>
                <?php  
                            $teg0=$details0[4];
                            $arus0=$details0['arus'];
                            $tgl0=$details0['tgltrip']; 
                }else{
                ?>
                  <a href="#" data-toggle="modal" data-target=".pop-up-<?php echo $datas['id'] ;?>">
                    <img src="assets/img/119.gif">
                  </a>
                <?php 
                            $teg0="Normal";
                            $arus0="Normal";
                            $tgl0="Normal";  
                }
                $a=0;
                $queryAnak = "SELECT * FROM `tgarduanak` WHERE `kdindux`='$datas[id]'";
                $hsl1=mysql_query($queryAnak) or die($queryAnak."<br/><br/>".mysql_error());;
                while ($anaks=mysql_fetch_array($hsl1))
                {   

                  $a++;
                ?>
                <table class="table" style="background:Black; color: white;">
                  <tbody>
                    <tr>
                     <td>
                      <?php
                        echo $anaks['kdgardu']."<br>";
                        $kodeAnak=$anaks['kdgardu'];

                          $query2 = "SELECT * FROM `plugin_sms_status` WHERE `kdgardu`='$kodeAnak'";
                          $hsl3=mysql_query($query2) or die($query2."<br/><br/>".mysql_error());
                          $details=mysql_fetch_array($hsl3);
                          $row3=mysql_num_rows($hsl3);
                          if($row3>0)
                          {
                          ?>
                            <a href="#" data-toggle="modal" data-target=".pop-up-<?php echo $anaks['kdgardu'] ;?>">
                              <img src="assets/img/118.gif">
                            </a>
                          <?php 
                            $teg=$details[4];
                            $arus=$details['arus'];
                            $tgl=$details['tgltrip']; 
                          }else{
                          ?>
                            <a href="#" data-toggle="modal" data-target=".pop-up-<?php echo $anaks['kdgardu'] ;?>">
                              <img src="assets/img/119.gif">
                            </a>
                          <?php 
                            
                             $teg="normal";
                            $arus="Normal";
                            $tgl="Normal"; 
                          }                          
                        ?>
                       </td>
                    </tr>
                  </tbody>
                 </table>
                  <!--  Modal content for the mixer image example -->
                <div class="modal fade pop-up-<?php echo $anaks['kdgardu'] ;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel-1">Gardu : <?php echo $anaks['kdgardu'] ;?></h4>
                      </div>
                      <div class="modal-body">
                          <h3 class="media-heading">Laporan Kondisi Gardu <small> <?php echo $anaks['kdgardu'] ;?></small></h3>
                          <span><strong>Kondisi: </strong></span>
                          <span class="label label-warning">Tegangan : <?php echo $teg ;?></span>
                          <span class="label label-info">Arus : <?php echo $arus ;?></span>
                          <span class="label label-info">Tanggal Trip : <?php echo $tgl ;?> </span>
                        <div id="modalTab">
                        <div class="tab-content">
                              <div class="tab-pane active" id="awal<?php echo $anaks['kdgardu'];?>">
                                <?php 
                                  
                                    $nomer=$aa1->bitCheckPhonebook($anaks['kdgardu']);


                                ?>
                                <p>
                                  <form method="post" action='<?php echo $aa1->urikalkun;?>index.php/messages/compose_process' id="composeForm">
                                      <input type="hidden" class="span12" name="manualvalue" id="no" value="<?php echo $nomer; ?>">
                                      <input type="hidden" class="span12" name="message" id="sms" value="<?php echo $aa1->reset1;?>">
                                      <input type="hidden" class="span12" name="senddateoption" id="sms1" value="option1">
                                      <input type="hidden" class="span12" name="sendoption" id="sms2" value="sendoption3">
                                      <input type="hidden" class="span12" name="smstype" id="sms3" value="normal">
                                      <input type="hidden" class="span12" name="sms_loop" id="sms4" value="1">
                                      <input type="hidden" class="span12" name="validity" id="sms5" value="-1">
                                      <input type="hidden" class="span12" name="datevalue" id="sms6" value="">
                                      <input type="hidden" class="span12" name="delayhour" id="sms7" value="00">
                                      <input type="hidden" class="span12" name="delayminute" id="sms8" value="00">
                                      <input type="hidden" class="span12" name="hour" id="sms9" value="00">
                                      <input type="hidden" class="span12" name="minute" id="sms10" value="00">
                                      <input type="hidden" class="span12" name="personvalue" id="sms11" value="">
                                      <input type="hidden" class="span12" name="url" id="sms12" value="">
                                      <input type="hidden" class="span12" name="import_value_count" id="sms13" value="">
                                      <br />
                                      <br />
                                      <button type="submit" class="btn btn-primary">Setel Ulang</button>
                                  </form>
                                  <form method="post" action='<?php echo $aa1->urikalkun;?>index.php/messages/compose_process' id="composeForm">
                                      <input type="hidden" class="span12" name="manualvalue" id="no" value="<?php echo $nomer; ?>">
                                      <input type="hidden" class="span12" name="message" id="sms" value="<?php echo $aa1->reset2;?>">
                                      <input type="hidden" class="span12" name="senddateoption" id="sms1" value="option1">
                                      <input type="hidden" class="span12" name="sendoption" id="sms2" value="sendoption3">
                                      <input type="hidden" class="span12" name="smstype" id="sms3" value="normal">
                                      <input type="hidden" class="span12" name="sms_loop" id="sms4" value="1">
                                      <input type="hidden" class="span12" name="validity" id="sms5" value="-1">
                                      <input type="hidden" class="span12" name="datevalue" id="sms6" value="">
                                      <input type="hidden" class="span12" name="delayhour" id="sms7" value="00">
                                      <input type="hidden" class="span12" name="delayminute" id="sms8" value="00">
                                      <input type="hidden" class="span12" name="hour" id="sms9" value="00">
                                      <input type="hidden" class="span12" name="minute" id="sms10" value="00">
                                      <input type="hidden" class="span12" name="personvalue" id="sms11" value="">
                                      <input type="hidden" class="span12" name="url" id="sms12" value="">
                                      <input type="hidden" class="span12" name="import_value_count" id="sms13" value="">
                                      <br />
                                      <br />
                                      <button type="submit" class="btn btn-primary">Matikan</button>
                                  </form>
                                  <form method="post" action='<?php echo $aa1->urikalkun;?>index.php/messages/compose_process' id="composeForm">
                                      <input type="hidden" class="span12" name="manualvalue" id="no" value="<?php echo $nomer; ?>">
                                      <input type="hidden" class="span12" name="message" id="sms" value="<?php echo $aa1->reset3;?>">
                                      <input type="hidden" class="span12" name="senddateoption" id="sms1" value="option1">
                                      <input type="hidden" class="span12" name="sendoption" id="sms2" value="sendoption3">
                                      <input type="hidden" class="span12" name="smstype" id="sms3" value="normal">
                                      <input type="hidden" class="span12" name="sms_loop" id="sms4" value="1">
                                      <input type="hidden" class="span12" name="validity" id="sms5" value="-1">
                                      <input type="hidden" class="span12" name="datevalue" id="sms6" value="">
                                      <input type="hidden" class="span12" name="delayhour" id="sms7" value="00">
                                      <input type="hidden" class="span12" name="delayminute" id="sms8" value="00">
                                      <input type="hidden" class="span12" name="hour" id="sms9" value="00">
                                      <input type="hidden" class="span12" name="minute" id="sms10" value="00">
                                      <input type="hidden" class="span12" name="personvalue" id="sms11" value="">
                                      <input type="hidden" class="span12" name="url" id="sms12" value="">
                                      <input type="hidden" class="span12" name="import_value_count" id="sms13" value="">
                                      <br />
                                      <br />                                    
                                      <button type="submit" class="btn btn-primary">Hidupkan</button>                                  
                                  </form>
                                 
                                    <p><a href="#forgotpassword<?php echo $anaks['kdgardu'];?>" data-toggle="tab">Lainnya</a></p>
                                 
                                </p>
                              </div>
                              <div class="tab-pane fade" id="forgotpassword<?php echo $anaks['kdgardu'];?>">
                                  <form method="post" action='<?php echo $aa1->urikalkun;?>index.php/messages/compose_process' id="composeForm" name="forgot_password"> 
                                    <br/>
                                      <p>Masukan Format SMS yang diinginkan!</p>
                                      <input type="hidden" class="span12" name="manualvalue" id="no" value="<?php echo $nomer; ?>">
                                      <input type="text" class="span12" name="message" id="sms" placeholder="Masukan SMS">
                                      <input type="hidden" class="span12" name="senddateoption" id="sms1" value="option1">
                                      <input type="hidden" class="span12" name="sendoption" id="sms2" value="sendoption3">
                                      <input type="hidden" class="span12" name="smstype" id="sms3" value="normal">
                                      <input type="hidden" class="span12" name="sms_loop" id="sms4" value="1">
                                      <input type="hidden" class="span12" name="validity" id="sms5" value="-1">
                                      <input type="hidden" class="span12" name="datevalue" id="sms6" value="">
                                      <input type="hidden" class="span12" name="delayhour" id="sms7" value="00">
                                      <input type="hidden" class="span12" name="delayminute" id="sms8" value="00">
                                      <input type="hidden" class="span12" name="hour" id="sms9" value="00">
                                      <input type="hidden" class="span12" name="minute" id="sms10" value="00">
                                      <input type="hidden" class="span12" name="personvalue" id="sms11" value="">
                                      <input type="hidden" class="span12" name="url" id="sms12" value="">
                                      <input type="hidden" class="span12" name="import_value_count" id="sms13" value="">
                                      <br />
                                      <br />
                                      <p><button type="submit" class="btn btn-primary">Submit</button>
                                      <a href="#awal<?php echo $anaks['kdgardu'];?>" data-toggle="tab">Kembali</a>
                                      </p>
                                  </form>
                              </div>
                            </div>
                          </div>
                      <!--<img src="http://i.imgur.com/YZ7AGyF.jpg.jpg" class="img-responsive img-rounded center-block" alt=""> -->
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal mixer image --> 
                <?php } ?>
                <!--  Modal content for the mixer image example -->
                <div class="modal fade pop-up-<?php echo $datas['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel-1"><?php echo $datas['kdgardu'] ;?></h4>
                      </div>
                      <div class="modal-body">
                        <h3 class="media-heading">Laporan Kondisi Gardu <small> <?php echo $datas['kdgardu'] ;?></small></h3>
                        <span><strong>Kondisi: </strong></span>
                        <span class="label label-warning">Tegangan : <?php echo $teg0 ;?></span>
                        <span class="label label-info">Arus : <?php echo $arus0 ;?></span>
                        <span class="label label-info">Tanggal Trip : <?php echo $tgl0 ;?> </span>
                        <div id="modalTab">
                        <div class="tab-content">
                              <div class="tab-pane active" id="awal<?php echo $datas['kdgardu'];?>">
                                  <!--<form method="post" action='' name="login_form">-->
                                      <!--<p><input type="hidden" class="span12" name="eidkdgd" id="nik"></p>-->
                                      <br />
                                      <br />
                                      <p><a href="#"><button type="button" class="btn btn-primary">Setel Ulang</button></a>
                                      <a href="#"><button type="button" class="btn btn-primary">Matikan</button></a>
                                      <a href="#"><button type="button" class="btn btn-primary">Hidupkan</button></a>
                                      <a href="#forgotpassword<?php echo $datas['kdgardu'];?>" data-toggle="tab">Lainnya</a>
                                      </p>
                                  <!--</form>-->
                              </div>
                              <div class="tab-pane fade" id="forgotpassword<?php echo $datas['kdgardu'];?>">
                                  <form method="post" action='' name="forgot_password">
                                    <br/>
                                      <p>Masukan Format SMS yang diinginkan!</p>
                                      <input type="text" class="span12" name="eid" id="sms" placeholder="Masukan SMS">
                                      <br/>
                                      <br/>
                                      <p><button type="submit" class="btn btn-primary">Submit</button>
                                      <a href="#awal<?php echo $datas['kdgardu'];?>" data-toggle="tab">Kembali</a>
                                      </p>
                                  </form>
                              </div>
                            </div>
                          </div>                        
                      <!--<img src="http://i.imgur.com/YZ7AGyF.jpg.jpg" class="img-responsive img-rounded center-block" alt="">-->
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal mixer image -->
          <?php } ?>
            </td>
              </tr>
            </tbody>
           </table>
</div>
</div>
</body>
</html>
