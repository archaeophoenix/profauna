<div class="row">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">&nbsp;</div>
      <form class="form form-horizontal" id="filter" method="post" action="<?php echo url; ?>bio/datas">
        <div class="card-header">
          <div class="col-xs-12">
            <label class="col-xs-2 control-label">Registrasi</label>
            <div class="col-xs-3 text-left">
              <div id="reportrange2" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; border-radius: 50px">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;<span id="span2"><?php echo (isset($_POST['awal']) && $_POST['null'] == 1) ? date('d F Y',strtotime($_POST['awal'])).' - '.date('d F Y',strtotime($_POST['akhir'])) : '' ; ?></span><b class="caret"></b>
              </div>
            </div>
            <label class="col-xs-2 control-label">Reg Ulang</label>
            <div class="col-xs-3">
              <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; border-radius: 50px">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;<span id="span"><?php echo (isset($_POST['awal']) && $_POST['null'] == 0) ? date('d F Y',strtotime($_POST['awal'])).' - '.date('d F Y',strtotime($_POST['akhir'])) : '' ; ?></span><b class="caret"></b>
              </div>
            </div>
            <div class="col-xs-2"><button type="submit" class="btn btn-primary btn-xl" title="Simpan"><i class="fa fa-search"></i></button></div>
          </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="card-header">
          <div class="col-xs-12">
            <label class="col-xs-2 control-label">Kota</label>
            <div class="col-xs-4">
              <input type="hidden" name="filter" id="param">
              <input type="hidden" id="range" name="range" onchange="tujuan();" value="<?php echo (isset($_POST['range'])) ? $_POST['range'] : 'registrasi.tanggal BETWEEN '."'".date('Y').'-'.date('m').'-01'."'".' AND '."'".date('Y').'-'.date('m').'-'.cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')).''."'" ; ?>">
              <input type="hidden" name="awal" value="<?php echo (isset($_POST['awal'])) ? $_POST['awal'] : '' ; ?>" id="awal">
              <input type="hidden" name="null" value="<?php echo (isset($_POST['null'])) ? $_POST['null'] : '' ; ?>" id="null">
              <input type="hidden" name="akhir" value="<?php echo (isset($_POST['akhir'])) ? $_POST['akhir'] : '' ; ?>" id="akhir">
              <select onchange="tujuan();" class="select2" id="kota" name="kota">
                <option value="" <?php echo (isset($_POST['kota']) && $_POST['kota'] == '') ? 'selected="selected"' : null ; ?>>&nbsp;</option>
              <?php foreach ($kota as $key => $value){ ?>
                <option value="<?php echo $value['kabupaten']; ?>" <?php echo (isset($_POST['kota']) && $_POST['kota'] == $value['kabupaten']) ? 'selected="selected"' : null ; ?>><?php echo $value['kabupaten']; ?></option>
              <?php } ?>
              </select>
            </div>
            <label class="col-xs-2 control-label">Propinsi</label>
            <div class="col-xs-4">
              <select onchange="tujuan();" class="select2" id="propinsi" name="propinsi">
                <option value="" <?php echo (isset($_POST['propinsi']) && $_POST['propinsi'] == '') ? 'selected="selected"' : null ; ?>>&nbsp;</option>
              <?php foreach ($propinsi as $key => $value){ ?>
                <option value="<?php echo $value['propinsi']; ?>" <?php echo (isset($_POST['propinsi']) && $_POST['propinsi'] == $value['propinsi']) ? 'selected="selected"' : null ; ?>><?php echo $value['propinsi']; ?></option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <label class="col-xs-2 control-label">Status</label>
            <div class="col-xs-4">
              <select onchange="tujuan();" class="select2" id="status" name="status">
                <option value="" <?php echo (isset($_POST['status']) && $_POST['status'] == '') ? 'selected="selected"' : null ; ?>>&nbsp;</option>
                <option value="Supporter" <?php echo (isset($_POST['status']) && $_POST['status'] == 'Supporter') ? 'selected="selected"' : null ; ?>>Supporter</option>
                <option value="Simpatisan" <?php echo (isset($_POST['status']) && $_POST['status'] == 'Simpatisan') ? 'selected="selected"' : null ; ?>>Simpatisan</option>
              </select>
            </div>
            <label class="col-xs-2 control-label">Type</label>
            <div class="col-xs-4">
              <select onchange="tujuan();" class="select2" id="type" name="type">
                <option value=""  <?php echo (isset($_POST['type']) && $_POST['type'] == '')  ? 'selected="selected"' : null ; ?>>&nbsp;</option>
                <option value="0" <?php echo (isset($_POST['type']) && $_POST['type'] == '0') ? 'selected="selected"' : null ; ?>>Registrasi Ulang</option>
                <option value="1" <?php echo (isset($_POST['type']) && $_POST['type'] == '1') ? 'selected="selected"' : null ; ?>>Tidak Registrasi Ulang</option>
              </select>
            </div>
          </div>
        </div>
      </form>
      <div class="card-body no-padding">
        <table class="datatable table table-striped primary" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="text-align: center;">#</th>
              <th style="text-align: center;">Nama</th>
              <th style="text-align: center;">Email</th>
              <th style="text-align: center;">Telpon</th>
              <th style="text-align: center;">Usia</th>
              <th style="text-align: center;">Tanggal Reg</th>
              <th style="text-align: center;">Status</th>
              <th style="text-align: center;">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $key => $value){ ?>
            <tr>
              <td><?php echo $key+1; ?></td>
              <td class="text-capitalize"><?php echo strtok($value['nama'], " "); ?></td>
              <td><?php echo strtok($value['email'], "/"); ?></td>
              <td><?php echo $value['telpon']; ?></td>
              <td><?php echo $value['usia']; ?></td>
              <td id="profesi<?php echo $value['id'];?>"><?php echo date('d-m-Y',strtotime($value['tanggal'])); ?></td>
              <td>
                <div><?php echo $value['status']; ?></div>
                <?php echo ($value['status'] == 'Simpatisan' && $value['type'] == 1) ? '<div class="badge badge-icon badge-danger text-center">Tidak Reg Ulang</div>' : '' ; ?>
              </td>
              <td class="text-center">
                <?php if ($value['status'] == 'Simpatisan'){ ?>
                  <?php if ($value['type'] == 0) { ?>
                    <button type="button" title="Registrasi Ulang" class="btn badge badge-icon badge-success" onclick="window.location='<?php echo url.'bio/reg/'.$value['id']; ?>'"><i class="fa fa-history"></i></button>
                  <?php } ?>
                <?php } else { ?>
                <button type="button" title="Edit" class="btn badge badge-icon badge-primary" onclick='window.location="<?php echo url.'bio/form/'.$value['id']; ?>"'><i class="fa fa-edit"></i></button>
                <?php } ?>
                <button type="button" class="btn badge badge-icon badge-info" onclick='window.location="<?php echo url.'bio/detail/'.$value['id']; ?>"' title="Detail"><i class="fa fa-newspaper-o"></i></button>
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
          <button type="button" class="btn btn-xs btn-primary" onclick="tableToExcel('excel', 'Daftar Anggotar');" title="Excel"><i class="fa fa-file-excel-o"></i></button>
        </div>
        <div class="col-xs-2 text-right"></div>
      </div>
      <div id="print" style="display: none;">
        <table class="table table-striped primary" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="text-align: center;">#</th>
              <th style="text-align: center;">Nama</th>
              <th style="text-align: center;">Email</th>
              <th style="text-align: center;">Telpon</th>
              <th style="text-align: center;">Usia</th>
              <th style="text-align: center;">Profesi</th>
              <th style="text-align: center;">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $key => $value){ ?>
            <tr>
              <td><?php echo $key+1; ?></td>
              <td class="text-capitalize"><?php echo $value['nama']; ?></td>
              <td><?php echo $value['email']; ?></td>
              <td><?php echo $value['telpon']; ?></td>
              <td><?php echo $value['usia']; ?></td>
              <td class="text-capitalize"><?php echo $value['profesi']; ?></td>
              <td>
                <div><?php echo $value['status']; ?></div>
                <?php echo ($value['status'] == 'Simpatisan' && $value['type'] == 1) ? '<div class="badge badge-icon badge-danger text-center">Tidak Reg Ulang</div>' : '' ; ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div style="display: none;">
        <table class="table table-striped primary" cellspacing="0" width="100%" id="excel">
          <thead>
            <tr>
              <th style="text-align: center;">Id</th>
              <th style="text-align: center;">KTS</th>
              <th style="text-align: center;">Nama</th>
              <th style="text-align: center;">Email</th>
              <th style="text-align: center;">Agama</th>
              <th style="text-align: center;">Alamat 1</th>
              <th style="text-align: center;">Alamat 2</th>
              <th style="text-align: center;">Telp 1</th>
              <th style="text-align: center;">Telp 2</th>
              <th style="text-align: center;">Profesi</th>
              <th style="text-align: center;">Sex</th>
              <th style="text-align: center;">Tempat lahir</th>
              <th style="text-align: center;">Tgl. Lahir</th>
              <th style="text-align: center;">Detil Profesi</th>
              <th style="text-align: center;">Tempat Profesi</th>
              <th style="text-align: center;">Status</th>
              <th style="text-align: center;">Tanggal Registrasi</th>
              <th style="text-align: center;">Type Registrasi</th>
              <th style="text-align: center;">Via</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $key => $value){ ?>
            <tr>
              <td class="text-capitalize"><?php echo $value['id']; ?></td>
              <td class="text-capitalize"><?php echo $value['kts']; ?></td>
              <td class="text-capitalize"><?php echo $value['nama']; ?></td>
              <td class="text-capitalize"><?php echo $value['email']; ?></td>
              <td class="text-capitalize"><?php echo $value['agama']; ?></td>
              <td class="text-capitalize"><?php echo $value['alamat']; ?></td>
              <td class="text-capitalize"><?php echo $value['address']; ?></td>
              <td class="text-capitalize"><?php echo $value['telpon']; ?></td>
              <td class="text-capitalize"><?php echo $value['telp']; ?></td>
              <td class="text-capitalize"><?php echo $value['profesi']; ?></td>
              <td class="text-capitalize"><?php echo $value['kelamin']; ?></td>
              <td class="text-capitalize"><?php echo $value['tempat_lahir']; ?></td>
              <td class="text-capitalize"><?php echo $value['tanggal_lahir']; ?></td>
              <td class="text-capitalize"><?php echo $value['detail_profesi']; ?></td>
              <td class="text-capitalize"><?php echo $value['tempat_profesi']; ?></td>
              <td class="text-capitalize"><?php echo $value['status']; ?></td>
              <td class="text-capitalize"><?php echo $value['tanggal']; ?></td>
              <td class="text-capitalize"><?php echo ($value['type'] == 0 )? 'PERPANJANG' : 'TIDAK PERPANJANG' ; ?></td>
              <td class="text-capitalize"><?php echo $value['chanel']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>        
      </div>
    </div>
  </div>
</div>