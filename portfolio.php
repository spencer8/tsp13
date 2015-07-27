<?php
/*
	Template Name: Portfolio Page
 */

get_header(); ?>
<?php the_post(); ?>
<?php if(get_field('portfolio') ) { ?>
<div class="port">
	<?php $gal = 0; ?>
    <?php while (has_sub_field('portfolio')): 
		if( get_sub_field('title') ) { ?>
	<div class="<?php echo $gal % 2 ? 'splitzone' : 'zone1'; ?>">
		<?php if($gal % 2){ ?>
		<div class="splitleft"></div>
		<div class="splitright"></div>
        <?php } ?>
		<div class="content cf">
            <div class="orangebox<?php echo $gal % 2  ?' left' : ' right'; ?> ob<?php echo $gal; ?> cf">
                <h2><?php the_sub_field('title'); ?></h2>
                <p><?php the_sub_field('description'); ?></p>
               <div class="slide-pager" id="sp-<?php echo $gal; ?>"></div>
            </div>
            <div class="slider-wrapper cf">
                <?php if( get_sub_field('images') ) { ?>
                <div class="gallery slider" data-cycle-slides= "> div" data-cycle-auto-height="27:18" data-cycle-pager="#sp-<?php echo $gal; ?>" id="gal-<?php echo $gal; ?>"><?php
                        $imgs = array();
						while (has_sub_field('images')):
							$imgs[] = get_sub_field('image');
						endwhile;
						
                        if(!empty($imgs) ) {foreach($imgs as $img) {
							echo '<div class="portslide"><img class="slide" alt="'.$img['alt'].'" src="'.$img['sizes']['large'].'" />';
							if($img['caption'] != '' ) echo '<p>'.$img['caption'].'</p>';
							echo '</div>';
                        }}
               ?></div>
               <?php } ?>
			</div>
		</div><!-- .content -->
	</div><!-- #zone1 -->
    <?php  $gal++; } endwhile; ?>
</div><!--end port-->
<?php } ?>
<?php get_footer(); ?>