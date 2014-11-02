jQuery(document).ready(function() {	
	var $template_select = jQuery('select#page_template'),
		$template_box = jQuery('#news_magazine_all_meta');
	if(document.getElementById("page_template") == null && document.getElementById("post-body")!=null)
	{
		jQuery(".t_portfolio").hide();
		jQuery(".t_contact").hide();
		jQuery(".t_sitemap").hide();
		jQuery(".t_blog").hide();
		jQuery(".t_news").hide();
		jQuery(".t_gallery").hide();
		jQuery(".t_search").hide();
		jQuery(".t_login").hide();
		jQuery(".t_mpopular").hide();
		jQuery(".t_default").hide();
		jQuery(".post_edit_page").show();
	}
	else
	{
	$template_select.live('change',function(){
		var this_value = jQuery(this).val();
		$template_box.find('.inside > div').css('display','none');
		
		switch ( this_value ) {
			case 'default':
				$template_box.find('.t_default').css('display','block')
				break;			
			case 'page-sitemap.php':
				$template_box.find('.t_sitemap').css('display','block')
				break;
			case 'page-blog.php':
				$template_box.find('.t_blog').css('display','block')
				break;
			case 'page-gallery.php':
				$template_box.find('.t_gallery').css('display','block')
				break;
			case 'page-template-portfolio.php':
				$template_box.find('.t_portfolio').css('display','block')
				break;
			case 'page-search.php':
				$template_box.find('.t_search').css('display','block')
				break;
			case 'page-news.php':
				$template_box.find('.t_news').css('display','block')
				break;	
			case 'page-login.php':
				$template_box.find('.t_login').css('display','block')
				break;
			case 'page-most_popular.php':
				$template_box.find('.t_mpopular').css('display','block')
				break;	
			case 'page-contact.php':
				$template_box.find('.t_contact').css('display','block')
				break;
			default:
                $template_box.find('.t_info').css('display','block');
		}
	});
	}
	$template_select.trigger('change');
});