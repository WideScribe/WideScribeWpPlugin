<?php
/**
 * Form 
 *
 * This page contains options for the Contact Form
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

                     
                        <div class="inside">
   <h2 class="hndle"><?php _e('Contact forms settings', $this->plugin->name); ?></h2>
                       <?php if (get_option('vxl_formEnabled') == 'enabled') {
                                     _e('The contact form is currently enabled<br> ', $this->plugin->name);
                               
                                    }
                                    else{
                                         _e('The contact form is currently disabled<br> ', $this->plugin->name);
                                    } ?> 
                             <form  method="post">
                                <p>  
                               <h3 class="hndle"><?php _e('Contact form', $this->plugin->name); ?></h3>
      
                                <?php _e('Enable or disable contact form', $this->plugin->name); ?>
                       
                                  <input name="vxlAction" type='hidden' value='save'>
                                    
                                  <select id="vxl_formEnabled" name="vxl_formEnabled">
                                      <option value='enabled' <?php if (get_option('vxl_formEnabled') == 'enabled') {
                                        print ' selected ';
                                    } ?> >  
                                         <?php _e('Enabled', $this->plugin->name) ?>
                                      </option>
                                        <option value='disabled'  <?php if (get_option('vxl_formEnabled') == 'disabled') {
                                        print ' selected ';
                                    } ?> >
                                        <?php  _e('Disabled', $this->plugin->name) ?>
                                      </option>
                                  </select>
                                    
                                    <?php wp_nonce_field($this->plugin->name, $this->plugin->name . '_nonce'); ?>
                                <p>
                                    <input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php _e('Save', $this->plugin->name); ?>" /> 
                                </p>
                            </form>
                        </div>
                    </div
                      <!-- Sidebar -->
            <div id="postbox-container-1" class="postbox-container">
                
                <?php require_once($this->plugin->folder.'/admin/includes/tips.php');  ?>
                
            </div>

                </div>      



