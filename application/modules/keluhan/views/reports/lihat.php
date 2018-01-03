<?php
Assets::add_js(array('js/tinymce/tinymce.min.js','js/jquery.datetimepicker.full.min.js'));
echo Assets::css('css/jquery.datetimepicker.min.css');
Assets::add_js("tinymce.init({selector:'textarea#isi_keluhan'});$('#waktu_lapor').datetimepicker({format:'Y-m-d H:i:s'});", 'inline');
$id = isset($keluhan->id_keluhan) ? $keluhan->id_keluhan : '';

?>
<div class='admin-box'>
    <h3>Keluhan</h3>
    <table class="table table-striped table-bordered">
     <tr>
      <th>Pelapor</th>
      <td><?= $keluhan->display_name." (".$keluhan->username.")" ?></td>
     </tr>
     <tr>
      <th>Tanggal Keluhan</th>
      <td><?= tanggal($keluhan->waktu_lapor); ?></td>
     </tr>
     <tr>
      <th>Kecamatan</th>
      <td><?= $keluhan->nama_kecamatan ?></td>
     </tr>
    </table>
    <h4>Keterangan</h4>
    <p><img class="img img-responsive" src="<?= base_url('data/images/'.$keluhan->foto_pendukung) ?>" alt="foto"/></p>
    <p><?= $keluhan->isi_keluhan ?></p>
</div>