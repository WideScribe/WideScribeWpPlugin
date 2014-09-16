<?php
/**
 * Trancher 
 *
 * This page contains options for managing the trancher functionality 
 *
 * @package   Vxlpay
 * @author    jens Tandstad <jens@vxlpay.com>
 * @license   GPL-2.0+
 * @link      http://www.vxlpay.com
 * @copyright 2014 Vxlpay AS
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

                     
                        <div class="inside">
   <h2 class="hndle"><?php _e('Paywall settings', $this->plugin->name); ?></h2>

                             <form  method="post">
                                <p>  
                               <h3 class="hndle"><?php _e('What to charge', $this->plugin->name); ?></h3>
      
                              <?php _e('There are three ways to charge on your wordpress site:  '
                               . ' You can charge by using specific tags, charge everything except specific tags and you may use the title to determine how much to charge<br> ', $this->plugin->name); ?>
                       
                                    <input name="vxlAction" type='hidden' value='save'>
                                    
                                      
                                    <select name="vxl_chargeMethod" id="vxl_domain" rows="8" style="font-family:Courier New;" value ="<?php echo get_option('vxl_trancherAtParagraphNo'); ?>">
                                        <option value="chargeByTag" <?php if (get_option('vxl_chargeMethod') == 'chargeByTag') {
                                        print ' selected ';
                                    } ?> >  
                                        <?php _e('Price tags, default to free', $this->plugin->name); ?></option>
                                        <option value="chargeEverything"  <?php if (get_option('vxl_trancherAt') == 'chargeEverything') {
                                                print ' selected ';
                                            } ?> >    
                                            <?php _e('Charge for all articles', $this->plugin->name); ?></option>
                                        <option value="chargeContentURL"  <?php if (get_option('vxl_trancherAt') == 'chargeContentURL') {
                                                print ' selected ';
                                            } ?> >    
                                            <?php _e('Charge content whose URL ends with -vxl', $this->plugin->name); ?></option>
                                       
                                    </select>
                                    
                                        </p>  
                                    
                                        
                                        <p>
                                   <h3 class="hndle"><?php _e('Shortening content before payment', $this->plugin->name); ?></h3>
      
                                   <?php _e('When a user arrives at paid content, the content is chopped awaiting the vxl payment process to complete. By default, vxlpay will chop the article when detecting a ::vxlpay:: in the string. If this is not present, please select approximately how many words the user will be allowed to read if his account is empty. <br> ', $this->plugin->name); ?>
                                    
                                    
                                    <select name="vxl_trancherAt" id="vxl_domain" rows="8" style="font-family:Courier New;" value ="<?php echo get_option('vxl_trancherAtParagraphNo'); ?>">
                                        <option value="trancher_at_token" <?php if (get_option('vxl_trancherAt') == 'trancher_at_token') {
                                        print ' selected ';
                                    } ?> >  
                                            <?php _e('Cut when ::vxl:: appearing in text', $this->plugin->name); ?></option>
                                        <option value="trancher_after_heading"  <?php if (get_option('vxl_trancherAt') == 'trancher_after_heading') {
                                                print ' selected ';
                                            } ?> >    
                                            <?php _e('Cut after heading', $this->plugin->name); ?></option>
                                        <option value="trancher_after_ingres"  <?php if (get_option('vxl_trancherAt') == 'trancher_after_ingres') {
                                                print ' selected ';
                                            } ?> >   
<?php _e('Cut after ingres', $this->plugin->name); ?></option>
                                        <option value="trancher_after_150_words"  <?php if (get_option('vxl_trancherAt') == 'trancher_after_150_words') {
    print ' selected ';
} ?> >   
                                <?php _e('Cut after approx 150 words', $this->plugin->name); ?></option>
                                       
                                        <option value="trancher_after_100_words"  <?php if (get_option('vxl_trancherAt') == 'trancher_after_100_words') {
                                    print ' selected ';
                                } ?> >   
<?php _e('Cut after approx 100 words', $this->plugin->name); ?></option> 
                                        <option value="trancher_after_50_words"  <?php if (get_option('vxl_trancherAt') == 'trancher_after_50_words') {
                                    print ' selected ';
                                } ?> >   
<?php _e('Cut after about 50 words', $this->plugin->name); ?></option>  
    <option value="trancher_after_20_words"  <?php if (get_option('vxl_trancherAt') == 'trancher_after_20_words') {
                                    print ' selected ';
                                } ?> >   
<?php _e('Cut after about 20 words', $this->plugin->name); ?></option>  
                                    </select>

                                </p>
                               
<?php wp_nonce_field($this->plugin->name, $this->plugin->name . '_nonce'); ?>
                                <p>
                                    <input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php _e('Save', $this->plugin->name); ?>" /> 
                                </p>
                            </form>
                        </div>
                    </div>


                </div>      



