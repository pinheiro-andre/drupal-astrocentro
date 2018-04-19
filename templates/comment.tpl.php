<article class="<?php print $classes; ?>" <?php print $attributes; ?>>
  <footer>
    <?php if ($new): ?>
      <mark><?php print $new; ?></mark>
    <?php endif; ?>
	
	<div class="comment-meta">
		<span class="author">
			<strong><?php print $author; ?></strong>
		</span>, 
		<span class="date">
			<time pubdate><?php print '<a href="#comment-'.$comment->cid.'" rel="bookmark" title="Permalink to this comment">'.$created.'</a>'; ?></time>
		</span>
	</div>
  </footer>
 
 
 
  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['links']);
      print render($content);
    ?>
  </div>
 
 
  <?php print render($content['links']) ?>
</article>