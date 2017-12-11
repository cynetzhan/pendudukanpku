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
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <div class="row">
        <fieldset>
            <div class="form-group<?php echo form_error('nama_kecamatan') ? ' error' : ''; ?>">
                <?php echo form_label(lang('kecamatan_field_nama_kecamatan') . lang('bf_form_label_required'), 'nama_kecamatan', array('class' => 'control-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <input id='nama_kecamatan' class="form-control" type='text' required='required' name='nama_kecamatan' maxlength='25' value="<?php echo set_value('nama_kecamatan', isset($kecamatan->nama_kecamatan) ? $kecamatan->nama_kecamatan : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('nama_kecamatan'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <?php echo form_label("File Foto", 'file_foto', array('class' => 'control-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <input type="hidden" name="file_foto" class="form-control" value="<?php echo set_value('file_foto', isset($kecamatan->file_foto) ? $kecamatan->file_foto : ''); ?>" />
                    <input id='images' type='file' name='images' />
                    <span class='help-inline'><?php echo form_error('file_foto'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <?php echo form_label("Warna Pada Peta", 'warna_peta', array('class' => 'control-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <input type="color" name="warna_peta" class="form-control" value="<?php echo set_value('warna_peta', isset($kecamatan->warna_peta) ? $kecamatan->warna_peta : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('warna_peta'); ?></span>
                </div>
            </div>
        </fieldset>
        </div>
        <div class="row">
         <div class="col-sm-12" style="padding-bottom:20px">
         <h4>Foto Kecamatan Saat Ini</h4>
         <?php if(file_exists('data/images/'.$kecamatan->file_foto)) { ?>
         <img src="<?= base_url('data/images/'.$kecamatan->file_foto) ?>" alt='Foto Kecamatan' class="img img-responsive"/>
         <?php } else { ?>
         <h4>Belum ada foto</h4>
         <?php } ?>
         </div>
        </div>
        <fieldset class='form-actions' style="float:left;margin-bottom:20px">
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('kecamatan_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/kecamatan', lang('kecamatan_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Kecamatan.Content.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('kecamatan_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('kecamatan_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>