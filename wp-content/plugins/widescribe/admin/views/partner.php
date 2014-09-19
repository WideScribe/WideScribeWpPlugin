<?php
/**
 * Partner view allows the users to set partner options
 *
 * This must be the same as defined on www.widescribe.com
 *
 * @package   WideScribe
 * @author    jens Tandstad <jens@widescribe.com>
 * @license   GPL-2.0+
 * @link      http://www.widescribe.com
 * @copyright 2014 WideScribe AS
 */
?>

<div class="wrap">

    <h2><?php echo $this->plugin->displayName; ?> &raquo; <?php _e('Settings', $this->plugin->name); ?></h2>

    <?php
    if (isset($this->message)) {
        ?>
        <div class="updated fade"><p><?php echo $this->message; ?></p></div>  
        <?php
    }
    if (isset($this->errorMessage)) {
        ?>
        <div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>  
        <?php
    }
    ?> 

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <!-- Content -->
            <div id="post-body-content">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">   

                    <div class="postbox">

                        <h3 class="hndle"><?php _e('Administration', $this->plugin->name); ?></h3>

                        <div class="inside">

                            <?php _e('Welcome the the vxl administration interface', $this->plugin->name); ?>
                            <form method="post">
                                <p>
                                    <input name="vxlAction" type='hidden' value='save'>
                                    <label for="vxl_domain"><strong><?php _e('Your partner id', $this->plugin->name); ?></strong></label>
                                    <input name="vxl_partnerId" id="vxl_domain" class="widefat" rows="8" style="font-family:Courier New;" value ="<?php echo get_option('vxl_partnerId'); ?>"></input>

                                    <label for="vxl_domain"><strong><?php _e('Your vxl enabled domain', $this->plugin->name); ?></strong></label>
                                    <input name="vxl_domain" id="vxl_domain" class="widefat" rows="8" style="font-family:Courier New;" value ="<?php echo get_option('vxl_domain'); ?>"></input>

                                    <label for="vxl_email"><strong><?php _e('Your email', $this->plugin->name); ?></strong></label>
                                    <input name="vxl_email" id="vxl_email" class="widefat" rows="8" style="font-family:Courier New;" value ="<?php echo get_option('vxl_email'); ?>"></input>	
                                    <label for="vxl_provider"><strong><?php _e('Your company name', $this->plugin->name); ?></strong></label>
                                    <input name="vxl_provider" id="vxl_provider" class="widefat" rows="8" style="font-family:Courier New;" value ="<?php echo get_option('vxl_provider'); ?>"></input>	
                                    <label for="vxl_sharedSecret"><strong><?php _e('Shared secret', $this->plugin->name); ?></strong></label>
                                    <input name="vxl_sharedSecret" id="vxl_sharedSecret" class="widefat" rows="8" style="font-family:Courier New;" value ="<?php echo get_option('vxl_sharedSecret'); ?>"></input>
                                   

                                </p>
<?php _e('Please ensure that your account at widescribe.com is enabled', $this->plugin->name); ?>	
<?php wp_nonce_field($this->plugin->name, $this->plugin->name . '_nonce'); ?>
                                <p>
                                    <input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php _e('Save', $this->plugin->name); ?>" /> 
                                </p>
                            </form>
                        </div>
                    </div>


                </div>      



