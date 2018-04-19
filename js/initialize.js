jQuery(document).ready(function(){

	jQuery('#wrap').click(function(event){
		event.stopPropagation();
	});


	// if mobile
	if( jQuery('#responsive-menu-button').length ) {

		//Sidr
		jQuery('#responsive-menu-button').sidr({
			side: 'left',
			source: '#main-menu',
			name: 'sidr-main',
		});
		jQuery('#main-content, #header-wrap').click(function() {
			jQuery.sidr('close','sidr-main');
		});
		jQuery('#sidr-main').click(function() {
			e.stopPropagation();
		});
		jQuery("#main-content, #header-wrap").on("click",function(e) { jQuery.sidr('close'); });

		//Toggle Search Box
		jQuery('#header .bt-search').click(function() {
			jQuery('.region-header-top').toggleClass('opened');
			return false;
		});

		//Ad banner expert most consulted
		if( document.cookie.indexOf("no-banner") < 0) {
			setTimeout(function(){
				jQuery( ".banner--expert" ).animate({
					opacity: 1,
					bottom: 0,
				}, 1000, function() {});
			}, 2000);
		}

		jQuery('.banner--expert--close').click(function() {
	  		jQuery('.banner--expert').animate({
				opacity: 0,
			}, 1000, function() {
				if( document.cookie.indexOf("no-banner") < 0) {
				  	document.cookie = "no-banner=1; max-age=" + 60 * 60 * 24 * 10 + "path=/; domain=" + window.location.host;
				}
			});
		});

		/* Display expert scroll banner mobile */
		var mywindow = jQuery(window);
		var mypos = mywindow.scrollTop();
		var up = false;
		var newscroll;
		mywindow.scroll(function () {
		    newscroll = mywindow.scrollTop();
		    if (newscroll > mypos && !up) {
		        jQuery('.expert_mobile').stop().slideToggle().hide();
		        up = !up;
		        console.log('up');
		    } else if(newscroll < mypos && up) {
		        jQuery('.expert_mobile').stop().slideToggle();
		        up = !up;
		        console.log('down');
		    }
		    mypos = newscroll;
		});

		jQuery('.fa-close').click(function() {
	  		jQuery('.expert_mobile').animate({
				opacity: 0,
			}, 1000, function() {
				if( document.cookie.indexOf("no-banner") < 0) {
				  	document.cookie = "no-banner=1; max-age=" + 60 * 60 * 24 * 10 + "path=/; domain=" + window.location.host;
				}
			});
		});

		if( document.cookie.indexOf("no-banner") < 0) {
			console.log('no cookie');
		} else {
			jQuery('.expert_mobile').remove();
			console.log('banner removed');
		}


	}

	//Add a close link
  	jQuery('#sidr-main ul.sidr-class-menu').prepend(
     	jQuery('<li id="sidr-close-opt">').append(
    		jQuery('<a class="sidr-close sidr-class-sf-depth-1 sidr-class-active">').attr('href','#').append("X")
  	));
  	if ( jQuery("#sidr-close-opt").length ) {
     	jQuery( "#sidr-close-opt" ).on("click", function() {
        	   jQuery.sidr('close', 'sidr-main');
     	});
  	}
  	jQuery('#sidr-main li.sidr-class-expanded #sidr-close-opt').remove();



	function getUrlParameter(sParam) {
		var sPageURL = window.location.search.substring(1);
		var sURLVariables = sPageURL.split('&');
		for (var i = 0; i < sURLVariables.length; i++) {
			var sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] == sParam)
			{
				return sParameterName[1];
			}
		}
	}

	//if visitor come from IG Delas
	if (getUrlParameter('wl') !== undefined || document.cookie.indexOf("wlj") >= 0){
		if( document.cookie.indexOf("wlj=") < 0) {
		  document.cookie = "wlj=161; max-age=" + 60 * 60 * 24 * 10 + "path=/; domain=" + window.location.host;
		}

		var wl = getUrlParameter('wl');

		var url = jQuery('.menu > .last > a').attr('href');
		url = url.replace('http://astrocentro.com.br/', 'http://www.wengo.com.br/');
		url = url.replace('v2_9019', 'v2_11601');
		jQuery('.menu > .last > a').attr('href', url);
		jQuery('.menu > .last > a').attr('href', jQuery('.menu > .last > a').attr('href') + '&wl=161');


	}

/* Manage wengowense trackers ID */
	if (jQuery('.not-front').length){
		jQuery('#more-experts .wg-card a').each(function(){
			this.href = this.href.replace('v2_11560', 'v2_10165');
		});
	}
	//- banner
	if (jQuery('.expert_mobile').length){
		jQuery('.expert_mobile a').each(function(){
			this.href = this.href.replace('v2_11560', 'v2_18031');
		});
	}


	//remove img height & width attributes
	jQuery('img').each(function(){
	  jQuery(this).removeAttr('width');
	  jQuery(this).removeAttr('height');
	});

	/*validation numero de telephone sur 2 champs*/
	var ddd = ["11", "12", "13", "14", "15", "16", "17", "18", "19", "21", "22", "24", "27", "28"];
	jQuery.fn.selectRange = function(start, end) {
		return this.each(function() {
			if (this.setSelectionRange) {
				this.focus();
				this.setSelectionRange(start, end);
			} else if (this.createTextRange) {
				var range = this.createTextRange();
				range.collapse(true);
				range.moveEnd('character', end);
				range.moveStart('character', start);
				range.select();
			}
		});
	};
	jQuery("input[id^='edit-prospect-phone1']").attr('maxlength','2');
	jQuery("input[id^='edit-prospect-phone1']").blur(function() {
		var value = jQuery( this ).val();
		if(jQuery.inArray(value, ddd) != -1){
			jQuery( "input[id^='edit-prospect-phone2']" ).val('9');
			jQuery( "input[id^='edit-prospect-phone2']" ).selectRange(1,2);
			jQuery( "input[id^='edit-prospect-phone2']" ).attr('maxlength','9');
			jQuery( "input[id^='edit-prospect-phone2']" ).attr('minlength','9');
		}

		else if(jQuery.inArray(value, ddd) == -1){
			jQuery( "input[id^='edit-prospect-phone2']" ).val('');
			jQuery( "input[id^='edit-prospect-phone2']" ).attr('maxlength','8');
			jQuery( "input[id^='edit-prospect-phone2']" ).attr('minlength','8');
		}
	});

	jQuery.validator.addMethod("valueNotEquals", function(value, element, arg){
		return arg != value;
	}, "");

	//Validation des formulaires
	jQuery("#astrocentro-br-newsletter-v2-form--2").validate({
		rules: {
			prospect_email: {
				required: true,
				email: true
			},
			prospect_name: {
				required: true,
				minlength: 3,
			},
			prospect_phone1: {
				required: true,
				min:11,
				maxlength: 3,
			},
			prospect_phone2: {
				required: true
			}
		},
		messages: {
			prospect_email: "digite seu email",
			prospect_name: "campo obrigatorio",
			prospect_phone1: "digite o DDD",
			prospect_phone2: "digite seu celular",
		},

		highlight: function(element) {
			$(element).closest('.form-type-textfield input').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-type-textfield input').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			if(element.parent('.input-group').length) {
				error.insertBefore(element.parent());
			} else {
				error.insertBefore(element);
			}
		},
		submitHandler: function(form) {
			form.submit();
		}
	});

    // validade blogform type landing
    jQuery("#astrocentro-br-landing-blogform-form").validate({
		rules: {
			prospect_email: {
				required: true,
				email: true
			},
			prospect_name: {
				required: true,
				minlength: 3,
			},
			prospect_phone1: {
				required: true,
				min:11,
				maxlength: 3,
			},
			prospect_phone2: {
				required: true
			}
		},
		messages: {
			prospect_email: "digite seu email",
			prospect_name: "campo obrigatorio",
			prospect_phone1: "digite o DDD",
			prospect_phone2: "digite seu celular",
		},

		highlight: function(element) {
			$(element).closest('.form-type-textfield input').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-type-textfield input').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			if(element.parent('.input-group').length) {
				error.insertBefore(element.parent());
			} else {
				error.insertBefore(element);
			}
		},
		submitHandler: function(form) {
			form.submit();
		}
	});

	//fix jcarousel class
	jQuery('#more-videos .view-video-recommended .view-content > div').removeClass(' jcarousel-skin-astrobr').addClass('jcarousel-skin-astrobr');

	//open a new tab/window on CTA post
	jQuery('div[class^="call2action"] a').attr('target','_blank');

	//hide related posts if empty
	if (jQuery('.view-related-tags-posts').length == 0) {
		jQuery('.removeifempty').remove();
	}




/* jcarousel resize */
(function(jQuery) {
	jQuery(window).resize(function() {
		var carousel_line = 110;

		var header_height = jQuery('#header').height();
		var footer_height = jQuery('#footer').height();
		var viewport_height = jQuery(window).height();

		var cpp = Math.floor((viewport_height - header_height - footer_height )/carousel_line);

		jQuery('.jcarousel-container, .jcarousel-clip').height(carousel_line * cpp);

	});

	Drupal.behaviors.mytheme = {
		attach: function(context, settings) {
			jQuery(window).resize();
		}
	}
})(jQuery);


// SAC open time
var startTime = '9:00 AM';
var endTime = '7:00 PM';

var curr_time = getval();
var currentTime = new Date();
var isWeekend = (currentTime.getDay() == 6) || (currentTime.getDay() == 0);

if (get24Hr(curr_time) > get24Hr(startTime) && get24Hr(curr_time) < get24Hr(endTime) && !isWeekend) {
    //alert("ok");
} else {
    //alert('nok');

    /* ANNONCES CTA - v1 */
	jQuery('.call2action-mobile-1').clone().insertAfter('.call2action-mobile-2');
	jQuery('.call2action-mobile-2').remove();

	/* ANNONCES CTA - v2 */
	jQuery('.ctalink-mobile-top').clone().insertAfter('.ctalink-mobile-bottom');
	jQuery('.ctalink-mobile-bottom').remove();

	/* Header */
	jQuery('#header .sac').replaceWith('<div class="sac on__mobile">Atendimento de segunda a sexta, das 9h às 19h</div>');
}

function get24Hr(time){
    var hours = Number(time.match(/^(\d+)/)[1]);
    var AMPM = time.match(/\s(.*)$/)[1];
    if(AMPM == "PM" && hours<12) hours = hours+12;
    if(AMPM == "AM" && hours==12) hours = hours-12;

    var minutes = Number(time.match(/:(\d+)/)[1]);
    hours = hours*100+minutes;
    //console.log(time +" - "+hours);
    return hours;
}

function getval() {
    var currentTime = new Date()
    var hours = currentTime.getHours()
    var minutes = currentTime.getMinutes()

    if (minutes < 10) minutes = "0" + minutes;

    var suffix = "AM";
    if (hours >= 12) {
        suffix = "PM";
        hours = hours - 12;
    }
    if (hours == 0) {
        hours = 12;
    }
    var current_time = hours + ":" + minutes + " " + suffix;

    return current_time;

}
