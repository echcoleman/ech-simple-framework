<?php
/**
 * @uses string $title Title of page
 * @uses string $body Content body
 * @uses string $class Content class
 */
?>
<?php echo $this->view('page-elements/header', array('title' => $title)); ?>

<div id="content"<?php if (isset($class)) { echo ' class="'.$class.'"'; } ?>>
	<?php echo $body; ?>
</div><!-- #content -->

<?php echo $this->view('page-elements/footer'); ?>