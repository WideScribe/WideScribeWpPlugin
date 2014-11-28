<?php
/**
 * Represents the view for the operational dashboard
 *
 * This page contains actions that can be used to set the operational 
 * parameters for the widescribe application.
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
                        <h3 class="hndle"><?php _e('Actions', $this->plugin->name); ?></h3>

                        <div class="inside">
                                
                            <?php _e('Welcome the the vxl administration interface', $this->plugin->name); ?>
                            <form  method="post">
                                <p>
                                    <label for="vxlAction"><strong><?php _e('Choose an action', $this->plugin->name); ?></strong></label>
                                    <select name="vxlAction" id="vxlAction"  rows="8" style="font-family:Courier New;" value ="<?php echo get_option('vxl_domain'); ?>">
                                        <option value="create_watchdog_table"><?php _e('Recreate watchdog table', $this->plugin->name); ?></option>
                                        <option value="empty_watchdog_table"><?php _e('Empty watchdog table', $this->plugin->name); ?></option>
                                        <option selected value="vxlwp_test"><?php _e('Test WideScribe connection', $this->plugin->name); ?></option>
                                        <option selected value="vxlwp_backdoor"><?php _e('Test WideScribe backdoor API connection', $this->plugin->name); ?></option>
                                        
                                    </select>
                                </p>

                                <?php wp_nonce_field($this->plugin->name, $this->plugin->name . '_nonce'); ?>
                                <p>
                                    <input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php _e('Execute', $this->plugin->name); ?>" /> 
                                </p>
                            </form>
                        </div>
                    </div>
                     <div class="postbox">
                        <h3 class="hndle"><?php _e('Error log', $this->plugin->name); ?></h3>

                        <div class="inside">
                                
                            <?php _e('Error logged locally on WideScribe', $this->plugin->name); ?>
                           
                            
                         <?php print $this->printError();?>
                            
                        </div>
                    </div>
                    <!-- /postbox -->

                    <?php
                    // RSS Feed
                    if (isset($this->dashboard)) {
                        ?>
                        <div id="wpbeginner" class="postbox">
                            <h3 class="hndle"><?php _e('Latest from widescribe', $this->plugin->name); ?></h3>

                            <div class="inside">
                                <?php
                                $this->dashboard->outputDashboardWidget();
                                ?>
                            </div>
                        </div>
                        <!-- /postbox -->
                        <?php
                    }
                    ?>
                </div>
                <!-- /normal-sortables -->
            </div>

            <!-- /post-body-content -->

            <!-- Sidebar -->
            <div id="postbox-container-1" class="postbox-container">
                
                <?php require_once($this->plugin->folder.'/admin/includes/tips.php');  ?>
                
            </div>

            <!-- /postbox-container -->
        </div>


    </div>



