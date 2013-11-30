
	<div class="container" style="padding-bottom: 50px;">
		<div class="row row-offcanvas row-offcanvas-left">

			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
				<ul class="custom-list">
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(1)"><label>Manufacturer</label></a>
						<ul class="custom-sublist sublist_1" style="list-style: none;">
							<?php foreach ($manufacturers as $m) { ?>
								<li><label style="color: #ffffff;"><input type="checkbox" name="manufacturer" value="<?php echo $m['manufacturer_name']; ?>" onclick="findGuitars()">&nbsp;&nbsp;<?php echo $m['manufacturer_name']; ?></label></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(2)"><label>Pickup</label></a>
						<ul class="custom-sublist sublist_2" style="list-style: none;">
							<?php foreach ($pickups as $p) { ?>
								<li><label style="color: #ffffff;"><input type="checkbox" name="manufacturer" value="<?php echo $p['pickup_configuration']; ?>" onclick="findGuitars()">&nbsp;&nbsp;<?php echo $p['pickup_configuration']; ?></label></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(3)"><label>Bridge</label></a>
						<ul class="custom-sublist sublist_3" style="list-style: none;">
							<?php foreach ($bridges as $b) { ?>
								<li><label style="color: #ffffff;"><input type="checkbox" name="manufacturer" value="<?php echo $b['bridge_type']; ?>" onclick="findGuitars()">&nbsp;&nbsp;<?php echo $b['bridge_type']; ?></label></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(4)"><label>Price Range</label></a>
						<ul class="custom-sublist sublist_4" style="list-style: none;">
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="0-9999" onclick="findGuitars()">&nbsp;&nbsp;฿ 0 - ฿ 9,999</label></li>
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="10000-19999" onclick="findGuitars()">&nbsp;&nbsp;฿ 10,000 - ฿ 19,999</label></li>
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="20000-29999" onclick="findGuitars()">&nbsp;&nbsp;฿ 20,000 - ฿ 29,999</label></li>
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="30000-39999" onclick="findGuitars()">&nbsp;&nbsp;฿ 30,000 - ฿ 39,999</label></li>
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="40000-49999" onclick="findGuitars()">&nbsp;&nbsp;฿ 40,000 - ฿ 49,999</label></li>
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="50000-200000" onclick="findGuitars()">&nbsp;&nbsp;> ฿ 50,000</label></li>
						</ul>
					</li>
				</ul>
			</div>

			<div class="col-xs-12 col-sm-9">
				<!-- <?php
					$string = "test1";
					$split = explode("|", $string);
					print_r($split);
				?> -->
				<div class="panel panel-default custom-panel">
					<div class="panel-heading"><h3>Panel heading without title</h3></div>
					<div class="panel-body" style="margin-left: 20px; margin-right: 20px;">
						<div class="row">
							<div class="col-6 col-sm-6 col-lg-4">
								<h2>Heading</h2>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
								<p><a class="btn btn-default" href="#" role="button">View details »</a></p>
							</div><!--/span-->
							<div class="col-6 col-sm-6 col-lg-4">
								<h2>Heading</h2>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
								<p><a class="btn btn-default" href="#" role="button">View details »</a></p>
							</div><!--/span-->
							<div class="col-6 col-sm-6 col-lg-4">
								<h2>Heading</h2>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
								<p><a class="btn btn-default" href="#" role="button">View details »</a></p>
							</div><!--/span-->
							<div class="col-6 col-sm-6 col-lg-4">
								<h2>Heading</h2>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
								<p><a class="btn btn-default" href="#" role="button">View details »</a></p>
							</div><!--/span-->
							<div class="col-6 col-sm-6 col-lg-4">
								<h2>Heading</h2>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
								<p><a class="btn btn-default" href="#" role="button">View details »</a></p>
							</div><!--/span-->
							<div class="col-6 col-sm-6 col-lg-4">
								<h2>Heading</h2>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
								<p><a class="btn btn-default" href="#" role="button">View details »</a></p>
							</div><!--/span-->
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<script type="text/javascript">

		$(document).ready(function() {
			hide_all_sublist();
		});

		function hide_all_sublist() {
			for (var i = 1; i <= 4; i++) {
				$(".sublist_" + i).hide();
			}
		}

		function toggle_sublist(id) {
			$(".sublist_" + id).toggle();
		}

	</script>
