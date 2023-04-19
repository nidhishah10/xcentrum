/* Custom General jQuery
/*--------------------------------------------------------------------------------------------------------------------------------------*/
;(function($, window, document, undefined) {
	//Genaral Global variables
	//"use strict";
	var $win = $(window);
	var $doc = $(document);
	var $winW = function(){ return $(window).width(); };
	var $winH = function(){ return $(window).height(); };
	var $screensize = function(element){  
			$(element).width($winW()).height($winH());
		};
		
		var screencheck = function(mediasize){
			if (typeof window.matchMedia !== "undefined"){
				var screensize = window.matchMedia("(max-width:"+ mediasize+"px)");
				if( screensize.matches ) {
					return true;
				}else {
					return false;
				}
			} else { // for IE9 and lower browser
				if( $winW() <=  mediasize ) {
					return true;
				}else {
					return false;
				}
			}
		};

	$doc.ready(function() {
/*--------------------------------------------------------------------------------------------------------------------------------------*/		
		// Remove No-js Class
		$("html").removeClass('no-js').addClass('js');
		
		
		
		/* Get Screen size
		---------------------------------------------------------------------*/
		$win.on('load', function(){
			$win.on('resize', function(){
				$screensize('your selector');	
			}).resize();	
		});
		
		
		/* Menu ICon Append prepend for responsive
		---------------------------------------------------------------------*/
		$(window).on('resize', function(){
			if (screencheck(1023)) {
				if(!$('#menu').length){
					$('#mainmenu').prepend('<a href="#" id="menu" class="menulines-button"><span class="menulines"></span></a>');
				}
			} else {
				$("#menu").remove();
			}
		}).resize();

		
		/* Tab Content box 
		---------------------------------------------------------------------*/
		var tabBlockElement = $('.tab-data');
			$(tabBlockElement).each(function() {
				var $this = $(this),
					tabTrigger = $this.find(".tabnav li"),
					tabContent = $this.find(".tabcontent");
					var textval = [];
					tabTrigger.each(function() {
						textval.push( $(this).text() );
					});	
				$this.find(tabTrigger).first().addClass("active");
				$this.find(tabContent).first().show();

				$(tabTrigger).on('click',function () {
					$(tabTrigger).removeClass("active");
					$(this).addClass("active");
					$(tabContent).hide().removeClass('visible');
					var activeTab = $(this).find("a").attr("data-rel");
					$this.find('#' + activeTab).fadeIn('normal').addClass('visible');
								
					return false;
				});
			
				var responsivetabActive =  function(){
				if (screencheck(767)){
					if( !$this.find('.tabMobiletrigger').length ){
						$(tabContent).each(function(index) {
							$(this).before("<h2 class='tabMobiletrigger'>"+textval[index]+"</h2>");	
							$this.find('.tabMobiletrigger:first').addClass("rotate");
						});
						$('.tabMobiletrigger').click('click', function(){
							var tabAcoordianData = $(this).next('.tabcontent');
							if($(tabAcoordianData).is(':visible') ){
								$(this).removeClass('rotate');
								$(tabAcoordianData).slideUp('normal');
								//return false;
							} else {
								$this.find('.tabMobiletrigger').removeClass('rotate');
								$(tabContent).slideUp('normal');
								$(this).addClass('rotate');
								$(tabAcoordianData).not(':animated').slideToggle('normal');
							}
							return false;
						});
					}
						
				} else {
					if( $('.tabMobiletrigger').length ){
						$('.tabMobiletrigger').remove();
						tabTrigger.removeClass("active");
						$this.find(tabTrigger).removeClass("active").first().addClass('active');
						$this.find(tabContent).hide().first().show();				
					}		
				}
			};
			$(window).on('resize', function(){
				if(!$this.hasClass('only-tab')){
					responsivetabActive();
				}
			}).resize();
		});
		
		/* Accordion box JS
		---------------------------------------------------------------------*/
		$('.accordion-databox').each(function() {
			var $accordion = $(this),
				$accordionTrigger = $accordion.find('.accordion-trigger'),
				$accordionDatabox = $accordion.find('.accordion-data');
				
				$accordionTrigger.first().addClass('open');
				$accordionDatabox.first().show();
				
				$accordionTrigger.on('click',function (e) {
					var $this = $(this);
					var $accordionData = $this.next('.accordion-data');
					if( $accordionData.is($accordionDatabox) &&  $accordionData.is(':visible') ){
						$this.removeClass('open');
						$accordionData.slideUp(400);
						e.preventDefault();
					} else {
						$accordionTrigger.removeClass('open');
						$this.addClass('open');
						$accordionDatabox.slideUp(400);
						$accordionData.slideDown(400);
					}
				});
		});
		
		
		/* Mobile menu click
		---------------------------------------------------------------------*/
		$(document).on('click',"#menu", function(){
			$(this).toggleClass('menuopen');
			$(this).next('ul').slideToggle('normal');
			return false;
		});


		/* Header Sticky
		---------------------------------------------------------------------*/
		if($("#header").length) {
			$(window).scroll(function() {
				var headerHeight = $('#header').outerHeight() - 10;
				if( $(this).scrollTop() > headerHeight ) {
					$("#header").addClass("sticky");
				} else {
					$("#header").removeClass("sticky");
				}
			});
			var header = document.querySelectorAll('#header');
			Stickyfill.add(header);
		}

			/*Custom Dropdown
		---------------------------------------------------------------------*/
		function create_custom_dropdowns() {
		  $('select').each(function(i, select) {
		    if (!$(this).next().hasClass('dropdown')) {
		      $(this).after('<div class="dropdown ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
		      var dropdown = $(this).next();
		      var options = $(select).find('option');
		      var selected = $(this).find('option:selected');
		      dropdown.find('.current').html(selected.data('display-text') || selected.text());
		      options.each(function(j, o) {
		        var display = $(o).data('display-text') || '';
		        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
		      });
		    }
		  });
		}

		// Event listeners

		// Open/close
		$(document).on('click', '.dropdown', function(event) {
		  $('.dropdown').not($(this)).removeClass('open');
		  $(this).toggleClass('open');
		  if ($(this).hasClass('open')) {
		    $(this).find('.option').attr('tabindex', 0);
		    $(this).find('.selected').focus();
		  } else {
		    $(this).find('.option').removeAttr('tabindex');
		    $(this).focus();
		  }
		});
		// Close when clicking outside
		$(document).on('click', function(event) {
		  if ($(event.target).closest('.dropdown').length === 0) {
		    $('.dropdown').removeClass('open');
		    $('.dropdown .option').removeAttr('tabindex');
		  }
		  event.stopPropagation();
		});
		// Option click
		$(document).on('click', '.dropdown .option', function(event) {
		  $(this).closest('.list').find('.selected').removeClass('selected');
		  $(this).addClass('selected');
		  var text = $(this).data('display-text') || $(this).text();
		  $(this).closest('.dropdown').find('.current').text(text);
		  $(this).closest('.dropdown').prev('select').val($(this).data('value')).trigger('change');
		});

		// Keyboard events
		$(document).on('keydown', '.dropdown', function(event) {
		  var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
		  // Space or Enter
		  if (event.keyCode == 32 || event.keyCode == 13) {
		    if ($(this).hasClass('open')) {
		      focused_option.trigger('click');
		    } else {
		      $(this).trigger('click');
		    }
		    return false;
		    // Down
		  } else if (event.keyCode == 40) {
		    if (!$(this).hasClass('open')) {
		      $(this).trigger('click');
		    } else {
		      focused_option.next().focus();
		    }
		    return false;
		    // Up
		  } else if (event.keyCode == 38) {
		    if (!$(this).hasClass('open')) {
		      $(this).trigger('click');
		    } else {
		      var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
		      focused_option.prev().focus();
		    }
		    return false;
		  // Esc
		  } else if (event.keyCode == 27) {
		    if ($(this).hasClass('open')) {
		      $(this).trigger('click');
		    }
		    return false;
		  }
		});

		
		create_custom_dropdowns();

			/*Custom Popup
		---------------------------------------------------------------------*/
		/* Popup function
				---------------------------------------------------------------------*/
				var $dialogTrigger = $('.poptrigger'),
				$pagebody =  $('body');
				$dialogTrigger.click( function(){
					var popID = $(this).attr('data-rel');
					$('body').addClass('overflowhidden');
					var winHeight = $(window).height();
					$('#' + popID).fadeIn();
					var popheight = $('#' + popID).find('.popup-block').outerHeight(true);
					
					if( $('.popup-block').length){
						var popMargTop = popheight / 2;
						//var popMargLeft = ($('#' + popID).find('.popup-block').width()/2);
						
						if ( winHeight > popheight ) {
							$('#' + popID).find('.popup-block').css({
								'margin-top' : -popMargTop,
								//'margin-left' : -popMargLeft
							});	
						} else {
							$('#' + popID).find('.popup-block').css({
								'top' : 0,
								//'margin-left' : -popMargLeft
							});
						}
						
					}
					
					$('#' + popID).append("<div class='modal-backdrop'></div>");
					$('.popouterbox .modal-backdrop').fadeTo("slow", 0.80);
					if( popheight > winHeight ){
						$('.popouterbox .modal-backdrop').height(popheight);
					} 
					$('#' + popID).focus();
					return false;
				});
						
				$(window).on("resize", function () {
					if( $('.popouterbox').length && $('.popouterbox').is(':visible')){
						var popheighton = $('.popouterbox .popup-block').height()+60;
						var winHeight = $(window).height();
						if( popheighton > winHeight ){
							$('.popouterbox .modal-backdrop').height(popheighton);
							$('.popouterbox .popup-block').removeAttr('style').addClass('taller');
							
						} else {
							$('.popouterbox .modal-backdrop').height('100%');
							$('.popouterbox .popup-block').removeClass('taller');
							$('.popouterbox .popup-block').css({
								'margin-top' : -(popheighton/2)
							});
						}	
					}
				});
				
				//Close popup		
				$(document).on('click', '.close-dialogbox, .modal-backdrop', function(){
					$(this).parents('.popouterbox').fadeOut(300, function(){
						$(this).find('.modal-backdrop').fadeOut(250, function(){
							$('body').removeClass('overflowhidden');
							$('.popouterbox .popup-block').removeAttr('style');
							$(this).remove();
						});
					});
					return false;
				});

		/* Offer Banner Slider
		---------------------------------------------------------------------*/
		if($('.offer-banner-slide').length) {
		$('.offer-banner-slide').owlCarousel({
			loop:true,
			items:1,
			dots:false,
			nav:true,
			autoplay:true,
			autoplayTimeout:3000,
			smartSpeed: 1500,	
			animateIn: 'fadeIn',
  			animateOut: 'fadeOut',
		})
		}

		if($('.service-offer-slide').length) {
			$('.service-offer-slide').owlCarousel({
				loop:true,
				items:1,
				dots:false,
				nav:true,
				smartSpeed: 800,	
				animateIn: 'fadeIn',
				animateOut: 'fadeOut',
			})
		}	

	/* Filter Categories Filter
		---------------------------------------------------------------------*/
		$(window).on('resize', function(){
			if (screencheck(1023)) {
				if(!$('.categories').length){
					$('.filter-categories').prepend('<div class="categories"><h4>Filter Options</h4></div>');
					$('.filter-categories').find('.accordion-databox').appendTo('.categories');
					$('.categories h4').on('click', function(){
						$(this).next('.accordion-databox').slideToggle();
						$('.categories').toggleClass('active');
					});
				}
			} else {
				$('.filter-categories').find('.accordion-databox').prependTo('.filter-categories');
				$('.categories').remove();
			}
		}).resize();

		/* Sal Animation
		---------------------------------------------------------------------*/
		if($("[data-sal]").length) {
			sal({
				once: true,
			});
		}

		/* All Options
		---------------------------------------------------------------------*/
		$(document).on('click', '.all-options-trigger', function(){
			$('.options-list ul').addClass('show');
			return false
		})

		/* News Slider
		---------------------------------------------------------------------*/
		if($('.news-slider').length) {
			$('.news-slider').owlCarousel({
				center: true,
				items:2,
				loop:true,
				autoplay:true,
				autoplayTimeout:4000,
				margin:30,
				nav: true,
				smartSpeed: 1200,
				responsive:{
					0:{
						margin:20,
						items:1
					},
					568:{
						items:2,
						margin:20
					},
					1024:{
						margin:30,
					}
				}
			});
		}

		if($('.accordion-databox').length) {
			jQuery('.accordion-databox .accordion-row').each(function(){
				var indexlength = 0;
				jQuery(this).find('.form-group').each(function(){
					if(indexlength > 3){
						jQuery(this).addClass('inactive').attr('data-inactive',true);
					}
					indexlength++;
				});
			
				if(indexlength > 4){
					jQuery(this).find('.accordion-data').append('<a class="readmore" href="javascript:void(0)"><i class="icon-plus-icon"></i>Toon meer</a>');
				}
				
			});	
		}

		$(document).on('click','.readmore',function(){ 
			
			$(this).parent().find('div[data-inactive="true"]').toggleClass('inactive');
		})

		if($('.filter-categories .accordion-databox a.readmore').length) {
			$(".filter-categories .accordion-databox a.readmore").click(function(){
				$(this).toggleClass("open");
			});
		}


		// sector section equal height headings

		if($('.stock-car-heading h4').length) {
			function titleHeightCheck() {
				var largest = 0;
				$(".stock-car-heading h4").each(function(){
					var findHeight = $(this).height();
					if(findHeight > largest){
						largest = Math.round(findHeight);
					}  
				});
				$(".stock-car-heading").css({"min-height":largest+"px"});
			}
			titleHeightCheck();
			$(window).on('resize', function(){
				titleHeightCheck();
			}).resize();
		  

		}


/*--------------------------------------------------------------------------------------------------------------------------------------*/		
	});	

/*All function need to define here for use strict mode
----------------------------------------------------------------------------------------------------------------------------------------*/


	
/*--------------------------------------------------------------------------------------------------------------------------------------*/
})(jQuery, window, document);