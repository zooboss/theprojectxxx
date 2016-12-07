$('#menu-trigger').click(function() {
		$('#mySidenav').animate({"left": "+=200px", "opacity": "show"}, "slow");
        $('#menu-trigger').hide();
		$('#menu-close-trigger').show();
		$(".article-wrap").css({opacity:"0.3", backgroundColor:"#000" });
		$("#galery").css({opacity:"0.3", backgroundColor:"#000" });
	}
);
$('#menu-close-trigger').click(function() {
		$('#mySidenav').hide('slow');
        $('#menu-close-trigger').hide();
		$('#menu-trigger').show();
		$(".article-wrap").css({opacity:"1", backgroundColor:"#fff" });
		$("#galery").css({opacity:"1", backgroundColor:"#fff" });
	}
);