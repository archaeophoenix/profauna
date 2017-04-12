<div class="row">
  <div class="col-xs-4 col-xs-6 col-xs-6 col-xs-12">
    <a class="card card-banner card-green-light" onclick="window.location='<?php echo url ?>event'">
      <div class="card-body">
        <i class="icon fa fa-calendar fa-4x"></i>
        <div class="content">
          <div class="title">Event Bulan Ini</div>
          <div class="value"><span class="sign"></span><?php echo (empty($event['id'])) ? 0 : $event['id'] ; ?></div>
        </div>
      </div>
    </a>
  </div>

  <div class="col-xs-4 col-xs-6 col-xs-6 col-xs-12">
    <a class="card card-banner card-blue-light" onclick="window.location='<?php echo url ?>projek'">
      <div class="card-body">
        <i class="icon fa fa-tasks fa-4x"></i>
        <div class="content">
          <div class="title">Projek Bulan Ini</div>
          <div class="value"><span class="sign"></span><?php echo (empty($projek['id'])) ? 0 : $projek['id'] ; ?></div>
        </div>
      </div>
    </a>
  </div>

  <div class="col-xs-4 col-xs-6 col-xs-6 col-xs-12">
    <a class="card card-banner card-yellow-light" onclick="window.location='<?php echo url ?>bio'">
      <div class="card-body">
      <i class="icon fa fa-user-plus fa-4x"></i>
        <div class="content">
          <div class="title">Registrasi Baru Bulan Ini</div>
          <div class="value"><span class="sign"></span><?php echo (empty($registrasi['id'])) ? 0 : $registrasi['id'] ; ?></div>
        </div>
      </div>
    </a>
  </div>
</div>

<div class="row">
  <div class="col-xs-6 col-xs-6 col-xs-12 col-xs-12">
    <div class="card card-mini">
      <div class="card-body no-padding table-responsive">
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

  <div class="col-xs-6 col-xs-6 col-xs-12 col-xs-12">
    <div class="card card-tab card-mini">
      <div class="card-header">
        <ul class="nav nav-tabs tab-stats">
          <li role="tab1" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><?php echo date('Y'); ?></a></li>
          <li role="tab2"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Tahunan</a></li>
        </ul>
      </div>
      <div class="card-body tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab1">
          <div class="row">
            <div class="col-xs-8">
              <div class="chart ct-chart-browser ct-perfect-fourth"></div>
            </div>
            <div class="col-xs-4">
              <ul class="chart-label">
                <?php foreach ($reg as $key => $value){ ?>
                <li class="ct-label ct-series-<?php echo $abjad[$key]; ?> bulanan" rel="<?php echo $value['jumlah'] ?>"><?php echo $bulan[$value['bulan']-1]; ?></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
          <div class="row">
            <div class="col-xs-8">
              <div class="chart ct-chart-os ct-perfect-fourth"></div>
            </div>
            <div class="col-xs-4">
              <ul class="chart-label">
                <?php foreach ($regis as $key => $value){ ?>
                <li class="ct-label ct-series-<?php echo $abjad[$key]; ?> tahunan" rel="<?php echo $value['jumlah'] ?>"><?php echo $value['tahun']; ?></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>