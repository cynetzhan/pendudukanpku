 <div class="row">
  <div class="col-md-8">
  <ol class="breadcrumb">
   <li><a href="<?= base_url('') ?>">Home</a></li>
   <li class="active"><span><?= $profil->judul_artikel ?></span></li>
  </ol>
  <h2><?= $profil->judul_artikel ?></h2>
  <p><small>Ditulis pada <?= tanggal($profil->tgl_terbit_artikel,true) ?></small></p>
      <?= $profil->isi_artikel ?>
  </div>
  <div class="col-md-4">
  <h4>Profil DKP Kota Pekanbaru</h4>
  <ul class="nav nav-pills nav-stacked">
   <?php foreach($prolist as $pro) { ?>
    <li <?= ($profil->id_artikel == $pro->id_artikel)?"class='active'":"" ?>><a href="<?= base_url('home/profil/'.$pro->id_artikel) ?>"><?= $pro->judul_artikel ?></a></li>
   <?php } ?>
  </ul>
  </div>
 </div>
