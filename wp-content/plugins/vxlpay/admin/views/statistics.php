<?php
/**
 * Represents the view for the statistics dashboard
 *
 * This page contains information and statistics
 * parameters for the vxlpay application.
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
                        <h3 class="hndle"><?php _e('Statistics', $this->plugin->name); ?></h3>

                        <div class="inside">

                            <?php _e('Vxlpay - your statistics', $this->plugin->name); ?>
                            <form  method="post">
                                <p>
                                    <label for="vxlAction"><strong><?php _e('Choose an action', $this->plugin->name); ?></strong></label>
                                    <select name="vxlAction" id="vxl_domain"  rows="8" style="font-family:Courier New;" value ="<?php echo get_option('vxl_domain'); ?>">
                                        <option value="showStatistcs">Statistics </option>
                                        <option value="something">Statistics</option>
                                        <option selected value="sumtin">Statistics</option>

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
                            <h3 class="hndle"><?php _e('Latest from vxlpay', $this->plugin->name); ?></h3>

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



