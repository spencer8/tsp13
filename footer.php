<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
		<div id="footwrap">
			<div id="footer" class="cf t8-cols-wrap">
			<div class="t8-cols-wrap">
				<div id="foot1" class="t8-col cols-5">
					<?php if ( is_active_sidebar( 'footer_1' ) ) : ?>
							<?php dynamic_sidebar( 'footer_1' ); ?>
					<?php else : ?>
						<h2>Get in touch</h2>
						<p>
						Triple Stamp Press<br />
						200 Everett St<br />
						Richmond, VA 23224<br />
						<a href="mailto:info@triplestamppress.com">info@triplestamppress.com</a><br />
						(804) 233-1502</p>
					<?php endif; ?>
				</div><!-- #primary-sidebar -->

				<div id="foot3" class="t8-col cols-2">
					<a class="pricebadge" href="<?php bloginfo('url'); ?>/pricing">Instant Price Calculator</a>
				</div>

				<div id="foot2" class="t8-col cols-5">
				<?php if ( is_active_sidebar( 'footer_2' ) ) : ?>
						<?php dynamic_sidebar( 'footer_2' ); ?>
				<?php else : ?>
					<h2>Follow Us</h2>
					<ul class="nav-social clear">
						<li><a href="https://instagram.com/triplestamppress/" class="instagram"><span class="genericon genericon-instagram"></span></a></li>
						<li><a href="http://triplestamppress.tumblr.com/" class="tumblr"><span class="genericon genericon-tumblr"></span></a></li>
						<li><a href="https://www.linkedin.com/company/triple-stamp-press" class="linkedin"><span class="genericon genericon-linkedin-alt"></span></a></li>
						<li><a href="https://www.facebook.com/triplestamp" class="facebook"><span class="genericon genericon-facebook"></span></a></li>
						<li><a href="https://twitter.com/triplestamp" class="twitter"><span class="genericon genericon-twitter"></span></a></li>
					</ul>
				<?php endif; ?>
				</div><!-- #primary-sidebar -->

			</div>
			</div><!-- #footer -->
		</div><!-- #footwrap -->
</div><!-- #page -->
	<?php
		$graph_opts = get_option('tsp_calc_graphic_options');
		$graph_lbr_sheet = $graph_opts['lbr_sheet'];
		$graph_lbr_swipe = $graph_opts['lbr_swipe'];
		$graph_lbr_screen = $graph_opts['lbr_screen'];
		$graph_mtrl_swipe = $graph_opts['mtrl_swipe'];
		$graph_mtrl_screen = $graph_opts['mtrl_screen'];
		$graph_lbr_job = $graph_opts['lbr_job'];
		$graph_hr_rate = $graph_opts['hourly_rate'];
		$graph_equip = $graph_opts['equipment'];
		$graph_pay = $graph_opts['payment_processing'];
		
		$app_opts = get_option('tsp_calc_apparel_options');
		$app_lbr_sheet = $app_opts['lbr_sheet'];
		$app_lbr_swipe = $app_opts['lbr_swipe'];
		$app_lbr_screen = 0;
		$app_mtrl_swipe = $app_opts['mtrl_swipe'];
		$app_mtrl_screen = $app_opts['mtrl_screen'];
		$app_lbr_job = $app_opts['lbr_job'];
		$app_hr_rate = $app_opts['hourly_rate'];
		$app_equip = $app_opts['equipment'];
		$app_pay = $app_opts['payment_processing'];
		$app_mod_hourly = 0;
		$app_qty_approach = $app_opts['qty_approach'];
		$app_add_location = $app_opts['add_location'];
	?>

<script type="text/javascript">
	jQuery(document).ready(function($j) {
		
		$j(".calcbox #lastname").hide();
		// VARS
	
		var $galleryNotouch1 = $j('#gal-1'),
			$galleryTouch1 = $j('.touch #gal-1'),
			$galleryNotouch2 = $j('#gal-2'),
			$galleryTouch2 = $j('.touch #gal-2'),
			$galleryNotouch3 = $j('#gal-3'),
			$galleryTouch3 = $j('.touch #gal-3'),
			$galleryNotouch4 = $j('#gal-4'),
			$galleryTouch4 = $j('.touch #gal-4'),
			$header = $j('.no-touch #header'),
			$touch = $j('.touch'),
			$notouch = $j('.no-touch'),
			$window = $j(window),
			$doc = $j(document),
			$subhead = $j('#subhead'),
			$nav = $j('#nav'),
			$pricea = $j('.pricing'),
			$logo = $j('.logo'),
			$navul = $j('#nav > ul'),
			$borderholder = $j('.borderholder'),
			$minilogo = $j('.minilogo'),
			$anim = $j('.pricing'),
			templateDir = "<?php bloginfo('template_directory'); ?>",
			$swatchwrap = $j('.swatchwrap'),
			$swatch = $j('.swatch'),
			$tab = $j('.tab'),
			$productinfoimg = $j('.launchcalc'),
			$calculator = $j('.calculator'),
			ajaxurl = "<?php echo bloginfo('url'); ?>/wp-admin/admin-ajax.php",
			$nolink = $j('.nolink'),
			$results = new Array(),
			$colors = '',
			$matby_swipe = '',
			$matby_screen = '',
			$add_loc = '',
			$add_loc_price = '',
			$iosSlider = $j('.iosSlider');
			// CALC GLOBAL VARS			
		var	$graphOpts = <?php echo json_encode($graph_opts); ?>,
			$appOpts = <?php echo json_encode($app_opts); ?>;
			console.log($graphOpts.lbr_sheet);
			
		// FUNCTIONS
			
		function typeToStyleAjax() {
			var $type = $j('select.apparel-type');
			var cat = $type.val();
			nonce = $j("input#tsp-nonce").val();
			var data = {
				action: 'tsp_calc_type',
				cat: cat,
				nonce : nonce
			};
			$j.post(ajaxurl, data, function(response) {
				response = $j.parseJSON(response);
				console.log(response);
				$type.parent().siblings('.calcboxright').find('select.style').html('');
				$j.each(response, function(i, e) {
					if($j('.productinfo').attr('data-id') == e.id) {
						$type.parent().siblings('.calcboxright').find('select.style').append('<option name=' + e.slug + ' value=' + e.id + ' data-price=' + e.price + ' selected>' + e.title + '</option>');
					} else {
						$type.parent().siblings('.calcboxright').find('select.style').append('<option name=' + e.slug + ' value=' + e.id + ' data-price=' + e.price + '>' + e.title + '</option>');
					}
				});
			calculate($type);
			});
			if($j('.calculate-button:visible').hasClass('off')) {
				$j('.calculate-button:visible').removeClass('off').addClass('on').on('click', function() {
						getStarted($j(this));
				});;
			}
		}
		
		function statQtyAjax() {
			var $style = $j('select.style:visible');
			var size = $j('select.style:visible option:selected').text();
			var array = $style.val();
			nonce = $j("input#tsp-nonce").val();
			var data = {
				action: 'tsp_stat_qty',
				array: array,
				size: size,
				nonce : nonce
			};
			$j.post(ajaxurl, data, function(response) {
				response = $j.parseJSON(response);
				console.log(response);
				$style.parent().find('select.qty').html('');
				$j('.h4.total:visible').html('thinking');
				$j('.h4.peritem:visible').html('thinking');
				$j.each(response, function(i, e) {
					$style.parent().find('select.qty').append('<option name=' + e.qty + ' value=' + e.price + ' data-add-price="' + e.addcolor + '">' + e.qty + '</option>');
				});
			calculate($style);
			});
			if($j('.calculate-button:visible').hasClass('off')) {
				$j('.calculate-button:visible').removeClass('off').addClass('on').on('click', function() {
						getStarted($j(this));
				});;
			}
		}

		function packQtyAjax() {
			var $type = $j('select.type:visible option:selected');
			var $qty = $type.parent().parent().siblings('.calcboxright').find('select.qty');
			var array = $j.parseJSON($type.val());
			console.log(array);
			$qty.html('');
			if(array != '') {
				$j.each(array, function(i, e) {
					$qty.append('<option name=' + e.qty_item + ' value=' + e.price_item + ' data-add-price="' + e.add_color + '">' + e.qty_item + '</option>');
				});
				calculate($qty);
			} else {
				$qty.append('<option>Needs Info</option>');
				calculate('empty');
			}
			if($j('.calculate-button:visible').hasClass('off')) {
				$j('.calculate-button:visible').removeClass('off').addClass('on').on('click', function() {
						getStarted($j(this));
				});;
			}
		}
		
		function getStarted(e) {
			var $referrer = '';
			var $details = [];
			$referrer = $j(e).parent().parent('.calcbox');
			console.log($referrer);
			
			if($referrer.hasClass('apparel')) {
				$style = $referrer.find('.style option:selected').html();
				$qty = $referrer.find('input[name="quantity"]').val();
				$front = $referrer.find('select[name="front"]').val();
				$back = $referrer.find('select[name="back"]').val();
			} else if($referrer.hasClass('posters')) {
				$style = $referrer.find('.style option:selected').html() + ' on ' + $referrer.find('.type option:selected').html();
				$qty = $referrer.find('input[name="quantity"]').val();
				$front = $referrer.find('select[name="front"]').val();
				$back = $referrer.find('select[name="back"]').val();
			} else if($referrer.hasClass('packaging')) {
				$style = $referrer.find('.type option:selected').html();
				$qty = $referrer.find('select.qty option:selected').html();
				$front = $referrer.find('select[name="front"]').val();
				$back = $referrer.find('select[name="back"]').val();
			} else if($referrer.hasClass('stationery')) {
				$style = $referrer.find('.style option:selected').html() + ' on ' + $referrer.find('.type option:selected').html();
				$qty = $referrer.find('select.qty option:selected').html();
				$front = $referrer.find('select[name="front"]').val();
				$back = $referrer.find('select[name="back"]').val();
			}
			$j('.referrer').removeClass('referrer');
			$referrer.addClass('referrer');

			console.log($qty);
			
			$total = $referrer.find('.h4.total').html();
			$peritem = $referrer.find('.h4.peritem').html();
			$referrer.hide();
			$j('.get-started').show();
			$j('.get-started .calcboxleft span.style').html($style);
			$j('.get-started .calcboxleft span.qty').html($qty);
			$j('.get-started .calcboxleft span.front').html($front);
			$j('.get-started .calcboxleft span.back').html($back);
			$j('.get-started .calcboxleft span.total').html($total);
			$j('.get-started .calcboxleft span.peritem').html($peritem);
			$j('input#project-details-style').val($style);
			$j('input#project-details-qty').val($qty);
			$j('input#project-details-front').val($front);
			$j('input#project-details-back').val($back);
			$j('input#project-total').val($total);
			$j('input#project-peritem').val($peritem);
			
		}
		
		$j('.calculate-button.back').on('click', function() {
			$j('.get-started').hide();
			$j('.referrer').show();
		});

		
		function calculate(e) {
		
			if(e == 'empty') {
				$j('.h4.total:visible').html('$');
				$j('.h4.peritem:visible').html('$');			
			}
		
			$parent = e.parent().parent();
			$front = $parent.find('select[name="front"] option:selected').val();
			$back = $parent.find('select[name="back"] option:selected').val();
			$colors = $front + $back;
			
			if($colors > 0) {
				$results = [];
				$colors = parseInt($parent.find('select[name="front"] option:selected').val()) + parseInt($parent.find('select[name="back"] option:selected').val());
		
				if($parent.hasClass('apparel')) {
					$qty = parseInt($parent.find('input[name="quantity"]').val());
					if($front > 0 && $back > 0) {
						$add_loc = 1;
					} else {
						$add_loc = 0;
					}
					$add_loc_price = $add_loc * $appOpts.add_location;
					$by_unit = $appOpts.lbr_sheet * $qty / 100;
					$by_swipe = $appOpts.lbr_swipe * $qty * $colors / 100;
					$results['qty_bonus'] = ( ( $qty - 23 ) / $appOpts.qty_approach ) * $appOpts.hourly_rate;
					if( $appOpts.qty_approach > $qty ) { //only factor discount if qty is less than approach
						$results['qty_bonus'] = 1 - (( $appOpts.max_discount * ( $qty / $appOpts.qty_approach  ) ) / 100); 
					}else{
						$results['qty_bonus'] = 1 - ($appOpts.max_discount/100);
					}
					$results['hours'] = (+$appOpts.lbr_job + +$by_unit + +$by_swipe) / 60;
					//console.log($appOpts.lbr_job+':'+$by_unit+':'+$by_swipe+':60:'+$results['hours']);
					$results['labor'] = ($results['hours'] * $appOpts.hourly_rate) * $results['qty_bonus'];
					$results['substrate'] = $parent.find('select.style option:selected').attr('data-price') * $qty;
					$matby_swipe = $appOpts.mtrl_swipe * $qty / 100;
					$matby_screen = $appOpts.mtrl_screen;
					$price = $parent.find('select[name="style"] option:selected').attr('data-price');
					$results['materials'] = +$matby_swipe + +$matby_screen;
					$results['equipment'] = ($results['materials'] + $results['labor']) * ($appOpts.equipment) / 100;
					
					var $offset = .25;
					if($qty < 150){
						$offset += ((150 - $qty)/150)*.475;
					}

					$results['more_color'] = (( $appOpts.clr_curve / $qty ) + $offset) * ($colors - 1) * $qty;
					//console.log($results);
					$results['total'] = +$results['more_color'] + +$results['materials'] + +$results['labor'] + +$results['substrate'] + ( $add_loc_price * $qty ) + ( (+$results['materials'] + +$results['labor']) * ( +$appOpts.payment_processing + +$appOpts.equipment ) / 100 );
					$results['total'] = $results['total'].toFixed(2);
					$results['unit'] = $results['total']/$qty;
					$results['unit'] = $results['unit'].toFixed(2);
					$results['net'] = $results['total'] - $results['materials'] - $results['equipment'];

					//console.log($results);
				} else if($parent.hasClass('stationery')) {
					$qty = parseInt($parent.find('select.qty option:selected').attr('name'));
					//console.log('qty is ' + $qty);
					$substrate = $parent.find('select.type option:selected').val() * $qty;
					$add_color = $parent.find('select.qty option:selected').attr('data-add-price');
					$add_color = $add_color * ($colors - 1);
					$price = $parent.find('select.qty option:selected').val();
					$results['total'] = parseInt($substrate) + parseInt($add_color) + +$price;
					$results['total'] = $results['total'].toFixed(2);
					$results['unit'] = $results['total']/$qty;
					$results['unit'] = $results['unit'].toFixed(2);
					
					// console.log($results);
				} else if($parent.hasClass('packaging')) {
					$qty = parseInt($parent.find('select.qty option:selected').attr('name'));
					//console.log('qty is ' + $qty);
					$add_color = $parent.find('select.qty option:selected').attr('data-add-price');
					$add_color = $add_color * ($colors - 1);
					$price = $parent.find('select.qty option:selected').val();
					$results['total'] = parseInt($add_color) + +$price;
					$results['total'] = $results['total'].toFixed(2);
					$results['unit'] = $results['total']/$qty;
					$results['unit'] = $results['unit'].toFixed(2);
					
					//console.log($results);
				} else {
					$qty = parseInt($parent.find('input[name="quantity"]').val());
					$style = parseInt($parent.find('select.style option:selected').val());
					//console.log('multiplier'+$style);
					$by_unit = $graphOpts.lbr_sheet * $qty / 100;
					$by_swipe = $graphOpts.lbr_swipe * $qty * $colors / 100;
					$by_screen = $graphOpts.lbr_screen * $colors ;
					$results['hours'] = (parseInt($graphOpts.lbr_job, 10) + +$by_unit + +$by_swipe + +$by_screen ) / 60;
					$results['labor'] = ($results['hours'] * $graphOpts.hourly_rate);
					$results['substrate'] = $parent.find('select.type').val() * $qty;
					$matby_swipe = $graphOpts.mtrl_swipe * $qty * $colors / 100;
					$results['matby_screen'] = $matby_screen = $graphOpts.mtrl_screen;
					$results['materials'] = +$matby_swipe + +$matby_screen;
					$results['equipment'] = (+$results['materials'] + +$results['labor']) * $graphOpts.equipment / 100;
					$results['total'] = ( +$results['materials'] + +$results['labor'] + +$results['substrate'] + ( (+$results['materials'] + +$results['labor']) * ( parseInt($graphOpts.payment_processing, 10) + parseInt($graphOpts.equipment, 10) ) / 100 ) ) * ( $style / 100 );
					$results['total'] = $results['total'].toFixed(2);
					$results['unit'] = $results['total']/$qty;
					$results['unit'] = $results['unit'].toFixed(2);
					$results['net'] = $results['total'] - $results['materials'] - $results['equipment'];
					// console.log($results);
				}
				if($qty < 24) {
					$j('.h4.total:visible').html('24 MIN QTY');
					$j('.h4.peritem:visible').html('24 MIN QTY');				
				} else if($qty >= 24 && $results['total'] != 'NaN') {
					$j('.h4.total:visible').html('$ ' + $results['total']);
					$j('.h4.peritem:visible').html('$ ' + $results['unit']);
				}
			} else {
				$j('.h4.total:visible').html('need colors');
				$j('.h4.peritem:visible').html('need colors');
			}
		}
		
		// TURN OFF NOLINKS
		/*$nolink.click(function(e) {
			e.preventDefault();
		});*/
		$j("li.nolink a:first").click(function(e) {
			e.preventDefault();
		});
		$j("option.nolink").click(function(e) {
			e.preventDefault(); // need to disable the value here
		});
		
		// HANDLE CYCLE GALLERIES FOR TOUCH AND NOTOUCH
			
		if($galleryNotouch1.length > 0) {
		}
		$j('.gallery').cycle({
			speed: 600,
			manualSpeed: 200,
			timeout: 7200
		});		
		//scroll follow script
		if($j('.backtotop').length > 0) {
		$j('.backtotop').click(function(){
			$j('html, body').animate({scrollTop:0}, 'slow');
		});
		

		$j(function() {

			var $sidebar   = $j(".backtotop"), 
				$window    = $j(window),
				topPadding     = 250;
				if( topPadding + 100 > $window.height() ) topPadding = $window.height() - 100;
				
				$window.scroll(function() {
										
					if ($window.scrollTop() > 200 ) {
						$sidebar.stop().show().animate({
							top: $window.scrollTop() + topPadding // $window.scrollTop() - topPadding
						}, 400);
					} else {
						$sidebar.stop().animate({
							top: $window.scrollTop() + $window.height() + topPadding
						}, 400);
					}
				});
		});
		}
		$j('a[href^="#"]').on('click',function (e) {
			e.preventDefault();
	
			var target = this.hash,
			$target = $j(target);
	
			$j('html, body').stop().animate({
				'scrollTop': $target.offset().top
			}, 700, 'swing', function () {
				window.location.hash = target;
			});
		});
		
		// CALCULATOR
		
		$productinfoimg.click(function(e) {
			e.preventDefault();
			if($calculator.hasClass('open')) {
				$calculator.slideToggle(400).removeClass('open');			
			} else {
				$calculator.slideToggle(400).addClass('open');			
				var pos = $calculator.position();
				$j('html, body').animate({
					 scrollTop: pos.top - 43
				}, 900);
			}
			if($j('.productinfo').attr('data-cat') != '' && $j('.productinfo').attr('data-cat')) {
				typeToStyleAjax();
			}
		});
		
		$j('.calculator .xbox').click(function() {
			$calculator.slideToggle(400).removeClass('open');
			if($header.data('size') == 'big') {
				$j('html, body').animate({
					 scrollTop: $calculator.offset().top - 400
				}, 900);
			} else {
				$j('html, body').animate({
					 scrollTop: $calculator.offset().top - 200
				}, 900);
			}
		});
		
		$j('.tab').click(function() {
			if($j(this).hasClass('selected')) {
				// do nothing
			} else {
				$j('.selected').removeClass('selected');
				$j(this).addClass('selected');
				if($j('.selected').hasClass('apparel')) {
					$j('.calcbox').hide();
					$j('.calcbox.apparel').show();
				} else if($j('.selected').hasClass('posters')) {
					$j('.calcbox').hide();
					$j('.calcbox.posters').show();
				} else if($j('.selected').hasClass('stationery')) {
					$j('.calcbox').hide();
					$j('.calcbox.stationery').show();
				} else if($j('.selected').hasClass('packaging')) {
					$j('.calcbox').hide();
					$j('.calcbox.packaging').show();
				}
			}
		});
		$j('select.type').change(function() {
			if($j(this).parent().siblings('.progress').find('.progress1').hasClass('on')) {
				$j(this).parent().siblings('.progress').find('.progress1').removeClass('on').addClass('off');
				$j(this).parent().siblings('.progress').find('.progress2').removeClass('off').addClass('on');
				$j(this).parent().siblings('.calcboxright').children('.disabled').removeClass('disabled').parent().find('select, input').removeAttr('disabled');
				if($j(this).parent().parent().hasClass('packaging')) {
					packQtyAjax();
					$j(this).parent().siblings('.calculate').children('.calculate-button').removeClass('off').addClass('on').on('click', function() {
						getStarted($j(this));
					});
				}
			}
			else if($j(this).parent().siblings('.progress').find('.progress2').hasClass('on')) {
				// do nothing
			}
			else if($j(this).parent().siblings('.progress').find('.progress3').hasClass('on')) {
				// do nothing
			}
		});
		
		$j('select.style').change(function() {
			$getstartedbtn = $j(this).parent().siblings('.calculate').children('.calculate-button:visible');
			if($getstartedbtn.hasClass('off')) {
				$getstartedbtn.removeClass('off').addClass('on');
			}
			if($getstartedbtn.hasClass('on')) {
				$getstartedbtn.on('click', function() {
					getStarted($j(this));
				});
			}
		});
		
		$j('.calculate-button.on').on('click', function() {
			getStarted($j(this));
		});
		
		// APPAREL SWATCHES
		
		$swatch.hover(
			function() {
				if($j(this).parent().hasClass('active')) {
				
				} else {
						$j(this).find('.swatchname').slideToggle(200);
				}
			},
			function() {
				if($j(this).parent().hasClass('active')) {
				
				} else {
						$j(this).find('.swatchname').slideToggle(200);
				}
			}
		);
		$swatchwrap.click(function() {
			if($j(this).hasClass('active')) {
				$j('.swatchflyout.active').slideToggle(200);
				$j('.active').removeClass('active');
				$j(this).find('.swatchname').show();
			} else if($j('.swatchflyout.active').length > 0) {
				$j('.swatchflyout.active').hide();
				var pos = $j(this).position().top + $j(this).outerHeight(true);
				$j('.active').removeClass('active');
				$j(this).addClass('active').next('.swatchflyout').css('top', pos + 'px').show().addClass('active');
				$j(this).find('.swatchname').hide();
			} else {
				var pos = $j(this).position().top + $j(this).outerHeight(true);
				console.log(pos);
				$j('.swatchflyout.active').slideToggle(200);
				$j('.active').removeClass('active');
				$j(this).addClass('active').next('.swatchflyout').css('top', pos + 'px').slideToggle(200).addClass('active');
				$j(this).find('.swatchname').hide();
				$j('html, body').animate({
					 scrollTop: $j(".swatchflyout.active").offset().top - 200
				}, 900);
			}
		});
		if($j('.swatchall').length > 0) {
			$j(document).click(function() {
				$j('.swatchflyout.active').slideToggle(200);
				$j('.active').removeClass('active');
			});
			$j(".swatchall").click(function(e) {
				e.stopPropagation(); // This is the preferred method.
			});	
		}
		
		$j('.calcboxright select, .calcboxright input').on('change', function() {
			calculate($j(this));
		});
		$j('.calcboxright input').on('keyup', function() {
			calculate($j(this));
		});
		
		// APPAREL CATEGORY PAGE
		
			var origHeight = $j('.content.apparel').height();
			$j('.view-all').click(function () {
				var $el = $j(this);
				var $eltop = $el.css('top');
				var $parent = $el.parent();
				var $wrap = $el.siblings('.app-wrap');
				var $title = $parent.parent().find('h2:first-child');
						console.log('orig'+origHeight);
				if($wrap.children('a').length > 4 ) {
					if($parent.hasClass('open')) {
						$parent.animate({height: origHeight}, 500).removeClass('open');
						$el.html('>> View All');
						$j("html, body").animate({ scrollTop: $parent.parent().offset().top - 30 }, 500);
						console.log(origHeight);
						// close it
					} else {
						var autoHeight = $parent.css('height', 'auto').height();
						//var $bottom = $parent.height();
						$parent.stop().height(origHeight).animate({height: autoHeight+'px'}, 500).addClass('open');
						console.log(autoHeight);
						$el.html('>> View Less');
						// open it
					}
				}
			});
/*		if($notouch.length) {
		} else {
			$j('.view-all').on('touchend', function () {
				var $el = $j(this);
				var $wrap = $el.siblings('.app-wrap');
				var $parent = $el.parent().parent();
			
				if($wrap.children('a').length > 1 ) {
			
					if($parent.hasClass('closed')) {
						var curHeight = $parent.height();
						var autoHeight = $parent.css('height', 'auto').height();
						var $bottom = $parent.height();
						$parent.height(curHeight).animate({height: autoHeight}, 200).removeClass('closed');
						console.log($bottom);
						$el.animate({ 'top' : $bottom - 80 + 'px' }).html('>> View Less');
						// open it
					} else {
						$parent.animate({height: '380px'}, 400).addClass('closed');
						$el.animate({ 'top' : '310px' }).html('>> View All');
						// close it
					}
				}
			});
		}
*/
		
		// AJAX for CALCULATOR
		
		$j('.apparel .type').on('change', function() {
			typeToStyleAjax();
		});
		
		$j('.stationery .style').on('change', function() {
			statQtyAjax();
		});
		$j('.packaging .type').on('change', function() {
			packQtyAjax();
		});
		
		// LOADING GIF
		$j('#ajaxLoader').hide().ajaxStart( function() {
			$j(this).show();  // show Loading Div
			} ).ajaxStop ( function(){
			$j(this).hide(); // hide loading div
		});
	});
</script>

<?php wp_footer(); ?>
</body>
</html>