<?php 
$languages = array('1'=>'English','2'=>'Norwegian BM','3'=>'Norwegian Nynorsk','4'=>'Swedish','5'=>'Danish');
?>
<div class="wrap">
    <?php if (!empty($partner)) { ?>
    <h2>Delete Partner &raquo; <?php _e($partner->partnerName, $this->plugin->name); ?> </h2>
    <?php } else { ?>
    <h2>Delete Partner</h2>
    <?php } ?>
<?php if (isset($this->message)) { ?>
    <div class="updated fade"><p><?php echo $this->message; ?></p></div>  
<?php } if (isset($this->errorMessage)) { ?>
    <div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>  
<?php } ?>
<?php if (empty($partner)) {
    return;
}?>
    <p><?php _e('Are you sure want to delete this partner?'); ?></p>
    <form action="" method="post" name="ws_deletepartner" id="ws_deletepartner" class="validate" novalidate="novalidate">
    <table class="form-table">
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_name"><?php _e('Name'); ?></label></th>
		  <td><input type="text" id="partner_name" value="<?php echo esc_attr($partner->partnerName); ?>" aria-required="true" readonly="readonly" readonly="readonly" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_languageID"><?php _e('Language'); ?></label></th>
		  <td><input type="text" id="partner_languageID" value="<?php echo esc_attr($languages[$partner->languageID]); ?>" aria-required="true" readonly="readonly" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_domain"><?php _e('Domain'); ?></label></th>
		  <td><input type="text" id="partner_domain" value="<?php echo esc_attr($partner->domain); ?>" aria-required="true" readonly="readonly" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_logosrc"><?php _e('Logo Url'); ?></label></th>
		  <td><input type="text" id="partner_logosrc" value="<?php echo esc_attr($partner->logosrc); ?>" aria-required="true" readonly="readonly" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_defaultCost"><?php _e('Cost'); ?></label></th>
		  <td><input type="text" id="partner_defaultCost" value="<?php echo esc_attr($partner->defaultCost); ?>" aria-required="true" readonly="readonly" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_wordpressPage"><?php _e('Is Wordpress Page?'); ?></label></th>
		  <td><label for="partner_wordpressPage"><input type="checkbox" id="partner_wordpressPage" value="1" <?php checked( $partner->wordpressPage ); ?> disabled="disabled"/> <?php _e( 'Partner using wordpress page.' ); ?></label></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_defaultCurrencyCode"><?php _e('Currency'); ?></label></th>
		  <td><input type="text" id="partner_defaultCurrencyCode" value="<?php echo esc_attr($partner->defaultCurrencyCode); ?>" aria-required="true" readonly="readonly" /></td>
	   </tr>
    </table>
    <?php submit_button( __( 'Delete Partner '), 'primary', 'ws_deletepartner', true, array( 'id' => 'ws_deletepartnersub' ) ); ?>
    </form>        
</div>