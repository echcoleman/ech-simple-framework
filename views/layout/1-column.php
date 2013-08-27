<?php
/**
 * @uses string $title Title of page
 * @uses string $content Content body
 */
?>
<?php echo $this->view('page-elements/header', array('title' => $title)); ?>

<div id="content">
	<?php echo $content; ?>
</div><!-- #content -->

<?php echo $this->view('page-elements/footer'); ?>