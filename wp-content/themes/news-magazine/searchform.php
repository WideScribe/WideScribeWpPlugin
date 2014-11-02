<form class="ast-search" role="search"  method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
		<input id="search" name="s" placeholder="<?php echo __('Search...','news_magazine'); ?>" value="<?php echo get_search_query(); ?>"/>
		<input type="submit" value="" id="search-submit" />
</form>