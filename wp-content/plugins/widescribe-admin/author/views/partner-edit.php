<div class="wrap">
    <h2>Edit Partner &raquo; <?php _e($partner->partnerName, $this->plugin->name); ?> </h2>
<?php if (isset($this->message)) { ?>
    <div class="updated fade"><p><?php echo $this->message; ?></p></div>  
<?php } if (isset($this->errorMessage)) { ?>
    <div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>  
<?php } ?>
<?php if (empty($partner)) {
    return;
}?>
    <p><?php _e('Edit partner attributes.'); ?></p>
    <form action="" method="post" name="ws_editpartner" id="ws_editpartner" class="validate" novalidate="novalidate">
    <input name="action" type="hidden" value="ws_editpartner" />
<?php
wp_nonce_field( 'ws-create-partner', '_wpnonce_ws-create-partner' );
// Load up the passed data, else set to a default.
$editing = isset( $_POST['ws_editpartner'] );

$edited_partner_name = $editing && isset( $_POST['partner']['partnerName'] ) ? wp_unslash( $_POST['partner']['partnerName'] ) : $partner->partnerName;
$edited_partner_languageId = $editing && isset( $_POST['partner']['languageId'] ) ? wp_unslash( $_POST['partner']['languageId'] ) : $partner->languageId;
$edited_partner_domain = $editing && isset( $_POST['partner']['domain'] ) ? wp_unslash( $_POST['partner']['domain'] ) : $partner->domain;
$edited_partner_logosrc = $editing && isset( $_POST['partner']['logosrc'] ) ? wp_unslash( $_POST['partner']['logosrc'] ) : $partner->logosrc;
$edited_partner_defaultCost = $editing && isset( $_POST['partner']['defaultCost'] ) ? wp_unslash( $_POST['partner']['defaultCost'] ) : $partner->defaultCost;
$edited_partner_wordpressPage = $editing && isset( $_POST['partner']['wordpressPage'] ) ? wp_unslash( $_POST['partner']['wordpressPage'] ) : $partner->wordpressPage;
$edited_partner_defaultCurrencyCode = $editing && isset( $_POST['partner']['defaultCurrencyCode'] ) ? wp_unslash( $_POST['partner']['defaultCurrencyCode'] ) : $partner->defaultCurrencyCode;
?>
    <table class="form-table">
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_name"><?php _e('Name'); ?> <span class="description"><?php _e('(required)'); ?></span></label></th>
		  <td><input name="partner[partnerName]" type="text" id="partner_name" value="<?php echo esc_attr($edited_partner_name); ?>" aria-required="true" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_languageId"><?php _e('Language'); ?> <span class="description"><?php _e('(required)'); ?></span></label></th>
		  <td>
		      <select name="partner[languageId]" id="partner_languageId">
		      <?php
			  if ( !$edited_partner_languageId )
				$edited_partner_languageId = 'USD';
			  $this->selectInputOptions(array('1'=>'English','2'=>'Norwegian BM','3'=>'Norwegian Nynorsk','4'=>'Swedish','5'=>'Danish'),$edited_partner_languageId);
			  ?>
			  </select>
		  </td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_domain"><?php _e('Domain'); ?> <span class="description"><?php _e('(required)'); ?></span></label></th>
		  <td><input name="partner[domain]" type="text" id="partner_domain" value="<?php echo esc_attr($edited_partner_domain); ?>" aria-required="true" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_logosrc"><?php _e('Logo Url'); ?> <span class="description"><?php _e('(required)'); ?></span></label></th>
		  <td><input name="partner[logosrc]" type="text" id="partner_logosrc" value="<?php echo esc_attr($edited_partner_logosrc); ?>" aria-required="true" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_defaultCost"><?php _e('Cost'); ?> <span class="description"><?php _e('(required)'); ?></span></label></th>
		  <td><input name="partner[defaultCost]" type="text" id="partner_defaultCost" value="<?php echo esc_attr($edited_partner_defaultCost); ?>" aria-required="true" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_wordpressPage"><?php _e('Is Wordpress Page?'); ?> <span class="description"><?php _e('(required)'); ?></span></label></th>
		  <td><label for="partner_wordpressPage"><input type="checkbox" name="partner[wordpressPage]" id="partner_wordpressPage" value="1" <?php checked( $edited_partner_wordpressPage ); ?> /> <?php _e( 'Partner using wordpress page.' ); ?></label></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_defaultCurrencyCode"><?php _e('Currency'); ?> <span class="description"><?php _e('(required)'); ?></span></label></th>
		  <td>
		      <select name="partner[defaultCurrencyCode]" id="partner_defaultCurrencyCode">
		      <?php
			  if ( !$edited_partner_defaultCurrencyCode )
				$edited_partner_defaultCurrencyCode = 'USD';
			  $this->selectInputOptions(array('USD'=>'USD','EUR'=>'EUR','NOK'=>'NOK','SEK'=>'SEK','DKK'=>'DKK'),$edited_partner_defaultCurrencyCode);
			  ?>
			  </select>
		  </td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_secret"><?php _e('Secret Key'); ?></label></th>
		  <td><input name="partner[secret]" type="text" id="partner_secret" value="<?php echo esc_attr($partner->secret); ?>" aria-required="true" readonly="readonly" /></td>
	   </tr>
    </table>
    <?php submit_button( __( 'Update Partner '), 'primary', 'ws_editpartner', true, array( 'id' => 'ws_editpartnersub' ) ); ?>
    </form>        
</div>