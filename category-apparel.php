<?php
get_header(); ?>
<?php the_post(); ?>
			<?php
			$args = array(
				'child_of'	=> 3,
				'orderby'	=> 'id'
			);
			$categories = get_categories($args);
?>
<div class="subnavwrap">
	<div class="subnav">
		<h3>apparel</h3>
        <?php foreach($categories as $cat) {
			echo '<a href="#'. $cat->slug .'">'. $cat->name .'</a>';		
		} ?>
	</div>
</div>
<div class="topwrapper">
	<a href="javascript:void(0)" class="backtotop" title="Back to Top">Back to Top</a>
</div>
<?php
//echo '<pre>'; print_r($categories); echo '</pre>';
	foreach($categories as $cat) {?>
		<a class="jump" id="<?php echo $cat->slug; ?>"></a>
        <div class="zone1 closed <?php echo $cat->slug; ?>">
			<h2><?php echo ($cat->description != '' ? $cat->description : $cat->name ); ?></h2>
			<div class="content apparel">
				<div class="app-wrap slider">
				<?php
				$args = array(
					'cat'				=>	$cat->cat_ID,
					'posts_per_page' 	=> 	-1,
					'order'				=> 'ASC',
					// 'orderby'			=>	'menu_order'
				);
				$posts = get_posts($args);
				$post_count = count($posts);
				foreach($posts as $post) {
					echo '<a href="'.get_permalink().'"><div class="app-thumb">';
					echo the_post_thumbnail('thumbnail');
					echo '<div class="app-desc">';
					echo '<h3>'.get_the_title().'</h3>';
					echo '</div>';
					echo '</div></a>';
				}
				wp_reset_query();
				?>
				</div>
				<?php if( $post_count > 4 ) { ?><span class="view-all">>> View All</span><?php } ?>
			</div>
		</div><!-- #zone1 -->
	<?php } ?>
<?php get_footer(); ?>