<div class="row">
  
  <div class="col-xs-6">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Jabatan</div>
      </div>
      <div class="card-body no-padding">
        <div class="table-responsive">
          <table class="datatable card-table table table-striped primary" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="text-align: center;">#</th>
                <th><p class="text-center">Jabatan</p></th>
                <th><p class="text-center">Atasan</p></th>
                <th><p class="text-center">Opsi</p></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($jabatan as $key => $value){ ?>
              <tr>
                <td id="no<?php echo $key;?>"><?php echo $key+1; ?></td>
                <td><?php echo $value['nama'];?></td>
                <td><?php echo $value['atasan']; ?></td>
                <td>
                  <?php if (is_null($id)){ ?>
                  <p class="text-center">
                    <button type="button" onclick="window.location='<?php echo url.'jabatan/datas/'.$value['id'];?>'" title="Edit" class="btn badge badge-info badge-icon"><i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button type="button" onclick="window.location='<?php echo url.'jabatan/inactive/'.$value['id'];?>'" title="Hapus" class="btn badge badge-danger badge-icon"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
      <div class="card-header"><?php echo (is_null($id)) ? 'Tambah' : 'Edit' ; ?> Jabatan</div>
      <div class="card-body">
        <form class="form form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo url.'jabatan/creup/'.$data['id']; ?>">
          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-xs-4 control-label">Jabatan</label>
                <div class="col-xs-8">
                  <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                  <input type="hidden" class="id_jabatan" value="<?php echo $data['id']; ?>">
                  <input style="border-radius: 50px;" type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" placeholder="Jabatan">
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-4 control-label">Atasan</label>
                <div class="col-xs-8">
                  <select name="id_atasan" style="border-radius: 50px;" class="select2 form-control" id="id_jabatan">
                    <option value="">&nbsp;</option>
                    <?php foreach ($atasan as $key => $value){ ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo ($data['id_atasan'] == $value['id']) ? 'selected="selected"' : '' ; ?>><?php echo $value['nama'] ?></option>
                    <?php } ?>
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
                <button type="button" class="btn btn-danger btn-xs" onclick="window.location='<?php echo url.'jabatan' ?>'" title="Batal"><i class="fa fa-close"></i></button>
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
            <?php foreach ($jabatan as $key => $value){ ?>
            <tr>
              <td><?php echo $value['id']; ?></td>
              <td><?php echo $value['id_atasan']; ?></td>
              <td><?php echo $value['nama']; ?></td>
              <td><?php echo $value['nama']; ?></td>
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