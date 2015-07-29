<?php
/*
	Template Name: Products Page
 */

get_header(); ?>
<?php the_post(); ?>
	<div class="zone1">
		<div class="content">
			<?php $category_link = get_category_link(3); ?>
			<a href="<?php echo esc_url( $category_link ); ?>"><div class="product">
				<h2>Apparel</h2>
				<img src="<?php echo z_taxonomy_image_url(3); ?>" />
			</div></a>
			<?php $category_link = get_category_link(7); ?>
			<a href="<?php echo esc_url( $category_link ); ?>"><div class="product">
				<h2>Posters</h2>
				<img src="<?php echo z_taxonomy_image_url(7); ?>" />
			</div></a>
			<?php $category_link = get_category_link(9); ?>
			<a href="<?php echo esc_url( $category_link ); ?>"><div class="product">
				<h2>Packaging</h2>
				<img src="<?php echo z_taxonomy_image_url(9); ?>" />
			</div></a>
			<?php $category_link = get_category_link(8); ?>
			<a href="<?php echo esc_url( $category_link ); ?>"><div class="product">
				<h2>Stationery</h2>
				<img src="<?php echo z_taxonomy_image_url(8); ?>" />
			</div></a>
		</div><!-- .content -->
	</div><!-- #zone1 -->
<?php get_footer(); ?>