<div class="container" style="margin:70px auto;min-height:80vh">
 <div class="row">
  <div class="col-md-8">
   <ol class="breadcrumb">
    <li><a href="<?= base_url('') ?>">Home</a></li>
    <li class="active"><span>Konfirmasi Laporan</span></li>
   </ol>
   <h2><?= $judul ?></h2>
   <?php if($success) { ?>
   <p>Terima kasih telah melaporkan keluhan Anda. Kami akan menindaklanjuti keluhan tersebut dan mengabarkan laporannya kepada Anda.</p>
   <?php } else { ?>
   <p>Mohon maaf. Terdapat kesalahan pada sistem saat mengirim laporan. Cobalah beberapa saat lagi.</p>
   <?php } ?>
   <a href="<?= base_url('home') ?>"><< Kembali ke Halaman utama</a>
  </div>
 </div>
</div>