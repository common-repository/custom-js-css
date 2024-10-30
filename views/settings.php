<div class="wrap">
    <div id="<?php echo $this->plugin->name; ?>-title" class="icon32"></div> 
    <h2 class="wpcube"><?php echo $this->plugin->displayName; ?> &raquo; <?php _e('Settings'); ?></h2>
           
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
	                    <h3 class="hndle"><?php _e('Instructions', $this->plugin->name); ?></h3>
	                    
	                    <div class="option">
	                    	<p>
	                    		<?php _e('Create / edit the following plugin files as necessary in your favourite code editor / IDE:', $this->plugin->name); ?>
	                    	</p>
	                    	<p>
	                    		<strong>custom/custom.css</strong>
	                    		<?php _e('Any CSS that needs to be applied to the site can be added here.', $this->plugin->name); ?>
	                    	</p>
	                    	<p>
	                    		<strong>custom/custom.js</strong>
	                    		<?php _e('Any Javascript that needs to be applied to the site can be added here.', $this->plugin->name); ?>
	                    	</p>
	                    	<p>
	                    		<strong>custom/custom.php</strong>
	                    		<?php _e('Any inline CSS, JS, HTML or PHP that needs to be applied to the footer of the site can be added here.', $this->plugin->name); ?>
	                    	</p>
	                    	<p>
	                    		<?php _e('Any updates to this plugin will not overwrite your custom CSS, JS or inline code.', $this->plugin->name); ?>
	                    	</p>
	                    </div>
	                </div>
	                <!-- /postbox -->
				</div>
				<!-- /normal-sortables -->
    		</div>
    		<!-- /post-body-content -->
    		
    		<!-- Sidebar -->
    		<div id="postbox-container-1" class="postbox-container">
    			<?php require_once($this->plugin->folder.'/_modules/dashboard/views/sidebar-donate.php'); ?>		
    		</div>
    		<!-- /postbox-container -->
    	</div>
	</div>       
</div>