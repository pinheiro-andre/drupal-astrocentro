jQuery(document).ready(function ($) {

	var $ = jQuery.noConflict();
	
//------------------------------------------------------------------------------------
	/* remove aside blocs if tablets */
//------------------------------------------------------------------------------------
	
	var isiPad = navigator.userAgent.toLowerCase().indexOf('ipad');
	if(isiPad > -1){
		jQuery('#sidebar').parent().hide();
		jQuery('#sidebar').parent().css('display', 'none');
	}
	else if (jQuery(window).width() > 768 && jQuery(window).width() < 959) {
		jQuery('#sidebar').parent().hide();
		jQuery('#sidebar').parent().css('display', 'none');
	}
	
//------------------------------------------------------------------------------------
	/* cards deck effect */
//------------------------------------------------------------------------------------
	
	var ID = 0;
	$('#index_cards > li').each(function() {
		ID++;
		$(this).attr('id', 'card-'+ID);
	});
	
//------------------------------------------------------------------------------------
	/* Popup */
//------------------------------------------------------------------------------------
	
    $.fn.shuffle = function() {
 
        var allElems = this.get(),
            getRandom = function(max) {
                return Math.floor(Math.random() * max);
            },
            shuffled = $.map(allElems, function(){
                var random = getRandom(allElems.length),
                    randEl = $(allElems[random]).clone(true)[0];
                allElems.splice(random, 1);
                return randEl;
           });
 
        this.each(function(i){
            $(this).replaceWith($(shuffled[i]));
        });
 
        return $(shuffled);

    };

	var random = Math.round(Math.random()*1);
	var count = 0;
	$(".mychoice").click(function() {
		$("#readingcards > div").shuffle().addClass("selected");
		count++;
		console.log(count);
	});
	
	$('.bordeaux').magnificPopup({
		type:'inline',
		midClick: true
	});
	
$(document).click(function(e){
    if($(e.target).closest('.2tryleft').length){
        $.magnificPopup.proto.close.call(this);
		return false;
    }
    if($(e.target).closest('.1tryleft').length){
        $.magnificPopup.proto.close.call(this);
		return false;
    }
});
	
    $('.mychoice').magnificPopup({
        type: 'inline',
        midClick: true,
        callbacks: {
            open: function () {
				if (count > 3){
					$('.bordeaux').magnificPopup('open');
				}
				if (count == 1){
					$( ".talk" ).before( "<p class='2tryleft' style='text-align:center'><a href='#'><span>Você ainda tem duas cartas para sua tiragem de hoje.<br/>Quer tirá-las?</span></a></p>" );
					$( ".1tryleft" ).remove();
				}
				if (count == 2){
					$( ".talk" ).before( "<p class='1tryleft' style='text-align:center'><a href='#'><span>Você ainda tem uma carta para sua tiragem de hoje.<br/>Quer tirá-la?</span></a></p>" );
					$( ".2tryleft" ).remove();
				}
				if (count == 3){
					$( ".2tryleft" ).remove();
					$( ".1tryleft" ).remove();
				}
			
                $.magnificPopup.instance.close = function () {
                    var confirmed = $(".caption").removeClass("selected").hide();
                    if (!confirmed) {
                        return;
                    }
                    $.magnificPopup.proto.close.call(this);
                };
            }
        }
    });
	
//------------------------------------------------------------------------------------
	/* Validation form */
//------------------------------------------------------------------------------------


	if( jQuery('#edit-step1-name').length ) {
		var tarotname = new LiveValidation('edit-step1-name');
		tarotname.add( Validate.Presence );
	}
	if( jQuery('#edit-step1-mail').length ) {
		var tarotmail = new LiveValidation('edit-step1-mail');
		tarotmail.add( Validate.Email );
	}
	if( jQuery('#edit-step1-birthdate').length ) {
		var tarotbirthdate = new LiveValidation('edit-step1-birthdate');
		tarotbirthdate.add(Validate.Length, { minimum: 10, failureMessage: "Data inválida" });
		
		jQuery('#edit-step1-birthdate').mask('99/99/9999');
	}
	
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
	
	
	
	if( jQuery('#edit-step1-ddd').length ) {
		var tarotddd = new LiveValidation('edit-step1-ddd');
		tarotddd.add(Validate.Numericality, { minimum: 11 });
	}
	if( jQuery('#edit-step1-phone').length ) {
		var tarotphone = new LiveValidation('edit-step1-phone');
		tarotphone.add(Validate.Numericality);
		jQuery('#edit-step1-phone').before('<span>-</span>');
	}
	
	var ddd = ['11', '12', '13', '14', '15', '16', '17', '18', '19', '21', '22', '24', '27', '28'];
	jQuery('#edit-step1-ddd').blur(function() {
		var value = jQuery( this ).val();
		if(jQuery.inArray(value, ddd) != -1){
			jQuery( '#edit-step1-phone' ).val('9');
			jQuery( '#edit-step1-phone' ).selectRange(1,2);
			jQuery( '#edit-step1-phone' ).attr('maxlength','9');
			jQuery( '#edit-step1-phone' ).attr('minlength','9');
			tarotphone.add(Validate.Length, { minimum: 9 });
		}
		
		if(jQuery.inArray(value, ddd) == -1){
			jQuery( '#edit-step1-phone' ).val('');
			jQuery( '#edit-step1-phone' ).attr('maxlength','8');
			jQuery( '#edit-step1-phone' ).attr('minlength','8');
			tarotphone.add(Validate.Length, { minimum: 8 });
		}
	});

});