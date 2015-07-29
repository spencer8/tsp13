<?php
/*
    basic page template, single column
 */
get_header(); ?>
<div class="zone1">
	<div class="content">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$bg_css = 0;
		if( get_field('background_color') ){
			$bg_css = ' style="background-color:'. get_field('background_color') . ';"';
		?>
		<div class="faqwrap single-col"<?php echo $bg_css; ?>>
			<?php the_content(); ?>
		</div>
		<?php }else{ ?>
		<div class="single-col">
			<?php the_content(); ?>
		</div>
		<?php } ?>
	<?php endwhile; // end of the loop. ?>
	</div>
</div>
<?php get_footer(); ?>