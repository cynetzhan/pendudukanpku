<div class="container" style="margin-top:70px;min-height:80vh">
 <div class="row">
  <div class="col-md-4">
   <div class="panel panel-success">
    <div class="panel-heading"><strong>Pencarian Informasi</strong></div>
    <div class="panel-body">
     <?= form_open(base_url('home/artikel')) ?>
      <div class="form-search search-only">
        <i class="search-icon glyphicon glyphicon-search"></i>
        <input type="text" class="form-control search-query" name="query" placeholder="Pencarian"/>
      </div>
      <br>
      <div class="form-group">
       <button type="submit" name="cari" class="form-control btn btn-default">Cari</button>
      </div>
     </form>
    </div>
   </div>
   </div>
   <div class="col-md-8">
   <div class="panel panel-primary">
    <div class="panel-heading">
     <strong>Pengumuman dan Informasi Publik</strong>
    </div>
    <div class="panel-body">  
     <?php if($artikel !== false) {
     foreach($artikel as $row){ ?>
     <div class="post-preview">
      <div class="media">
       <div class="media-left"><img src="<?= ($row->foto_informasi!=null)?base_url('data/images/'.$row->foto_informasi):base_url('data/images/'.'kat-1.png') ?>" alt="thumbs" class="media-object" style="max-height:100px;max-width:120px"/></div>
       <div class="media-body">
        <h2 class="media-heading"><a href="<?= base_url('home/profil/'.$row->id_artikel) ?>"><?= $row->judul_artikel ?></a></h2>
        </a> pada <?= tanggal($row->tgl_terbit_artikel) ?></small>
        <p>
        <?= text_preview($row->isi_artikel,5) ?>
        </p>
       </div>
      </div>
     </div>
     <hr>
     <?php }
     } else {
      echo "<p class='text-center'><strong> Tidak Ada Informasi Ditemukan </strong></p>";
     }
     ?>
    </div>
   </div>
  </div>
 </div>
</div>