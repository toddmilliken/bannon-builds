(function($) { 
  
    $(document).ready(function($) { 
        initHomeWheel();
        initOwlCarousel();
		initMobMenu();
        initMenuHover(); 
        initLastMenuChild(); 
        //initImgShadows(); 
        initRemovePTags(); 
        initListSplit(); 
        initTableBorder(); 
        initImageLightBox();
        initYouTubeVimeoLightBox(); 
        initUniform(); 
    }); 

    $(window).load(function($) {
        initLazyLoadBackground();
    });

    //! Home Page Wheel - add classes using hover intent.
    var initHomeWheel = function() {
        $('.circle-container').hoverIntent({ 
            "over" : function() { 
                $(this).addClass('hover'); 
                $('.circle-container').addClass('paused');
            }, 
            "out" : function() { 
                $('.circle-container').removeClass('paused');  
            }, 
            "timeout" : 500 
        });
    };
    
    //! Home Panel Owl Carousel Functions
    var initOwlCarousel = function(){
	    $('.panels').owlCarousel({
            dots: true,
            items: 1,
            loop: true,
            nav: true,
            navText: '',
        });	   
    };
		
    //! Mobile Menu - Toggle classes for mobile navigation transitions. 
    var initMobMenu = function() {         
        $('.mob-menu').click(function(){
			$(this).toggleClass('active');
			$('.site-wrap').toggleClass('pushed');
			$('.site-navigation').toggleClass('pushed');
			
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
            "opacity" : 0.7 
        }); 
        
        $('.icons-featured-cte').click(function(){
	        $img = $(this).prev();
	        //console.log($img);
	        $(this).colorbox({ 
	            "href" : $img.attr('src'),
	            "close" : "", 
	            "width" : "auto",  
	            "height" : "auto", 
	            "opacity" : 0.7 
	        });
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
      
}(jQuery));