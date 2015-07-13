<?php
get_header(); ?>
	<div class="zone1">
		<div class="content gallerywrap">
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
		</div><!-- .content -->
	</div><!-- #zone1 -->
<?php get_footer(); ?>