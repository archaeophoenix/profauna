<div class="row">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">Input Biodata</div>
      <div class="card-body">
        <div class="row">
          <div class="col-xs-12">
            <form class="form form-horizontal" method="post" action="<?php echo url.'bio/submit/'.$data['id']; ?>">
              <div class="section">
                <div class="section-title">Biodata</div>
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Nama</label>
                    <div class="col-xs-9">
                      <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                      <input style="border-radius: 50px;" type="text" class="form-control" name="bio[nama]" value="<?php echo $data['nama']; ?>" placeholder="Nama Lengkap">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">KTP</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="text" class="form-control" name="bio[ktp]" value="<?php echo $data['ktp']; ?>" placeholder="111">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Email</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="text" class="form-control" name="bio[email]" value="<?php echo $data['email']; ?>" placeholder="em@i.l">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Facebook</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="text" class="form-control" name="bio[fb]" value="<?php echo $data['fb']; ?>" placeholder="email / username / URL">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Agama</label>
                    <div class="col-xs-9">
                      <select class="select2" name="bio[agama]" style="border-radius: 50px;">
                        <?php foreach ($agama as $key => $value){ ?>
                          <option value="<?php echo $value ?>" <?php echo ($data['agama'] == $value) ? 'selected="selected"' : null ; ?>><?php echo $value ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Telpon</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control" name="bio[telpon]" value="<?php echo $data['telpon']; ?>" placeholder="+62">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Telpon 2</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control" name="bio[telp]" value="<?php echo $data['telp']; ?>" placeholder="+62">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Kelamin</label>
                    <div class="col-xs-9">
                      <div class="radio radio-inline">
                        <input style="border-radius: 50px;" name="bio[kelamin]" id="radio10" value="Laki-Laki" type="radio" <?php echo ($data['kelamin'] == 'Laki-Laki') ? 'checked="checked"' : null ; ?>>
                        <label for="radio10">Laki-Laki</label>
                      </div>
                      <div class="radio radio-inline">
                        <input style="border-radius: 50px;" name="bio[kelamin]" id="radio11" value="Perempuan" type="radio" <?php echo ($data['kelamin'] == 'Perempuan') ? 'checked="checked"' : null ; ?>>
                        <label for="radio11">Perempuan</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Alamat</label>
                    <div class="col-xs-9">
                      <?php $alamat = explode('|', $data['alamat']); ?>
                      <input placeholder="Jalan Medan Merdeka Barat 21" name="bio[alamat]" style="border-radius: 50px;" type="text" class="form-control" value="<?php echo (!empty($data['id'])) ? trim($alamat[0]) : trim('') ; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">&nbsp;</label>
                    <div class="col-xs-9">
                      <input placeholder="Kelurahan Tinggal" name="bio[kelurahan]" style="border-radius: 50px;" type="text" class="form-control autocomplete" value="<?php echo (!empty($data['id']) && !empty($alamat[1])) ? trim($alamat[1]) : trim('') ; ?>" rel="id_kota">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Alamat 2</label>
                    <div class="col-xs-9">
                      <?php $address = explode('|', $data['address']); ?>
                      <input placeholder="Jalan Medan Merdeka Barat 21" name="bio[address]" style="border-radius: 50px;" type="text" class="form-control" value="<?php echo (!empty($data['id'])) ? trim($address[0]) : trim('') ; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">&nbsp;</label>
                    <div class="col-xs-9">
                      <input placeholder="Kelurahan Tinggal" name="bio[kel]" style="border-radius: 50px;" type="text" class="form-control autocomplete" value="<?php echo (!empty($data['id']) && !empty($address[1])) ? trim($address[1]) : trim('') ; ?>">
                      <input type="hidden" name="bio[id_kota]" value="<?php echo $data['id_kota']; ?>" id="id_kota">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Tempat Lahir</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control" name="bio[tempat_lahir]" value="<?php echo $data['tempat_lahir']; ?>" placeholder="Tempat Lahir">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Tanggal Lahir</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control datepicker" name="bio[tanggal_lahir]" value="<?php echo (empty($data['tanggal_lahir'])) ? date('d-m-Y') : date('d-m-Y', strtotime($data['tanggal_lahir'])); ?>" placeholder="<?php echo date('d-m-Y') ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Profesi</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control" name="bio[profesi]" value="<?php echo $data['profesi']; ?>" placeholder="Profesi">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Detail Profesi</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control" name="bio[detail_profesi]" value="<?php echo $data['detail_profesi']; ?>" placeholder="Detail Profesi">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Tempat Profesi</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control" name="bio[tempat_profesi]" value="<?php echo $data['tempat_profesi']; ?>" placeholder="Tempat Profesi">
                    </div>
                  </div>
                </div>
              </div>
              <div class="section">
                <div class="section-title">Registrasi</div>
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Via</label>
                    <div class="col-xs-9">
                      <?php if (!is_null($data['via'])){ ?>
                        <input type="hidden" name="via[id]" value="<?php echo $data['via']; ?>">
                      <?php } ?>
                      <select class="select2" name="via[id_via]" style="border-radius: 50px;">
                        <?php foreach ($via as $key => $value){ ?>
                          <option value="<?php echo $value['id']; ?>" <?php echo ($data['id_via'] == $value['id']) ? 'selected="selected"' : null ; ?>><?php echo $value['via']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Keanggotaan</label>
                    <div class="col-xs-9">
                      <select class="select2" name="via[status]" style="border-radius: 50px;">
                        <option value="Supporter" <?php echo ($data['status'] == 'Supporter') ? 'selected="selected"' : null ; ?>>Supporter</option>
                        <option value="Simpatisan" <?php echo ($data['status'] == 'Simpatisan') ? 'selected="selected"' : null ; ?>>Simpatisan</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Status Registrasi</label>
                    <div class="col-xs-9">
                      <select class="select2" name="via[type]" style="border-radius: 50px;">
                        <option value="0" <?php echo ($data['type'] == '0') ? 'selected="selected"' : null ; ?>>Registrasi Ulang</option>
                        <option value="1" <?php echo ($data['type'] == '1') ? 'selected="selected"' : null ; ?>>Tidak Registrasi Ulang</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Tanggal Registrasi</label>
                    <div class="col-xs-9">
                      <input style="border-radius: 50px;" type="" class="form-control datepicker" name="via[tanggal]" value="<?php echo (empty($data['tanggal'])) ? date('d-m-Y') : date('d-m-Y',strtotime($data['tanggal'])); ?>" placeholder="<?php echo date('d-m-Y'); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-3 control-label">Keterangan</label>
                    <div class="col-xs-9">
                      <textarea style="border-radius: 15px;" class="form-control" name="via[keterangan]" rows="3" placeholder="keterangan"><?php echo $data['keterangan']; ?></textarea>
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