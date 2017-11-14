<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('sarana_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($sarana->id_sarana) ? $sarana->id_sarana : '';

?>
<div class='admin-box'>
    <h3>Sarana</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('id_kecamatan') ? ' error' : ''; ?>">
                <?php echo form_label(lang('sarana_field_id_kecamatan') . lang('bf_form_label_required'), 'id_kecamatan', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='id_kecamatan' type='text' required='required' name='id_kecamatan' maxlength='11' value="<?php echo set_value('id_kecamatan', isset($sarana->id_kecamatan) ? $sarana->id_kecamatan : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('id_kecamatan'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('krit1_sarana') ? ' error' : ''; ?>">
                <?php echo form_label(lang('sarana_field_krit1_sarana') . lang('bf_form_label_required'), 'krit1_sarana', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='krit1_sarana' type='text' required='required' name='krit1_sarana' maxlength='11' value="<?php echo set_value('krit1_sarana', isset($sarana->krit1_sarana) ? $sarana->krit1_sarana : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('krit1_sarana'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('krit2_sarana') ? ' error' : ''; ?>">
                <?php echo form_label(lang('sarana_field_krit2_sarana') . lang('bf_form_label_required'), 'krit2_sarana', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='krit2_sarana' type='text' required='required' name='krit2_sarana' maxlength='11' value="<?php echo set_value('krit2_sarana', isset($sarana->krit2_sarana) ? $sarana->krit2_sarana : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('krit2_sarana'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('krit3_sarana') ? ' error' : ''; ?>">
                <?php echo form_label(lang('sarana_field_krit3_sarana') . lang('bf_form_label_required'), 'krit3_sarana', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='krit3_sarana' type='text' required='required' name='krit3_sarana' maxlength='11' value="<?php echo set_value('krit3_sarana', isset($sarana->krit3_sarana) ? $sarana->krit3_sarana : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('krit3_sarana'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('krit4_sarana') ? ' error' : ''; ?>">
                <?php echo form_label(lang('sarana_field_krit4_sarana') . lang('bf_form_label_required'), 'krit4_sarana', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='krit4_sarana' type='text' required='required' name='krit4_sarana' maxlength='11' value="<?php echo set_value('krit4_sarana', isset($sarana->krit4_sarana) ? $sarana->krit4_sarana : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('krit4_sarana'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('krit5_sarana') ? ' error' : ''; ?>">
                <?php echo form_label(lang('sarana_field_krit5_sarana') . lang('bf_form_label_required'), 'krit5_sarana', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='krit5_sarana' type='text' required='required' name='krit5_sarana' maxlength='11' value="<?php echo set_value('krit5_sarana', isset($sarana->krit5_sarana) ? $sarana->krit5_sarana : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('krit5_sarana'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('sarana_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/settings/sarana', lang('sarana_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Sarana.Settings.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('sarana_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('sarana_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>