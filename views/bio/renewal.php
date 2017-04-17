<div class="row">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">Input Biodata</div>
      <div class="card-body">
        <div class="row">
          <div class="col-xs-12">
            <form class="form form-horizontal" method="post" action="<?php echo url.'bio/renewal/'.$data['id']; ?>">
              <div class="section">
                <div class="section-title">Registrasi Ulang</div>
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Via</label>
                    <div class="col-xs-9">
                      <?php if (!is_null($data['via'])){ ?>
                        <input type="hidden" name="id" value="<?php echo $data['via']; ?>">
                      <?php } ?>
                      <select class="select2" name="id_via" style="border-radius: 50px;">
                        <?php foreach ($via as $key => $value){ ?>
                          <option value="<?php echo $value['id']; ?>" <?php echo ($data['id_via'] == $value['id']) ? 'selected="selected"' : null ; ?>><?php echo $value['via']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Keanggotaan</label>
                    <div class="col-xs-9">
                      <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                      <input type="text" style="border-radius: 50px;" class="form-control" readonly="readonly" name="status" value="Supporter">
                      <!-- <select class="select2" name="status" style="border-radius: 50px;">
                        <option value="Supporter" <?php echo ($data['status'] == 'Supporter') ? 'selected="selected"' : null ; ?>>Supporter</option>
                        <option value="Simpatisan" <?php echo ($data['status'] == 'Simpatisan') ? 'selected="selected"' : null ; ?>>Simpatisan</option>
                      </select> -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Status Registrasi Kedepan</label>
                    <div class="col-xs-9">
                      <select class="select2" name="type" style="border-radius: 50px;">
                        <option value="0" <?php echo ($data['type'] == '0') ? 'selected="selected"' : null ; ?>>Registrasi Ulang</option>
                        <option value="1" <?php echo ($data['type'] == '1') ? 'selected="selected"' : null ; ?>>Tidak Registrasi Ulang</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Tanggal Registrasi</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control datepicker" name="tanggal" value="<?php echo date('d-m-Y'); ?>" placeholder="<?php echo date('d-m-Y'); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Keterangan</label>
                    <div class="col-xs-9">
                      <textarea style="border-radius: 15px;" class="form-control" name="keterangan" rows="3" placeholder="keterangan"><?php echo $data['keterangan']; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-footer">
                <div class="form-group">
                  <div class="col-xs-3 col-xs-offset-9 text-right">
                    <input type="hidden" id="acdata" value="data" rel="data">
                    <button type="submit" class="btn btn-primary btn-xs" title="Simpan"><i class="fa fa-check"></i></button>
                    <button type="button" class="btn btn-danger btn-xs" onclick="window.location='<?php echo url ?>'" title="Batal"><i class="fa fa-close"></i></button>
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