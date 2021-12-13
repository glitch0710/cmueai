<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view("layouts/head-home") ?>
	<body class="nav-fixed">
	<?php $this->load->view("layouts/topbar") ?>
        <div id="layoutSidenav">
    <?php $this->load->view("layouts/sidebar") ?>
			<?php echo $content ;?>		
		</div>
	<?php $this->load->view("layouts/footer-home") ?>
	</body>
</html>