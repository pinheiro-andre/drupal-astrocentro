<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>
	<head>
		<?php print $head; ?>
		<title><?php print $head_title; ?></title>
		
		<?php print $styles; ?>

		<!-- DFP -->
		<script type='text/javascript'>
			var googletag = googletag || {};
			googletag.cmd = googletag.cmd || [];
			(function() {
				var gads = document.createElement('script');
				gads.async = true;
				gads.type = 'text/javascript';
				var useSSL = 'https:' == document.location.protocol;
				gads.src = (useSSL ? 'https:' : 'http:') + 
				'//www.googletagservices.com/tag/js/gpt.js';
				var node = document.getElementsByTagName('script')[0];
				node.parentNode.insertBefore(gads, node);
			})();
		</script>
		<script type='text/javascript'>
			googletag.cmd.push(function() {
				googletag.defineSlot('/19717642/astrobr_sidebar_slot1', [300, 250], 'div-gpt-ad-1425649938190-0').addService(googletag.pubads());
				googletag.defineSlot('/19717642/astrobr_sidebar_slot2', [300, 250], 'div-gpt-ad-1425649938190-1').addService(googletag.pubads());
				googletag.defineSlot('/19717642/astrobr_sidebar_slot3', [300, 250], 'div-gpt-ad-1425649938190-2').addService(googletag.pubads());
				googletag.defineSlot('/19717642/astrobr_under_form', [468, 60], 'div-gpt-ad-1425649938190-3').addService(googletag.pubads());
				googletag.pubads().enableSingleRequest();
				googletag.enableServices();
			});
		</script>
		
		<?php
			$current_uri = $_SERVER['REQUEST_URI'];
			if (false !== strpos($current_uri,'oraculos')) { ?>
				<script src="<?php print base_path() . drupal_get_path('theme', 'astrocentro_br_v2') . '/js/swfobject.js'; ?>"></script>
		<?php } ?>
		
		<!-- Push notification -->
		<script src="<?php print 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/" . drupal_get_path('theme', 'astrocentro_br_v2') . '/pushbots-chrome.js'; ?>"></script>
		<link rel="manifest" href="<?php print 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/" . drupal_get_path('theme', 'astrocentro_br_v2') . '/manifest.json'; ?>">

		<!-- Taboola -->
		<script type="text/javascript">
			window._taboola = window._taboola || [];
			_taboola.push({article:'auto'});
			!function (e, f, u, i) {
				if (!document.getElementById(i)){
					e.async = 1;
					e.src = u;
					e.id = i;
					f.parentNode.insertBefore(e, f);
				}
			}(document.createElement('script'),
			document.getElementsByTagName('script')[0],
			'//cdn.taboola.com/libtrc/astrocentro/loader.js',
			'tb_loader_script');
		</script>

	</head>
	<body class="<?php print $classes; ?>"<?php print $attributes; ?>>

		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3&appId=1572280139724266";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	
		<?php print $page_top; ?>
		<?php print $page; ?>
		<?php print $scripts; ?>
		<?php print $page_bottom; ?>
		<!--[if lt IE 9]><script src="<?php print base_path() . drupal_get_path('theme', 'astrocentro_br_v2') . '/js/html5.js'; ?>"></script><![endif]-->
		
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		<script type="text/javascript">
		  window.___gcfg = {lang: 'fr'};

		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
		
		<script sync type="text/javascript">
		//<![CDATA[
			var _gaq = _gaq || [];
			var search_matches = window.location.pathname.match(/\/search\/(.*?)\/(.*)/);
			
			_gaq.push(['_setAccount', 'UA-35713232-2']);
			_gaq.push(['_setDomainName', '.astrocentro.com.br']);
			_gaq.push(['_trackPageview']);
			
			// doubleclick checker -
			window.onload = function () {

				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);


			setTimeout(function(){ if(typeof _gat === "undefined"){
			(function(){ var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		 })(); _gaq.push(['_trackEvent','GA Remarketing Tag','DC Script','Failed',0,true]);
			gaCustomVar.save();
		 } }, 1500); }
		  
			/*gaCustomVar.save();*/
			
			<?php if (arg(0) == 'search') { ?>
				_gaq.push(['_trackPageview', '/searchresult/?q=<?php echo arg(2) ?>']);
			<?php } ?>
		//]]>
		</script>
		
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-876783-19', 'auto');
		  ga('require', 'displayfeatures');
		  ga('send', 'pageview');

		</script>
		
		
		<script type="text/javascript">
			var $ = jQuery.noConflict();
			//Form LiveValidation
			if( jQuery('#edit-prospect-email').length ) {
				var prospectmail = new LiveValidation('edit-prospect-email');
				prospectmail.add( Validate.Email );
			}
			if( jQuery('#edit-prospect-email--3').length ) {
				var prospectmail3 = new LiveValidation('edit-prospect-email--3');
				prospectmail3.add( Validate.Email );
			}
		</script>
		
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');

		fbq('init', '681509141962022');
		fbq('track', "PageView");</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=681509141962022&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->
		
		<!-- End Taboola -->
		<script type="text/javascript">
			window._taboola = window._taboola || [];
			_taboola.push({flush: true});
		</script>
	</body>
</html>





