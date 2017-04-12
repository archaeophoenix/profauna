<div class="row">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">
        <div class="col-xs-2">
          <select class="select2" onchange="periode();" id="bulan">
          <?php foreach ($bulan as $key => $value){ ?>
            <option value="<?php echo $key; ?>" <?php echo ($key == $param['bulan']) ? 'selected="selected"' : '' ; ?>><?php echo $value; ?></option>
          <?php } ?>
          </select>
        </div>
        <div class="col-xs-2">
          <select class="select2" onchange="periode();" id="tahun">
          <?php foreach ($tahun as $key => $value){ ?>
            <option value="<?php echo $value['tahun']; ?>" <?php echo ($value['tahun'] == $param['tahun']) ? 'selected  ="selected"' : '' ; ?>><?php echo $value['tahun']; ?></option>
          <?php } ?>
          </select>
        </div>
      </div>
      <div class="card-body no-padding">
        <table class="datatable table table-striped primary" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="text-align: center;">#</th>
              <th style="text-align: center;">Event</th>
              <th style="text-align: center;">Type</th>
              <th style="text-align: center;">Pemimpin</th>
              <th style="text-align: center;">Periode</th>
              <th style="text-align: center;">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $key => $value){ ?>
            <tr>
              <td id="no<?php echo $key;?>"><?php echo $key+1; ?></td>
              <td id="nama<?php echo $value['id'];?>"><?php echo $value['nama']; ?></td>
              <td id="id_type<?php echo $value['id'];?>"><?php echo $value['type']; ?></td>
              <td id="pemimpin<?php echo $value['id'];?>"><?php echo $value['npemimpin']; ?></td>
              <td style="text-align: center;" id="tanggal_awal<?php echo $value['id'];?>"><?php echo date('d-m-Y',strtotime($value['tanggal_awal'])).' - '.date('d-m-Y',strtotime($value['tanggal_akhir'])); ?></td>
              <td>
                <button type="button" class="btn badge badge-info badge-icon" onclick='window.location="<?php echo url.'event/detail/'.$value['id']; ?>"' title="Detail"><i class="fa fa-newspaper-o"></i></button>
                <?php if (date('Y-m-d') <= $value['tanggal_awal']){ ?>
                  <button type="button" title="Edit" class="btn badge badge-primary badge-icon" onclick='window.location="<?php echo url.'event/form/'.$value['id']; ?>"'><i class="fa fa-edit"></i></button>
                  <button type="button" title="Peserta" class="btn badge badge-success badge-icon" onclick='window.location="<?php echo url.'event/peserta/'.$value['id']; ?>"'><i class="fa fa-users"></i></button>
                <?php } ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-xs-4 text-right"></div>
        <div class="col-xs-4 text-right"></div>
        <div class="col-xs-2 col-xs-offset-9 text-right">
          <button type="button" class="btn btn-xs btn-success" onclick="printpage('<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>');" title="Cetak"><i class="fa fa-print"></i></button>
          <button type="button" class="btn btn-xs btn-primary" onclick="tableToExcel('excel', 'Daftar Event');" title="Excel"><i class="fa fa-file-excel-o"></i></button>
        </div>
        <div class="col-xs-2 text-right"></div>
      </div>
      <div id="print" style="display: none;">
        <table class="table table-striped primary" cellspacing="0" width="100%" id="excel">
          <thead>
            <tr>
              <th style="text-align: center;">#</th>
              <th style="text-align: center;">Event</th>
              <th style="text-align: center;">Type</th>
              <th style="text-align: center;">Pemimpin</th>
              <th style="text-align: center;">Periode</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $key => $value){ ?>
            <tr>
              <td id="no<?php echo $key;?>"><?php echo $key+1; ?></td>
              <td id="nama<?php echo $value['id'];?>"><?php echo $value['nama']; ?></td>
              <td id="id_type<?php echo $value['id'];?>"><?php echo $value['type']; ?></td>
              <td id="pemimpin<?php echo $value['id'];?>"><?php echo $value['npemimpin']; ?></td>
              <td style="text-align: center;" id="tanggal_awal<?php echo $value['id'];?>"><?php echo date('d-m-Y',strtotime($value['tanggal_awal'])).' - '.date('d-m-Y',strtotime($value['tanggal_akhir'])); ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>