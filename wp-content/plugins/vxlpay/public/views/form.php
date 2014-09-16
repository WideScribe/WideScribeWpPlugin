<?php
/**
 * Trancher 
 *
 * This page contains the content of the RedeemVoucher form
 *
 * @package   Vxlpay
 * @author    jens Tandstad <jens@vxlpay.com>
 * @license   GPL-2.0+
 * @link      http://www.vxlpay.com
 * @copyright 2014 Vxlpay AS
 */
?>

<div class="wrap">

    <h2><?php _e('Redeem Voucher', $this->plugin_slug); ?></h2>

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


                             <form  method="post">
                                <p>  
                               <h3 class="hndle"><?php  _e('Register your email and voucher code below to redeem', $this->plugin_slug); ?></h3>
      
                               <input name="vxlAction" type='hidden' value='redeem'>
                               <input name='email' 
                                      type='text' 
                                      placeholder="<?php _e('Email', $this->plugin_slug); ?>"  
                                      value='<?php if(isset($_POST['email'])){print $_POST['email'];} ?>'>        
                               <input name='firstname' 
                                      type='text' 
                                      placeholder="<?php _e('Firstname', $this->plugin_slug); ?>" 
                                       value='<?php if(isset($_POST['firstname'])){print $_POST['firstname'];} ?>'>    
                               <input name='lastname' 
                                      type='text' 
                                      placeholder="<?php _e('Lastname', $this->plugin_slug); ?>" 
                                      value='<?php if(isset($_POST['lastname'])){print $_POST['lastname'];} ?>'>    
                               <input name='voucherCode' 
                                      type='text' 
                                     placeholder="<?php _e('Voucher code', $this->plugin_slug); ?>" 
                                     value=''>    
                               </p>
                               
                                <?php wp_nonce_field($this->plugin_slug, $this->plugin_slug . '_nonce'); ?>
                                <p>
                                    <input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php _e('Redeem voucher and create WideScribe account', $this->plugin_slug); ?>" /> 
                                </p>
                            </form>
                        </div>
                    </div>


                </div>      



