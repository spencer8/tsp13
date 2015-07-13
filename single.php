<?php
get_header(); ?>
<?php the_post(); ?>
<?php $nonce = wp_create_nonce('tsp_nonce'); ?>
<input type="hidden" id="tsp-nonce" value="<?php echo $nonce; ?>" />
	<div class="zone0">
<?php 
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	$imgDeets = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' );
	$is_portrait = is_portrait( $imgDeets[0] );
	if(in_category('apparel')) : ?>
		<div class="content<?php if( !$is_portrait ) echo ' flipoffset'; ?>">
			<?php
				$cats = wp_get_post_categories($post->ID);
				foreach($cats as $cat) {
					if(category_has_parent($cat)) {
						$post_cat = $cat;
					}
					else {
						// no parent
					}
				}
			?>
			<div class="productimg">
				<?php the_post_thumbnail('medium'); ?>
			</div>
			<div class="productinfo left" data-id="<?php echo $post->ID; ?>" data-slug="<?php echo $post->post_name; ?>" data-cat="<?php echo $post_cat; ?>">
				<h4><?php the_field('product_code'); ?></h4>
				<h2><?php the_title(); ?></h2>
				<div class="contentp">
					<?php the_content(); ?>
				</div>
				<?php if(get_field('sizes')): 
					while(has_sub_field('sizes')):
						$sizes[] = get_sub_field('size');
					endwhile;
					echo "<h4 class='sizes'>Sizes: ".implode(", ", $sizes ). "</h4>";
				endif; ?>
                <a class="rsrcelink" title="View our House Ink Colors" href="<?php bloginfo( 'url' ); ?>/resources/#HouseInks">View our House Ink Colors</a>
                <a class="rsrcelink templates" title="View our Art Preparation Templates" href="<?php bloginfo( 'url' ); ?>/resources/#Templates">View our Art Preparation Templates</a>
                <a class="rsrcelink samples" title="View our Samples" href="<?php bloginfo( 'url' ); ?>/portfolio">View our Samples</a>
                <div class="rsrcelink launchcalc" title="Instant Pricing Calculator">Instant Pricing Calculator</div>
			</div>
		</div>
<?php else : ?>
		<div class="content<?php if( !$is_portrait ) echo ' flipoffset'; ?>">
			<div class="productimg">
				<?php the_post_thumbnail('medium'); ?>
			</div>
			<div class="productinfo left">
				<h2><?php the_title(); ?></h2>
				<div class="contentp">
					<?php the_content(); ?>
				</div>
				<?php if(get_field('sizes')): 
					while(has_sub_field('sizes')):
						$sizes[] = get_sub_field('size');
					endwhile;
					echo "<h4>Sizes: ".implode(", ", $sizes ). "</h4>";
				endif; ?>
                <a class="rsrcelink" title="View our House Ink Colors" href="<?php bloginfo( 'url' ); ?>/resources/#HouseInks">View our House Ink Colors</a>
                <a class="rsrcelink templates" title="View our Art Preparation Templates" href="<?php bloginfo( 'url' ); ?>/resources/#Templates">View our Art Preparation Templates</a>
                <a class="rsrcelink samples" title="View our Samples" href="<?php bloginfo( 'url' ); ?>/portfolio">View our Samples</a>
                <div class="rsrcelink launchcalc" title="Instant Pricing Calculator">Instant Pricing Calculator</div>
			</div>
		</div>
<?php endif; ?>
	</div>
	<div class="calculator">
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
				<div class="tab apparel<?php if(in_category('apparel')) echo ' selected'; ?>">
					<div class="tableft"></div>
					<h3>Apparel</h3>
					<div class="tabright"></div>
				</div>
				<div class="tab posters<?php if(in_category('posters')) echo ' selected'; ?>">
					<div class="tableft"></div>
					<h3>Posters</h3>
					<div class="tabright"></div>
				</div>
				<div class="tab stationery<?php if(in_category('stationery')) echo ' selected'; ?>">
					<div class="tableft"></div>
					<h3>Stationery</h3>
					<div class="tabright"></div>
				</div>
				<div class="tab packaging<?php if(in_category('packaging')) echo ' selected'; ?>">
					<div class="tableft"></div>
					<h3>Packaging</h3>
					<div class="tabright"></div>
				</div>
				<div class="xboxwrap">
					<img class="xbox" src="<?php bloginfo('template_directory'); ?>/images/xbox.png" width="21" height="21" alt="close calculator" />
				</div>
			</div>
			<div class="calcbox apparel<?php if(in_category('apparel')) echo ' selected'; ?>">
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
					<div class="calculate-button <?php echo (empty($post_cat)) ? 'off' : 'on'; ?>"></div>
				</div>
			</div>
			<div class="calcbox posters<?php if(in_category('posters')) echo ' selected'; ?>">
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
					<div class="calculate-button off"></div>
				</div>
			</div>
			<div class="calcbox stationery<?php if(in_category('stationery')) echo ' selected'; ?>">
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
// echo $stat_id;
// echo '<pre>';
// print_r($stat_types);
// echo '</pre>';
						foreach($stat_types as $type) {
							if($type["type_price"]) echo '<option value="'.$type["type_price"].'">'.$type["type_name"].'</option>';
						}
					?>
					</select>
				</div>
				<div class="calcboxright">
					<h4 class="disabled">choose style</h4>
					<select name="style" class="style" disabled="disabled">
						<option value="" selected="selected" disabled="disabled">--Select--</option>
						<?php
						$stat_sizes = get_field('sizes', 382);
						foreach($stat_sizes as $size) {
							echo "<option value='". json_encode($size['qty_price']) ."'>".$size['size']."</option>";
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
					<div class="calculate-button off"></div>
				</div>
			</div>
			<div class="calcbox packaging<?php if(in_category('packaging')) echo ' selected'; ?>">
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
// echo $pack_id;
// echo '<pre>';
// print_r($pack_types);
// echo '</pre>';
						foreach($pack_types as $type) {
							echo "<option value='". json_encode($type['qty_range']) ."'>".$type['type_name']."</option>";
						}
					?>
					</select>
				</div>
				<div class="calcboxright">
					<h4 class="disabled">number of colors</h4>
					<label class="disabled" for="front">Outside</label>
					<select class="half" name="front" disabled="disabled">
						<option value="0">0</option>
						<option value="1" selected="selected">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
					<label class="disabled" for="back">Inside</label>
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
					<div class="calculate-button off"></div>
				</div>
			</div>
			<div class="calcbox get-started">
				<form id="get-started-form" class="post-form" action="<?php bloginfo('url'); ?>/pricing/" method="post">
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
					<p>
					Pricing does not include shipping and assumes a standard turnaround time of 10 business days plus transit. All pricing is subject to change once we review the art and project details.<br>
					Virginia sales tax applies to all liable Virginia-based customers.<br>
					There are many more products, t-shirts, and paper stocks available. If you are unable to find the right options for your project, email us the specifics and we will contact you directly.
					</p>
					<input type="hidden" id="project-details-style" name="project-details-style" value="" />
					<input type="hidden" id="project-details-qty" name="project-details-qty" value="" />
					<input type="hidden" id="project-details-front" name="project-details-front" value="" />
					<input type="hidden" id="project-details-back" name="project-details-back" value="" />
					<input type="hidden" id="project-total" name="project-total" value="" />
					<input type="hidden" id="project-peritem" name="project-peritem" value="" />
					<input type="submit" class="calculate-button send" value="" name="submit" />
					<div class="calculate-button back"></div>
				</div>
				</form>
			</div>
			</div>
		</div>
	</div>
	<div class="zone1">
<?php if(in_category('apparel')) : ?>
		<div class="content">
			<div class="swatches apparel">
				<h4>available in these colors</h4>
				<?php
				$colors = get_field('colors');
				foreach($colors as $color) :
				?>
				<div class="swatchall">
					<div class="swatchwrap">
						<div class="swatch" style="background-color: <?php echo $color['color']; ?>;">
							<div class="swatchname">
								<?php echo $color['color_name']; ?>
							</div>
						</div>
					</div>
					<div class="swatchflyout">
						<div class="sfwrap">
							<div class="swatchbig" style="background-color: <?php echo $color['color']; ?>;"></div>
							<div class="swatchinfo">
									<h3><?php echo $color['color_name']; ?></h3>
									<h4>approximately pantone <?php echo $color['pantone']; ?></h4>
									<p><?php echo $color['color_desc']; ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div><!-- .content -->
<?php elseif(in_category('packaging')) : ?>
		<div class="content">
			<div class="swatches">
				<h4>available packaging</h4>
				<?php
				$types = get_field('types');
				foreach($types as $type) :
				if( !$type['color'] && !$type['image'] ){ }else{ //leaving color and image blank removes this item from front end
				?>
				<div class="swatchall">
					<div class="swatchwrap">
                    	<?php if($type['color'] && $type['color'] != '' ){ ?>
						<div class="swatch" style="background-color: <?php echo $type['color']; ?>;">
                        <?php } else { ?>
						<div class="swatch" style="background: url('<?php echo $type['image']; ?>'); background-size: 110px 110px;">
                        <?php } ?>
							<div class="swatchname">
								<?php echo $type['type_name']; ?>
							</div>
						</div>
					</div>
					<div class="swatchflyout">
						<div class="sfwrap">
                    	<?php if($type['color'] && $type['color'] != '' ){ ?>
							<div class="swatchbig" style="background-color: <?php echo $type['color']; ?>;"></div>
                        <?php } else { ?>
							<div class="swatchbig" style="background: url('<?php echo $type['image']; ?>'); background-size: 252px 252px;"></div>
                        <?php } ?>
							<div class="swatchinfo">
									<h3><?php echo $type['type_name']; ?></h3>
									<p><?php echo $type['type_desc']; ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php } endforeach; ?>
			</div>
		</div><!-- .content -->
<?php else : ?>
		<div class="content">
			<div class="swatches">
				<h4>available in these colors</h4>
				<?php
				$types = get_field('types');
				foreach($types as $type) :
				if( !$type['color'] && !$type['image'] ){ }else{ //leaving color and image blank removes this item from front end
				?>
				<div class="swatchall">
					<div class="swatchwrap">
                    	<?php if($type['color'] && $type['color'] != '' ){ ?>
						<div class="swatch" style="background-color: <?php echo $type['color']; ?>;">
                        <?php } else { ?>
						<div class="swatch" style="background: url('<?php echo $type['image']; ?>'); background-size: 110px 110px;">
                        <?php } ?>
							<div class="swatchname">
								<?php echo $type['type_name']; ?>
							</div>
						</div>
					</div>
					<div class="swatchflyout">
						<div class="sfwrap">
                    	<?php if($type['color'] && $type['color'] != '' ){ ?>
							<div class="swatchbig" style="background-color: <?php echo $type['color']; ?>;"></div>
                        <?php } else { ?>
							<div class="swatchbig" style="background: url('<?php echo $type['image']; ?>'); background-size: 252px 252px;"></div>
                        <?php } ?>
							<div class="swatchinfo">
									<h3><?php echo $type['type_name']; ?></h3>
									<p><?php echo $type['type_desc']; ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php } endforeach; ?>
			</div>
		</div><!-- .content --><?php endif; ?>
	</div><!-- #zone1 -->
<?php get_footer(); ?>