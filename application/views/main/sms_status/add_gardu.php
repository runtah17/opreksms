<!-- gardu dialog -->
<script src="<?php echo $this->config->item('js_path');?>jquery-plugin/jquery.validate.min.js"></script>
<script src="<?php echo $this->config->item('js_path');?>jquery-plugin/jquery.validate.phone.js"></script>
<script src="<?php echo $this->config->item('js_path');?>jquery-plugin/jquery.tagsinput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_path');?>jquery-plugin/jquery.tagsinput.css" />
<script src="<?php echo $this->config->item('js_path');?>jquery-plugin/jquery.autocomplete.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_path');?>jquery-plugin/jquery.autocomplete.css" />


<div id="dialog" class="dialog" style="display: block">
<p id="validateTips"><?php echo lang('tni_form_fields_required'); ?></p>
<?php echo form_open('plugin/sms_status/add_garduindux_process', array('id' => 'addgardu'));?>
<fieldset>
<input type="hidden" name="gardu_id_gd" id="gardu_id_gd" value="<?php echo $this->session->userdata('id_user');?>" />
<label for="kdgardu">Kode Gardu</label>
<input type="text" name="kdgardu" id="kdgardu" value="<?php if(isset($gardu)) echo $gardu->row('kdgardu');?>" class="text ui-widget-content ui-corner-all required" />
<label for="name">Nama Gardu</label>
<input type="text" name="nama" id="name" value="<?php if(isset($gardu)) echo $gardu->row('Nama');?>" class="text ui-widget-content ui-corner-all required" />
<label for="number">Ket Gardu</label>
<input type="text" name="ket" id="ket" value="<?php if(isset($gardu)) echo $gardu->row('ket');?>" class="text ui-widget-content ui-corner-all required" />


<?php if(isset($gardu)): ?> 
<input type="hidden" name="editid_gardu" id="editid_gardu" value="<?php echo $gardu->row('id');?>" />
<?php endif;?>
</fieldset>
<?php echo form_close();?>
</div>
