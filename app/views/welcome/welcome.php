<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>

<p><?php echo $data['welcome_message'] ?></p>

<a class="btn btn-md btn-success" href="<?php echo DIR;?>subpage">
	Subpage
</a>

<?php
    echo "<pre>";
    print_r($data["dev"]);
    print_r($_SESSION);
    echo "</pre>";
?>