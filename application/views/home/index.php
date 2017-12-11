<script>
var dataSkorCamat = <?= json_encode($sarana) ?>;
var kecamatanColors = <?= json_encode($warna) ?>;
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
 <div class="jumbotron text-center" style="background-color:#ddd;background-image:url('themes/default/images/panorama-pekanbaru.jpg');background-size:cover;background-position-y:-50px;">
  <div class="row">
  <div class="col-sm-12" style="background-color:rgba(0,0,0,.5);color:#fff;padding:20px">
   <h3>Selamat Datang di Sistem Informasi</h3>
   <h4>Pemetaan Potensi Daerah Pengembangan Kawasan Pemukiman Layak Huni</h4>
   <p class="lead"><strong>Dinas Pekerjaan Umum Pekanbaru</strong></p>
   <a href="<?= base_url('home/peta') ?>" class="btn btn-primary"><span class="fa fa-map"></span> Buka Peta Informasi</a>
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
             <br>
              <?php echo form_open_multipart(base_url('home/aksi_lapor'),'name="formaduan" class="form-horizontal"'); ?>
               <div class="form-group row">
                <label class="control-label col-sm-4" >Nama Anda<br><small style="color:red"><em>(*)</em></small></label>
                <div class="col-sm-8">
                 <input type='text' class="form-control" name="nama_pe_laporanmas" maxlength="25" value="">
                </div>
               </div>
               <div class="form-group row">
                <label class="control-label col-sm-4" >Nomor Telepon<br><small style="color:red"><em>(*)</em></small></label>
                <div class="col-sm-8">
                 <input type='text' class="form-control" name="notel_laporanmas" maxlength="15" value="">
                </div>
               </div>
               <div class="form-group row">
                <label class="control-label col-sm-4" >Alamat E-mail<br><small style="color:red"></small></label>
                <div class="col-sm-8">
                 <input type='text' class="form-control" name="email_laporanmas" maxlength="35" value="">
                </div>
               </div>
               <div class="form-group row">
                <label class="control-label col-sm-4" >Keluhan/Laporan<br><small style="color:red"><em>(*)</em></small></label>
                <div class="col-sm-8">
                 <textarea class="form-control" name="isi_laporanmas"></textarea>
                </div>
               </div>
               <div class="form-group row">
                <label class="control-label col-sm-4" >Lokasi TPS</label>
                <div class="col-sm-8">
                 <input type='hidden' class="form-control" name="id_tps" id="form_id_tps" /><span id="span_id_tps"></span>
                </div>
               </div>
               <div class="form-group row">
                <label class="control-label col-sm-4" >Kecamatan</label>
                <div class="col-sm-8">
                 <input type='hidden' class="form-control" name="kecamatan_laporanmas" id="form_id_kec" value="" /><span id="span_id_kec"></span>
                </div>
               </div>
               <div class="form-group row">
                <label class="control-label col-sm-4" >Kelurahan</label>
                <div class="col-sm-8">
                 <input type='hidden' class="form-control" name="kelurahan_laporanmas" id="form_id_kel" value="" /><span id="span_id_kel"></span>
                </div>
               </div>
               <div class="form-group row">
                <label class="control-label col-sm-4" >Foto Bukti<br></label>
                <div class="col-sm-8">
                 <input type='file' class="form-control" name="foto_laporanmas" />
                </div>
               </div>
               <div class="form-group row">
                <div class="col-sm-offset-8 col-sm-4">
                 <button type="submit" class="btn btn-primary"  name="submit" style="float:right">Kirim Laporan</button>
                </div>
               </div>
              </form>
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