<?php 
	$detect = mobile_detect_get_object();

	if ((isset($_GET["wl"])) || (isset($_COOKIE["wl"]))) {
		$telephone_display = '(11) 4933-0754';
		$telephone_call = '+551149330754';
	} else {
		$telephone_display = '(11) 3957-1012';
		$telephone_call = '+551139571012';
	}
?>

<div id="wrap" class="clearfix">
	<div id="header-wrap">
		<header id="header" class="clearfix" role="banner">
		  
			<?php if( $detect->isMobile() || $detect->isTablet() ){ ?>
				<div id="mobile-header">
					<a id="responsive-menu-button" href="#responsive-menu-button"><span>Menu</span></a>
				</div>
			<?php } ?>

			<div id="site-header-main" class="clearfix">
				<a href="/blog" title="Blog do <?php print $site_name; ?>" class="brand" rel="home">Blog do <span><?php print $site_name; ?></span></a>
				<?php if( !$detect->isMobile() && !$detect->isTablet() ){ ?>
					<p class="callcenter">Atendimento: <a href="tel:<?php echo $telephone_call ?>"><i class="fa fa-phone fa-lg"></i> <?php echo $telephone_display ?></a></p>
				<?php } ?>
				
				<div class="header-elements">
					<?php if( $detect->isMobile() || $detect->isTablet() ){ ?>
						<p class="callcenter">Atendimento: <a href="tel:<?php echo $telephone_call ?>"><i class="fa fa-phone fa-lg"></i> <?php echo $telephone_display ?></a></p>
					<?php } ?>
					<?php print render($page['header_top']); //Search bar ?>
				</div>
			</div>
			
			<nav id="navigation" role="navigation">
				<div id="main-menu">
					<?php 
						if (module_exists('i18n_menu')) {
							$main_menu_tree = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu'));
						} else {
							$main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
						}
						print drupal_render($main_menu_tree);
					?>
				</div>
			</nav>
		</header>
	
	<!-- Search bar-->
	<?php print render($page['header_top']); ?>
	<div class="clear"></div>
  </div>
  
  <div id="main-content" class="clearfix">
    <?php $sidebarclass=" "; if($page['sidebar_first']) { $sidebarclass="sidebar-bg"; } ?>
    <div id="primary" class="container <?php print $sidebarclass; ?> clearfix">
      <section id="content" role="main" class="clearfix">
		<?php print $messages; ?>
        <?php if (theme_get_setting('breadcrumbs')): ?><?php if ($breadcrumb): ?><div id="breadcrumbs"><?php print $breadcrumb; ?></div><?php endif;?><?php endif; ?>
        
        <?php if ($page['content_top']): ?><div id="content_top"><?php print render($page['content_top']); ?></div><?php endif; ?>
        <div id="content-wrap">
          <?php print render($title_prefix); ?>
          <?php if ($title): ?><h1 class="page-title"><?php print $title; ?></h1><?php endif; ?>
          <?php print render($title_suffix); ?>
          <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper clearfix"><?php print render($tabs); ?></div><?php endif; ?>
          <?php print render($page['help']); ?>
          <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
          <?php print render($page['content']); ?>
        </div>
      </section>
    </div>

    <div class="clear"></div>
  </div>

	
	<footer id="footer-bottom">
			<div id="copyright">
				<h2>Consultas esotéricas 24 horas</h2> &copy; <?php print t('Copyright'); ?> <a href="<?php print $front_page; ?>"><?php print $site_name; ?></a> <?php echo date("Y"); ?> - todos direitos reservados
			</div>

			<ul id="footer-categories" class="clearfix">
				<li><a href="/blog/tarot">Tarot</a></li>
				<li><a href="/blog/videncia">Vidência</a></li>
				<li><a href="/blog/astrologia">Astrologia</a></li>
				<li><a href="/blog/oraculos">Oráculos</a></li>
				<li><a href="/blog/numerologia">Numerologia</a></li>
				<li><a href="/blog/espiritual">Bem-estar</a></li>
			</ul>
			<div class="clear"></div>
			
	
<?php 
		$twitter_url = theme_get_setting('twitter_url', 'astrocentro_br_v2'); 
		$facebook_url = theme_get_setting('facebook_url', 'astrocentro_br_v2'); 
		$google_plus_url = theme_get_setting('google_plus_url', 'astrocentro_br_v2');
?>
			
			<ul id="footer-social" class="clearfix">
				<?php if ($facebook_url): ?><li>
				  <a target="_blank" title="<?php print $site_name; ?> Facebook" href="<?php print $facebook_url; ?>"><img alt="Facebook" src="<?php print base_path() . drupal_get_path('theme', 'astrocentro_br_v2') . '/images/social/facebook.png'; ?>"> </a>
				</li><?php endif; ?>
				<?php if ($twitter_url): ?><li>
				  <a target="_blank" title="<?php print $site_name; ?>Twitter" href="<?php print $twitter_url; ?>"><img alt="Twitter" src="<?php print base_path() . drupal_get_path('theme', 'astrocentro_br_v2') . '/images/social/twitter.png'; ?>"> </a>
				</li><?php endif; ?>
				<?php if ($google_plus_url): ?><li>
				  <a target="_blank" title="<?php print $site_name; ?>Google+" href="<?php print $google_plus_url; ?>"><img alt="Google+" src="<?php print base_path() . drupal_get_path('theme', 'astrocentro_br_v2') . '/images/social/google.png'; ?>"> </a>
				</li><?php endif; ?>
				<li>
				  <a target="_blank" title="<?php print $site_name; ?>RSS" href="<?php print $front_page; ?>rss.xml"><img alt="RSS" src="<?php print base_path() . drupal_get_path('theme', 'astrocentro_br_v2') . '/images/social/rss.png'; ?>"> </a>
				</li>
			</ul>
<?php if ($page['footer']): ?>
			<?php print render($page['footer']); ?>
<?php endif; ?>
	</footer>
</div>