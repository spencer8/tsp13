<?php
//Template Name: Pricing Page
get_header(); ?>
<?php $nonce = wp_create_nonce('tsp_nonce'); ?>
<input type="hidden" id="tsp-nonce" value="<?php echo $nonce; ?>" />
<?php
	if(isset($_POST['submit'])) {
		if($_POST['lastname'] != ''){ 
			$hasError = true;
			?>
	<div class="content pricing-success">
		<h2>Thank You!</h2>
		<p>While you're waiting to hear back, feel free to check out some examples of our work</p>
		<a href="<?php bloginfo('url'); ?>/portfolio" class="pricing-link">Portfolio</a>
	</div>
<?php }
		if(trim($_POST['formname']) === '') {
			$formnameError = 'Please enter your name';
			$hasError = true;
		} else {
			$formname = trim($_POST['formname']);
		}
		
		if(trim($_POST['email']) === '') {
			$emailError = 'Please enter your email';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
		
		if(trim($_POST['duedate']) === '') {
		} else {
			$duedate = trim($_POST['duedate']);
		}

		if(trim($_POST['message']) === '') {
		} else {
			$message = trim($_POST['message']);
		}

		if(trim($_POST['project-details-style']) === '') {
		} else {
			$style = trim($_POST['project-details-style']);
		}

		if(trim($_POST['project-details-qty']) === '') {
		} else {
			$qty = trim($_POST['project-details-qty']);
		}

		if(trim($_POST['project-details-front']) === '') {
		} else {
			$front = trim($_POST['project-details-front']);
		}

		if(trim($_POST['project-details-back']) === '') {
		} else {
			$back = trim($_POST['project-details-back']);
		}

		if(trim($_POST['project-total']) === '') {
		} else {
			$total = trim($_POST['project-total']);
		}

		if(trim($_POST['project-peritem']) === '') {
		} else {
			$peritem = trim($_POST['project-peritem']);
		}

		if(!isset($hasError)) {
			$emailTo = 'pricing@triplestamppress.com';
			$subject = 'Pricing Calculator: Project request from '. $formname;

			$body = "Name: $formname \n\nEmail Address: $email \n\nDue Date: $duedate \n\nProject Type: $style \n\nQty: $qty \n\nFront colors: $front \n\nBack colors: $back \n\nTotal: $total \n\nPrice per item: $peritem \n\nMessage: $message";
			$headers = 'From: TSP Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
		 
			$result = wp_mail($emailTo, $subject, $body, $headers);
			if (!$result) {
				global $ts_mail_errors;
				global $phpmailer;
				if (!isset($ts_mail_errors)) $ts_mail_errors = array();
				if (isset($phpmailer)) {
					$ts_mail_errors[] = $phpmailer->ErrorInfo;
				}
			} else { ?>
		<div class="content pricing-success">
			<h2>Your Email has been sent!</h2>
			<p>While you're waiting to hear back, feel free to check out some examples of our work</p>
			<a href="<?php bloginfo('url'); ?>/portfolio" class="pricing-link">Portfolio</a>
		</div>
	<?php	}
			
			// echo '<pre>'; print_r($ts_mail_errors); echo '</pre>';
		}
	} else {
	
?>
	<div class="calculator open">
		<?php //Temporarily Down Notice
/* echo '<div style="max-width:680px;width:100%;margin:40px auto;text-align:center;background: #555;padding:3em;box-sizing:border-box;"><h2 style="
    margin-bottom: 20px;
    color: #DD604C;
">NOTICE: Our Online Pricing Calculator is temporarily down.</h2><p style="
    color: #C6C7BD;
    font-size: 1.125em;
">We are working to get it up and running again pronto. In the meantime, please contact info@triplestamppress.com for custom pricing. Thanks for your patience.</p></div>'; */ ?>
		<div
		<?php
		$graphic_options = get_option( 'tsp_calc_graphic_options' );
		$apparel_options = get_option( 'tsp_calc_apparel_options' );
		// echo '<pre>';
		// print_r($apparel_options);
		// echo '</pre>';
		?>
		<div class="calcbanner" title="Instant Pricing Calculator"><h3>Instant Pricing Calculator</h3></div>
		<div class="calc">
			<div id="ajaxLoader">
				<img src='<?php bloginfo('template_directory'); ?>/images/ajax-loader.gif' />
			</div>
			<div class="calctabs">
				<div class="tab apparel selected">
					<div class="tableft"></div>
					<h3>Apparel</h3>
					<div class="tabright"></div>
				</div>
				<div class="tab posters">
					<div class="tableft"></div>
					<h3>Posters</h3>
					<div class="tabright"></div>
				</div>
				<div class="tab stationery">
					<div class="tableft"></div>
					<h3>Stationery</h3>
					<div class="tabright"></div>
				</div>
				<div class="tab packaging">
					<div class="tableft"></div>
					<h3>Packaging</h3>
					<div class="tabright"></div>
				</div>
			</div>
			<div class="calcbox apparel selected">
				<div class="progress">
					<img class="progressbar" src="<?php bloginfo('template_directory'); ?>/images/progress-bar.png" width="620" height="19" alt="progress bar" />
					<div class="progress1 <?php echo (empty($post_cat)) ? 'on' : 'off'; ?>"></div>
					<div class="progress2 <?php echo (empty($post_cat)) ? 'off' : 'on'; ?>"></div>
					<div class="progress3 off"></div>
				</div>
				<div class="calcboxleft">
					<h4>choose apparel type</h4>
					<?php wp_dropdown_categories('show_option_none=--Select--&child_of=3&class=apparel-type type&name=type&selected='.$post_cat.''); ?>
				</div>
				<div class="calcboxright">
					<h4 <?php echo (empty($post_cat)) ? ' class="disabled"' : ''; ?>>choose style</h4>
					<select name="style" class="style" <?php echo (empty($post_cat)) ? 'disabled' : ''; ?>>
						<option value="" selected="selected" disabled="disabled">--Select--</option>
					</select>
					<h4 <?php echo (empty($post_cat)) ? ' class="disabled"' : ''; ?>>number of colors</h4>
					<label <?php echo (empty($post_cat)) ? ' class="disabled"' : ''; ?> for="front">Front</label>
					<select class="half" name="front" <?php echo (empty($post_cat)) ? 'disabled' : ''; ?>>
						<option value="0">0</option>
						<option value="1" selected="selected">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
					<label <?php echo (empty($post_cat)) ? ' class="disabled"' : ''; ?> for="back">Back</label>
					<select class="half" name="back" <?php echo (empty($post_cat)) ? 'disabled' : ''; ?>>
						<option value="0" selected="selected">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
					<h4 <?php echo (empty($post_cat)) ? ' class="disabled"' : ''; ?>>Quantity</h4>
					<input type="number" name="quantity" min="24" value="24" <?php echo (empty($post_cat)) ? 'disabled' : ''; ?> />
					<p class="p-right">
					total: <span class="h4 total">$</span><br>
					per item: <span class="h4 peritem">$</span>
					</p>
				</div>
				<div class="calculate">
					<div class="calculate-button cf <?php echo (empty($post_cat)) ? 'off' : 'on'; ?>"></div>
					<section>
					<?php if( get_field( "apparel_text" ) ): 
						 the_field( "apparel_text" ); 
					endif; ?>
					</section>
				</div>
			</div>
			<div class="calcbox posters">
				<div class="progress">
					<img class="progressbar" src="<?php bloginfo('template_directory'); ?>/images/progress-bar.png" width="620" height="19" alt="progress bar" />
					<div class="progress1 on"></div>
					<div class="progress2 off"></div>
					<div class="progress3 off"></div>
				</div>
				<div class="calcboxleft">
					<h4>choose paper type</h4>
					<select name="poster-type" id="poster-type" class="poster-type type">
						<option value="-1">--Select--</option>
					<?php
						$poster_types = get_field('types', 83);
// echo $poster_id;
// echo '<pre>';
// print_r($poster_types);
// echo '</pre>';
						foreach($poster_types as $type) {
							if($type["type_price"]) echo '<option value="'.$type["type_price"].'">'.$type["type_name"].'</option>';
						}
					?>
					</select>
				</div>
				<div class="calcboxright">
					<h4 class="disabled">choose size</h4>
					<select name="style" class="style" disabled="disabled">
						<option value="" selected="selected" disabled="disabled">--Select--</option>
						<?php
						$poster_sizes = get_field('sizes', 83);
						foreach($poster_sizes as $size) {
							echo '<option value="'.$size["price_prct"].'">'.$size["size"].'</option>';
						}
						?>
					</select>
					<h4 class="disabled">number of colors</h4>
					<label class="disabled" for="front">Front</label>
					<select class="half" name="front" disabled="disabled">
						<option value="0">0</option>
						<option value="1" selected="selected">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
					<label class="disabled" for="back">Back</label>
					<select class="half" name="back" disabled="disabled">
						<option value="0" selected="selected">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
					<h4 class="disabled">Quantity</h4>
					<input type="number" name="quantity" min="24" value="24" disabled="disabled" />
					<p class="p-right">
					total: <span class="h4 total">$</span><br>
					per item: <span class="h4 peritem">$</span>
					</p>
				</div>
				<div class="calculate">
					<div class="calculate-button cf off"></div>
					<section>
					<?php if( get_field( "posters_text" ) ): 
						 the_field( "posters_text" ); 
					endif; ?>
					</section>
				</div>
			</div>
			<div class="calcbox stationery">
				<div class="progress">
					<img class="progressbar" src="<?php bloginfo('template_directory'); ?>/images/progress-bar.png" width="620" height="19" alt="progress bar" />
					<div class="progress1 on"></div>
					<div class="progress2 off"></div>
					<div class="progress3 off"></div>
				</div>
				<div class="calcboxleft">
					<h4>choose paper type</h4>
					<select name="stat-type" id="stat-type" class="stat-type type">
						<option value="-1">--Select--</option>
					<?php
						$stat_types = get_field('types', 382);
						foreach($stat_types as $type) {
							if($type["type_price"]) echo '<option value="'.$type["type_price"].'">'.$type["type_name"].'</option>';
						}
					?>
					</select>
				</div>
				<div class="calcboxright">
					<h4 class="disabled">choose size</h4>
					<select name="style" class="style" disabled="disabled">
						<option value="" selected="selected" disabled="disabled">--Select--</option>
						<?php
						$stat_sizes = get_field('sizes', 382);
						foreach($stat_sizes as $size) {
							echo '<option value="'.json_encode($size["qty_price"]).'">'.$size["size"].'</option>';
						}
						?>
					</select>
					<h4 class="disabled">number of colors</h4>
					<label class="disabled" for="front">Front</label>
					<select class="half" name="front" disabled="disabled">
						<option value="0">0</option>
						<option value="1" selected="selected">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
					<label class="disabled" for="back">Back</label>
					<select class="half" name="back" disabled="disabled">
						<option value="0" selected="selected">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
					<h4 class="disabled">Quantity</h4>
					<select name="qty" class="qty threequart" disabled="disabled">
						<option value="" selected="selected" disabled="disabled">Choose Style First</option>
					</select>
					<p class="p-right">
					total: <span class="h4 total">$</span><br>
					per item: <span class="h4 peritem">$</span>
					</p>
				</div>
				<div class="calculate">
					<div class="calculate-button cf off"></div>
					<section>
					<?php if( get_field( "stationery_text" ) ): 
						 the_field( "stationery_text" ); 
					endif; ?>
					</section>
				</div>
			</div>
			<div class="calcbox packaging">
				<div class="progress">
					<img class="progressbar" src="<?php bloginfo('template_directory'); ?>/images/progress-bar.png" width="620" height="19" alt="progress bar" />
					<div class="progress1 on"></div>
					<div class="progress2 off"></div>
					<div class="progress3 off"></div>
				</div>
				<div class="calcboxleft">
					<h4>choose package type</h4>
					<select name="pack-type" id="pack-type" class="pack-type type">
						<option value="-1">--Select--</option>
					<?php
						$pack_types = get_field('types', 91);
						foreach($pack_types as $type) {
							echo "<option value='". json_encode($type['qty_range']) ."'>".$type['type_name']."</option>";
						}
					?>
					</select>
				</div>
				<div class="calcboxright">
					<h4 class="disabled">number of colors</h4>
					<label class="disabled" for="front">Front</label>
					<select class="half" name="front" disabled="disabled">
						<option value="0">0</option>
						<option value="1" selected="selected">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
					<label class="disabled" for="back">Back</label>
					<select class="half" name="back" disabled="disabled">
						<option value="0" selected="selected">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
					<h4 class="disabled">Quantity</h4>
					<select name="qty" class="qty threequart" disabled="disabled">
						<option value="" selected="selected" disabled="disabled">Choose Type First</option>
					</select>
					<p class="p-right">
					total: <span class="h4 total">$</span><br>
					per item: <span class="h4 peritem">$</span>
					</p>
				</div>
				<div class="calculate">
					<div class="calculate-button off cf"></div>
					<section>
					<?php if( get_field( "packaging_text" ) ): 
						 the_field( "packaging_text" ); 
					endif; ?>
					</section>
				</div>
			</div>
			<div class="calcbox get-started">
				<form id="get-started-form" class="post-form" action="" method="post">
				<div class="progress">
					<img class="progressbar" src="<?php bloginfo('template_directory'); ?>/images/progress-bar.png" width="620" height="19" alt="progress bar" />
					<div class="progress1 off"></div>
					<div class="progress2 off"></div>
					<div class="progress3 on"></div>
				</div>
				<div class="calcboxleft">
					<h3>your project details</h3>
					<span class="h4 style"></span>
					<p>
					QTY: <span class="qty"></span><br>
					Front Colors: <span class="front"></span><br>
					Back Colors: <span class="back"></span><br>
					</p>
					<p class="p-right">
					<span class="h4 total">$ PRICE</span> total<br>
					<span class="h4 peritem"> $ PRICE</span> per item
					</p>
					<p class="xxl">
					For apparel sizes XXL add $1 per unit. XXXL add $2 per unit.
					</p>
				</div>
				<div class="calcboxright">
					<h3>contact us about your project</h3>
					<span class="h4">name</span>
					<input type="text" name="formname" value="" required />
					<span class="h4">email</span>
					<input type="email" name="email" value="" required />
					<span class="h4">project due</span>
					<input type="date" name="duedate" value="" />
					<span class="h4">message</span>
					<textarea name="message"></textarea>
					<input type="text" id="lastname" name="lastname" placeholder="Leave Blank If Human" autocomplete="off">
				</div>
				<div class="calculate">
					<input type="hidden" id="project-details-style" name="project-details-style" value="" />
					<input type="hidden" id="project-details-qty" name="project-details-qty" value="" />
					<input type="hidden" id="project-details-front" name="project-details-front" value="" />
					<input type="hidden" id="project-details-back" name="project-details-back" value="" />
					<input type="hidden" id="project-total" name="project-total" value="" />
					<input type="hidden" id="project-peritem" name="project-peritem" value="" />
					<input type="submit" class="calculate-button cf send" value="" name="submit" />
					<div class="calculate-button back"></div>
					<section>
					<?php if( get_field( "step_3_text" ) ): 
						 the_field( "step_3_text" ); 
					endif; ?>
					</section>
				</div>
				</form>
			</div>
			</div>
		</div>
	</div>
	<div class="zone1 pricing-page">
		<div class="content">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="single-col">
				<?php the_content(); ?>
			</div>
		<?php endwhile; // end of the loop. ?>
		</div>
	</div>
<?php } get_footer(); ?> 