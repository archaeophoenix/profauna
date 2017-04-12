<div class="row">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">Input Event</div>
      <div class="card-body">
        <div class="row">
          <div class="col-xs-12">
            <form class="form form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo url.'event/submit/'.$data['id']; ?>">
              <div class="section">
                <div class="section-title">Event</div>
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Event</label>
                    <div class="col-xs-9">
                      <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                      <input style="border-radius: 50px;" type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" placeholder="Nama Event">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Foto</label>
                    <div class="col-xs-9">
                      <input type="file" name="foto" class="fa fa-upload btn btn-default" accept="image/*">
                      <?php if (!empty($data['id'])){ ?>
                        <input type="hidden" name="otof" value="<?php echo $data['foto'] ?>">
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Lokasi</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="text" class="form-control" name="lokasi" value="<?php echo $data['lokasi']; ?>" placeholder="lokasi">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Type</label>
                    <div class="col-xs-9">
                      <select class="select2" name="id_type">
                        <?php foreach ($type as $key => $value){ ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo ($value['id'] == $data['id_type']) ? 'selected="selected"' : '' ; ?>><?php echo $value['nama'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Jenis Satwa<p style="color: #E74C3C;font-size: 10px;">jika diperlukan</p></label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="text" class="form-control" name="satwa" value="<?php echo $data['satwa']; ?>" placeholder="Orang Utan">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Pemimpin</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="text" class="form-control autocomplete" rel="pemimpin" value="<?php echo $data['npemimpin']; ?>" placeholder="Pemimpin">
                      <input type="hidden" name="pemimpin" class="id_bio" value="<?php echo $data['pemimpin']; ?>" id="pemimpin">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Penanggung Jawab</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="text" class="form-control autocomplete" rel="tanggungjawab" value="<?php echo $data['ntanggungjawab']; ?>" placeholder="Penanggun gJawab">
                      <input type="hidden" name="tanggungjawab" class="id_bio" value="<?php echo $data['tanggungjawab']; ?>" id="tanggungjawab">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Projek</label>
                    <div class="col-xs-9">
                      <select class="select2" name="id_projek">
                        <option value="">Tanpa Project</option>
                        <?php foreach ($projek as $key => $value){ ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo ($value['id'] == $data['id_projek']) ? 'selected="selected"' : '' ; ?>><?php echo $value['nama'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">keterangan</label>
                    <div class="col-xs-9">
                      <textarea style="border-radius: 15px;" class="form-control" name="keterangan" rows="3" placeholder="keterangan"><?php echo $data['keterangan']; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Tanggal Mulai</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control datepicker" name="tanggal_awal" value="<?php echo (empty($data['tanggal_awal'])) ? date('d-m-Y') : date('d-m-Y', strtotime($data['tanggal_awal'])); ?>" placeholder="<?php echo date('d-m-Y') ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Tanggal Berakhir</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control datepicker" name="tanggal_akhir" value="<?php echo (empty($data['tanggal_akhir'])) ? date('d-m-Y') : date('d-m-Y', strtotime($data['tanggal_akhir'])); ?>" placeholder="<?php echo date('d-m-Y') ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-footer">
                <div class="form-group">
                  <div class="col-xs-3 col-xs-offset-9 text-right">
                  <input type="hidden" id="baris" value="1">
                  <input id="acdata" class="id_" value="data/peserta/" rel="data/peserta/" type="hidden">
                    <button type="submit" class="btn btn-primary btn-xs" title="Simpan"><i class="fa fa-check"></i></button>
                    <button type="button" class="btn btn-danger btn-xs" onclick="window.location='<?php echo url.'event' ?>'" title="Batal"><i class="fa fa-close"></i></button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>