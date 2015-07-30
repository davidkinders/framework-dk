<?php
use Helpers\Url;
use Helpers\Hooks;
use Helpers\AdminLTE\AdminLTE;
use Helpers\AdminLTE\Assets;
?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> <?=VERSION?>
        </div>
        <strong>Copyright &copy; <?=COPYRIGHTYEAR?> <?=COPYRIGHT?>.</strong> All rights reserved.
      </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

<?php
echo Assets::renderFooter("js");
echo Assets::renderFooterScript();

echo Assets::getError();

?>

        </body>
</html>