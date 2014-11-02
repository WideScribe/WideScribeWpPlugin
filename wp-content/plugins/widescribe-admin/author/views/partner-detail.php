<div class="wrap">
    <h2><?php _e($partner->partnerName); ?> <a
			href="<?php menu_page_url('widescribe-admin'); ?>&action=edit&id=<?php echo $partner->id;?>" class="add-new-h2"> Edit</a></h2>
<?php if (isset($this->message)) { ?>
    <div class="updated fade"><p><?php echo $this->message; ?></p></div>  
<?php } if (isset($this->errorMessage)) { ?>
    <div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>  
<?php } ?>
    <p><?php _e('Partner Detail.'); ?></p>
    <form action="" method="post" name="ws_editpartner" id="ws_editpartner" class="validate" novalidate="novalidate">
    <table class="form-table">
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_name"><?php _e('Name'); ?></label></th>
		  <td><input name="partner[name]" type="text" id="partner_name" value="<?php echo esc_attr($partner->partnerName); ?>" aria-required="true" readonly="readonly" readonly="readonly" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_languageID"><?php _e('Language'); ?></label></th>
		  <td>
		      <select name="partner[languageID]" id="partner_languageID" disabled="disabled">
		      <?php
			  if ( !$partner->languageID )
				$partner->languageID = 'USD';
			  $this->selectInputOptions(['1'=>'English','2'=>'Norwegian BM','3'=>'Norwegian Nynorsk','4'=>'Swedish','5'=>'Danish'],$partner->languageID);
			  ?>
			  </select>
		  </td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_domain"><?php _e('Domain'); ?></label></th>
		  <td><input name="partner[domain]" type="text" id="partner_domain" value="<?php echo esc_attr($partner->domain); ?>" aria-required="true" readonly="readonly" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_logosrc"><?php _e('Logo Url'); ?></label></th>
		  <td><input name="partner[logosrc]" type="text" id="partner_logosrc" value="<?php echo esc_attr($partner->logosrc); ?>" aria-required="true" readonly="readonly" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_defaultCost"><?php _e('Cost'); ?></label></th>
		  <td><input name="partner[defaultCost]" type="text" id="partner_defaultCost" value="<?php echo esc_attr($partner->defaultCost); ?>" aria-required="true" readonly="readonly" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_wordpressPage"><?php _e('Is Wordpress Page?'); ?></label></th>
		  <td><label for="partner_wordpressPage"><input type="checkbox" name="partner[wordpressPage]" id="partner_wordpressPage" value="1" <?php checked( $partner->wordpressPage ); ?> disabled="disabled"/> <?php _e( 'Partner using wordpress page.' ); ?></label></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_defaultCurrencyCode"><?php _e('Currency'); ?></label></th>
		  <td>
		      <select name="partner[defaultCurrencyCode]" id="partner_defaultCurrencyCode" disabled="disabled">
		      <?php
			  if ( !$partner->defaultCurrencyCode )
				$partner->defaultCurrencyCode = 'USD';
			  $this->selectInputOptions(['USD'=>'USD','EUR'=>'EUR','NOK'=>'NOK','SEK'=>'SEK','DKK'=>'DKK'],$partner->defaultCurrencyCode);
			  ?>
			  </select>
		  </td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="partner_secret"><?php _e('Secret Key'); ?></label></th>
		  <td><input name="partner[secret]" type="text" id="partner_secret" value="<?php echo esc_attr($partner->secret); ?>" aria-required="true" readonly="readonly" /></td>
	   </tr>
    </table>
    </form>        
</div>