<article>
	<?php if ($teaser) : ?>
		<?php print drupal_render($teaser); ?>
		
	<?php else :  ?>  
		<?php print render($title_prefix); ?>
			<h3><a href="<?php print $url; ?>"><?php print $title; ?></a></h3>
	<?php endif; ?>
</article>