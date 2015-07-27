<?php
/**
	Template Name: FAQ Page
 */

get_header(); ?>
<?php the_post(); ?>
<div class="subnavwrap">
	<div class="subnav">
<?php
$rows = get_field('faq_sections');
if($rows){ 
	foreach($rows as $row) { 
		$subnavitems[] = '<a href="#'. str_replace(' ','', $row['section_name']) .'">'. $row['section_name'].'</a>';
	}
	echo implode(' | ', $subnavitems);
	if(get_field('house_colors_title')) echo ' | <a href="#'. str_replace(' ','', get_field('house_colors_title')) .'">'. get_field('house_colors_title') .'</a>';
}
?>
    </div>
</div>
<div class="faq">
<div class="topwrapper">
	<a href="javascript:void(0)" class="backtotop" title="Back to Top">Back to Top</a>
</div>
<?php
$rows = get_field('faq_sections');
if($rows){ 
	$rownum = rand(1,5) - 1;
	foreach($rows as $row) { ?>
	<div class="<?php echo $rownum % 2 ? 'splitzone' : 'zone1'; ?>">
		<a class="jump" id="<?php echo str_replace(' ','', $row['section_name']); ?>"></a>
		<?php if($rownum % 2){ ?>
		<div class="splitleft"></div>
		<div class="splitright"></div>
        <?php } ?>
		<div class="content faqwrapper">
			<div class="orangebox left ob<?php echo $rownum; ?>">
				<h2><?php echo $row['section_name']; ?></h2>
				<p><?php echo $row['section_desc']; ?></p>
			</div>
			<div class="faqwrap">
				<?php echo $row['section_content']; ?>
			</div>
		</div><!-- .content -->
	</div><!-- #zone1 -->
<?php $rownum++; $rownum = $rownum > 4 ? 0 : $rownum; }?>
<?php if(get_field('house_colors_title')) : ?>
	<div class="<?php echo $rownum % 2 ? 'splitzone' : 'zone1'; ?>">
		<a class="jump" id="<?php echo str_replace(' ','', get_field('house_colors_title')); ?>"></a>
		<?php if($rownum % 2){ ?>
		<div class="splitleft"></div>
		<div class="splitright"></div>
        <?php } ?>
		<div class="content faqwrapper hzcolors">
			<div class="orangebox left ob<?php echo $rownum; ?>">
				<h2><?php the_field('house_colors_title'); ?></h2>
				<p><?php the_field('house_colors_description'); ?></p>
			</div>
			<div class="faqwrap">
				<?php the_field('house_colors'); ?>
			</div>
			<div class="swatches">
				<?php
				$colors = get_field('ink_colors');
				foreach($colors as $color) :
				?>
				<div class="swatchall">
					<div class="swatchwrap">
						<div class="swatch" style="background-color: <?php echo $color['color']; ?>;">
							<div class="swatchname">
								<?php echo $color['color_name']; ?>
							</div>
						</div>
					</div>
					<div class="swatchflyout">
						<div class="sfwrap">
							<div class="swatchbig" style="background-color: <?php echo $color['color']; ?>;"></div>
							<div class="swatchinfo">
									<h3><?php echo $color['color_name']; ?></h3>
									<p><?php echo $color['color_description']; ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
                <div class="clear"></div>
			</div>
		</div><!-- .content -->
	</div><!-- #zone1 -->
<?php endif; ?>
</div>
<?php } get_footer(); ?>