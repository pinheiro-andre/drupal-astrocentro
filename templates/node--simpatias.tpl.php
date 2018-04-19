<?php $detect = mobile_detect_get_object(); ?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  
	<div class="content simpatias"<?php print $content_attributes; ?>>
		<?php
			// print render($content);
			
			$wrapper = entity_metadata_wrapper('node', $node);
			$formtype = field_get_items('node', $node, 'field_simpatia');
			foreach($formtype as $itemid) {
				$item = field_collection_field_get_entity($itemid);
				
		?>
			<div>
					<a href="<?php print $item->field_simpatia_link ['und'][0]['url'] ?>" class="simpatias-link">
						<h2><?php print $item->field_simpatia_title['und'][0]['safe_value']; ?></h2>
						<img src="<?php print image_style_url('thumb_hp_last_content', $item->field_simpatia_image['und'][0]['uri']); ?>" />
					</a>
					<div class="simpatia-desc">
						<p><?php print $item->field_simpatia_description['und'][0]['safe_value']; ?></p>
					</div>
				</a>
			</div>
		<?php
			}
		?>
	</div>
</div>