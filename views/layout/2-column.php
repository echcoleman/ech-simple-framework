<?php
/**
 * @uses string $title Title of page
 * @uses string $body Content body
 * @uses string $class Content class
 */
?>
<?php echo $this->view('page-elements/header', array('title' => $title)); ?>

<div id="content">
	<?php echo $content; ?>
</div><!-- #content -->

<div id="sidebar">
	<?php
	if (!isset($sidebar)) {
		echo $this->view('page-elements/sidebar');
	}
	else {
		echo $sidebar;
	}
	?>
</div>

<?php echo $this->view('page-elements/footer'); ?>