<div class="row">

  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">Detail Informasi</div>
      <div class="card-body">
        <div class="card card-tab card-mini">
          <div class="card-header">
            <ul class="nav nav-tabs">
              <li role="tab1" class="active">
                <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Projek</a>
              </li>
              <li role="tab2" class="">
                <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Peserta</a>
              </li>
              <li role="tab3" class="">
                <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp;Report</a>
              </li>
            </ul>
          </div>
          <div class="card-body tab-content no-padding">

            <div role="tabpanel" class="tab-pane active" id="tab1">
              <div class="card-body">
                <div class="row">
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">nama</label>
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
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">Pemimpin</label>
                    <label class="col-xs-9 control-label text-capitalize">
                      <a onclick='window.location="<?php echo url.'bio/detail/'.$data['pemimpin']; ?>"' style="cursor: pointer;"><span class="badge badge-info badge-icon"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span><?php echo $data['npemimpin']; ?></span></span></a>
                    &nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">Penanggung Jawab</label>
                    <label class="col-xs-9 control-label text-capitalize">
                      <a onclick='window.location="<?php echo url.'bio/detail/'.$data['tanggungjawab']; ?>"' style="cursor: pointer;"><span class="badge badge-info badge-icon"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span><?php echo $data['ntanggungjawab']; ?></span></span></a>
                    &nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">periode</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo date('d/m/y',strtotime($data['tanggal_awal'])).' - '.date('d/m/y',strtotime($data['tanggal_akhir']));; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">Keterangan</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['keterangan']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">Event terkait</label>
                    <label class="col-xs-9 control-label text-capitalize">
                      <a onclick='window.location="<?php echo url.'event/detail/'.$data['id_event']; ?>"' style="cursor: pointer;"><span class="badge badge-info badge-icon"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span><?php echo $data['event']; ?></span></span></a>
                    &nbsp;</label>
                  </div>
                </div>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab2">
              <div class="card-body">
                <div class="row">
                  <div class="table-responsive">
                    <table class="datatable card-table table table-striped primary" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th style="text-align: center;">#</th>
                          <th><p class="text-center text-capitalize">Nama</p></th>
                          <th><p class="text-center text-capitalize">Lulus Event Terkait</p></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($member as $key => $value){ ?>
                        <tr>
                          <td id="no<?php echo $key;?>"><?php echo $key+1; ?></td>
                          <td><p class="text-capitalize"><a onclick='window.location="<?php echo url.'bio/detail/'.$value['id']; ?>"' style="cursor: pointer;"><span class="badge badge-info badge-icon"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span><?php echo $value['nama'];?></span></span></a></p></td>
                          <td><p class="text-capitalize"><?php echo $value['nilai'];?></p></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab3">
              <div class="card-body">
                <div id="print">
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
                          <label class="col-xs-4 control-label text-capitalize">Projek</label>
                          <label class="col-xs-8 control-label text-capitalize"><?php echo $data['nama']; ?>&nbsp;</label>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-4 control-label text-capitalize">lokasi</label>
                          <label class="col-xs-8 control-label text-capitalize"><?php echo $data['lokasi']; ?>&nbsp;</label>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-4 control-label text-capitalize">type projek</label>
                          <label class="col-xs-8 control-label text-capitalize"><?php echo $data['type']; ?>&nbsp;</label>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label class="col-xs-4 control-label text-capitalize">periode</label>
                          <label class="col-xs-8 control-label text-capitalize"><?php echo date('d/m/y',strtotime($data['tanggal_awal'])).' - '.date('d/m/y',strtotime($data['tanggal_akhir']));; ?>&nbsp;</label>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-4 control-label text-capitalize">Event terkait</label>
                          <label class="col-xs-8 control-label text-capitalize"><?php echo $data['event']; ?>&nbsp;</label>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-4 control-label text-capitalize">Keterangan</label>
                          <label class="col-xs-8 control-label text-capitalize"><?php echo $data['keterangan']; ?>&nbsp;</label>
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
                            <th style="text-align: center;">#</th>
                            <th><p class="text-center text-capitalize">Nama peserta</p></th>
                            <th><p class="text-center text-capitalize">Lulus Event Terkait</p></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($member as $key => $value){ ?>
                          <tr>
                            <td id="no<?php echo $key;?>"><?php echo $key+1; ?></td>
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
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="row">
                  <div class="col-xs-3 col-xs-offset-9 text-right">
                    <button type="button" class="btn btn-xs btn-success" onclick="printpage();" title="Cetak"><i class="fa fa-print"></i></button>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

</div>