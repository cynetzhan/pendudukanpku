<script>
var dataSkorCamat = <?= json_encode($sarana) ?>;
var kecamatanColors = <?= json_encode($warna) ?>;
var kecamatanID = <?= json_encode($kecamatan) ?>;
var barChartData = {
	labels: <?= json_encode(array_keys($sarana)) ?>,
	datasets: [{
			label: 'Data Sarana',
			backgroundColor: [<?php $c=1; foreach($warna as $wn) { echo "'".hex2rgba($wn,0.7)."'"; if($c < count($warna)) {echo ","; $c++;} } ?>],
			borderColor: 'rgba(0,0,0,.7)',
			borderWidth: 1.6,
			data: [<?php $c=1; foreach($sarana as $sr) { echo $sr['hasil']; if($c < count($sarana)) {echo ","; $c++;} } ?>]
		}
	]
};
</script>
<div class="container-fluid">
  <div class="row">
  <div class="banner" style="background-color:#ddd;background-image:url('themes/default/images/panorama-pekanbaru.jpg');background-size:cover;background-position-y:-50px;">
   <div class="text-center" style="background-color:rgba(0,0,0,.5);color:#fff;padding:20px;min-height:50vh">
   <img src="<?= base_url('assets/images/pulgo.png') ?>" alt="logo dinas PUPR" />
   <h3>Selamat Datang di Sistem Informasi</h3>
   <h4>Pemetaan Potensi Daerah Pengembangan Kawasan Pemukiman Layak Huni</h4>
   <p class="lead"><strong>Dinas Pekerjaan Umum Pekanbaru</strong></p>
   </div>
  </div>
  </div>
</div>
<div class="container-fluid">
 <div class="row">
  <div class="col-sm-12">
   <!--canvas id="chartaja"></canvas-->
  </div>
 </div>
 <div class="row">
  <div class="col-sm-12" id="mapcol" style="box-shadow: 0 0 10px rgba(0,0,0,0.5)">
       <div id="sidebar">
        <div class="sidebar-wrapper">
          <div class="panel panel-primary" id="features">
            <div class="panel-heading">
              <h3 class="panel-title">Points of Interest
              <button type="button" class="btn btn-xs btn-default pull-right" id="sidebar-hide-btn"><i class="fa fa-chevron-left"></i></button></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-8 col-md-8">
                  <input type="text" class="form-control search" placeholder="Filter" />
                </div>
                <div class="col-xs-4 col-md-4">
                  <button type="button" class="btn btn-primary pull-right sort" data-sort="feature-name" id="sort-btn"><i class="fa fa-sort"></i>&nbsp;&nbsp;Sort</button>
                </div>
              </div>
            </div>
            <div class="sidebar-table">
              <table class="table table-hover" id="feature-list">
                <thead class="hidden">
                  <tr>
                    <th>Icon</th>
                  <tr>
                  <tr>
                    <th>Name</th>
                  <tr>
                  <tr>
                    <th>Chevron</th>
                  <tr>
                </thead>
                <tbody class="list"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div id="map" style="min-height:90vh"></div>
    <div id="loading">
      <div class="loading-indicator">
        <div class="progress progress-striped active">
          <div class="progress-bar progress-bar-info progress-bar-full"></div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" style="z-index:1050">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title text-primary" id="feature-title"></h4>
          </div>
          <div class="modal-body">
           <ul class="nav nav-tabs nav-justified" id="infoTab">
              <li class="active">
               <a href="#feature-info" data-toggle="tab"><i class="fa fa-question-circle"></i>&nbsp;Informasi Tempat</a>
              </li>
              <li>
               <a href="#form-aduan" data-toggle="tab"><i class="fa fa-envelope"></i>&nbsp;Form Pengaduan</a>
              </li>
            </ul>
            <div class="tab-content" id="featureContent">
             <div class="tab-pane fade active in" id="feature-info"></div>
             <div class="tab-pane fade in" id="form-aduan">
             <?php 
             if($this->auth->is_logged_in()) { 
             $user = $this->auth->user();
             ?>
             <br>
              <?php echo form_open_multipart(base_url('home/aksi_lapor'),'name="formaduan" class="form-horizontal"'); ?>
               <div class="form-group row">
                <label class="control-label col-sm-4" >Nama Pelapor<br><small style="color:red"></small></label>
                <div class="col-sm-8" style="padding-top:7px">
                 <?= $user->display_name ?>
                 <input type='hidden' class="form-control" name="id_user" value="<?= $user->id ?>">
                </div>
               </div>
               <div class="form-group row">
                <label class="control-label col-sm-4" >Keluhan/Laporan<br><small style="color:red"><em>(*)</em></small></label>
                <div class="col-sm-8" style="padding-top:7px">
                 <textarea class="form-control" name="isi_keluhan"></textarea>
                </div>
               </div>
               
               <div class="form-group row">
                <label class="control-label col-sm-4" >Kecamatan</label>
                <div class="col-sm-8" style="padding-top:7px">
                 <input type='hidden' class="form-control" name="id_kecamatan" id="form_id_kec" value="" /><span id="span_id_kec"></span>
                </div>
               </div>
               
               <div class="form-group row">
                <label class="control-label col-sm-4" >Foto Pendukung</label>
                <div class="col-sm-8" style="padding-top:7px">
                 <input type='file' class="form-control" name="foto_pendukung" />
                </div>
               </div>

               <div class="form-group row">
                <div class="col-sm-offset-8 col-sm-4">
                 <button type="submit" class="btn btn-primary"  name="submit" style="float:right">Kirim Laporan</button>
                </div>
               </div>
              </form>
             <?php } else { ?>
              
              <p class="text-center">
              <span class="fa fa-sign-in" style="font-size:6em;margin:20px;color:#aaa"></span><br>
               <strong>Sebelum melaporkan, mohon <a href="<?php echo site_url(REGISTER_URL); ?>">mendaftar</a> terlebih dahulu atau <a href="<?php echo site_url(LOGIN_URL); ?>">masuk</a></strong>
              </p>
             <?php } ?>
             </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
  </div>
 </div>
</div>