<?php
/**
 * New Widesribe Partner Administration Screen.
 *
 * @package   WideScribe
 * @author    jens Tandstad <jens@widescribe.com>
 * @license   GPL-2.0+
 * @link      http://www.widescribe.com
 * @copyright 2014 WideScribe AS
 */
?>

<div class="wrap">
    <h2>
        <?php echo $this->plugin->displayName; ?> &raquo; <?php _e('Settings', $this->plugin->name); ?>
        <form action="" method="post" name="ws_initializeportal" id="ws_initializeportal" class="validate" novalidate="novalidate" style="display: inline-block; vertical-align: super;">
            <?php submit_button( __( 'Initialize'), 'small', 'ws_initializeportal', true, array( 'id' => 'ws_initializeportalsub' ) ); ?>
        </form>
    </h2>
<?php if (isset($this->message)) { ?>
    <div class="updated fade"><p><?php echo $this->message; ?></p></div>  
<?php } if (isset($this->errorMessage)) { ?>
    <div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>  
<?php } ?>
    <p><?php _e('Update your WideScribe Admin settings.'); ?></p>
    <form method="post" action="options.php">
    <?php settings_fields( 'widescribe-admin' ); ?>
    <?php do_settings_sections( 'widescribe-admin' ); ?>
    <table class="form-table">
	   <tr class="form-field form-required">
		  <th scope="row"><label for="<?php echo $this->plugin->name;?>_api_url"><?php _e('API Url'); ?> <span class="description"><?php _e('(required)'); ?></span></label></th>
		  <td><input name="<?php echo $this->plugin->name;?>_api_url" type="text" id="<?php echo $this->plugin->name;?>_api_url" value="<?php echo esc_attr( get_option($this->plugin->name.'_api_url') ); ?>" aria-required="true" /></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="<?php echo $this->plugin->name;?>_public_key"><?php _e('Initiation Key'); ?> <span class="description"></label></th>
		  <td><textarea rows="3" name="<?php echo $this->plugin->name;?>_init_key" id="<?php echo $this->plugin->name;?>_init_key"><?php echo esc_attr( get_option($this->plugin->name.'_init_key') ); ?></textarea></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="<?php echo $this->plugin->name;?>_public_key"><?php _e('Public Key'); ?> <span class="description"></span></label></th>
		  <td><textarea rows="3" name="<?php echo $this->plugin->name;?>_public_key" id="<?php echo $this->plugin->name;?>_public_key"><?php echo esc_attr( get_option($this->plugin->name.'_public_key') ); ?></textarea></td>
	   </tr>
	   <tr class="form-field form-required">
		  <th scope="row"><label for="<?php echo $this->plugin->name;?>_private_key"><?php _e('Private Key'); ?> <span class="description"></span></label></th>
		  <td><textarea rows="3" name="<?php echo $this->plugin->name;?>_private_key" id="<?php echo $this->plugin->name;?>_private_key"><?php echo esc_attr( get_option($this->plugin->name.'_private_key') ); ?></textarea></td>
	   </tr>
    </table>
    <?php submit_button(); ?>
    </form>        
</div>