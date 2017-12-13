<?php
Assets::add_js('js/tinymce/tinymce.min.js');
Assets::add_js("tinymce.init({selector:'textarea#isi_artikel'});", 'inline');
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
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="form-group<?php echo form_error('judul_artikel') ? ' error' : ''; ?>">
                <?php echo form_label(lang('artikel_field_judul_artikel') . lang('bf_form_label_required'), 'judul_artikel', array('class' => 'control-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <input id='judul_artikel' class='form-control' type='text' required='required' name='judul_artikel' maxlength='35' value="<?php echo set_value('judul_artikel', isset($artikel->judul_artikel) ? $artikel->judul_artikel : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('judul_artikel'); ?></span>
                </div>
            </div>

            <div class="form-group<?php echo form_error('tgl_terbit_artikel') ? ' error' : ''; ?>">
                <?php echo form_label(lang('artikel_field_tgl_terbit_artikel'), 'tgl_terbit_artikel', array('class' => 'control-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <input id='tgl_terbit_artikel' type='date' name='tgl_terbit_artikel' maxlength='30' class="form-control" value="<?php echo set_value('tgl_terbit_artikel', isset($artikel->tgl_terbit_artikel) ? $artikel->tgl_terbit_artikel : date('Y-m-d')); ?>" />
                    <span class='help-inline'><?php echo form_error('tgl_terbit_artikel'); ?></span>
                </div>
            </div>

            <div class="form-group<?php echo form_error('isi_artikel') ? ' error' : ''; ?>">
                <?php echo form_label(lang('artikel_field_isi_artikel'), 'isi_artikel', array('class' => 'control-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <textarea name="isi_artikel" class="form-control" id="isi_artikel" rows="8">
                    <?= set_value('isi_artikel', isset($artikel->isi_artikel) ? $artikel->isi_artikel : '') ?>
                    </textarea>
                    <span class='help-inline'><?php echo form_error('isi_artikel'); ?></span>
                </div>
            </div>

            <div class="form-group<?php echo form_error('kategori_artikel') ? ' error' : ''; ?>">
                <?php echo form_label(lang('artikel_field_kategori_artikel'), 'kategori_artikel', array('class' => 'control-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <select name="kategori_artikel" class="form-control">
                     <option value="Profil" <?= (set_value('kategori_artikel') == "Profil") ? "selected" : ''; ?>>Profil</option>
                     <option value="Publik" <?= (set_value('kategori_artikel') == "Publik")? "selected" : ''; ?>>Berita & Informasi Publik</option>
                     <option value="Pengumuman" <?= (set_value('kategori_artikel') == "Pengumuman") ? "selected" : ''; ?>>Pengumuman</option>
                    </select>
                    <span class='help-inline'><?php echo form_error('kategori_artikel'); ?></span>
                </div>
            </div>
            
            <div class="form-group">
                <?php echo form_label('Foto Informasi', 'images', array('class' => 'control-label col-sm-4')); ?>
                <div class='controls col-sm-8'>
                    <input type="hidden" name="foto_informasi" value=""/>
                    <input id='images' type='file' name='images' class="form-control"/>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('artikel_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/artikel', lang('artikel_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>