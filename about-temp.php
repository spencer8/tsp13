<?php
/*
	Template Name: Temp About Page
 */

get_header(); ?>
	<div class="zone1 about">
		<div class="content">
			<?php the_post(); ?>
			<?php
				$imgs = array();
				while (has_sub_field('slider')):
					$imgtest =  get_sub_field('image');
					if( !empty( $imgtest ) ){
						$imgs[] = $imgtest;
					}
				endwhile;
	//			echo '<pre>'; print_r( $imgs ); echo '</pre>';
			$gal = 1; ?>
            <div class="slider-wrapper cf">
				<?php if( !empty($imgs) ) { 
					if( count($imgs) > 1 ) { ?>
                <div class="gallery slider" data-cycle-slides= "> div" data-cycle-auto-height="27:18" data-cycle-pager="#sp-<?php echo $gal; ?>" id="gal-<?php echo $gal; ?>"><?php
                        foreach($imgs as $img) {
							echo '<div class="portslide"><img class="slide" alt="'.$img['alt'].'" src="'.$img['sizes']['large'].'" />';
							echo '</div>';
                        }
               	?></div>
               	<div class="slide-pager" id="sp-<?php echo $gal; ?>"></div>
				   <?php } else { ?>
                    <div class="slider"><?php
						foreach($imgs as $img) {
							echo '<div class="portslide"><img class="slide" alt="'.$img['alt'].'" src="'.$img['sizes']['large'].'" />';
							echo '</div>';
						}
                    ?></div>

                   <?php }
				} ?>
			</div>
			<div class="galinfo right cf">
				<?php the_content(); ?>
			</div>
		</div><!-- .content -->
	</div><!-- #zone1 -->
<?php get_footer(); ?>