<div class="wrap">
    <h2>
        <?php _e('My Partners', $this->plugin->name); ?>
        <a href="<?php menu_page_url('widescribe-admin-add'); ?>" class="add-new-h2">Add New</a>
	</h2>
    <?php if (isset($this->message)) { ?>
    <div class="updated fade">
       	<p><?php echo $this->message; ?></p>
	</div>  
    <?php } if (isset($this->errorMessage)) { ?>
    <div class="error fade">
		<p><?php echo $this->errorMessage; ?></p>
	</div>  
    <?php } ?>
    <form id="partners-filter" method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <?php $partnersTable->display() ?>
    </form>
</div>
	