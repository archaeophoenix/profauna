<div class="row">
  
  <div class="col-xs-7">
    <div class="card">
      <div class="card-header">
        <div class="col-xs-4">
          <input type="hidden" id="bulan" value="<?php echo $param['bulan']; ?>">
          <select class="select2" onchange="periode();" id="tahun">
          <?php foreach ($tahun as $key => $value){ ?>
            <option value="<?php echo $value['tahun']; ?>" <?php echo ($value['tahun'] == $param['tahun']) ? 'selected  ="selected"' : '' ; ?>><?php echo $value['tahun']; ?></option>
          <?php } ?>
          </select>
        </div>
      </div>
      <div class="card-body no-padding">
        <div class="table-responsive">
          <table class="datatable card-table table table-striped primary" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="text-align: center;">#</th>
                <th><p class="text-center">Staff</p></th>
                <th><p class="text-center">Jabatan</p></th>
                <th><p class="text-center">Periode</p></th>
                <th><p class="text-center">Opsi</p></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($staff as $key => $value){ ?>
              <tr>
                <td id="no<?php echo $key;?>"><?php echo $key+1; ?></td>
                <td>
                  <?php echo strtok($value['nama'], " ");?>
                  <input type="hidden" class="id_bio" value="<?php echo $value['id_bio']; ?>">
                </td>
                <td>
                  <?php echo $value['jabatan'];?>
                  <?php if ($data['id_jabatan'] != $value['id_jabatan']){ ?>
                  <input type="hidden" class="id_jabatan" value="<?php echo $value['id_jabatan']; ?>">
                  <?php } ?>
                </td>
                <td><?php echo date('y',strtotime($value['tanggal_awal'])).' - '.date('y',strtotime($value['tanggal_akhir'])) ;?></td>
                <td>
                  <?php if (is_null($id)){ ?>
                  <p class="text-center">
                    <button type="button" onclick="window.location='<?php echo url.'staff/datas/'.$param['bulan'].'/'.$param['tahun'].'/'.$value['id'];?>'" title="Edit" class="btn badge badge-info badge-icon"><i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button type="button" onclick="window.location='<?php echo url.'staff/inactive/'.$value['id'];?>'" title="Hapus" class="btn badge badge-danger badge-icon"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
      <div class="card-header"><?php echo (is_null($id)) ? 'Tambah' : 'Edit' ; ?> Staff</div>
      <div class="card-body">
        <form class="form form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo url.'staff/creup/'.$data['id']; ?>">
          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-xs-4 control-label">Staff</label>
                <div class="col-xs-8">
                  <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                  <input type="text" required="required" style="border-radius: 50px;" class="form-control autocomplete" value="<?php echo $data['nama']; ?>" rel="id_bio" id="bio">
                  <input type="hidden" name="id_bio" class="id_bio" id="id_bio" value="<?php echo $data['id_bio']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-4 control-label">Jabatan</label>
                <div class="col-xs-8">
                  <select required="required" name="id_jabatan" id="id_jabatan" style="border-radius: 50px;" class="form-control select2">
                    <option value=""></option>
                    <?php foreach ($jabatan as $key => $value){ ?>
                    <option value="<?php echo $value['id'] ?>" <?php echo ($data['id_jabatan'] == $value['id']) ? 'selected="selected"' : '' ; ?>><?php echo $value['nama'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-4 control-label">Tanggal Awal</label>
                <div class="col-xs-8">
                  <input required="required" style="border-radius: 50px;" type="text" class="form-control datepicker" name="tanggal_awal" value="<?php echo (empty($data['tanggal_awal'])) ? '' : date('d-m-Y',strtotime($data['tanggal_awal'])); ?>" placeholder="<?php echo date('d-m-Y'); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-4 control-label">Tanggal Awal</label>
                <div class="col-xs-8">
                  <input required="required" style="border-radius: 50px;" type="text" class="form-control datepicker" name="tanggal_akhir" value="<?php echo (empty($data['tanggal_akhir'])) ? '' : date('d-m-Y',strtotime($data['tanggal_akhir'])); ?>" placeholder="<?php echo date('d-m-Y',strtotime('+1 year',strtotime(date('d-m-Y')))); ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="form-footer">
            <div class="form-group">
              <div class="col-xs-4 col-xs-offset-8 text-right">
                <input type="hidden" id="baris" value="1">
                <input type="hidden" id="kts" value="0">
                <input type="hidden" id="acdata" class="id_" value="data/peserta/" rel="data/peserta/">
                <button type="submit" class="btn btn-primary btn-xs" title="Simpan"><i class="fa fa-check"></i></button>
                <?php if (!is_null($id)){ ?>
                <button type="reset" onclick="window.location='http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>'" class="btn btn-warning btn-xs" title="ReSet"><i class="fa fa-undo"></i></button>
                <?php } ?>
                <button type="button" class="btn btn-danger btn-xs" onclick="window.location='<?php echo url.'staff' ?>'" title="Batal"><i class="fa fa-close"></i></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-xs-12">
    <div class="card card-mini">
      <div class="card-header">Bagan Organisasi</div>
      <div class="card-body">
        <div id="people"></div>
        <div style="float: right; width: 10%; height:100%; text-align:center; display: none;" >
          <table id="orgChartData">
            <tr>
              <th>id</th>
              <th>parent id</th>
              <th>name</th>
              <th>title</th>
              <th>image</th>
            </tr>
            <?php foreach ($staff as $key => $value){ ?>
            <tr>
              <td><?php echo $value['id_jabatan']; ?></td>
              <td><?php echo $value['id_atasan']; ?></td>
              <td><?php echo $value['nama']; ?></td>
              <td><?php echo $value['jabatan']; ?></td>
              <td><?php echo url; ?>/assets/images/profile.png</td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="<?php echo url; ?>assets/js/getorgchart.js"></script>
  <script type="text/javascript">
  var peopleElement = document.getElementById("people");
  var orgChart = new getOrgChart(peopleElement, {
      theme: "deborah",
      orientation: getOrgChart.RO_LEFT_PARENT_TOP,
      linkType: "B", 
      enableDetailsView: false,
      enableEdit: false,
      enableMove: false,
      enableZoom: false,
      gridView: true,
      enableSearch: false,
      primaryFields: ["name", "title"],
      photoFields: ["image"],
      enableGridView: true,
      dataSource: document.getElementById("orgChartData")
  });
  </script>
  
</div>