<?php
/*
	Template Name: Home Page
 */
get_header(); ?>
	<div class="slider">
		<?php if ( function_exists( 'soliloquy' ) ) { soliloquy( '1138' ); } ?>
		<div class="content cf">
			
		</div><!-- .content -->
	</div><!-- #zone1 -->
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="fullwidth">
		<div class="content cf">
			<?php the_content(); ?>
		</div>
	</div>

	<?php
	$rows = get_field('sections');
	if($rows){ 
		$rownum = 0;
		foreach($rows as $row) { ?>
		<div class="<?php echo $rownum % 2 ? 'splitzone' : 'zone1'; ?> additional">
			<section class="content faqwrapper">
				<header class="ob<?php echo $rownum; ?>">
					<h2><?php echo $row['section_title']; ?></h2>
					<p><?php echo $row['section_description']; ?></p>
				</header>
				<div class="intro cf">
					<?php echo $row['section_content']; ?>
				</div>



<?php
			$args = array(
				'child_of'	=> 3,
				'orderby'	=> 'id'
			);
			$categories = get_categories($args);
?>

			<div class="app-wrap slider">
			<?php foreach($categories as $cat) {?>
				<?php
				$args = array(
					'cat'				=>	$cat->cat_ID,
					'posts_per_page' 	=> 	1,
					'order'				=> 'ASC',
					// 'orderby'			=>	'menu_order'
				);
				$apparel_posts = new WP_Query( $args );
				while ( $apparel_posts->have_posts() ) {
					$apparel_posts->the_post();
					echo '<a href="'.get_bloginfo('url').'/category/apparel/#'. $cat->slug .'"><div class="app-thumb">';
					echo the_post_thumbnail('thumbnail');
					echo '<div class="app-desc">';
					echo '<h3>';
					echo ($cat->description != '' ? $cat->description : $cat->name );
					echo '</h3>';
					echo '</div>';
					echo '</div></a>';
				}
				wp_reset_query();
				?>
				
			<?php } ?>
			<?php 
			$args = array(
				'post__in'		=> array( 83, 91, 382 ),
				'order'			=>	'ASC'
			);
			$flatstock_posts = new WP_Query( $args );
			while ( $flatstock_posts->have_posts() ) {
				$flatstock_posts->the_post();
				echo '<a href="'.get_permalink().'"><div class="app-thumb">';
				echo the_post_thumbnail('thumbnail');
				echo '<div class="app-desc">';
				echo '<h3>';
				echo the_title();
				echo '</h3>';
				echo '</div>';
				echo '</div></a>';
			}
			wp_reset_query();
			?>

			</div>



			</section><!-- .content -->
		</div><!-- #zone1 -->
	<?php $rownum++; $rownum = $rownum > 4 ? 0 : $rownum; } } ?>
	<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>