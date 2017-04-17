    <footer class="app-footer"> 
      <div class="row">
        <div class="col-xs-12">
          <div class="footer-copyright">
            Copyright © 2016 ProFauna - Powered by Laabana Lab.
          </div>
        </div>
      </div>
    </footer>
    </div>
  </div>
  <input type="hidden" id="base" value="<?php echo url; ?>">
  <?php if (isset($link)){ ?>
    <input type="hidden" id="link" value="<?php echo $link; ?>">
  <?php } ?>
</body>

<script type="text/javascript" src="<?php echo url; ?>assets/js/vendor.js"></script>
<script type="text/javascript" src="<?php echo url; ?>assets/js/app.js"></script>
<!-- date-range-picker -->
<script src="<?php echo url; ?>assets/js/moment.min.js"></script>
<script src="<?php echo url; ?>assets/js/daterangepicker.js"></script>

<script type="text/javascript" src="<?php echo url; ?>assets/js/custom.js"></script>
<script type="text/javascript" src="<?php echo url; ?>assets/js/excel.js"></script>

</html>