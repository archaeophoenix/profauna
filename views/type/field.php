<div class="row">
  
  <div class="col-xs-7">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Type Event / Projek</div>
      </div>
      <div class="card-body no-padding">
        <div class="table-responsive">
          <table class="datatable card-table table table-striped primary" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="text-align: center;">#</th>
                <th><p class="text-center">Type Event / Projek</p></th>
                <th><p class="text-center">Jenis Type</p></th>
                <th><p class="text-center">Opsi</p></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($type as $key => $value){ ?>
              <tr>
                <td id="no<?php echo $key;?>"><?php echo $key+1; ?></td>
                <td><?php echo $value['nama'];?></td>
                <td><?php
                switch ($value['kts']) {
                  case 1: echo "Verifikasi KTS"; break;
                  case 2: echo "Penyelamatan Satwa"; break;
                  default: echo "-"; break;
                }
                ?></td>
                <td>
                  <?php echo ($value['active'] == 0) ? '<p class="text-center">Inactive</p>' : '' ; ?>
                  <?php if (is_null($id) && $value['active'] == 1){ ?>
                  <p class="text-center">
                    <button type="button" onclick="window.location='<?php echo url.'type/datas/'.$value['id'];?>'" title="Edit" class="btn badge badge-info badge-icon"><i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button type="button" onclick="window.location='<?php echo url.'type/inactive/'.$value['id'];?>'" title="Hapus" class="btn badge badge-danger badge-icon"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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

  <div class="col-xs-5">
    <div class="card card-mini">
      <div class="card-header"><?php echo (is_null($id)) ? 'Tambah' : 'Edit' ; ?> Type Event / Projek</div>
      <div class="card-body">
        <form class="form form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo url.'type/creup/'.$data['id']; ?>">
          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-xs-4 control-label">Type Event / Projek</label>
                <div class="col-xs-8">
                  <input style="border-radius: 50px;" type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" placeholder="Type Event / Projek">
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-4 control-label">Jenis Type</label>
                <div class="col-xs-8">
                  <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                  <select name="kts" style="border-radius: 50px;" class="form-control">
                    <option value="0" <?php echo ($data['kts'] == 0) ? 'selected="selected"' : '' ; ?>>-</option>
                    <option value="1" <?php echo ($data['kts'] == 1) ? 'selected="selected"' : '' ; ?>>Verifikasi KTS</option>
                    <option value="2" <?php echo ($data['kts'] == 2) ? 'selected="selected"' : '' ; ?>>Penyelamatan Satwa</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-footer">
            <div class="form-group">
              <div class="col-xs-4 col-xs-offset-8 text-right">
                <button type="submit" class="btn btn-primary btn-xs" title="Simpan"><i class="fa fa-check"></i></button>
                <?php if (!is_null($id)){ ?>
                <button type="reset" onclick="window.location='http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>'" class="btn btn-warning btn-xs" title="ReSet"><i class="fa fa-undo"></i></button>
                <?php } ?>
                <button type="button" class="btn btn-danger btn-xs" onclick="window.location='<?php echo url.'type' ?>'" title="Batal"><i class="fa fa-close"></i></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>