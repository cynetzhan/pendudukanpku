<?php
Assets::add_js(array('js/tinymce/tinymce.min.js','js/jquery.datetimepicker.full.min.js'));
echo Assets::css('css/jquery.datetimepicker.min.css');
Assets::add_js("tinymce.init({selector:'textarea#isi_keluhan'});$('#waktu_lapor').datetimepicker({format:'Y-m-d H:i:s'});", 'inline');
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
$user = $this->auth->user();
?>
<div class='admin-box'>
    <h3>Keluhan</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="form-group<?php echo form_error('email_keluhan') ? ' error' : ''; ?>">
                <?php echo form_label("ID User", 'id_user', array('class' => 'form-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <input id='id_user' class="form-control" type='hidden' name='id_user' value="<?php echo set_value('id_user', isset($keluhan->id_user) ? $keluhan->id_user : $user->id); ?>" /><?= $user->display_name." (".$user->username.")" ?>
                    <span class='help-inline'><?php echo form_error('email_keluhan'); ?></span>
                </div>
            </div>
            
            <div class="form-group<?php echo form_error('waktu_lapor') ? ' error' : ''; ?>">
                <?php echo form_label("Tanggal Keluhan", 'waktu_lapor', array('class' => 'form-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <input id='waktu_lapor' class="form-control" type='text' name='waktu_lapor' value="<?php echo set_value('waktu_lapor', isset($keluhan->waktu_lapor) ? $keluhan->waktu_lapor : date('Y-m-d H:i:s')); ?>" />
                    <span class='help-inline'><?php echo form_error('tanggal_lapor'); ?></span>
                </div>
            </div>

            <?php // Change the values in this array to populate your dropdown as required
                
                /* echo form_dropdown(array('name' => 'id_kecamatan', 'required' => 'required'), $options, set_value('id_kecamatan', isset($keluhan->id_kecamatan) ? $keluhan->id_kecamatan : ''), lang('keluhan_field_id_kecamatan') . lang('bf_form_label_required')); */
            ?>
            <div class="form-group<?php echo form_error('id_kecamatan') ? ' error' : ''; ?>">
                <?php echo form_label(lang('keluhan_field_id_kecamatan') . lang('bf_form_label_required'), 'id_kecamatan', array('class' => 'form-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <select name='id_kecamatan' id='id_kecamatan' class="form-control">
                    <?php foreach($kecamatan as $row) { ?>
                     <option value="<?= $row->id_kecamatan ?>" <?= set_value('id_kecamatan', isset($keluhan->id_kecamatan) ? "selected" : '') ?>><?= $row->nama_kecamatan ?></option>
                    <?php } ?>
                    </select>
                    <span class='help-inline'><?php echo form_error('id_kecamatan'); ?></span>
                </div>
            </div>

            <div class="form-group<?php echo form_error('isi_keluhan') ? ' error' : ''; ?>">
                <?php echo form_label(lang('keluhan_field_isi_keluhan') . lang('bf_form_label_required'), 'isi_keluhan', array('class' => 'form-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <textarea name="isi_keluhan" id="isi_keluhan" class="form-control" rows="8" required><?php echo set_value('isi_keluhan', isset($keluhan->isi_keluhan) ? $keluhan->isi_keluhan : '') ?>
                    </textarea>
                    <span class='help-inline'><?php echo form_error('isi_keluhan'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('keluhan_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/keluhan', lang('keluhan_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>