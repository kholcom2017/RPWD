<?php require_once('includes/connect.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php include('includes/header.php'); ?>
<div class='row carousel_section'>
	<div id='carousel' class='carousel slide' data-ride='carousel'>
			<!-- Indicators -->
			<ol class='carousel-indicators'>
				<li data-target="#carousel" data-slide-to="0" class></li>
				<li data-target="#carousel" data-slide-to="1" class></li>
				<li data-target="#carousel" data-slide-to="2" class></li>
			</ol>
			<div class='carousel-inner' role='listbox'>
				<div class='item first active'>
					<img class='first-slide slide' src='images/racetrack5.jpg' alt='First Slide' />
					<div class='container-fluid'>
						<div class='carousel-caption'>
							<h1 class='visible-xs'>Race Season is Fast Approaching</h1>
							<h1 class='hidden-xs'>Race Season is Fast Approaching</h1>
							<h3>Why not give your fans a place<br /> to get all the updated<br /> news?</h3>
							<p><button class='btn quote'>Get A Quote</button></p>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<div class='row' id='services'>
	<h2 style='text-align: center; text-decoration: underline;'>Services</h2>
	<?php 
		$services = get_services();
		foreach ($services as $service){ ?>
			<div class='visible-xs col-xs-10 col-xs-push-1 services'>
				<h3><?php echo $service['service']; ?></h3>
				<hr />
				<p><?php echo $service['description']; ?></p>
			</div>
			<div class='visible-sm col-sm-10 col-sm-push-1 services'>
				<h3><?php echo $service['service']; ?></h3>
				<hr />
				<p><?php echo $service['description']; ?></p>
			</div>
			<div class='visible-md visible-lg col-md-4 services'>
				<h3><?php echo $service['service']; ?></h3>
				<hr />
				<p><?php echo $service['description']; ?></p>
			</div>
		<?php } ?>
</div>
<?php include('includes/footer.php'); ?>