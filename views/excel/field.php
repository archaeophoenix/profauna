<div class="row">
  <div class="col-xs-6">
    <div class="card card-mini">
      <div class="card-header">Import Biodata Dari Excel</div>
      <div class="card-body">
        <form class="form form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo url; ?>excel/import">
          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-xs-4 control-label">VIA Pendaftaran</label>
                <div class="col-xs-8">
                  <input style="border-radius: 50px;" type="file" name="file" placeholder="Import Dari Excel" class="fa fa-upload btn btn-default" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </div>
              </div>
            </div>
          </div>
          <div class="form-footer">
            <div class="form-group">
              <div class="col-xs-4 col-xs-offset-8 text-right">
                <button type="submit" class="btn btn-primary btn-xs" title="Simpan"><i class="fa fa-check"></i></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>