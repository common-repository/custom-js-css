<?php
/**
* Plugin Name: Custom JS and CSS
* Plugin URI: http://www.wpcube.co.uk/plugins/custom-js-css
* Version: 1.0.4
* Author: WP Cube
* Author URI: http://www.wpcube.co.uk
* Description: Allows developers to add CSS and Javascript for inclusion on a WordPress web site.
* License: GPL2
*/

/*  Copyright 2014 WP Cube (email : support@wpcube.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
* Custom JS and CSS Class
* 
* @package WP Cube
* @subpackage Custom JS and CSS
* @author Tim Carr
* @version 1.0.4
* @copyright WP Cube
*/
class CustomJSCSS {
    /**
    * Constructor.
    */
    function CustomJSCSS() {
        // Plugin Details
        $this->plugin = new stdClass;
        $this->plugin->name = 'custom-js-css'; // Plugin Folder
        $this->plugin->displayName = 'Custom JS and CSS'; // Plugin Name
        $this->plugin->version = '1.0.4';
        $this->plugin->folder = WP_PLUGIN_DIR.'/'.$this->plugin->name; // Full Path to Plugin Folder
        $this->plugin->url = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
        
        // Plugin customisation files that may be available
        $this->plugin->css = WP_PLUGIN_DIR.'/'.$this->plugin->name.'/custom/custom.css';
        $this->plugin->js = WP_PLUGIN_DIR.'/'.$this->plugin->name.'/custom/custom.js';
        $this->plugin->inline = WP_PLUGIN_DIR.'/'.$this->plugin->name.'/custom/inline.php';
        
        // Dashboard Submodule
        if (!class_exists('WPCubeDashboardWidget')) {
			require_once($this->plugin->folder.'/_modules/dashboard/dashboard.php');
		}
		$dashboard = new WPCubeDashboardWidget($this->plugin); 

		// Hooks
        add_action('admin_menu', array(&$this, 'adminPanelsAndMetaBoxes'));
        add_action('wp_enqueue_scripts', array(&$this, 'frontendScriptsAndCSS'));
        add_action('plugins_loaded', array(&$this, 'loadLanguageFiles'));

        $this->createFolder();
    }
    
    /**
    * Attempts to create the 'custom' folder, if it does not exist.
    *
    * If the folder cannot be created, an admin notice is added
    */
    function createFolder() {
    	if (!is_dir($this->plugin->folder.'/custom')) {
    		$result = @mkdir($this->plugin->folder.'/custom');
    		if ($result === false) {
    			add_action('admin_notices', array(&$this, 'adminNotices'));
    		}
    	}
    }
    
    /**
    * Notifies the user that the custom folder is missing, or could not be created
    */
    function adminNotices() {
		echo ('<div class="error"><p>'.$this->plugin->displayName.': '.__('could not create \'custom\' folder for JS + CSS. Please manually create this folder, or ask your web hosting provider to do this for you.', $this->plugin->name).'</p></div>');
    }
    
    /**
    * Register the plugin settings panel
    */
    function adminPanelsAndMetaBoxes() {
        add_menu_page($this->plugin->displayName, $this->plugin->displayName, 'manage_options', $this->plugin->name, array(&$this, 'adminPanel'), 'dashicons-art');
    }
    
	/**
    * Output the Administration Panel
    * Save POSTed data from the Administration Panel into a WordPress option
    */
    function adminPanel() {
        // Save Settings
        if (isset($_POST['submit'])) {
        	if (isset($_POST[$this->plugin->name])) {
        		update_option($this->plugin->name, $_POST[$this->plugin->name]);
				$this->message = __('Settings Updated.', $this->plugin->name);
			}
        }
        
        // Get latest settings
        $this->settings = get_option($this->plugin->name);
        
		// Load Settings Form
        include_once(WP_PLUGIN_DIR.'/'.$this->plugin->name.'/views/settings.php');  
    }
    
    /**
    * Register and enqueue any JS and CSS for the frontend web site
    */
    function frontendScriptsAndCSS() {
    	// JS
    	if (file_exists($this->plugin->js)) {
    		// JS
    		wp_enqueue_script($this->plugin->name.'-js', $this->plugin->url.'custom/custom.js');
    	}
    	       
    	// CSS
    	if (file_exists($this->plugin->css)) {
			wp_enqueue_style($this->plugin->name.'-css', $this->plugin->url.'custom/custom.css'); 
       	}
    }
    
    /**
    * Load any inline JS scripts here
    */
    function frontendFooter() {
    	if (file_exists($this->plugin->inline)) {
    		include_once($this->plugin->inline);
    	}
    }
    
    /**
	* Loads plugin textdomain
	*/
	function loadLanguageFiles() {
		load_plugin_textdomain($this->plugin->name, false, $this->plugin->name.'/languages/');
	}
}

$customJSCSS = new CustomJSCSS();
?>
