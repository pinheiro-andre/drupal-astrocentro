<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>

<?php $detect = mobile_detect_get_object(); ?>

<?php /* Affichage en mode teaser */ if($teaser){ ?>
	<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

		<div class="article-teaser-left">
			<?php hide($content['field_video_url_embed']); ?>
			<?php print render($content['field_video_url_embed']); ?>
		</div>

		<div class="article-teaser-right">
			<div class="title">
			<?php if (!$page): ?>
				<?php print render($title_prefix); ?>
					<h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
				<?php print render($title_suffix); ?>
			<?php endif; ?>
			</div>
			<div class="submitted"><p class="meta clearfix"><?php print $date; ?></p></div>

			<div class="content"<?php print $content_attributes; ?>>
				<?php
					hide($content['links']);
					print render($content);
					//print render($content['links']);
				?>

			</div>
		</div>
	</div>

<?php 
}
// Mode Page
elseif($page){
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

	<div class="submitted"> <?php print $submitted; ?> </div>
  
	<div class="content"<?php print $content_attributes; ?>>
		<?php print render($content); ?>
		
		<?php if ( $detect->isMobile() ) { ?>
			<div id="more-video" class="clearfix">
				<h3>Assista também</h3>
				<?php 
					$block_video = module_invoke('views','block_view','more_videos-block');
					print render($block_video);
				?>
			</div>
		
			<div id="sibebar-video">
				<?php print $prospect_captation_block; ?>
				
				<div class="experts-content">
					<span>Esotéricos e videntes disponíveis agora</span>
					<script type="text/javascript">var wengo_widget_u = (location.protocol=='https:'?'https://secure.wgcdn.net/widget/':'http://www.wgcdn.net/widget/');document.write ('<scr'+'ipt type="text/javascript" src="'+wengo_widget_u+'v=5/t=sellerlist/k=465b9b364090bec46deabece391b0188/lng=por_bra/wl=140/a=jif/q=limit%3A4%20sortfilter%3A8/c=4/f=260x85/r=260x318/wp=0/c1=F5F5F5/c2=9f0d5e/c3=FFFFFF/c4=000000/c5=0065D1/tracker_id=v2_10165"></scr'+'ipt>');</script>
				</div>
			</div>
		<?php } else { ?>
			<div id="sibebar-video">
				<?php print $prospect_captation_block; ?>
				
				<div class="experts-content">
					<span>Esotéricos e videntes disponíveis agora</span>
					<script type="text/javascript">var wengo_widget_u = (location.protocol=='https:'?'https://secure.wgcdn.net/widget/':'http://www.wgcdn.net/widget/');document.write ('<scr'+'ipt type="text/javascript" src="'+wengo_widget_u+'v=5/t=sellerlist/k=465b9b364090bec46deabece391b0188/lng=por_bra/wl=140/a=jif/q=limit%3A4%20sortfilter%3A8/c=4/f=260x85/r=260x318/wp=0/c1=F5F5F5/c2=9f0d5e/c3=FFFFFF/c4=000000/c5=0065D1/tracker_id=v2_10165"></scr'+'ipt>');</script>
				</div>
			</div>
			
			<div class="bt-social">
				<div class="fb-share-button" data-href="<?php $_SERVER['HTTP_HOST'] . request_uri(); ?>" data-layout="button_count"></div>
				
				<div class="twitter-share-button">
					<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</div>
			</div>
			
			<div id="more-video" class="clearfix">
				<h3>Assista também</h3>
				<?php 
					// display 6 random videos 
					$block_video = module_invoke('views','block_view','more_videos-block');
					print render($block_video);
				?>
			</div>
		
			<div id="more-video" class="removeifempty clearfix">
				<h3>Artigos recentes</h3>
				<?php 
					// display 3 posts with same tags
					$block_recents_posts = module_invoke('views','block_view','related_tags_posts-block');
					print render($block_recents_posts);
				?>
			</div>
		<?php } ?>
		
		
		<div class="clear"></div>
	</div>
  
	<div class="hr_plain"></div>

</div>

<?php 
}
?>	