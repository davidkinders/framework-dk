<?php
use Helpers\Url;
use Helpers\Hooks;
use Helpers\AdminLTE\AdminLTE;
use Helpers\AdminLTE\Assets;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?=$data['title']?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php
    Assets::addToHeader("css", Url::templatePath() . 'bootstrap/css/bootstrap.min.css');
    Assets::addToHeader("css", Url::templatePath() . 'plugins/bootstrap-dialog/css/bootstrap-dialog.min.css');   
    Assets::addToHeader("css", Url::templatePath() . 'plugins/font-awesome/css/font-awesome.min.css');
    Assets::addToHeader("css", Url::templatePath() . 'dist/css/AdminLTE.min.css');   
    Assets::addToHeader("css", Url::templatePath() . 'plugins/iCheck/square/blue.css');   
 
    echo (Assets::renderHeader("css")); 
    
    Assets::addToFooter("js", Url::templatePath() . 'plugins/jQuery/jQuery-2.1.4.min.js');   
    Assets::addToFooter("js", Url::templatePath() . 'bootstrap/js/bootstrap.min.js');   
    Assets::addToFooter("js", Url::templatePath() . 'plugins/iCheck/icheck.min.js'); 
    Assets::addToFooter("js", Url::templatePath() . 'plugins/bootstrap-dialog/js/bootstrap-dialog.min.js'); 
    ?>
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="/login"><b>SMVC</b>dk</a>
      </div>
      <div class="login-box-body">
        <p class="login-box-msg"><?=$data['login_text']?></p>
        <form action="/login" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="username" />
            <span class="form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" />
            <span class="form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="rememberme"> Remember Me
                </label>
              </div>
            </div>
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form>
        <a href="/profile/forgot">I forgot my password</a><br>
      </div>
    </div>
    
<?php
echo Assets::renderFooter("js");
echo Assets::renderFooterScript();
?>   
  <script>
    $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
      BootstrapDialog.alert('<?="qsd"?>');
    </script>
  </body>
</html>
