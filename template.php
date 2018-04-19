<?php

//bugfix :: avoiding 404 issues reporting by Google :: 20170103
$url = $_SERVER['HTTP_HOST'] . request_uri();
if (strpos($url,'mobile/') !== false || strpos($url,'m/') !== false) {
	$url = str_replace(array("mobile/", "m/"), "", $url );
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://".$url);
	exit();
}

function astrocentro_br_v2_html_head_alter(&$head_elements) {
	$head_elements['system_meta_content_type']['#attributes'] = array('charset' => 'utf-8');
}

function astrocentro_br_v2_breadcrumb($variables) {
	$sep = ' <i class="fa fa-angle-double-right"></i> ';

	if (count($variables['breadcrumb']) > 0) {
		return implode($sep, $variables['breadcrumb']);
	} else {
		return t("Home");
	}
}

function astrocentro_br_v2_menu_link(array $variables) {

	$element = $variables['element'];
	$sub_menu = '';

	/* Add angle down to expanded main menu */
	if( in_array('expanded',$element['#attributes']['class']) ){
		$linkText = $element['#title'] . ' <i class="fa fa-angle-down"></i>';
		$element['#localized_options']['html'] = true;
	} else {
		$linkText = $element['#title'];
	}

	if ($element['#below']) {
		$sub_menu = drupal_render($element['#below']);
	}

	$output = l($linkText, $element['#href'], $options = $element['#localized_options']);
	return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/* Override or insert variables into the page template */
function astrocentro_br_v2_preprocess_page(&$vars) {

	if (isset($vars['main_menu'])) {
		$vars['main_menu'] = theme('links__system_main_menu', array(
			'links' => $vars['main_menu'],
			'attributes' => array(
			'class' => array('links', 'main-menu', 'clearfix'),
		),
		'heading' => array(
		'text' => t('Main menu'),
			'level' => 'h2',
			'class' => array('element-invisible'),
		)
		));
	} else {
		$vars['main_menu'] = FALSE;
	}

	if (isset($vars['secondary_menu'])) {
		$vars['secondary_menu'] = theme('links__system_secondary_menu', array(
			'links' => $vars['secondary_menu'],
			'attributes' => array(
				'class' => array('links', 'secondary-menu', 'clearfix'),
			),
			'heading' => array(
				'text' => t('Secondary menu'),
				'level' => 'h2',
				'class' => array('element-invisible'),
			)
		));
	}
	else {
		$vars['secondary_menu'] = FALSE;
	}

	if (isset($vars['node'])) {
		$vars['theme_hook_suggestions'][] = 'page__'. str_replace('_', '--', $vars['node']->type);

	}

	//Reload the javascript into the scripts.
	$vars['scripts'] = drupal_get_js();

	$alias = drupal_get_path_alias();

	// Home Page, pas de fil d'ariane
	if($alias == "node")
		return;

	$breadcrumb = array();
	$breadcrumb[] = l('Home', 'blog');

	if(preg_match("/^blog\//", $alias)){

		//$breadcrumb[] = l('Blog', 'blog');

		$path = drupal_get_normal_path($alias);
		if(!preg_match("/^taxonomy\/term/", $path)){
			$node = menu_get_object();
			if(is_object($node)){
				$tid = $node->field_categorie[LANGUAGE_NONE][0]['tid'];
				$categorie = taxonomy_term_load($tid);
				$breadcrumb[] = l($categorie->name, drupal_get_path_alias("taxonomy/term/{$tid}"));
			}
		}
	}
	elseif(preg_match("/^previsoes\//", $alias)){
		$breadcrumb[] = l('Previsões', 'previsoes/horoscopo');

		if(preg_match("/^previsoes\/horoscopo\/.?/", $alias)){
			$breadcrumb[] = l('Horóscopo do dia', 'previsoes/horoscopo');
		}

		if(preg_match("/^evento\/chat\/.?/", $alias)){
			$breadcrumb[] = l('Chat ao vivo', 'evento/chat');
		}
	}
	elseif(preg_match("/^oraculos\//", $alias)){
		$breadcrumb[] = l('Oraculos', 'oraculos');
	}

	elseif ($alias == "/^video\//") {
		$breadcrumb[] = l('Vídeo', 'video');
	}

	elseif ($alias == "astrocentrotv") {
		$breadcrumb[] = l('AstrocentroTV', 'astrocentrotv');
	}
	elseif(preg_match("/^simpatias\//", $alias)){
		$breadcrumb[] = l('Simpatias', 'simpatias');
	}

	// Page courante
	if($alias != "oraculos" && $alias != "blog" && $alias != "video")
		$title = drupal_get_title();
	elseif($alias == "oraculos"){
		$title = "Oraculos";
	}
	elseif($alias == "blog"){
		$title = "Blog";
	}
	elseif($alias == "video"){
		$title = "Vídeo";
	}
	elseif($alias == "simpatias"){
		$title = "Simpatias";
	}
	$breadcrumb[] = l($title, $alias);

	$detect = mobile_detect_get_object();

	// Set the breadcrumbs only on desktop
	if ( !$detect->isMobile() ) {
		drupal_set_breadcrumb($breadcrumb);
	}

	// Add JS
	if ( $detect->isMobile() ) {
		drupal_add_js(drupal_get_path('theme', 'astrocentro_br_v2') . '/js/jquery.sidr.min.js');
	} else {
		drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css', 'external');
	}
	drupal_add_js(drupal_get_path('theme', 'astrocentro_br_v2') . '/js/livevalidation_standalone.compressed.js');
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js', 'external');
	drupal_add_js(drupal_get_path('theme', 'astrocentro_br_v2') . '/js/initialize.js');

	// -
	// Add CSS
	drupal_add_css('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', 'external');

    if ( $detect->isMobile() ) {
		drupal_add_css(drupal_get_path('theme', 'astrocentro_br_v2') . '/css/jquery.sidr.dark.css');
	}

	if ($alias == "astrocentrotv") {
		drupal_add_js(drupal_get_path('theme', 'astrocentro_br_v2') . '/js/initialize-astrocentrotv.js');
		drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/mixitup/1.5.6/jquery.mixitup.min.js', 'external');
		drupal_add_css(drupal_get_path('theme', 'astrocentro_br_v2') . '/css/astrocentrotv.css');
	}

	if ($alias == "oraculos/tarot-do-amor-gratis") {
		drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/magnific-popup.css', 'external');;
		drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/jquery.magnific-popup.min.js', 'external');
		drupal_add_js(drupal_get_path('theme', 'astrocentro_br_v2') . '/js/jquery.maskedinput.min.js');
	}

	if (arg(0) == 'search') {
		$vars['page']['header_top'] = NULL;
	}
}

function astrocentro_br_v2_js_alter(&$javascript) {
	$alias = drupal_get_path_alias();
	if ($alias == "astrocentrotv") {
		unset($javascript[drupal_get_path('theme', 'astrocentro_br_v2') . '/js/livevalidation_standalone.compressed.js']);
		unset($javascript[drupal_get_path('theme', 'astrocentro_br_v2') . '/js/jquery.maskedinput.min.js']);
	}
}

/* Duplicate of theme_menu_local_tasks() but adds clearfix to tabs */
function astrocentro_br_v2_menu_local_tasks(&$variables) {
	$output = '';

	if (!empty($variables['primary'])) {
		$variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
		$variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
		$variables['primary']['#suffix'] = '</ul>';
		$output .= drupal_render($variables['primary']);
	}
	if (!empty($variables['secondary'])) {
		$variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
		$variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
		$variables['secondary']['#suffix'] = '</ul>';
		$output .= drupal_render($variables['secondary']);
	}
	return $output;
}

/* Override or insert variables into the node template */
function astrocentro_br_v2_preprocess_node(&$variables) {

	$node = $variables['node'];
	if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
		$variables['classes_array'][] = 'node-full';
	}
	$variables['date'] = t('!datetime', array('!datetime' =>  date('d/m/y', $variables['created'])));

	//$variables['article_middle'] = theme('blocks', 'article_middle');
    // Get a list of all the regions
	foreach (system_region_list($GLOBALS['theme']) as $region_key => $region_name) {

		// Get the content for each region and add it to the $region variable
		if ($blocks = block_get_blocks_by_region($region_key)) {
			$variables['region'][$region_key] = $blocks;
		} else {
			$variables['region'][$region_key] = array();
		}
	}

	// init var to include the block newsletter_v2 below article
	$variables['prospect_captation_block'] = block_render('astrocentro_br_app', 'astrocentro_br_newsletter_v2');

	//Facebook Open Graph Metatags
	if ($variables['type'] == 'article') {

		$og_title = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'property' => 'og:title',
				'content' => $variables['title'],
			),
		);
		drupal_add_html_head($og_title, 'og_title');

		$og_url = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'property' => 'og:url',
				'content' => 'http://' . $_SERVER['HTTP_HOST'] . request_uri(),
			),
		);
		drupal_add_html_head($og_url, 'og_url');

		$img = field_get_items('node', $variables['node'], 'field_image');
		$img_url = file_create_url($img[0]['uri']);
		$og_image = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'property' => 'og:image',
				'content' => $img_url,
			),
		);
		drupal_add_html_head($og_image, 'og_image');

		$og_image_url = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'property' => 'og:image:url',
				'content' => $img_url,
			),
		);
		drupal_add_html_head($og_image_url, 'og_image_url');

		$og_image_type = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'property' => 'og:image:type',
				'content' => 'image/jpg',
			),
		);
		drupal_add_html_head($og_image_type, 'og_image_type');

		$og_image_width = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'property' => 'og:image:width',
				'content' => '590',
			),
		);
		drupal_add_html_head($og_image_width, 'og_image_width');

		$og_image_height = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'property' => 'og:image:width',
				'content' => '280',
			),
		);
		drupal_add_html_head($og_image_height, 'og_image_height');


		$body_field = field_view_field('node', $variables['node'], 'body', array('type' => 'text_plain'));
		$og_description = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'property' => 'og:description',
				'content' => text_summary($body_field[0]['#markup'], NULL, 100),
			),
		);
		drupal_add_html_head($og_description, 'og_description');

		$og_type = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'property' => 'og:type',
				'content' => 'article',
			),
		);
		drupal_add_html_head($og_type, 'og_type');


		//Twitter Metatags
		$twitter_card = array( '#tag' => 'meta', '#attributes' => array( 'name' => 'twitter:card', 'content' => 'summary', ), );
		drupal_add_html_head($twitter_card, 'twitter_card');

		$twitter_site = array( '#tag' => 'meta', '#attributes' => array( 'name' => 'twitter:site', 'content' => '@astrocentrobr', ), );
		drupal_add_html_head($twitter_site, 'twitter_site');

		$twitter_title = array( '#tag' => 'meta', '#attributes' => array( 'name' => 'twitter:title', 'content' => $variables['title'], ), );
		drupal_add_html_head($twitter_title, 'twitter_title');

		$twitter_description = array( '#tag' => 'meta', '#attributes' => array( 'name' => 'twitter:description', 'content' => text_summary($body_field[0]['#markup'], NULL, 100), ), );
		drupal_add_html_head($twitter_description, 'twitter_description');

		$twitter_image = array( '#tag' => 'meta', '#attributes' => array( 'name' => 'twitter:image', 'content' => $img_url, ), );
		drupal_add_html_head($twitter_image, 'twitter_image');

		$twitter_url = array( '#tag' => 'meta', '#attributes' => array( 'name' => 'twitter:url', 'content' => 'http://'.$_SERVER['HTTP_HOST'].'/'.drupal_lookup_path('alias',current_path()), ), );
		drupal_add_html_head($twitter_url, 'twitter_url');

	}

}

function astrocentro_br_v2_page_alter($page) {

	// <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	$viewport = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
			'name' =>  'viewport',
			'content' =>  'initial-scale=1'
		)
	);
	drupal_add_html_head($viewport, 'viewport');

	// Chrome push notification
	<link rel="manifest" href="sites/all/themes/astrocentro_br_v2/manifest.json">
	$push_manifest = array(
		'#type' => 'html_tag',
		'#tag' => 'link',
		'#attributes' => array(
			'rel' =>  'manifest',
			'href' =>  'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/".drupal_get_path('theme', 'astrocentro_br_v2') . '/manifest.json'
		)
	);
	drupal_add_html_head($push_manifest, 'push_manifest');
	drupal_add_js(drupal_get_path('theme', 'astrocentro_br_v2') . '/pushbots-chrome.js');
	drupal_add_js('jQuery.extend(Drupal.settings, { "pathToTheme": "' . path_to_theme() . '" });', 'inline');


	//Favicons
	$msapplication = array( '#tag' => 'meta', '#attributes' => array( 'name' => 'msapplication-config', 'content' => '/sites/all/themes/astrocentro_br_v2/images/favicons/favicon-16x16.png?v=KmbGMjQAGr/images/favicons/browserconfig.xml?v=KmbGMjQAGr' ) );
	drupal_add_html_head($msapplication, 'msapplication-config');

	$theme_color = array( '#tag' => 'meta', '#attributes' => array( 'name' => 'theme-color', 'content' => '#ffffff' ) );
	drupal_add_html_head($theme_color, 'theme-color');

	$apple_icon = array( '#tag' => 'link', '#attributes' => array( 'rel' => 'apple-touch-icon', 'sizes' => '180x180', 'href' => '/sites/all/themes/astrocentro_br_v2/images/favicons/apple-touch-icon.png?v=KmbGMjQAGr' ) );
	drupal_add_html_head($apple_icon, 'apple-touch-icon');

	$icon_32 = array( '#tag' => 'link', '#attributes' => array( 'rel' => 'icon', 'type' => 'image/png', 'href' => '/sites/all/themes/astrocentro_br_v2/images/favicons/favicon-32x32.png?v=KmbGMjQAGr', 'sizes' => '32x32' ) );
	drupal_add_html_head($icon_32, 'icon');

	$icon_16 = array( '#tag' => 'link', '#attributes' => array( 'rel' => 'icon', 'type' => 'image/png', 'href' => '/sites/all/themes/astrocentro_br_v2/images/favicons/favicon-16x16.png?v=KmbGMjQAGr', 'sizes' => '16x16' ) );
	drupal_add_html_head($icon_16, 'icon');

	$manifest = array( '#tag' => 'link', '#attributes' => array( 'rel' => 'manifest', 'href' => '/sites/all/themes/astrocentro_br_v2/images/favicons/manifest.json?v=KmbGMjQAGr' ) );
	drupal_add_html_head($manifest, 'manifest');

	$mask_icon = array( '#tag' => 'link', '#attributes' => array( 'rel' => 'mask-icon', 'href' => '/sites/all/themes/astrocentro_br_v2/images/favicons/safari-pinned-tab.svg?v=KmbGMjQAGr', 'color' => '#5bbad5' ) );
	drupal_add_html_head($mask_icon, 'mask-icon');

	$shortcut_icon = array( '#tag' => 'link', '#attributes' => array( 'rel' => 'shortcut icon', 'href' => '/sites/all/themes/astrocentro_br_v2/images/favicons/favicon.ico?v=KmbGMjQAGr' ) );
	drupal_add_html_head($shortcut_icon, 'mask-icon');

}

function astrocentro_br_v2_form_alter(&$form, &$form_state, &$form_id){
	if ($form_id == 'search_form' && $_GET['q'] != 'search') {
		unset($form['advanced']);
	}
	if ($form_id == 'search_block_form') {
		$form['search_block_form']['#title_display'] = 'invisible';
		$form['search_block_form']['#attributes']['placeholder'] = t('O que você procura?');
		$form['actions']['submit']['#value'] = t('');
		$form['actions']['submit']['#attributes']['class'][] = 'submit-search-form';
	}
}

function block_render($module, $block_id) {
	$block = block_load($module, $block_id);
	$block_content = _block_render_blocks(array($block));
	$build = _block_get_renderable_array($block_content);
	$block_rendered = drupal_render($build);
	return $block_rendered;
}

function astrocentro_br_v2_preprocess_search_result(&$vars) {
	$node = $vars['result']['node'];
	if ($node->nid) {
		$vars['teaser'] = node_view($node, 'teaser');
	}
}
