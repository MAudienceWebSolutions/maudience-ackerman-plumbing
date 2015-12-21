;(function($, window, document, undefined) {
	var $win = $(window);
	var $doc = $(document);


	$doc.ready(function() {
		$('.slider-intro .slide, .service').each(function(){
			var imgSource = $(this).find('img').attr('src')
			$(this).css( 'background-image', 'url('+ imgSource +')' )
		});


		$('.btn-menu').on('click', function (event) {
		    $(this).toggleClass('active');  
		    
		    $('.nav .menu').toggleClass('show');
		    
		    event.preventDefault();
		});

		$('.icon-search').on('click', function (event) {
		    $('.search-field').toggleClass('show');
		});

		if ( $('.section-list_section').length ) {
			var tubePosition = $('.section-list_section').offset().top;
		};

		$win.scroll(function(){
			var windScllTop = $win.scrollTop();
			if ( tubePosition <= windScllTop && windScllTop > 550 ){
		    	$('.tube .tube-fill').addClass('filled');
		   	}
		});

		(function(){
		    // This class will be added to active tab link 
		    // and the content container
		    var activeTabClass = 'current';
		    
		    $('.tabs-nav a').on('click', function(event) {
		        var $tabLink = $(this);
		        var $targetTab = $($tabLink.attr('href'));
		 
		        $tabLink
		            .parent() // go up to the <li> element
		            .add($targetTab)
		            .addClass(activeTabClass)
		                .siblings()
		                .removeClass(activeTabClass);
		        
		        event.preventDefault();
		    });
		})();
	});

	$win.load(function() {
		$('.slider-services .slides').bxSlider({
			easing: 'ease-in-out',
			pager: false			
		});

		var $autoStart = false;
		if ( $('.slider-intro .slides').children().length > 1 ) {
			$autoStart = true;
		} else {
			$autoStart = false;
		};

		$('.slider-intro .slides').bxSlider({
			mode: 'fade',
			pause: 10000,
			auto: $autoStart,
		});
	})
})(jQuery, window, document);
