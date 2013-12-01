
	<div class="container" style="padding-bottom: 15px;">
		<div class="row row-offcanvas row-offcanvas-left">

			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
				<ul class="custom-list">
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(1)"><label>Manufacturer</label></a>
						<ul class="custom-sublist sublist_1" style="list-style: none;">
							<?php foreach ($manufacturers as $m) { ?>
								<li><label style="color: #ffffff;"><input type="checkbox" name="manufacturer" value="<?php echo $m['manufacturer_name']; ?>" onclick="findGuitars(1)">&nbsp;&nbsp;<?php echo $m['manufacturer_name']; ?></label></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(3)"><label>Bridge</label></a>
						<ul class="custom-sublist sublist_3" style="list-style: none;">
							<?php foreach ($bridges as $b) { ?>
								<li><label style="color: #ffffff;"><input type="checkbox" name="bridge" value="<?php echo $b['bridge_type']; ?>" onclick="findGuitars(1)">&nbsp;&nbsp;<?php echo $b['bridge_type']; ?></label></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(7)"><label>Made In</label></a>
						<ul class="custom-sublist sublist_7" style="list-style: none;">
							<?php foreach ($madeins as $madein) { ?>
								<li><label style="color: #ffffff;"><input type="checkbox" name="madin" value="<?php echo $madein['made_in']; ?>" onclick="findGuitars(1)">&nbsp;&nbsp;<?php echo $madein['made_in']; ?></label></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(6)"><label>Number of Fret</label></a>
						<ul class="custom-sublist sublist_6" style="list-style: none;">
							<?php foreach ($frets as $f) { ?>
								<li><label style="color: #ffffff;"><input type="checkbox" name="manufacturer" value="<?php echo $f['number_of_fret']; ?>" onclick="findGuitars(1)">&nbsp;&nbsp;<?php echo $f['number_of_fret']; ?></label></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(5)"><label>Number of String</label></a>
						<ul class="custom-sublist sublist_5" style="list-style: none;">
							<?php foreach ($strings as $s) { ?>
								<li><label style="color: #ffffff;"><input type="checkbox" name="manufacturer" value="<?php echo $s['number_of_string']; ?>" onclick="findGuitars(1)">&nbsp;&nbsp;<?php echo $s['number_of_string']; ?></label></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(2)"><label>Pickup</label></a>
						<ul class="custom-sublist sublist_2" style="list-style: none;">
							<?php foreach ($pickups as $p) { ?>
								<li><label style="color: #ffffff;"><input type="checkbox" name="manufacturer" value="<?php echo $p['pickup_configuration']; ?>" onclick="findGuitars(1)">&nbsp;&nbsp;<?php echo $p['pickup_configuration']; ?></label></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="#" style="margin-left: -10px; font-size: 16px;" onclick="toggle_sublist(4)"><label>Price Range</label></a>
						<ul class="custom-sublist sublist_4" style="list-style: none;">
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="0-9999" onclick="findGuitars()">&nbsp;&nbsp;฿ 0 - ฿ 9,999</label></li>
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="10000-19999" onclick="findGuitars(1)">&nbsp;&nbsp;฿ 10,000 - ฿ 19,999</label></li>
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="20000-29999" onclick="findGuitars(1)">&nbsp;&nbsp;฿ 20,000 - ฿ 29,999</label></li>
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="30000-39999" onclick="findGuitars(1)">&nbsp;&nbsp;฿ 30,000 - ฿ 39,999</label></li>
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="40000-49999" onclick="findGuitars(1)">&nbsp;&nbsp;฿ 40,000 - ฿ 49,999</label></li>
							<li><label style="color: #ffffff;"><input type="checkbox" name="pricerange" value="50000-200000" onclick="findGuitars(1)">&nbsp;&nbsp;> ฿ 50,000</label></li>
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
					<div class="panel-heading">
                        <div class="row">
                        	<div class="col-sm-10">
	                        	<h3>Guitar Models</h3>
                            </div>
                        	<div class="col-sm-2">
                                <h3>
                                	<div class="btn-group">
                                		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="width:100px;">
                                			<strong>Sort By </strong><span class="caret"></span>
                                		</button>
                                		<ul class="dropdown-menu" role="menu">
                                			<li><a href="#" onclick="findGuitars(1)">Model Name A-Z</a></li>
                                			<li><a href="#" onclick="findGuitars(2)">Model Name Z-A</a></li>
                                			<li><a href="#" onclick="findGuitars(3)">Highest Price First</a></li>
                                			<li><a href="#" onclick="findGuitars(4)">Lowest Price First</a></li>
                                		</ul>
                                	</div>
                                </h3>
                            </div>
                        </div>
                    </div>
					<div class="panel-body" style="margin-left: 20px; margin-right: 20px;">
						<div class="row" id='guitarsDiv'>
							<?php for ($i = 1; $i < sizeof($guitars)/3 + 1; $i++) { ?>
								<div class="row">
									<?php for ($j = (3*$i)-3; $j < 3*$i && $j < sizeof($guitars); $j++) { 
										$guitar = $guitars[$j];		
									?>
										<div class="col-6 col-sm-6 col-lg-4" >
											<h2><?php echo $guitar['manufacturer_name']; ?></h2>
											<h5><?php echo $guitar['model_name']; ?></h5>
											<img src="<?php echo base_url(); ?>assets/images/<?php echo $guitar['model_name']; ?>.jpg" style="width: 237px;">
											<h5>Price ฿ <?php echo $guitar['price']; ?>.0</h5>
											<p><a class="btn btn-default" href="#" role="button" onclick="showGuitar(<?php echo $guitar['guitar_id']; ?>)">View details »</a></p>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
						<div class="row" id='guitarBox'>
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
			for (var i = 1; i <= 7; i++) {
				$(".sublist_" + i).hide();
			}
		}

		function toggle_sublist(id) {
			$(".sublist_" + id).toggle();
		}

	</script>
