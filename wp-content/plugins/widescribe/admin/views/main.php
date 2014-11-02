<?php
/**
 * Represents the view for the main dashboard
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
                        <h3 class="hndle"><?php _e('Main panel splash', $this->plugin->name); ?></h3>

                        <div class="inside">

                            <?php _e('Welcome the the vxl administration interface', $this->plugin->name); ?>
                            
                        </div>
                          <!-- Sidebar -->
                        <div id="postbox-container-1" class="postbox-container">

                            <?php require_once($this->plugin->folder.'/admin/includes/tips.php');  ?>

                        </div>

                    </div>
                    <!-- /postbox -->

                </div>
                <!-- /normal-sortables -->
            </div>

            <!-- /post-body-content -->

            <!-- Sidebar -->
        
            <!-- /postbox-container -->
        </div>


    </div>



