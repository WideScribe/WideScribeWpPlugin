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
                                        <option selected value="none">Select an operation</option>
                                        <option value="create_log_tables">Re create log tables</option>
                                        <option value="empty_log_table">Empty log table </option>
                                        <option value="empty_error_table">Empty error table </option>
                                        <option value="vxlwp_test">Test widescribe connection</option>
                                        
                                    </select>
                                </p>

                                <?php wp_nonce_field($this->plugin->name, $this->plugin->name . '_nonce'); ?>
                                <p>
                                    <input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php _e('Execute', $this->plugin->name); ?>" /> 
                                </p>
                            </form>
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
                Happens in the sidebar;
                <?php //require_once($this->plugin->folder.'/_modules/dashboard/views/sidebar-donate.php');  ?>
            </div>

            <!-- /postbox-container -->
        </div>


    </div>



