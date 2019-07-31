<?php
/*
	Template Name: About Page
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
	<?php if($_GET['admin']=='t8-seo-check'){ echo '<div class="content cf">'; the_meta(); echo '</div>'; } ?>
	</div><!-- #zone1 -->

<?php
$rows = get_field('team_bios');
if($rows){ 
	foreach($rows as $row) { ?>
	<div class="splitzone faq">

		<div class="splitleft"></div>
		<div class="splitright"></div>

		<div class="content faqwrapper">
			<div class="orangebox left">
				<?php 

				$image = $row['image'];

				if( !empty($image) ): 
					// vars
					$title = $image['title'];
					$alt = $image['alt'];

					// thumbnail
					$size = 'thumbnail';
					$thumb = $image['sizes'][ $size ];
					$width = $image['sizes'][ $size . '-width' ];
					$height = $image['sizes'][ $size . '-height' ];

					?>

					<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />

				<?php endif; ?>
			</div>
			<div class="faqwrap cf">
				<?php echo $row['bio']; ?>
			</div>
		</div><!-- .content -->
	</div><!-- #zone1 -->
<?php } } ?>



<?php
$rows = get_field('sections');
if($rows){ 
	$rownum = 1;
	foreach($rows as $row) { ?>
	<div class="<?php echo $rownum % 2 ? 'splitzone' : 'zone1'; ?> faq">
		<?php if($rownum % 2){ ?>
		<div class="splitleft"></div>
		<div class="splitright"></div>
        <?php } ?>
		<div class="content faqwrapper">
			<div class="orangebox left ob<?php echo $rownum; ?>">
				<h2><?php echo $row['section_title']; ?></h2>
				<p><?php echo $row['section_description']; ?></p>
			</div>
			<div class="faqwrap cf">
				<?php echo $row['section_content']; ?>
			</div>
		</div><!-- .content -->
	</div><!-- #zone1 -->
<?php $rownum++; $rownum = $rownum > 4 ? 0 : $rownum; } } ?>
<?php get_footer(); ?>