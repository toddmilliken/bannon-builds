(function($) { 
  
	$(document).ready(function($) { 
		initFrontPage();
		initInteriorPage();
		initProjectSlider();
		initOwlCarousel();
		initMobMenu();
		initMenuHover(); 
		initLastMenuChild(); 
		//initImgShadows(); 
		// initRemovePTags(); 
		initListSplit(); 
		initTableBorder(); 
		initImageLightBox();
		initYouTubeVimeoLightBox(); 
		initUniform(); 
  }); 

  $(window).load(function($) {
      initLazyLoadBackground();
      initLoadingIndicator();
  });
    
    
  
  var initLoadingIndicator = function() {
	  
	  if ( $('body').hasClass('home') ) {
		  setTimeout(function(){
				$('.loading-indicator').addClass('disabled');
			}, 250);
		}
	  
  }
    
    
  //---
  // FRONT PAGE FUNCTIONALITY
  //---
	var initFrontPage = function() {	

		if ( $('body').hasClass('home') ) {

			//! ARROW DOWN FUNCTIONALITY
			$('.arrow--down').click(function() {	
				$this = $(this);	
				$('html, body').animate({ scrollTop: $('#home-content').offset().top - 71 }, 1000);						
			});	
			
			//! HEADER WAYPOINTS
			var homeWaypoint = new Waypoint({
			  element: document.getElementById('home-content'),
			  handler: function(dir) {
				  if ( dir == 'down' ) {
					  $('.site-head').addClass('site-head--dark');
				  } else {
					  $('.site-head').removeClass('site-head--dark');
				  }
			    
			  },
			  offset: 71
			})
		
		} // end if body.home
	
	}
	
	
	//---
  // INTERIOR PAGE FUNCTIONALITY
  //---
	var initInteriorPage = function() {	

		if ( $('body').hasClass('interior') ) {
			
			if ( !document.getElementById('main-content') )
				return;

			//! HEADER WAYPOINTS
			var contentWaypoint = new Waypoint({
			  element: document.getElementById('main-content'),
			  handler: function(dir) {
				  if ( dir == 'down' ) {
					  $('.site-head').addClass('site-head--dark');
				  } else {
					  $('.site-head').removeClass('site-head--dark');
				  }
			    
			  },
			  offset: 71
			})
		
		} // end if body.home
	
	}
    
	var initProjectSlider = function() {
		//! PROJECT SLIDER
		if ( $('.project-slider').length  ) {            
			var $projectSlides = $('.project-slides'),
					speed = 1000,
					timeOut = 7000,
					owlParams = {
						fluidSpeed: speed,
						navSpeed: speed,
						smartSpeed: speed,
						dots: 0,
						items : 1,
						nav: 1,
						navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
					};
			
			//! init panels carousel
			$projectSlides.owlCarousel(owlParams);
			
			setTimeout(function(){
				$('.site-head').addClass('site-head--show-on-hover');
			}, 5000);
	
		}
		
	}
   	
   	    
  //---
  // HOME PAGE CAROUSEL
  //---
  var initOwlCarousel = function(){
		
		//! fadeIn background
		$(window).load(function(){
			//$('.panel-bg').addClass('fadeIn');
		});
        
		//! HOME PANELS SLIDER
		if ( $('.panel').length  ) {            
			var $panels = $('.panels'),
					speed = 500,
					timeOut = 7000,
					owlParams = {
						autoplay: 1,
						autoplayTimeout: timeOut,
						animateOut: 'fadeOut',
						dots: 0,
						items: 1,
						loop: 1,
						nav: 1,
						navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
						//mouseDrag: 0,
					};
			
			//! init panels carousel
			$panels.owlCarousel(owlParams);
			
			// stop loop
			$panels.on('changed.owl.carousel', function(e){
				var currentIndex = e.item.index,
				currentPanel = $(e.target).find('.owl-item').eq(currentIndex).find('.panel');
			
				if ( currentPanel.hasClass('panel-1') ) {
					//! destroy and rebuild after completing the looping back to 1, without autoplay parameters
					setTimeout(function(){
						$panels.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
						$panels.find('.owl-stage-outer').children().unwrap();
						owlParams['autoplay'] = 0; // turn off autoplay 
						$panels.owlCarousel(owlParams);
					}, (speed * 2));
				}
			});
		
		}
        
	};
		
    //! Mobile Menu - Toggle classes for mobile navigation transitions. 
    var initMobMenu = function() {         
        $('.mob-menu').click(function(){
            $this = $(this);
			$this.toggleClass('active');
			$('.site-wrap').toggleClass('pushed');
			$('.site-navigation').toggleClass('site-navigation--active');
			
            if ( $this.hasClass('active') ) {
                $this.find('span').text('Close');
            } else {
                $this.find('span').text('Menu');
            }

		}); 
    }; 
      
    //! Menu Hover - Add .hover class to Drop Down menu items on mouse hover 
    var initMenuHover = function() {         
        $('.main-menu li').hoverIntent({ 
            "over" : function() { 
                $(this).addClass('hover'); 
            }, 
            "out" : function() { 
                $(this).removeClass('hover');    
            }, 
            "timeout" : 500 
        }); 
    }; 
  
    //! Flag last tier one menu item 
    var initLastMenuChild = function() { 
        $('.main-menu > li:last-child').addClass('menu-item-last'); 
    }; 
  
    //! Warp img tags found in content in span to add inner shadow 
    var initImgShadows = function() { 
        $('.content img').each(function(){   
			if ( !$(this).hasClass('no-border') ) {
	            var imgClass = $(this).attr('class'); 
	  
	            if ($(this).is('.aligncenter ')) { 
	                $(this).wrap('<div class="img-wrap"><span class="img-shadow ' + imgClass + ' "></span></div>'); 
	            }else{ 
	                $(this).wrap('<span class="img-shadow ' + imgClass + ' "></span>'); 
	                $(this).attr('class' , ''); 
	            } 
			}
        }); 
  
    }; 
      
    //! Remove p tag wrap from image tags empty p tags and Remove empty p tags <p></p> 
    var initRemovePTags = function() { 
  
        //! remove empty p tags from content 
        $('.main').find('p:empty').remove(); 
  
        //! Remove p tag wrap from image tags 
        $('img').each(function(){ 
            var $this = $(this); 
            var $parent = $this.parents('p'); 
  
            if ( $parent.text().length ) return; 
              
            if ( $this.parent('a').length ){ 
                var $a = $this.parent(); 
                $a.addClass($this.attr('class')); 
                $this.removeAttr('class'); 
                $this = $a; 
            } 
              
            $this.addClass($parent.attr('class')); 
            $this.insertBefore($parent); 
            $parent.remove(); 
        }); 
    }; 
  
    //! Multi Column List 
	var initListSplit = function() { 
		$('ul.two-column, ol.two-column').easyListSplitter({
			"colNumber" : 2,
			"containerClass" : "list-container two-column clearfix"
		}); 
		
		$('ul.three-column, ol.three-column').easyListSplitter({
			"colNumber" : 3,
			"containerClass" : "list-container three-column clearfix"
		});
	} 
  
    //! Table .data class for alternating rows 
    var initTableBorder = function() { 
        $('table.data tr:nth-child(even) td').parent().addClass('table-row'); 
        $('table.data tr:nth-child(odd) td').parent().addClass('table-altrow'); 
    }; 
  
    //! Image Lightbox 
    var initImageLightBox = function() { 
        $('a[href*=".jpg"], a[href*=".gif"], a[href*=".png"]').colorbox({ 
            "close" : "", 
            "width" : "auto",  
            "height" : "auto",
        }); 
    }; 
  
    //! YouTube & Vimeo Lightbox 
    var initYouTubeVimeoLightBox = function() { 
        $('[href*="youtube.com"],[href*="youtu.be"],[href*="vimeo.com"]').click(function() { 
            var $me = $(this); 
            var href = $me.attr('href'); 
      
            if ( $me.parent().attr('data-yt') ) 
			{
				return;	
			} 
  
            if ( href.indexOf('/watch') >= 0 ) 
            { 
                var hrefParts = href.split('?'); 
                var qsParts = hrefParts[1].split('&'); 
                var qs = []; 
  
                for ( i = 0; i < qsParts.length; i++ ) 
                { 
                    var tmp = qsParts[i].split('='); 
                    qs[tmp[0]] = tmp[1]; 
                } 
  
                href = 'http://www.youtube.com/embed/' + qs['v'] + '?autoplay=1&hd=1'; 
            } 
  
            if ( href.indexOf('youtu.be') >= 0 ) 
            { 
                var hrefParts = href.split('/'); 
                href = 'http://www.youtube.com/embed/' + hrefParts[hrefParts.length - 1] + '?autoplay=1&hd=1'; 
            } 
  
            //! VIMEO 
            if ( href.indexOf('vimeo.com') >= 0 ) 
            { 
                if ( href.indexOf('player.vimeo.com') >= 0 ) { 
                    //don't change href 
                } else { 
                    var hrefParts = href.split('/'); 
                    href = 'http://player.vimeo.com/video/' + hrefParts[hrefParts.length - 1] + '?autoplay=1' ; 
                } 
            } 
  
            $.colorbox({                 
                "href" : href, 
                "close" : "", 
                "iframe" : 1, 
                "innerHeight" : 480, 
                "innerWidth" : 853, 
                "initialHeight" : 200, 
                "initialWidth" : 200, 
                "opacity" : 0.7 
            }); 
  
            return false; 
        }); 
    }; 
  
    var initUniform = function() { 
        $('input[type="radio"],select,input[type="file"]').uniform(); 
          
        $('select').uniform({ 
            "selectAutoWidth" : false
        }); 
    };


    var initLazyLoadBackground = function() {
	    	$('.masthead-bg').addClass('ready');
	    
        $('.lazyload').each(function() {

            var lazy = $(this);
            var src = lazy.attr('data-src');

            $('<img>').attr('src', src).load(function(){
                lazy.find('img.spinner').remove();
                lazy.css('background-image', 'url("'+src+'")').fadeIn(9000);
                $('.lazyload-wrapper').addClass('ready');
            });

        });
    };
    
    initUniform = function() {
	    
	        $('[type="file"]').uniform(); 
	        
	        //! wrap select with .selector
	        if ( $('select').length ) {
		        $('select').each(function(){
			        var $this = $(this),
			        	classes = $(this).attr('class');
			        		
			        $this.wrapAll('<div class="selector">');
			        $this.removeClass(classes).parents('.selector').addClass(classes);
		        });
	        } 
	        
	        if ( $('[type="file"]').length ) {
		        $('[type="file"]').each(function(){
			        var $this = $(this),
			        	classes = $(this).attr('class');		        		
			        
			        $this.removeClass(classes).parents('.uploader').addClass(classes);
		        });
	        }
	        
	    
    };
      
}(jQuery));