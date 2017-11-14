<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('keluhan_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($keluhan->id_keluhan) ? $keluhan->id_keluhan : '';

?>
<div class='admin-box'>
    <h3>Keluhan</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('email_keluhan') ? ' error' : ''; ?>">
                <?php echo form_label(lang('keluhan_field_email_keluhan'), 'email_keluhan', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='email_keluhan' type='text' name='email_keluhan' maxlength='40' value="<?php echo set_value('email_keluhan', isset($keluhan->email_keluhan) ? $keluhan->email_keluhan : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('email_keluhan'); ?></span>
                </div>
            </div>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    11 => 11,
                );
                echo form_dropdown(array('name' => 'id_kecamatan', 'required' => 'required'), $options, set_value('id_kecamatan', isset($keluhan->id_kecamatan) ? $keluhan->id_kecamatan : ''), lang('keluhan_field_id_kecamatan') . lang('bf_form_label_required'));
            ?>

            <div class="control-group<?php echo form_error('isi_keluhan') ? ' error' : ''; ?>">
                <?php echo form_label(lang('keluhan_field_isi_keluhan') . lang('bf_form_label_required'), 'isi_keluhan', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'isi_keluhan', 'id' => 'isi_keluhan', 'rows' => '5', 'cols' => '80', 'value' => set_value('isi_keluhan', isset($keluhan->isi_keluhan) ? $keluhan->isi_keluhan : ''), 'required' => 'required')); ?>
                    <span class='help-inline'><?php echo form_error('isi_keluhan'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('keluhan_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/developer/keluhan', lang('keluhan_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>