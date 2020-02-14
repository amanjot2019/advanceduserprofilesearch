<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Advanceduserprofilesearch
 * @subpackage Advanceduserprofilesearch/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Advanceduserprofilesearch
 * @subpackage Advanceduserprofilesearch/admin
 * @author     Aman <amanjot@gmail.com>
 */
class Advanceduserprofilesearch_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	    add_action('admin_menu', array( $this, 'pqs_plugin_setup_menu') );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Advanceduserprofilesearch_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Advanceduserprofilesearch_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/advanceduserprofilesearch-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Advanceduserprofilesearch_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Advanceduserprofilesearch_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/advanceduserprofilesearch-admin.js', array( 'jquery' ), $this->version, false );

	}
 function pqs_plugin_setup_menu(){
            
             add_options_page( ' Quick Search Page', 'Advance User Profile Search', 'manage_options', 'advanceduserprofilesearch', array($this,'aups_init') );
            
        }
        
    
        function aups_init(){
            
            echo "<h2>Advanced User Profile Search Plugin</h2>";  ?>
            
          <table>
                <tbody><tr valign="top">
                  <th>
                      
                      <?php echo esc_html( __( "How to use this Plugin", 'wp-profile-quick-search' ) ); ?>
                   
                  </th>
                  
                   <td>
                      &nbsp; 
                  </td> 
                  
                  <td>
                      <?php echo esc_html( __( "It's a user profile search plugin.", 'wp-profile-quick-search' ) ); ?>    
                  </td> 
                  </tr>
                  
                  <tr>
                      
                  <td>
                       <strong>Shortcode</strong>
                  </td>
                      
                      <td>
                      &nbsp; 
                  </td> 
                      
                  <td>
                  <p> 
                    
                    
                   <?php echo esc_html( __( "To show search form use this shortcode in html editor", 'wp-profile-quick-search' ) ); ?> <span style="color:red;">[aups_form]</span><br/>
                   <?php echo esc_html( __( "To show search Reasult use this shortcode in html editor", 'wp-profile-quick-search' ) ); ?> <span style="color:red;">[aups_result]</span>
                    
                    </p>
                     
                  </td>
                </tr>
               
              </tbody></table>   
<?php 
          }   


}
