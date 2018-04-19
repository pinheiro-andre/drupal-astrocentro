<?php $detect = mobile_detect_get_object(); ?>

<?php /* Affichage en mode teaser */ if($teaser){ ?>

	<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

		<div class="article-teaser-left">
			<?php hide($content['field_image']); ?>
			<?php print render($content['field_image']); ?>
		</div>

		<div class="article-teaser-right">
			<div class="title">
				<?php if (!$page): ?>
					<?php print render($title_prefix); ?>
					<h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
					<?php print render($title_suffix); ?>
				<?php endif; ?>
			</div>
			<div class="submitted">
				<!-- <p class="meta clearfix">por <?php //print $name; ?>, <?php //print $date; ?></p> -->
				<p class="meta"><?php print $date; ?></p>
			</div>

			<div class="content"<?php print $content_attributes; ?>>
				<?php
					hide($content['links']);
					hide($content['field_image']);
					print render($content);
					//print render($content['links']);
				?>
			</div>
	  </div>
	</div>

<?php
	} elseif($page) {
?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

<div class="footer--ads">

	<div class="expert--ad">

	</div>
</div>

	<div class="submitted">
		<?php print $submitted; ?>
	</div>

	<div class="content"<?php print $content_attributes; ?>>

		<?php
			// We hide the comments and links now so that we can render them later.
			hide($content['comments']);
			hide($content['links']);

			//tracker cta
			if ($items = field_get_items('node', $variables['node'], 'field_tracker')) {
				$subtracker = $items[0]['value'];
			}

			if (isset($subtracker)) {

				$load_content = render($content);

				//images desktop
				$img_cta1_desktop = file_create_url($node->field_cta_desktop_top_1['und'][0]['uri']);
				$img_cta2_desktop = file_create_url($node->field_cta_desktop_bottom_1['und'][0]['uri']);

				//links desktop
				$link_cta1_desktop = '';
				$link_cta2_desktop = '';
				if ($link = field_get_items('node', $variables['node'], 'field_cta_desktop_top_link_2')) {
					$link_cta1_desktop = $link[0]['value']."&tracker_id=v2_".$subtracker;
				}
				if ($link = field_get_items('node', $variables['node'], 'field_cta_desktop_bottom_link_1')) {
					$link_cta2_desktop = $link[0]['value']."&tracker_id=v2_".$subtracker;
				}

				//images mobile
				$img_cta1_mobile = file_create_url($node->field_cta_mobile_top_1['und'][0]['uri']);
				$img_cta2_mobile = file_create_url($node->field_cta_mobile_bottom_1['und'][0]['uri']);

				//links mobile
				$link_cta1_mobile = '';
				$link_cta2_mobile = '';
				if ($link = field_get_items('node', $variables['node'], 'field_cta_mobile_top_link_1')) {
					$link_cta1_mobile = $link[0]['value']."&tracker_id=v2_".$subtracker;
				}
				if ($link = field_get_items('node', $variables['node'], 'field_cta_mobile_bottom_link_1')) {
					$link_cta2_mobile = $link[0]['value'];
				}

				$first_cta_desktop = "<a href='".$link_cta1_desktop."' target='_blank'><img src='".$img_cta1_desktop."' class='cta-desktop-top' /></a>";
				$last_cta_desktop = "<a href='".$link_cta2_desktop."' target='_blank'><img src='".$img_cta2_desktop."' class='cta-desktop-bottom' /></a>";

				$first_cta_mobile = "<a href='".$link_cta1_mobile."' target='_blank' class='ctalink-mobile-top'><img src='".$img_cta1_mobile."' class='cta-mobile-top' /></a>";
				$last_cta_mobile = "<a href='".$link_cta2_mobile."' target='_blank' class='ctalink-mobile-bottom'><img src='".$img_cta2_mobile."' class='cta-mobile-bottom' /></a>";

				$html_obj = new simple_html_dom();
				$html_obj->load($load_content);

				foreach($html_obj->find('div[class=field-name-body] div[class=field-item]') as $desktop) {
					$desktop->children(0)->innertext .= $first_cta_desktop;
					$desktop->last_child()->innertext .= $last_cta_desktop;
				}

				foreach($html_obj->find('div[class=field-name-body] div[class=field-item]') as $mobile) {
					$mobile->children(0)->innertext .= $first_cta_mobile;
					$mobile->last_child()->innertext .= $last_cta_mobile;
				}

				$html_obj->save();
				echo $html_obj;

				$html_obj->clear();
				unset($html_obj);
			} else {
				print render($content);
			}
		?>

		<div class="social-buttons">
			<ul>
				<li>
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php print 'http://' . $_SERVER['HTTP_HOST'] . request_uri(); ?>" class="facebook-color" target="_blank">
						<span class="fa-stack fa-lg fa-2x">
							<i class="fa fa-square fa-stack-2x"></i>
							<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
						</span>
					</a>
				</li>
				<li>
					<a href="https://twitter.com/intent/tweet?text=<?php print drupal_get_title(); ?>&url=<?php print 'http://' . $_SERVER['HTTP_HOST'] . request_uri(); ?>&hashtags=blog&via=astrocentrobr" class="twitter-color" target="_blank">
						<span class="fa-stack fa-lg fa-2x">
							<i class="fa fa-square fa-stack-2x"></i>
							<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
						</span>
					</a>
				</li>
				<?php if ( $detect->isMobile() ) { ?>
					<li>
						<a href="whatsapp://send?text=<?php print drupal_get_title(); ?>" data-action="share/whatsapp/share" class="whatsapp-color">
							<span class="fa-stack fa-lg fa-2x">
								<i class="fa fa-square fa-stack-2x"></i>
								<i class="fa fa-whatsapp fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>


		<div id="more-experts" class="clearfix">
			<h3>Especialistas conectados</h3>
			<?php
				$block_experts = module_invoke('astrocentro_br_app','block_view','astrocentro_br_experts_tabs');
				print render($block_experts['content']);
			?>
		</div>


		<div id="more-content" class="clearfix">

			<!-- Below Article Thumbnails -->
			<div id="taboola-below-article-thumbnails"></div>
			<script type="text/javascript">
				window._taboola = window._taboola || [];
				_taboola.push({
					mode: 'thumbnails-a',
					container: 'taboola-below-article-thumbnails',
					placement: 'Below Article Thumbnails',
					target_type: 'mix'
				});
			</script>

			<!-- Organic Below Article Thumbnails -->
			<div id="taboola-organic-below-article-thumbnails"></div>
			<script type="text/javascript">
				window._taboola = window._taboola || [];
				_taboola.push({
					mode: 'organic-thumbnails-a',
					container: 'taboola-organic-below-article-thumbnails',
					placement: 'Organic Below Article Thumbnails',
					target_type: 'mix'
				});
			</script>

			<!-- Right Rail Article Thumbnails -->
			<div id="taboola-right-rail-article-thumbnails"></div>
			<script type="text/javascript">
				window._taboola = window._taboola || [];
				_taboola.push({
					mode: 'thumbnails-rr',
					container: 'taboola-right-rail-article-thumbnails',
					placement: 'Right Rail Article Thumbnails',
					target_type: 'mix'
				});
			</script>

			<!-- Organic Right Rail Article Thumbnails -->
			<div id="taboola-organic-right-rail-article-thumbnails"></div>
			<script type="text/javascript">
				window._taboola = window._taboola || [];
				_taboola.push({
					mode: 'organic-thumbnails-rr',
					container: 'taboola-organic-right-rail-article-thumbnails',
					placement: 'Organic Right Rail Article Thumbnails',
					target_type: 'mix'
				});
			</script>

		</div>
		<div class="clear"></div>

	</div>

	<div class="hr_plain"></div>

</div>

<?php
}
?>
