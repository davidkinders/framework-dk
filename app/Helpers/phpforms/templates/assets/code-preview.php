<?php
$source_code = file_get_contents(rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . $_SERVER['PHP_SELF']);
$title = 'Source Code';
if (preg_match('`<title>([^<]+)</title>`', $source_code, $out)) {
    $title = $out[1] . ' Source Code';
}
$source_code = htmlspecialchars(preg_replace('`\?>(\s)+<\?php /\* code preview button([^>])+>\n(\s)+<\?php\n(\s)+`', "", $source_code));
?>
<p></p>
<!-- Button trigger modal -->
<div class="text-right">
    <button type="button" id="view-src-btn" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">View source code</button>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <div class="modal-body">
        <pre class="prettyprint"><?php
                echo $source_code;
            ?>
        </pre>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Demo prettify code -->
<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
<!-- Demo Styles -->
<link href='http://fonts.googleapis.com/css?family=Dosis:300' rel='stylesheet' type='text/css'>
<style type="text/css">
    h1 {
        color: white;
        background: #006673;
        font-family: 'Dosis';
        font-weight: 300 !important;
        margin: 0 0 40px;
        padding: 10px;
        border-bottom: 5px solid #00343B;
    }
    .modal-dialog {
        width:80%;
        max-width:960px;
    }
    pre.prettyprint {
        font-size: 11px;
        padding: 5px 30px;
    }
    #view-src-btn {
        margin-bottom: -48px;
        font-size: 14px;
        padding: 1px 10px;
    }
</style>
