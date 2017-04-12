<div class="row">
  
  <div class="col-xs-6">
    <div class="card">
      <div class="card-header">Daftar Pengguna</div>
      <div class="card-body no-padding">
        <div class="table-responsive">
          <table class="datatable card-table table table-striped primary" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="text-align: center;">#</th>
                <th><p class="text-center">Username</p></th>
                <th><p class="text-center">Status</p></th>
                <th><p class="text-center">Aktiv</p></th>
                <th><p class="text-center">Opsi</p></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($user as $key => $value){ ?>
              <tr>
                <td id="no<?php echo $key;?>"><?php echo $key+1; ?></td>
                <td><?php echo $value['username'];?></td>
                <td><?php echo ($value['active'] == 1) ? 'Aktiv' : 'Tidak Aktiv' ;?></td>
                <td><?php echo $hak[$value['status']-1];?></td>
                <td>
                  <?php if (is_null($id)){ ?>
                  <p class="text-center">
                    <button type="button" onclick="window.location='<?php echo (empty($value['nama'])) ? url.'bio/user/'.$value['id'] : url.'bio/user/'.$value['id_bio'] ;?>'" title="Edit" class="btn badge badge-info badge-icon"><i class="fa fa-edit" aria-hidden="true"></i></button>
                  </p>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xs-6">
    <div class="card card-mini">
      <div class="card-header">Input Pengguna</div>
      <div class="card-body">
        <form class="form form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo url.'bio/active/'.$data['id']; ?>">
          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-xs-4 control-label">Username</label>
                <div class="col-xs-8">
                  <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                  <input type="text" required="required" style="border-radius: 50px;" class="form-control" value="<?php echo $data['username']; ?>" name="username">
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-4 control-label">Password</label>
                <div class="col-xs-8">
                  <input type="password" <?php echo (empty($data['id'])) ? 'required="required"' : '' ; ?> style="border-radius: 50px;" class="form-control" name="password">
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-4 control-label">Status</label>
                <div class="col-xs-8">
                  <select name="status" style="border-radius: 50px;" class="form-control select2">
                    <option value="1" <?php echo ($data['status'] == 1) ? 'selected="selected"' : '' ; ?>>Admin</option>
                    <option value="2" <?php echo ($data['status'] == 2) ? 'selected="selected"' : '' ; ?>>Pimpinan</option>
                    <option value="3" <?php echo ($data['status'] == 3) ? 'selected="selected"' : '' ; ?>>Petugas</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-4 control-label">Aktiv</label>
                <div class="col-xs-8">
                  <select name="active" style="border-radius: 50px;" class="form-control select2">
                    <option value="1" <?php echo ($data['active'] == 1) ? 'selected="selected"' : '' ; ?>>Aktiv</option>
                    <option value="0" <?php echo ($data['active'] == 0) ? 'selected="selected"' : '' ; ?>>Tidak Aktiv</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-footer">
            <div class="form-group">
              <div class="col-xs-4 col-xs-offset-8 text-right">
                <input type="hidden" id="baris" value="1">
                <input type="hidden" id="acdata" class="id_" value="data/peserta/" rel="data/peserta/">
                <button type="submit" class="btn btn-primary btn-xs" title="Simpan"><i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger btn-xs" onclick="window.location='<?php echo url.'bio/user' ?>'" title="Batal"><i class="fa fa-close"></i></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  
</div>