<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('artikel_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($artikel->id_artikel) ? $artikel->id_artikel : '';

?>
<div class='admin-box'>
    <h3>Artikel</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('judul_artikel') ? ' error' : ''; ?>">
                <?php echo form_label(lang('artikel_field_judul_artikel') . lang('bf_form_label_required'), 'judul_artikel', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='judul_artikel' type='text' required='required' name='judul_artikel' maxlength='35' value="<?php echo set_value('judul_artikel', isset($artikel->judul_artikel) ? $artikel->judul_artikel : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('judul_artikel'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('tgl_terbit_artikel') ? ' error' : ''; ?>">
                <?php echo form_label(lang('artikel_field_tgl_terbit_artikel'), 'tgl_terbit_artikel', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='tgl_terbit_artikel' type='text' name='tgl_terbit_artikel' maxlength='30' value="<?php echo set_value('tgl_terbit_artikel', isset($artikel->tgl_terbit_artikel) ? $artikel->tgl_terbit_artikel : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('tgl_terbit_artikel'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('isi_artikel') ? ' error' : ''; ?>">
                <?php echo form_label(lang('artikel_field_isi_artikel'), 'isi_artikel', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'isi_artikel', 'id' => 'isi_artikel', 'rows' => '5', 'cols' => '80', 'value' => set_value('isi_artikel', isset($artikel->isi_artikel) ? $artikel->isi_artikel : ''))); ?>
                    <span class='help-inline'><?php echo form_error('isi_artikel'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('kategori_artikel') ? ' error' : ''; ?>">
                <?php echo form_label(lang('artikel_field_kategori_artikel'), 'kategori_artikel', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='kategori_artikel' type='text' name='kategori_artikel' maxlength='15' value="<?php echo set_value('kategori_artikel', isset($artikel->kategori_artikel) ? $artikel->kategori_artikel : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('kategori_artikel'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('artikel_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/reports/artikel', lang('artikel_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Artikel.Reports.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('artikel_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('artikel_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>