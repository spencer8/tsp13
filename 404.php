<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	<div id="primary" class="faq zone1">
		<div id="content" role="main" class="content faqwrapper">

			<article id="post-0" class="post error404 no-results not-found">
				<div class="orangebox left ob0">
					<h3 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentytwelve' ); ?></h1>
				</div>

				<div class="faqwrap">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Try the navigation above.', 'tsp13' ); ?></p>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>