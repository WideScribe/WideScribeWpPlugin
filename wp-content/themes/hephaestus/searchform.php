<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
		<div id="sbox">
        <input type="text" value="<?php _e( 'Search...', 'hephaestus' ); ?>" name="s" id="s" onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}" />
        <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/magnifier.png" id="searchsubmit" alt="" />
		</div>
    </div>
</form>