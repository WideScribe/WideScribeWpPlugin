jQuery(document).ready(function(){
	jQuery('.hoverpost').hover(function(){
	jQuery('.hoverimg',this).stop(true, true).fadeIn(500);
	},function(){
		jQuery('.hoverimg',this).stop(true, true).fadeOut(200)});
		
	jQuery('#slider').cycle({ 
		fx:     'scrollHorz',
		speed:  '800', 
		timeout: 4000, 
		next:   '#snext', 
		prev:   '#sprev' 
	});
	
	jQuery('ul.mainnav').superfish();
});
