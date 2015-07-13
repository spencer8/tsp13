<?php
/**
	Template Name: Home Page
 */
get_header(); ?>
<div class="subnavwrap">
	<div class="subnav">
		<h2><?php bloginfo('description'); ?></h2>
	</div>
</div>
	<div class="zone1">
		<div class="content cf">
			<?php the_post(); ?>
			<?php
				$slides = array();
				while (has_sub_field('slider')):
					$imgtest =  get_sub_field('image');
					if( !empty( $imgtest ) ){
						$slide['img'] = $imgtest;
						$slide['title'] = get_sub_field('title');
						$slide['description'] = get_sub_field('description');
						$slide['link'] = ( get_sub_field('external_link') ?  get_sub_field('external_link') : get_sub_field('link') );
						$slides[] = $slide;
					}
				endwhile;
// echo '<pre>'; print_r( $slides ); echo '</pre>';
			$gal = 0; ?>
			<?php if( !empty($slides) ) { 
				if( count($slides) > 1 ) { ?>
            <div class="slider-wrapper cf">
                <div class="gallery slider" data-cycle-slides="> div" data-cycle-auto-height="27:18" data-cycle-pager="#sp-<?php echo $gal; ?>" id="gal-<?php echo $gal; ?>"><?php
                foreach($slides as $slide) {
                	if( $slide['link'] ){
						echo '<div class="portslide"><a href="'. $slide['link'] .'" ><img class="slide" alt="'.$slide['img']['alt'].'" src="'.$slide['img']['sizes']['large'].'" /></a></div>';
                	} else {
						echo '<div class="portslide"><img class="slide" alt="'.$slide['img']['alt'].'" src="'.$slide['img']['sizes']['large'].'" /></div>';
                	}
                } ?>
               	</div>
			</div>
			<div class="orangebox right ob<?php echo $gal; ?> gallery cf" data-cycle-pager="#sp-<?php echo $gal; ?>" data-cycle-pager-template="" data-cycle-slides="> div">
            <?php
            $scnt = 1;
            foreach($slides as $slide) { ?>
				<div class="ob<?php echo $scnt; ?> cf">
	                <?php if($slide['title']) echo '<h3>' . $slide['title'] . '</h3>'; ?>
	                <p><?php echo $slide['description']; ?></p>
	            </div>                
            <?php 
            if($scnt < 5) $scnt++; else $scnt = 1;
            } ?>
            </div>                
           	<div class="slide-pager" id="sp-<?php echo $gal; ?>"></div>
			<?php } else { ?>
            <div class="slider-wrapper cf">
				<div class="slider"><?php
					foreach($slides as $slide) {
						echo '<div class="portslide"><img class="slide" alt="'.$slide['img']['alt'].'" src="'.$slide['img']['sizes']['large'].'" />';
						echo '</div>';
					}
				?></div>
			</div>
           <?php }

		} ?>
		</div><!-- .content -->
	</div><!-- #zone1 -->
	<?php if(get_field('video_title') != ""): ?>
	<div class="splitzone">
		<div class="splitleft"></div>
		<div class="splitright"></div>
		<div class="content vidwrap">
			<div class="orangebox left">
					<h2><?php the_field('video_title'); ?></h2>
				<?php if(get_field('video_desc') != ""): ?>
					<p><?php the_field('video_desc'); ?></p>
				<?php endif; ?>
			</div>
			<div class="vid">
				<?php if(get_field('video') != ""): ?>
					<?php the_field('video'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>