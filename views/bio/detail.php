<div class="row">

  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">Detail Informasi</div>
      <div class="card-body">
        <div class="card card-tab card-mini">
          <div class="card-header">
            <ul class="nav nav-tabs">
              <li role="tab1" class="active">
                <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Biodata</a>
              </li>
              <li role="tab2" class="">
                <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Registrasi</a>
              </li>
              <li role="tab3" class="">
                <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp;Aktivitas</a>
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
                    <label class="col-xs-3 control-label text-capitalize">email</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['email']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">kepercayaan</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['agama']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">telpon</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['telpon']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">Alamat</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['alamat']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">profesi</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['profesi']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">kelamin</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['kelamin']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">usia</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['usia']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">tempat Tanggal lahir</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['tempat_lahir'].'  '.date('d M Y',strtotime($data['tanggal_lahir'])); ?>&nbsp;</label>
                  </div>
                </div>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab2">
              <div class="card-body">
                <div class="row">
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">profesi</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['detail_profesi']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">Kantor</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['tempat_profesi']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">pendaftaran via</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['chanel']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">Status Registrasi</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo ($data['type'] == 0) ? 'Perpanjang' : 'Tidak Perpanjang' ; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">status</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['status']; ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">tanggal registrasi</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo date('d M Y',strtotime($data['tanggal'])); ?>&nbsp;</label>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label text-capitalize">keterangan</label>
                    <label class="col-xs-9 control-label text-capitalize"><?php echo $data['keterangan']; ?>&nbsp;</label>
                  </div>
                </div>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab3">
              <div class="card-body">
                <div class="row">
                  <div class="table-responsive">
                    <table class="datatable card-table table table-striped primary" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th><p class="text-center text-capitalize">Event</p></th>
                          <th><p class="text-center text-capitalize">Lulus Event</p></th>
                          <th><p class="text-center text-capitalize">Periode Event</p></th>
                          <th><p class="text-center text-capitalize">Projek</p></th>
                          <th><p class="text-center text-capitalize">Periode Projek</p></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($member as $key => $value){ ?>
                        <tr>
                          <td><p class="text-capitalize">
                            <?php if (!empty($value['event'])){ ?>
                              <a onclick='window.location="<?php echo url.'event/detail/'.$value['id_event']; ?>"' style="cursor: pointer;"><span class="badge badge-info badge-icon"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span><?php echo $value['event'];?></span></span></a>
                            <?php } ?>
                          </p></td>
                          <td><p class="text-capitalize"><?php echo $value['nilai'];?></p></td>
                          <td><p><?php echo (empty($value['etanggal_awal'])) ? '&nbsp;' : date('d-m-y',strtotime($value['etanggal_awal'])).' - '.date('d-m-y',strtotime($value['etanggal_akhir'])); ?></p></td>
                          <td><p class="text-capitalize">
                              <?php if (!empty($value['projek'])){ ?>
                              <a onclick='window.location="<?php echo url.'projek/detail/'.$value['id_projek']; ?>"' style="cursor: pointer;"><span class="badge badge-primary badge-icon"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span><?php echo $value['projek'];?></span></span></a>
                            <?php } ?>
                          </p></td>
                          <td><p><?php echo (empty($value['ptanggal_awal'])) ? '&nbsp;' : date('d-m-y',strtotime($value['ptanggal_awal'])).' - '.date('d-m-y',strtotime($value['ptanggal_akhir'])); ?></p></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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