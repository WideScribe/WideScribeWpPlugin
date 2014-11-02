( function( jQuery ){ 
  
wp.customize( 'blogname', function( value ) {
value.bind( function( to ) {
jQuery( '.site-title-a' ).text( to );
} );
} );
wp.customize( 'blogdescription', function( value ) {
value.bind( function( to ) {
jQuery( '#site-description-p' ).text( to );
} );
} );
  
wp.customize( 'theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-menu_elem_back_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-menu_elem_back_color-css">	\
#back h3 a\
{\
	 color:#'+negativeColor(ligthest_brigths(to,10))+'  !important;\
}\
.reply ,.top-nav-list.phone   li ul li:hover  > a,.top-nav-list.phone   li ul li  > a:hover, .top-nav-list.phone   li ul li  > a:focus, .top-nav-list.phone   li ul li  > a:active ,.top-nav-list.phone  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li.current-menu-item > a:focus, .top-nav-list.phone  li.current-menu-item > a:active\
{\
	 background-color:'+to+';\
}\
.read_more:hover, a.read_more:hover, .more-link:hover \
{\
	 background-color:#'+ligthest_brigths(to,15)+';\
}\
#back\
{\
	 background-color:#'+ligthest_brigths(to,10)+';\
}\
#top-nav ,.phone #top-nav > div > ul,.phone #top-nav > div ul,#reply-title small,#top-nav.phone  > li  > a, #top-nav.phone  > li  > a:link, #top-nav.phone  > li  > a:visited  \
{\
	 background:'+to+';\
}\
.top-nav-list.phone  li.has-sub >  a, .top-nav-list.phone  li.has-sub > a:link, .top-nav-list.phone  li.has-sub >  a:visited ,.top-nav-list.phone  li.has-sub:hover > a,.top-nav-list.phone  li.has-sub > a:hover, .top-nav-list.phone  li.has-sub > a:focus, .top-nav-list.phone  li.has-sub >  a:active \
{\
	 background:'+to+' url('+curent_template_url+'/images/arrow.menu.png) right top  no-repeat  !important;\
}\
.top-nav-list.phone  li ul li.has-sub > a, .top-nav-list.phone  li ul li.has-sub > a:link, .top-nav-list.phone  li ul li.has-sub > a:visited\
{\
	 background:'+to+' url('+curent_template_url+'/images/arrow.menu.png)right-18px no-repeat !important;\
}\
.top-nav-list.phone  li ul li.has-sub:hover > a,.top-nav-list.phone  li ul li.has-sub > a:hover, .top-nav-list.phone  li ul li.has-sub > a:focus, .top-nav-list.phone  li ul li.has-sub > a:active \
{\
	 background:#'+ligthest_brigths(to,15)+' url('+curent_template_url+'/images/arrow.menu.png) right -18px no-repeat !important;\
}\
.top-nav-list.phone  li.current-menu-parent > a, .top-nav-list.phone  li.current-menu-parent > a:link, .top-nav-list.phone  li.current-menu-parent > a:visited,.top-nav-list.phone  li.current-menu-parent > a:hover, .top-nav-list.phone  li.current-menu-parent > a:focus, .top-nav-list.phone  li.current-menu-parent > a:active,.top-nav-list.phone  li.has-sub.current-menu-item  > a, .top-nav-list.phone  li.has-sub.current-menu-item > a:link, .top-nav-list.phone  li.has-sub.current-menu-item > a:visited,.top-nav-list.phone  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list.phone  li.has-sub.current-menu-item > a:focus, .top-nav-list.phone  li.has-sub.current-menu-item > a:active,.top-nav-list.phone  li.current-menu-ancestor > a, .top-nav-list.phone  li.current-menu-ancestor > a:link, .top-nav-list.phone  li.current-menu-ancestor > a:visited,.top-nav-list.phone  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li.current-menu-ancestor > a:focus, .top-nav-list.phone  li.current-menu-ancestor > a:active \
{\
	 background:'+to+' url('+curent_template_url+'/images/arrow.menu.png)right bottom no-repeat !important;\
}\
.top-nav-list.phone  li ul  li.current-menu-item > a, .top-nav-list.phone  li ul  li.current-menu-item > a:link, .top-nav-list.phone  li ul  li.current-menu-item > a:visited,.top-nav-list.phone  li ul  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li ul  li.current-menu-item > a:focus, .top-nav-list.phone  li ul  li.current-menu-item > a:active\
{\
	 background-color:#'+ligthest_brigths(to,15)+' !important;\
}\
.top-nav-list.phone li ul  li.current-menu-parent > a, .top-nav-list.phone  li ul  li.current-menu-parent > a:link, .top-nav-list.phone  li ul  li.current-menu-parent > a:visited,.top-nav-list.phone li ul li.current-menu-parent  > a:hover, .top-nav-list.phone  li ul  li.current-menu-parent > a:focus, .top-nav-list.phone  li ul  li.current-menu-parent > a:active,.top-nav-list.phone  li ul  li.has-sub.current-menu-item > a, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:link, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:visited,.top-nav-list.phone  li ul  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:focus, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:active,.top-nav-list.phone li ul  li.current-menu-ancestor > a, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:link, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:visited,.top-nav-list.phone li ul li.current-menu-ancestor  > a:hover, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:focus, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:active \
{\
	 background:#'+ligthest_brigths(to,15)+' url('+curent_template_url+'/images/arrow.menu.png) right -158px no-repeat !important;\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-menu_elem_back_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-menu_elem_back_color-css">	\
#back h3 a\
{\
	 color:#'+negativeColor(ligthest_brigths(_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]'],10))+'  !important;\
}\
.reply ,.top-nav-list.phone   li ul li:hover  > a,.top-nav-list.phone   li ul li  > a:hover, .top-nav-list.phone   li ul li  > a:focus, .top-nav-list.phone   li ul li  > a:active ,.top-nav-list.phone  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li.current-menu-item > a:focus, .top-nav-list.phone  li.current-menu-item > a:active\
{\
	 background-color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]']+';\
}\
.read_more:hover, a.read_more:hover, .more-link:hover \
{\
	 background-color:#'+ligthest_brigths(_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]'],15)+';\
}\
#back\
{\
	 background-color:#'+ligthest_brigths(_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]'],10)+';\
}\
#top-nav ,.phone #top-nav > div > ul,.phone #top-nav > div ul,#reply-title small,#top-nav.phone  > li  > a, #top-nav.phone  > li  > a:link, #top-nav.phone  > li  > a:visited  \
{\
	 background:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]']+';\
}\
.top-nav-list.phone  li.has-sub >  a, .top-nav-list.phone  li.has-sub > a:link, .top-nav-list.phone  li.has-sub >  a:visited ,.top-nav-list.phone  li.has-sub:hover > a,.top-nav-list.phone  li.has-sub > a:hover, .top-nav-list.phone  li.has-sub > a:focus, .top-nav-list.phone  li.has-sub >  a:active \
{\
	 background:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]']+' url('+curent_template_url+'/images/arrow.menu.png)right top no-repeat !important;\
}\
.top-nav-list.phone  li ul li.has-sub > a, .top-nav-list.phone  li ul li.has-sub > a:link, .top-nav-list.phone  li ul li.has-sub > a:visited\
{\
	 background:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]']+' url('+curent_template_url+'/images/arrow.menu.png)right-18px no-repeat !important;\
}\
.top-nav-list.phone  li ul li.has-sub:hover > a,.top-nav-list.phone  li ul li.has-sub > a:hover, .top-nav-list.phone  li ul li.has-sub > a:focus, .top-nav-list.phone  li ul li.has-sub > a:active \
{\
	 background:#'+ligthest_brigths(_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]'],15)+'  url('+curent_template_url+'/images/arrow.menu.png)right-18px  no-repeat !important;\
}\
.top-nav-list.phone  li.current-menu-parent > a, .top-nav-list.phone  li.current-menu-parent > a:link, .top-nav-list.phone  li.current-menu-parent > a:visited,.top-nav-list.phone  li.current-menu-parent > a:hover, .top-nav-list.phone  li.current-menu-parent > a:focus, .top-nav-list.phone  li.current-menu-parent > a:active,.top-nav-list.phone  li.has-sub.current-menu-item  > a, .top-nav-list.phone  li.has-sub.current-menu-item > a:link, .top-nav-list.phone  li.has-sub.current-menu-item > a:visited,.top-nav-list.phone  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list.phone  li.has-sub.current-menu-item > a:focus, .top-nav-list.phone  li.has-sub.current-menu-item > a:active,.top-nav-list.phone  li.current-menu-ancestor > a, .top-nav-list.phone  li.current-menu-ancestor > a:link, .top-nav-list.phone  li.current-menu-ancestor > a:visited,.top-nav-list.phone  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li.current-menu-ancestor > a:focus, .top-nav-list.phone  li.current-menu-ancestor > a:active \
{\
	 background:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]']+'  url('+curent_template_url+'/images/arrow.menu.png)right bottom  no-repeat !important;\
}\
.top-nav-list.phone  li ul  li.current-menu-item > a, .top-nav-list.phone  li ul  li.current-menu-item > a:link, .top-nav-list.phone  li ul  li.current-menu-item > a:visited,.top-nav-list.phone  li ul  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li ul  li.current-menu-item > a:focus, .top-nav-list.phone  li ul  li.current-menu-item > a:active\
{\
	 background-color:#'+ligthest_brigths(_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]'],15)+'  !important;\
}\
.top-nav-list.phone li ul  li.current-menu-parent > a, .top-nav-list.phone  li ul  li.current-menu-parent > a:link, .top-nav-list.phone  li ul  li.current-menu-parent > a:visited,.top-nav-list.phone li ul li.current-menu-parent  > a:hover, .top-nav-list.phone  li ul  li.current-menu-parent > a:focus, .top-nav-list.phone  li ul  li.current-menu-parent > a:active,.top-nav-list.phone  li ul  li.has-sub.current-menu-item > a, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:link, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:visited,.top-nav-list.phone  li ul  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:focus, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:active,.top-nav-list.phone li ul  li.current-menu-ancestor > a, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:link, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:visited,.top-nav-list.phone li ul li.current-menu-ancestor  > a:hover, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:focus, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:active \
{\
	 background:#'+ligthest_brigths(_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_elem_back_color]'],15)+'  url('+curent_template_url+'/images/arrow.menu.png) right-158px  no-repeat  !important;\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_sideb_background_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-sideb_background_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-sideb_background_color-css">	\
.sidebar-container ,.commentlist li, #latest-news>h2 \
{\
	 background-color:'+to+';\
}\
.children .comment,#respond\
{\
	 background-color:#ligthest_brigths('+to+',37);\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-sideb_background_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-sideb_background_color-css">	\
.sidebar-container ,.commentlist li, #latest-news>h2 \
{\
	 background-color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_sideb_background_color]']+';\
}\
.children .comment,#respond\
{\
	 background-color:#ligthest_brigths('+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_sideb_background_color]']+',37);\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_footer_back_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-footer_back_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-footer_back_color-css">	\
.container.device.phone,.container.device,#footer-bottom \
{\
	 background-color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-footer_back_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-footer_back_color-css">	\
.container.device.phone,.container.device,#footer-bottom \
{\
	 background-color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_footer_back_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);

wp.customize( 'theme_mods_news-magazine[news_magazinecc_meta_info_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-meta_info_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-meta_info_color-css">	\
.entry-meta *,.entry-meta-cat * \
{\
	 color:'+to+' !important;\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-meta_info_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-meta_info_color-css">	\
.entry-meta *,.entry-meta-cat * \
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_meta_info_color]']+' !important;\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);

wp.customize( 'theme_mods_news-magazine[news_magazinecc_footer_sidebar_back_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-footer_sidebar_back_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-footer_sidebar_back_color-css">	\
#footer \
{\
	 background-color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-footer_sidebar_back_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-footer_sidebar_back_color-css">	\
#footer\
{\
	 background-color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_footer_sidebar_back_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);

wp.customize( 'theme_mods_news-magazine[news_magazinecc_slider_back_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-slider_back_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-slider_back_color-css">	\
#slideshow \
{\
	 background-color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-slider_back_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-slider_back_color-css">	\
#slideshow\
{\
	 background-color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_slider_back_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);

wp.customize( 'theme_mods_news-magazine[news_magazinecc_footer_text_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-footer_text_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-footer_text_color-css">	\
.container.device,#footer-bottom \
{\
	 color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-footer_text_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-footer_text_color-css">	\
.container.device,#footer-bottom \
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_footer_text_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);

wp.customize( 'theme_mods_news-magazine[news_magazinecc_slider_text_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-slider_text_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-slider_text_color-css">	\
.bwg_slideshow_description_text,.bwg_slideshow_description_text *,.bwg_slideshow_title_text * \
{\
	 color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-slider_text_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-slider_text_color-css">	\
.bwg_slideshow_description_text,.bwg_slideshow_description_text *,.bwg_slideshow_title_text * \
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_slider_text_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_borders_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-borders_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-borders_color-css">	\
h3.most-categories-header,.widget-area> h3, .widget-area> h2 \
{\
	 border-bottom:2px solid '+to+';\
}\
h3.most-categories-header a,#search-input::-webkit-input-placeholder, #search-input, .widget-area> h3, .widget-area >h2,.sep, .sitemap h3,.comment-author .fn, .tab-more  \
{\
	 color:'+to+' !important;\
}\
.image-block .post-date, #wd-categories-vertical-tabs ul.tabs li.active,a.read_more:visited,a.read_more:link,.read_more, .more-link ,#searchsubmit,.phone #wd-categories-vertical-tabs .tabs-block,#commentform #submit,.reply,#reply-title small, #wd-categories-vertical-tabs ul.tabs li:hover, a .page-links-number, .post-password-form input[type="submit"], .more-link\
{\
	 background-color:'+to+';\
}\
.arrow-left\
{\
	 border:2px solid '+to+';\
}\
.arrow-right\
{\
	 border-left:5px solid '+to+';\
}\
#top-posts-list li, #latest-news, .post-date + img,.phone #wd-categories-vertical-tabs .content-block\
{\
	 border-top:2px solid '+to+';\
}\
.sidebar-container   .widget-area ul li:before, .news_categories ul li:before \
{\
	 border-left:6px solid '+to+';\
}\
#wd-categories-vertical-tabs .tabs-block\
{\
	 border-right:1px solid'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-borders_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-borders_color-css">	\
h3.most-categories-header,.widget-area> h3, .widget-area> h2 \
{\
	 border-bottom:2px solid '+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_borders_color]']+';\
}\
h3.most-categories-header a,#search-input::-webkit-input-placeholder, #search-input, .widget-area> h3, .widget-area >h2,.sep, .sitemap h3,.comment-author .fn, .tab-more  \
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_borders_color]']+' !important;\
}\
.image-block .post-date, #wd-categories-vertical-tabs ul.tabs li.active,a.read_more:visited,a.read_more:link,.read_more, .more-link ,#searchsubmit,.phone #wd-categories-vertical-tabs .tabs-block, #commentform #submit,.reply,#reply-title small, #wd-categories-vertical-tabs ul.tabs li:hover, a .page-links-number, .post-password-form input[type="submit"], .more-link\
{\
	 background-color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_borders_color]']+';\
}\
#top-posts-list li, #latest-news, .post-date + img,.phone #wd-categories-vertical-tabs .content-block\
{\
	 border-top:2px solid'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_borders_color]']+';\
}\
.arrow-left\
{\
	 border:2px solid '+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_borders_color]']+';\
}\
.arrow-right\
{\
	 border-left:5px solid '+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_borders_color]']+';\
}\
.sidebar-container   .widget-area ul li:before, .news_categories ul li:before \
{\
	 border-left:6px solid '+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_borders_color]']+';\
}\
#wd-categories-vertical-tabs .tabs-block\
{\
	 border-right:2px solid '+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_borders_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_top_posts_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-top_posts_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-top_posts_color-css">	\
#top-posts \
{\
	 background-color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-top_posts_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-top_posts_color-css">	\
#top-posts \
{\
	 background-color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_top_posts_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_text_headers_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-text_headers_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-text_headers_color-css">	\
h1, h2, h3, h4, h5, h6, h1>a, h2>a, h3>a, h4>a, h5>a, h6>a,h1 > a:link, h2 > a:link, h3 > a:link, h4 > a:link, h5 > a:link, h6 > a:link,h1 > a:hover,h2 > a:hover,h3 > a:hover,h4 > a:hover,h5 > a:hover,h6 > a:hover,h61> a:visited,h2 > a:visited,h3 > a:visited,h4 > a:visited,h5 > a:visited,h6 > a:visited \
{\
	 color:'+to+';\
}\
h2.page-header{\
	border-bottom: 2px solid '+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-text_headers_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-text_headers_color-css">	\
h1, h2, h3, h4, h5, h6, h1>a, h2>a, h3>a, h4>a, h5>a, h6>a,h1 > a:link, h2 > a:link, h3 > a:link, h4 > a:link, h5 > a:link, h6 > a:link,h1 > a:hover,h2 > a:hover,h3 > a:hover,h4 > a:hover,h5 > a:hover,h6 > a:hover,h61> a:visited,h2 > a:visited,h3 > a:visited,h4 > a:visited,h5 > a:visited,h6 > a:visited \
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_text_headers_color]']+';\
}\
h2.page-header{\
	border-bottom: 2px solid '+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_text_headers_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_primary_text_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-primary_text_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-primary_text_color-css">	\
body,#wrapper\
{\
	 color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-primary_text_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-primary_text_color-css">	\
body,#wrapper\
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_primary_text_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_primary_links_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-primary_links_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-primary_links_color-css">	\
a:link, a:visited \
{\
	 color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-primary_links_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-primary_links_color-css">	\
a:link, a:visited \
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_primary_links_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);


wp.customize( 'theme_mods_news-magazine[news_magazinecc_primary_links_hover_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-primary_links_hover_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-primary_links_hover_color-css">	\
a:hover,a:active\
{\
	 color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-primary_links_hover_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-primary_links_hover_color-css">	\
a:hover,a:active\
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_primary_links_hover_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
 
wp.customize( 'theme_mods_news-magazine[news_magazinecc_menu_links_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-menu_links_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-menu_links_color-css">	\
.top-nav-list > ul> li > a,.reply ,.reply a, .more-link,#reply-title small a:link,#commentform #submit,#top-nav.phone  > li  > a, #top-nav.phone  > li  > a:link, #top-nav.phone  > li  > a:visited, a .page-links-number, .post-password-form input[type="submit"], .more-link  ,.top-nav-list.phone   li ul li  > a, .top-nav-list.phone   li ul li  > a:link, .top-nav-list.phone   li  ul li > a:visited ,#top-nav-list > li > a, #top-nav-list > li ul > li > a, .top-nav-list a, .top-nav-list > li ul > li > a,.top-nav-list.phone  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li.current-menu-item > a:focus, .top-nav-list.phone  li.current-menu-item > a:active,.top-nav-list.phone  li.current-menu-parent > a, .top-nav-list.phone  li.current-menu-parent > a:link, .top-nav-list.phone  li.current-menu-parent > a:visited,.top-nav-list.phone  li.current-menu-parent > a:hover, .top-nav-list.phone  li.current-menu-parent > a:focus, .top-nav-list.phone  li.current-menu-parent > a:active,.top-nav-list.phone  li.has-sub.current-menu-item  > a, .top-nav-list.phone  li.has-sub.current-menu-item > a:link, .top-nav-list.phone  li.has-sub.current-menu-item > a:visited,.top-nav-list.phone  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list.phone  li.has-sub.current-menu-item > a:focus, .top-nav-list.phone  li.has-sub.current-menu-item > a:active,.top-nav-list.phone  li.current-menu-ancestor > a, .top-nav-list.phone  li.current-menu-ancestor > a:link, .top-nav-list.phone  li.current-menu-ancestor > a:visited, .top-nav-list.phone  li.current-menu-ancestor > a:focus, .top-nav-list.phone  li.current-menu-ancestor > a:active ,.top-nav-list.phone  li ul  li.current-menu-item > a, .top-nav-list.phone  li ul  li.current-menu-item > a:link, .top-nav-list.phone  li ul  li.current-menu-item > a:visited,.top-nav-list.phone  li ul  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li ul  li.current-menu-item > a:focus, .top-nav-list.phone  li ul  li.current-menu-item > a:active,.top-nav-list.phone li ul  li.current-menu-parent > a, .top-nav-list.phone  li ul  li.current-menu-parent > a:link, .top-nav-list.phone  li ul  li.current-menu-parent > a:visited,.top-nav-list.phone li ul li.current-menu-parent  > a:hover, .top-nav-list.phone  li ul  li.current-menu-parent > a:focus, .top-nav-list.phone  li ul  li.current-menu-parent > a:active,.top-nav-list.phone  li ul  li.has-sub.current-menu-item > a, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:link, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:visited,.top-nav-list.phone  li ul  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:focus, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:active,.top-nav-list.phone li ul  li.current-menu-ancestor > a, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:link, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:visited,.top-nav-list.phone li ul li.current-menu-ancestor  > a:hover, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:focus, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:active \
{\
	 color:'+to+';\
}\
.read_more:hover, a.read_more:hover, .more-link:hover \
{\
	 color:#'+ligthest_brigths(to,50)+' !important;\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-menu_links_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-menu_links_color-css">	\
.top-nav-list > ul> li > a,.reply ,.reply a, .more-link,#reply-title small a:link,#commentform #submit,#top-nav.phone  > li  > a, #top-nav.phone  > li  > a:link, #top-nav.phone  > li  > a:visited, a .page-links-number, .post-password-form input[type="submit"], .more-link  ,.top-nav-list.phone   li ul li  > a, .top-nav-list.phone   li ul li  > a:link, .top-nav-list.phone   li  ul li > a:visited ,#top-nav-list > li > a, #top-nav-list > li ul > li > a, .top-nav-list a, .top-nav-list > li ul > li > a,.top-nav-list.phone  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li.current-menu-item > a:focus, .top-nav-list.phone  li.current-menu-item > a:active,.top-nav-list.phone  li.current-menu-parent > a, .top-nav-list.phone  li.current-menu-parent > a:link, .top-nav-list.phone  li.current-menu-parent > a:visited,.top-nav-list.phone  li.current-menu-parent > a:hover, .top-nav-list.phone  li.current-menu-parent > a:focus, .top-nav-list.phone  li.current-menu-parent > a:active,.top-nav-list.phone  li.has-sub.current-menu-item  > a, .top-nav-list.phone  li.has-sub.current-menu-item > a:link, .top-nav-list.phone  li.has-sub.current-menu-item > a:visited,.top-nav-list.phone  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list.phone  li.has-sub.current-menu-item > a:focus, .top-nav-list.phone  li.has-sub.current-menu-item > a:active,.top-nav-list.phone  li.current-menu-ancestor > a, .top-nav-list.phone  li.current-menu-ancestor > a:link, .top-nav-list.phone  li.current-menu-ancestor > a:visited, .top-nav-list.phone  li.current-menu-ancestor > a:focus, .top-nav-list.phone  li.current-menu-ancestor > a:active ,.top-nav-list.phone  li ul  li.current-menu-item > a, .top-nav-list.phone  li ul  li.current-menu-item > a:link, .top-nav-list.phone  li ul  li.current-menu-item > a:visited,.top-nav-list.phone  li ul  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li ul  li.current-menu-item > a:focus, .top-nav-list.phone  li ul  li.current-menu-item > a:active,.top-nav-list.phone li ul  li.current-menu-parent > a, .top-nav-list.phone  li ul  li.current-menu-parent > a:link, .top-nav-list.phone  li ul  li.current-menu-parent > a:visited,.top-nav-list.phone li ul li.current-menu-parent  > a:hover, .top-nav-list.phone  li ul  li.current-menu-parent > a:focus, .top-nav-list.phone  li ul  li.current-menu-parent > a:active,.top-nav-list.phone  li ul  li.has-sub.current-menu-item > a, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:link, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:visited,.top-nav-list.phone  li ul  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:focus, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:active,.top-nav-list.phone li ul  li.current-menu-ancestor > a, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:link, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:visited,.top-nav-list.phone li ul li.current-menu-ancestor  > a:hover, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:focus, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:active \
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_links_color]']+';\
}\
.read_more:hover, a.read_more:hover, .more-link:hover \
{\
	 color:#'+ligthest_brigths(_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_links_color]'],50)+' !important;\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_menu_links_hover_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-menu_links_hover_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-menu_links_hover_color-css">	\
.top-nav-list .current-menu-item > a,.top-nav-list li.current-menu-item > a, .top-nav-list li.current_page_item a,.top-nav-list.phone  > li:hover > a ,.top-nav-list.phone  > li  > a:hover, .top-nav-list.phone  > li  > a:focus, .top-nav-list.phone  > li  > a:active ,#top-nav-list > li:hover > a, #top-nav-list > li ul > li > a:hover,.top-nav-list.phone   li ul li:hover  > a,.top-nav-list.phone   li ul li  > a:hover, .top-nav-list.phone   li ul li  > a:focus, .top-nav-list.phone   li ul li  > a:active,.top-nav-list  li:hover,#menu-button-block a, #menu-button-block a:link \
{\
	 color:'+to+' !important;\
}\
#menu-button-block \
{\
	 border-left: 3px solid '+to+' !important;\
}\
.phone-menu-block.phone:before \
{\
	 border-left:9px solid '+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-menu_links_hover_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-menu_links_hover_color-css">	\
.top-nav-list .current-menu-item > a,.top-nav-list li.current-menu-item > a, .top-nav-list li.current_page_item a,.top-nav-list.phone  > li:hover > a ,.top-nav-list.phone  > li  > a:hover, .top-nav-list.phone  > li  > a:focus, .top-nav-list.phone  > li  > a:active ,#top-nav-list > li:hover > a, #top-nav-list > li ul > li > a:hover,.top-nav-list.phone   li ul li:hover  > a,.top-nav-list.phone   li ul li  > a:hover, .top-nav-list.phone   li ul li  > a:focus, .top-nav-list.phone   li ul li  > a:active,.top-nav-list  li:hover,#menu-button-block a, #menu-button-block a:link \
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_links_hover_color]']+' !important;\
}\
#menu-button-block \
{\
	 border-left: 3px solid '+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_links_hover_color]']+' !important;\
}\
.phone-menu-block.phone:before \
{\
	 border-left:9px solid '+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_links_hover_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_menu_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-menu_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-menu_color-css">	\
#header-block,.get_title,.top-nav-list li li:hover .top-nav-list a:hover, .top-nav-list .current-menu-item a:hover,.top-nav-list li:hover,#header .phone-menu-block.phone \
{\
	 background-color:'+to+';\
}\
.phone #top-nav-list > li ul li\
{\
	 background-color:#'+ligthest_brigths(to,10)+';\
}\
 #top-nav-list > li ul > li > a, .top-nav-list > li ul > li > a\
{\
	 border-top:1px solid #'+ligthest_brigths(to,20)+';\
}\
#top-nav-list > li ul, .top-nav-list > ul > li ul\
{\
	 background:'+hex_to_rgba(to,0.7)+';\
}\
.top-nav-list.phone  > li:hover > a ,.top-nav-list.phone  > li  > a:hover, .top-nav-list.phone  > li  > a:focus, .top-nav-list.phone  > li  > a:active ,.styledHeading,.phone #top-nav > div > ul li ul\
{\
	 background:'+to+';\
}\
.phone  #top-nav-list  li, .phone #top-nav-list > li ul li \
{\
	 border-bottom:'+to+';\
}\
.phone #top-nav > div > ul > li.haschild > a:hover, .phone #top-nav > div > ul > li.haschild > a:focus,.phone #top-nav > div > ul > li.haschild > a:active\
{\
	 	background: url('+curent_template_url+'/images/arrow.menu.png)right bottom no-repeat'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-menu_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-menu_color-css">	\
#header-block,.get_title,.top-nav-list li li:hover .top-nav-list a:hover, .top-nav-list .current-menu-item a:hover,.top-nav-list li:hover,#header .phone-menu-block.phone \
{\
	 background-color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_color]']+';\
}\
.phone #top-nav-list > li ul li\
{\
	  background-color:#'+ligthest_brigths(_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_color]'],10)+';\
}\
 #top-nav-list > li ul > li > a, .top-nav-list > li ul > li > a\
{\
	  border-top:1px solid #'+ligthest_brigths(_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_color]'],10)+';\
}\
#top-nav-list > li ul, .top-nav-list > ul > li ul\
{\
	 background:'+hex_to_rgba(_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_color]'],0.7)+';\
}\
.top-nav-list.phone  > li:hover > a ,.top-nav-list.phone  > li  > a:hover, .top-nav-list.phone  > li  > a:focus, .top-nav-list.phone  > li  > a:active ,.styledHeading,.phone #top-nav > div > ul li ul\
{\
	 background:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_color]']+';\
}\
.phone  #top-nav-list  li, .phone #top-nav-list > li ul li \
{\
	 border-bottom:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_color]']+';\
}\
.phone #top-nav > div > ul > li.haschild > a:hover, .phone #top-nav > div > ul > li.haschild > a:focus,.phone #top-nav > div > ul > li.haschild > a:active\
{\
	 	background: url('+curent_template_url+'/images/arrow.menu.png)right bottom no-repeat'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_menu_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_selected_menu_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-selected_menu_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-selected_menu_color-css">	\
.top-nav-list .current-menu-item,.top-nav-list li.current-menu-item, .top-nav-list li.current_page_item, .top-nav-list.phone   li ul li:hover  > a,.top-nav-list.phone   li ul li  > a:hover, .top-nav-list.phone   li ul li  > a:focus, .top-nav-list.phone   li ul li  > a:active,  .top-nav-list.phone  li.current-menu-item > a:hover,.top-nav-list.phone  li.current-menu-item > a,.top-nav-list.phone  li.current-menu-item > a:visited,.top-nav-list .current-menu-item\
{\
	 background-color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-selected_menu_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-selected_menu_color-css">	\
.top-nav-list .current-menu-item,.top-nav-list li.current-menu-item, .top-nav-list li.current_page_item, .top-nav-list.phone   li ul li:hover  > a,.top-nav-list.phone   li ul li  > a:hover, .top-nav-list.phone   li ul li  > a:focus, .top-nav-list.phone   li ul li  > a:active,  .top-nav-list.phone  li.current-menu-item > a:hover,.top-nav-list.phone  li.current-menu-item > a,.top-nav-list.phone  li.current-menu-item > a:visited,.top-nav-list .current-menu-item\
{\
	 background-color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_selected_menu_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_logo_text_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-logo_text_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-logo_text_color-css">	\
a:link.site-title-a,a:hover.site-title-a,a:visited.site-title-a,a.site-title-a\
{\
	 color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-logo_text_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-logo_text_color-css">	\
a:link.site-title-a,a:hover.site-title-a,a:visited.site-title-a,a.site-title-a\
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_logo_text_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);
        
wp.customize( 'theme_mods_news-magazine[news_magazinecc_block_text_color]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-block_text_color-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-block_text_color-css">	\
.image-block .post-date, #wd-categories-vertical-tabs ul.tabs li.active,a.read_more:visited,a.read_more:link,.read_more, .more-link ,#searchsubmit,#wd-categories-vertical-tabs  ul.tabs li.active a h3,#wd-categories-vertical-tabs  ul.tabs li.active a span ,#wd-categories-vertical-tabs  ul.tabs li a:focus, #wd-categories-vertical-tabs  ul.tabs li a:active,.reply a, #reply-title small a,#commentform #submit,#wd-categories-vertical-tabs ul.tabs li:hover h3,#wd-categories-vertical-tabs ul.tabs li:hover span, a .page-links-number, .post-password-form input[type="submit"], .more-link \
{\
	 color:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-block_text_color-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-block_text_color-css">	\
.image-block .post-date, #wd-categories-vertical-tabs ul.tabs li.active,a.read_more:visited,a.read_more:link,.read_more, .more-link ,#searchsubmit,#wd-categories-vertical-tabs  ul.tabs li.active a h3,#wd-categories-vertical-tabs  ul.tabs li.active a span ,#wd-categories-vertical-tabs  ul.tabs li a:focus, #wd-categories-vertical-tabs  ul.tabs li a:active,.reply a, #reply-title small a,#commentform #submit,#wd-categories-vertical-tabs ul.tabs li:hover h3,#wd-categories-vertical-tabs ul.tabs li:hover span, a .page-links-number, .post-password-form input[type="submit"], .more-link \
{\
	 color:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_block_text_color]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);

wp.customize( 'theme_mods_news-magazine[news_magazinecc_type_headers_font]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-type_headers_font-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-type_headers_font-css">	\
h1:not(.site-title),h2,h3,h4,h5,h6,.nav a\
{\
	 font-family:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-type_headers_font-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-type_headers_font-css">	\
h1:not(.site-title),h2,h3,h4,h5,h6,.nav a\
{\
	 font-family:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_type_headers_font]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);


wp.customize( 'theme_mods_news-magazine[news_magazinecc_type_primary_font]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-type_primary_font-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-type_primary_font-css">	\
body:not(.ftricons):not(#top-nav-list a):not(.top-nav-list a)\
{\
	 font-family:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-type_primary_font-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-type_primary_font-css">	\
body:not(.ftricons):not(#top-nav-list a):not(.top-nav-list a)\
{\
	 font-family:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_type_primary_font]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);




wp.customize( 'theme_mods_news-magazine[news_magazinecc_type_inputs_font]', function( value ) {
    value.bind( function( to ) {
        style = jQuery('#custom-type_inputs_font-css');
        style.remove();
        style = jQuery('\
			<style type="text/css" id="custom-type_inputs_font-css">	\
textarea,input[type="text"]\
{\
	 font-family:'+to+';\
}\
</style>').appendTo( 'head' );
     	} );
        if(!(jQuery('#custom-type_inputs_font-css').length > 0)){
         jQuery('\
			<style type="text/css" id="custom-type_inputs_font-css">	\
textarea,input[type="text"]\
{\
	 font-family:'+_wpCustomizeSettings.values['theme_mods_news-magazine[news_magazinecc_type_inputs_font]']+';\
}\
			</style>').appendTo( 'head' );
        
        }
	} 
);


} )( jQuery );