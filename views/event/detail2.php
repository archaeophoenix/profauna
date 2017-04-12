<div class="row">

  <div class="col-xs-12">
    <div class="card">
      <div class="print">
      <div class="card-header">Detail Informasi</div>

        <div class="card-body">
          <div class="row">
            <div class="col-xs-4">
              <div class="media-left">
                <a class="media-left" href="#"><img style="max-height: 200px; max-width: 200px; height: auto; width: auto;" class="media-object" src="<?php echo url.'/assets/images' ?>/profauna.jpg" alt="Profauna"></a>
              </div>
            </div>
          </div>
          <div class="col-xs-12">&nbsp;</div>
          <div class="col-xs-12">&nbsp;</div>
          <div class="row">
            <div class="col-xs-12">
              <div class="col-xs-6">
                <div class="form-group">
                  <label class="col-xs-3 control-label text-capitalize">Event</label>
                  <label class="col-xs-9 control-label text-capitalize"><?php echo $data['nama']; ?>&nbsp;</label>
                </div>
                <div class="form-group">
                  <label class="col-xs-3 control-label text-capitalize">lokasi</label>
                  <label class="col-xs-9 control-label text-capitalize"><?php echo $data['lokasi']; ?>&nbsp;</label>
                </div>
                <div class="form-group">
                  <label class="col-xs-3 control-label text-capitalize">type projek</label>
                  <label class="col-xs-9 control-label text-capitalize"><?php echo $data['type']; ?>&nbsp;</label>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="form-group">
                  <label class="col-xs-3 control-label text-capitalize">periode</label>
                  <label class="col-xs-9 control-label text-capitalize"><?php echo date('d/m/y',strtotime($data['tanggal_awal'])).' - '.date('d/m/y',strtotime($data['tanggal_akhir']));; ?>&nbsp;</label>
                </div>
                <div class="form-group">
                  <label class="col-xs-3 control-label text-capitalize">Projek terkait</label>
                  <label class="col-xs-9 control-label text-capitalize"><?php echo $data['projek']; ?>&nbsp;</label>
                </div>
                <div class="form-group">
                  <label class="col-xs-3 control-label text-capitalize">Keterangan</label>
                  <label class="col-xs-9 control-label text-capitalize"><?php echo $data['keterangan']; ?>&nbsp;</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">&nbsp;</div>
            <div class="col-xs-12">&nbsp;</div>
          </div>
          <div class="row">
            <div class="table-responsive">
              <table class="card-table table table-striped primary" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th><p class="text-center text-capitalize">Nama peserta</p></th>
                    <th><p class="text-center text-capitalize">Lulus Event Terkait</p></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($member as $key => $value){ ?>
                  <tr>
                    <td><p class="text-capitalize"><?php echo $value['nama'];?></p></td>
                    <td><p class="text-capitalize"><?php echo $value['nilai'];?></p></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-xs-12">&nbsp;</div>
          <div class="col-xs-12">&nbsp;</div>
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label class="text-center col-xs-12 control-label text-capitalize">Pemimpin</label>
                <label class="text-center col-xs-12 control-label text-capitalize">&nbsp;</label>
                <label class="text-center col-xs-12 control-label text-capitalize">&nbsp;</label>
                <label class="text-center col-xs-12 control-label text-capitalize">&nbsp;</label>
                <label class="text-center col-xs-12 control-label text-capitalize"><?php echo $data['npemimpin']; ?>&nbsp;</label>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label class="text-center col-xs-12 control-label text-capitalize">Penanggung Jawab</label>
                <label class="text-center col-xs-12 control-label text-capitalize">&nbsp;</label>
                <label class="text-center col-xs-12 control-label text-capitalize">&nbsp;</label>
                <label class="text-center col-xs-12 control-label text-capitalize">&nbsp;</label>
                <label class="text-center col-xs-12 control-label text-capitalize"><?php echo $data['ntanggungjawab']; ?>&nbsp;</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>