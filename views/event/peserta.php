<div class="row">
  <div class="col-xs-6">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Peserta Event <?php echo $data['type'] ?></div>
        <?php if ($edit != 'edit' && date('Y-m-d') >= $data['tanggal_akhir'] && date('Y-m-d') <= date('Y-m-d',strtotime('+3 day',strtotime($data['tanggal_akhir']))) ) { ?>
        <ul class="card-action">
          <li class="dropdown">
            <a class="dropdown-toggle" title="Edit" style="cursor: pointer;" onclick="window.location='http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'/edit'; ?>'" data-toggle="dropdown"><i class="fa fa-edit" aria-hidden="true"></i></a>
            <!-- <ul class="dropdown-menu">
              <li><a href="#">Action 1</a></li>
              <li><a href="#">Action 2</a></li>
              <li><a href="#">Action 3</a></li>
            </ul> -->
          </li>
        </ul>
        <?php } ?>
      </div>
      <div class="card-body no-padding">
        <input type="hidden" class="id_bio" value="">
        <input type="hidden" class="id_bio" value="<?php echo $data['pemimpin']; ?>">
        <input type="hidden" class="id_bio" value="">
        <input type="hidden" class="id_bio" value="<?php echo $data['tanggungjawab']; ?>">
        <form class="form form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo url.'event/nilai/'.$data['id']; ?>">
          <div class="table-responsive">
            <table class="table card-table">
              <thead>
                <tr>
                  <th align="center">Peserta</th>
                  <th align="center">KTS</th>
                  <th align="center">KTD</th>
                  <th align="center">Jenis</th>
                  <th align="center"><?php echo (date('Y-m-d') > $data['tanggal_akhir']) ? 'Keterangan' : 'Hapus' ; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php $lulus = 0; foreach ($peserta as $key => $value){ ?>
                <tr>
                  <td>
                    <?php echo strtok($value['peserta'], " ");?>
                    <input type="hidden" class="id_bio" name="id_bio[<?php echo $value['id']; ?>]" value="<?php echo $value['idb']; ?>">
                    <input type="hidden" name="id_user[<?php echo $value['id']; ?>]" value="<?php echo $_SESSION['id']; ?>">
                  </td>
                  <td><?php echo $value['kts'];?></td>
                  <td><?php echo $value['status'];?></td>
                  <td><?php echo ($value['jenis'] == 0) ? 'Peserta' : 'Pemateri' ;?></td>
                  <td>
                  <?php if (date('Y-m-d') > $data['tanggal_awal']){ ?>
                    <?php if ($edit == 'edit'){ ?>
                      <?php if($value['nilai'] != 'Lulus') { ?>
                      <div class="checkbox">
                        <input id="checkbox<?php echo $value['id'] ?>" type="checkbox" style="border-radius: 50px;" class="form-control text-right" name="nilai[<?php echo $value['id']; ?>]" value="Lulus">
                        <label for="checkbox<?php echo $value['id'] ?>">Lulus</label>
                      </div>
                      <?php } else { $lulus += 1; ?>
                        <label class="text-center">Lulus</label>
                      <?php } ?>
                    <?php } else {
                      echo '<p class="text-center">'.$value['nilai'].'</p>';
                    } ?>
                  <?php } else { ?>
                    <button type="button" title="Hapus" onclick="window.location='<?php echo url.'event/rem/'.$value['id'].'/'.$data['id']; ?>';" class="btn badge badge-danger badge-icon"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                  <?php } ?>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="form-footer">
            <div class="form-group">
              <div class="col-xs-4 col-xs-offset-8 text-right">
              <?php if ($lulus != count($peserta) && $edit == 'edit' && date('Y-m-d') >= $data['tanggal_akhir'] && date('Y-m-d') <= date('Y-m-d',strtotime('+3 day',strtotime($data['tanggal_akhir']))) ) { ?>
                <button type="submit" class="btn btn-primary btn-xs" title="Simpan"><i class="fa fa-check"></i></button>
                <button type="reset" onclick="window.location='http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>'" class="btn btn-warning btn-xs" title="ReSet"><i class="fa fa-undo"></i></button>
                <button type="button" class="btn btn-danger btn-xs" onclick="window.location='<?php echo url.'event/peserta/'.$data['id']; ?>'" title="Batal"><i class="fa fa-close"></i></button>
              <?php } /*else { echo '<meta http-equiv="refresh"  content="0; url='.url.'event/peserta/"'.$data['id'].' />'; }*/ ?>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php if (date('Y-m-d') < $data['tanggal_awal']){ ?>
  <div class="col-xs-6">
    <div class="card card-mini">
      <div class="card-header">Tambah Peserta</div>
      <div class="card-body">
        <form class="form form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo url.'event/add/'.$data['id'].'/'.$data['id_projek']; ?>">
          <div class="table-responsive">
            <table class="table card-table">
              <thead>
                <tr>
                  <th>Nama Peserta</th>
                  <th>Jenis</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody id="peserta">
                <tr id="baris1">
                  <td><input type="text" style="border-radius: 50px;" class="form-control autocomplete" rel="id_bio1" id="bio1"><input type="hidden" name="id_bio[]" class="id_bio" id="id_bio1"></td>
                  <td align="center">
                    <input type="hidden" name="id_user[]" value="<?php echo $_SESSION['id']; ?>">
                    <select name="jenis[]" style="border-radius: 50px;" class="form-control select2">
                      <option value="0">Peserta</option>
                      <option value="1">Pemateri</option>
                    </select>
                  </td>
                  <td align="center"><button type="button" title="Hapus" onclick="minus(1);" class="btn badge badge-danger badge-icon"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-footer">
            <div class="form-group">
              <div class="col-xs-4 col-xs-offset-8 text-right">
                <input type="hidden" id="baris" value="1">
                <input type="hidden" id="kts" value="<?php echo $data['kts'] ?>">
                <input type="hidden" id="acdata" class="id_" value="data/peserta/" rel="data/peserta/">
                <button type="submit" class="btn btn-primary btn-xs" title="Simpan"><i class="fa fa-check"></i></button>
                <button type="button" onclick="plus();" class="btn btn-success btn-xs" title="Tambah Baris"><i class="fa fa-plus"></i></button>
                <button type="reset" onclick="window.location='http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>'" class="btn btn-warning btn-xs" title="ReSet"><i class="fa fa-undo"></i></button>
                <button type="button" class="btn btn-danger btn-xs" onclick="window.location='<?php echo url.'event' ?>'" title="Batal"><i class="fa fa-close"></i></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>
  <!-- <div class="col-xs-6">
    <div class="card card-tab card-mini">
      <div class="card-header">
        <ul class="nav nav-tabs">
          <li role="tab1" class="active">
            <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Card Tab 1</a>
          </li>
          <li role="tab2">
            <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Card Tab 2</a>
          </li>
        </ul>
      </div>
      <div class="card-body tab-content no-padding">
        <div role="tabpanel" class="tab-pane active" id="tab1">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
        </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nullaip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nullaip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
        </div>
      </div>
    </div>
  </div> -->
</div>