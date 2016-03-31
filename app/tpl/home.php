<div class="container">

	<?php 
		if(isset($_SESSION['user'])){
			if($_COOKIE['user'] == 'admin'){
				$menu=array(
					'Home'=>APP_W.'home',
					'Dashboard'=>APP_W.'admin'
				); 
			}else{
				$menu=array(
					'Home'=>APP_W.'home',
					'Dashboard'=>APP_W.'users'
				);
			}
		}else{
			$menu=array(
				'Home'=>APP_W.'home',
				'Register'=>APP_W.'register'
			); 
		}
	?>

	<nav>
		<?php Menu::create($menu); ?>
	</nav>

	<div id="ads">
		<!--<div class="ad">
			<img src="" />
			<div>
				<h3></h3>
				<div class="ad-content"></div>
			</div>
		</div>-->
	</div>

</div>