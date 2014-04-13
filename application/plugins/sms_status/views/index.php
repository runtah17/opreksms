<?php $this->load->view('js_status');?>
<div id="window_container">
<div id="window_title">
	<div id="window_title_left"><?php echo lang('kalkun_sms_status');?></div>
	<div id="window_title_right">
	<a href="#" id="send_status" class="nicebutton">&#43; <?php echo lang('tni_send_message');?></a>	
	<a href="#" id="garduindux" class="nicebutton">&#43; Gardu Indux </a>
	<a href="#" id="garduanak" class="nicebutton">&#43; Gardu Anak </a>
	</div>
</div>
<div id="status information" style="background: #eee; padding: 5px 10px; border-bottom: 1px solid #ccc;">
	<?php echo lang('kalkun_sms_total_status');?>: <?php echo $total_status;?>
</div>

<div id="window_content">

<?php
/*
if($total_status==0):
echo "<p class=\"no_content\"><span class=\"ui-icon ui-icon-alert\" style=\"float:left;\"></span><i>".lang('kalkun_sms_no_status').".</i></p>";
else:
foreach($status as $tmp_status):
	echo $tmp_status['kdgardu']." - ".$tmp_status['tegangan']." - ".$tmp_status['tgltrouble']." - <br/>";
endforeach;
endif;
*/
?>
<table class="table" style="background:Black; color: white;">
			  <thead>
				  <tr>
				   
					  <th style="text-align: center;"></th>
				
				  </tr>
			  </thead>   
			  <tbody>
				<?php if($total_status==0) : ?>
				  <tr valign="middle">
				    <td colspan="6" valign="middle" style="text-align: center;"><strong>There is no data</strong></td>
				  </tr>
				<?php else: ?>
						
				 <tr valign="middle">
				 <?php 
				 	foreach($gdinduxs as $gdindux):
				 ?>
									
				    <td valign="middle" style="border-left: 1px solid white; padding: 0px; text-align: left;"><strong>
				    	<?php
				     	
				     	echo $gdindux['kdgardu']."<br>";
				     	$aas = $this->plugin_model->get_ttrouble($gdindux['kdgardu'])->result_array();
				     	foreach($aas as $aa):
				     		$teg=$aa['tegangan'];
				     		$arus=$aa['arus'];

				     	endforeach; 
				     		if(empty($aas)):
				     		?>
				     		<a href="#" class="trouble" data-gd="<?php echo $gdindux['kdgardu']; ?>" data-tegangan="Normal" data-arus="Normal"><img src="<?php echo $this->config->item('img_path');?>119.gif" /></a>
				     		<?php
				     		else:
				     		?>
				     		<a href="#" class="trouble" data-gd="<?php echo $gdindux['kdgardu']; ?>" data-tegangan="<?php echo $teg; ?>" data-arus="<?php echo $arus; ?>"><img src="<?php echo $this->config->item('img_path');?>118.gif" /></a>
				     		<?php
				     		endif;
				     	

				     	$gdanaks = $this->plugin_model->get_garduanak($gdindux['id'])->result_array();
				    	foreach($gdanaks as $gdanak):
				    		?>
				    			<table class="table" style="background:Black; color: white;">
									<tbody>
										<tr>
										 <td>
										 	<?php
									     	echo $gdanak['kdgardu']."<br>";
									     	$aaabs = $this->plugin_model->get_ttrouble($gdanak['kdgardu'])->result_array();
									     	
									     		if(empty($aaabs)):
									     			?>
									     			<a href="#" id="trouble" ><img src="<?php echo $this->config->item('img_path');?>119.gif" /></a>
										     		<?php
										     		else:
										     		?>
										     		<a href="#" id="trouble" ><img src="<?php echo $this->config->item('img_path');?>118.gif" /></a>
										     		<?php
									     		endif;
									     		
									     	?>
									     </td>
										</tr>
									</tbody>
								 </table>
				    		<?php

				    	endforeach 	
				     ?>
				    
				    </td>
				  
				 <?php 
				 	endforeach; 
				 	?>
				 </tr> 
				<?php endif; ?> 
			  </tbody>
			</table>
</div>
</div>
<div id="contact_container" class="hidden"></div>

<!-- Add contact wizard dialog -->
<div id="pbk_add_wizard_dialog" title="<?php echo lang('kalkun_pbk_add_method');?>" class="dialog">
	<div align="left">
	<p><a href="#" id="addpbkcontact" class="addpbkcontact"><big><strong><?php echo lang('kalkun_pbk_add_form');?></strong></big><br />
	<?php echo lang('kalkun_pbk_add_form_desc');?>
	</a></p>
	
	<p><a href="#" id="importpbk"><big><strong><?php echo lang('kalkun_pbk_add_csv');?></strong></big><br />
	<?php echo lang('kalkun_pbk_add_csv_desc');?>
	</a></p>
	</div>
</div>