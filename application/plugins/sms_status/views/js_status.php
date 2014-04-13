<script type="text/javascript">
$(document).ready(function(){
		
	// Compose SMS
	$('#send_status').bind('click', function() {
		var status = '<?php echo $total_status;?>';
		if(status==0)
		{
			$('.notification_area').text("No status registered");
			$('.notification_area').show();	
		}
		else {
		$("#compose_sms_container").html("<div align=\"center\"> Loading...</div>");
		$("#compose_sms_container").load('<?php echo site_url('messages/compose')?>', { 'type': "normal" }, function() {
		  $(this).dialog({
		    modal:true,		
			width: 550,
		    buttons: {
			'<?php echo lang('tni_send_message'); ?>': function() {
				if($("#composeForm").valid()) {
				    $('.ui-dialog-buttonpane :button').each(function(){ if($(this).text() == '<?php echo lang('tni_send_message'); ?>') $(this).html('<?php echo lang('tni_sending_message'); ?> <img src="<?php echo $this->config->item('img_path').'processing.gif' ?>" height="12" style="margin:0px; padding:0px;">');   });
				$.post("<?php echo site_url('messages/compose_process') ?>", $("#composeForm").serialize(), function(data) {
					$("#compose_sms_container").html(data);
					$("#compose_sms_container" ).dialog( "option", "buttons", { "Okay": function() { $(this).dialog("destroy"); } } );
					setTimeout(function() {$("#compose_sms_container").dialog('destroy')} , 1500);
				});
				}			},
			Cancel: function() { $(this).dialog('destroy');}
		    }
		  });
		});
		$("#compose_sms_container").dialog('open');
		return false;
		}
	});	

$('.truble').click(function(event) {
    var mytext = $(this).data('gd');
    var mytext2 = $(this).data('tegangan');
    var mytext3 = $(this).data('arus');


    $('<div id="dialog"> Kode Gardu :'+mytext+' | tengangan Gardu :'+mytext2+' | Arus Gardu :'+mytext3+' <br /> </div>').appendTo('body');
    event.preventDefault();

		$("#dialog").dialog({					
			width: 600,
			modal: true,
			close: function(event, ui) {
				$("#dialog").remove();
				}
			});
    }); //close click


// Add contact wizard
	$('#garduinduxs').click(function() {
		$("#pbk_add_wizard_dialog").dialog({
			autoOpen: false,
			height: 250,
			modal: true,
			buttons: {
				'<?php echo lang('kalkun_cancel'); ?>': function() {
					$(this).dialog('close');
				}
			}
		});		
		$('#pbk_add_wizard_dialog').dialog('open');
	});

	$('#garduindux').bind('click', function() {
		var status = '<?php echo $total_status;?>';
		
		$("#contact_container").html("<div align=\"center\"> Loading...</div>");
		$("#contact_container").load('<?php echo site_url('plugin/sms_status/add_gardu')?>', { 'type': "normal", 'param1': "param1" }, function() {
		$(this).dialog({
			title: 'gardu',
			modal: true,
			show: 'fade',
			hide: 'fade',
			open: function() {
				$("#nama").focus();
			},
			buttons: {
			'<?php echo lang('kalkun_save')?>': function() {
			 if($('#addgardu').valid()){
				$.post("<?php echo site_url('plugin/sms_status/add_garduindux_process') ?>", $("#addgardu").serialize(), function(data) {
				$("#contact_container").html(data);
				$("#contact_container").dialog({ buttons: { "Okay": function() { $(this).dialog("close"); } } });
				setTimeout(function() {$("#contact_container").dialog('close')} , 1500);
			});
            } else { return false;}
            
			}, <?php echo lang('kalkun_cancel')?>: function() { $(this).dialog('close');} }
			});
		});
		$("#contact_container").dialog('open');
		return false;
		
	});

	$('#garduanak').bind('click', function() {
		var status = '<?php echo $total_status;?>';
		
		$("#contact_container").html("<div align=\"center\"> Loading...</div>");
		$("#contact_container").load('<?php echo site_url('plugin/sms_status/add_contact')?>', { 'type': "normal", 'param1': "param1" }, function() {
		$(this).dialog({
			title: 'gardu',
			modal: true,
			show: 'fade',
			hide: 'fade',
			open: function() {
				$("#nama").focus();
			},
			buttons: {
			'<?php echo lang('kalkun_save')?>': function() {
			 if($('#addgardu').valid()){
				$.post("<?php echo site_url('plugin/sms_status/add_gardu_process') ?>", $("#addgardu").serialize(), function(data) {
				$("#contact_container").html(data);
				$("#contact_container").dialog({ buttons: { "Okay": function() { $(this).dialog("close"); } } });
				setTimeout(function() {$("#contact_container").dialog('close')} , 1500);
			});
            } else { return false;}
            
			}, <?php echo lang('kalkun_cancel')?>: function() { $(this).dialog('close');} }
			});
		});
		$("#contact_container").dialog('open');
		return false;
		
	});	
});
</script>