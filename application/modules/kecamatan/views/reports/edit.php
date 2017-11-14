<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('kecamatan_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($kecamatan->id_kecamatan) ? $kecamatan->id_kecamatan : '';

?>
<div class='admin-box'>
    <h3>Kecamatan</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('nama_kecamatan') ? ' error' : ''; ?>">
                <?php echo form_label(lang('kecamatan_field_nama_kecamatan') . lang('bf_form_label_required'), 'nama_kecamatan', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='nama_kecamatan' type='text' required='required' name='nama_kecamatan' maxlength='25' value="<?php echo set_value('nama_kecamatan', isset($kecamatan->nama_kecamatan) ? $kecamatan->nama_kecamatan : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('nama_kecamatan'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('kecamatan_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/reports/kecamatan', lang('kecamatan_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Kecamatan.Reports.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('kecamatan_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('kecamatan_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>