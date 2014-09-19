<?php
/**
 * Look and feel 
 *
 * This page contains setting options for positioning the vxl counter
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
   <h2 class="hndle"><?php _e('Look and feel ', $this->plugin->name); ?></h2>

                             <form  method="post">
                                <p>  
                               <h3 class="hndle"><?php _e('Counter and vxl balance icon', $this->plugin->name); ?></h3>
      
                              <?php _e('Use the below style settings to position the vxl logo. This overloads the balanceBox class '
                               . '<br> ', $this->plugin->name); ?>
                       
                                    <input name="vxlAction" type='hidden' value='save'>
                                    <textarea name="vxlStyle" rows="5" cols="44" ><?php print get_option('vxlStyle'); ?></textarea>
                           
                                   
                                    
                                        </p>  
                                    
                                        
                                        <p>
                                   <h3 class="hndle"><?php _e('Shortening content before payment', $this->plugin->name); ?></h3>
      
                                   <?php _e('Select the vxl counter and balance icon<br> ', $this->plugin->name); ?>
                                    
                                    <select name="vxlTrinketType" id="vxl_domain" rows="8" style="font-family:Courier New;" value ="<?php echo get_option('vxlTrinketType'); ?>">
                                        <option value="type1" <?php if (get_option('vxlTrinketType') == 'type1') {
                                        print ' selected ';
                                    } ?> >  
                                            <?php _e('Type 1', $this->plugin->name); ?></option>
                                        <option value="type2"  <?php if (get_option('vxlTrinketType') == 'type2') {
                                                print ' selected ';
                                            } ?> >    
                                            <?php _e('Type 2', $this->plugin->name); ?></option>
                                        <option value="type3"  <?php if (get_option('vxlTrinketType') == 'type3') {
                                                print ' selected ';
                                            } ?> >   
            <?php _e('Type 3', $this->plugin->name); ?>
                                        </option>
                                    </select>

                                </p>
                               
<?php wp_nonce_field($this->plugin->name, $this->plugin->name . '_nonce'); ?>
                                <p>
                                    <input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php _e('Save', $this->plugin->name); ?>" /> 
                                </p>
                            </form>
                           <?php 
                           
                            print WideScribeWpPlugin::getTrinket(get_option('vxlTrinketType'));
                            
                            ?>
                        </div>
                    </div>


                </div>      



