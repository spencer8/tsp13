<?php
/*
	Template Name: Home Page
 */
get_header(); ?>
<div class="subnavwrap">
	<div class="subnav">
		<h2><?php bloginfo('description'); ?></h2>
	</div>
</div>
	<div class="zone1">
		<?php if ( function_exists( 'soliloquy' ) ) { soliloquy( '1138' ); } ?>
		<div class="content cf">
			
		</div><!-- .content -->
	</div><!-- #zone1 -->
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="splitzone">
		<div class="splitleft"></div>
		<div class="splitright"></div>
		<div class="content">
			<?php
				$bg_css = '';
				if( get_field('background_color') ){
					$bg_css = ' style="background-color:'. get_field('background_color') . ';"';
				}
			?>
			<div class="faqwrap single-col"<?php echo $bg_css; ?>>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>