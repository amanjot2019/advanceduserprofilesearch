<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Advanceduserprofilesearch
 * @subpackage Advanceduserprofilesearch/public
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Advanceduserprofilesearch
 * @subpackage Advanceduserprofilesearch/public
 * @author     Aman <amanjot@gmail.com>
 */
class Advanceduserprofilesearch_Public
{
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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;
        /* Shortcodes */
        add_shortcode('aups_Searchform', array(
            $this,
            'AdvancedUserProfile_searchform_html'
        ));
        add_shortcode('aups_result', array(
            $this,
            'AdvancedUserProfile_quick_seach_result'
        ));
    }
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
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
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/advanceduserprofilesearch-public.css', array(), $this->version, 'all');
    }
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
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
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/advanceduserprofilesearch-public.js', array(
            'jquery'
        ), $this->version, false);
    }
    public function AdvancedUserProfile_searchform_html()
    {
        /* Generating Form Using Woocommerce */
        global $woocommerce;
        $user        = wp_get_current_user();
        $roles       = ( array ) $user->roles;
        $userMetaKey = 'account_agent';
        global $wpdb;
        $results       = $wpdb->get_results("SELECT meta_value FROM  " . $wpdb->prefix . "usermeta  where meta_key='" . $userMetaKey . "' and meta_value !='' GROUP By meta_value ", OBJECT);
        $metadataArray = array();
        foreach ($results as $result => $value) {
            $metadataArray[] = $value->meta_value;
        }
?>
  <div class="s007">
    <form  action="<?php
        echo $_SERVER['REQUEST_URI'];
?>" method="post">
        <div class="inner-form">
          <div class="basic-search">
 
            <div class="input-field">
            
               <h2><?php
        _e("Advanced User Profile Search");
?></h2>
              <!--div class="result-count">
                <span>108 </span>results</div-->
            </div>
          </div>
          <div class="advance-search">
            <span class="desc">Advanced Search</span>
            <div class="row">
              <div class="input-field">
                <div class="input-select">
                   <?php
        woocommerce_form_field('account_passport', array(
            'type' => 'select',
            'label' => 'Passport',
            'required' => false, // remember, this doesn't make the field required, just adds an "*"
            'placeholder' => 'Passport',
            'options' => array(
                '' => __('Select a country&hellip;', 'woocommerce')
            ) + WC()->countries->get_allowed_countries(),
            'validate' => array(
                'validate-position'
            ),
            'class' => array(
                'woocommerce-form-row',
                'woocommerce-form-row--first',
                'form-row',
                'form-row-first'
            )
        ), get_user_meta(get_current_user_id(), 'account_passport', true) // get the data
            );
?>
              </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                    <?php
        woocommerce_form_field('account_height', array(
            /*'type' => 'select',
            'label' => 'Height',
            'required' => false, // remember, this doesn't make the field required, just adds an "*"
            'placeholder' => 'Height',
            'options' => $this->getUserMeta('account_height'),
            'validate' => array(
                'validate-leg'
            )*/
             'type' => 'text',
            'label' => 'Height',
            'required' => false,
            'placeholder' => 'Height',
            'priority' => 1,
            'class' => array(
                'woocommerce-form-row',
                'woocommerce-form-row--first',
                'form-row',
                'form-row-first'
            )
        ), get_user_meta(get_current_user_id(), 'account_height', true) // get the data
            );
?>
              </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <?php
        woocommerce_form_field('account_weight', array(
           /* 'type' => 'select',
            'label' => 'Weight',
            'required' => false, // remember, this doesn't make the field required, just adds an "*"
            'placeholder' => 'Weight',
            'options' => $this->getUserMeta('account_weight'),
            'validate' => array(
                'validate-leg'
            )*/
                 'type' => 'text',
            'label' => 'Weight',
            'required' => false,
            'placeholder' => 'Weight',
            'priority' => 1,
            'class' => array(
                'woocommerce-form-row',
                'woocommerce-form-row--first',
                'form-row',
                'form-row-first'
            )
        ), get_user_meta(get_current_user_id(), 'account_weight', true) // get the data
            );
?>
              </div>
              </div>
            </div>
            <div class="row second">
              <div class="input-field">
                <div class="input-select">
                   <?php
        woocommerce_form_field('account_dominant_leg', array(
            'type' => 'select',
            'label' => 'Dominant leg',
            'required' => false, // remember, this doesn't make the field required, just adds an "*"
            'placeholder' => 'Dominant leg',
            'options' => array(
                'Left',
                'Right'
            ),
            'validate' => array(
                'validate-leg'
            )
        ), get_user_meta(get_current_user_id(), 'account_dominant_leg', true) // get the data
            );
?>
              </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                <?php
        woocommerce_form_field('account_current_club', array(
            'type' => 'select',
            'label' => 'Current Club',
            'required' => false, // remember, this doesn't make the field required, just adds an "*"
            'placeholder' => 'Current Club',
            'options' => $this->getUserMeta('account_current_club'),
            'validate' => array(
                'validate-leg'
            ),
            'class' => array(
                'woocommerce-form-row',
                'woocommerce-form-row--first',
                'form-row',
                'form-row-first'
            )
        ), get_user_meta(get_current_user_id(), 'account_current_club', true) // get the data
            );
?>
              </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                 <?php
        woocommerce_form_field('account_contract_end_date', array(
            'type' => 'date',
            'label' => 'End of the contract',
            'placeholder' => 'End of the contract',
            'class' => array(
                'woocommerce-form-row',
                'woocommerce-form-row--first',
                'form-row',
                'form-row-first'
            )
        ), get_user_meta(get_current_user_id(), 'account_contract_end_date', true) // get the data
            );
?>
              </div>
              </div>
            </div>
               <div class="row third3">
              <div class="input-field">
                <div class="input-select">
                   <?php
        woocommerce_form_field('account_agent', array(
           /* 'type' => 'select',
            'label' => 'Agent',
            'required' => false, // remember, this doesn't make the field required, just adds an "*"
            'placeholder' => 'agent',
            'options' => $this->getUserMeta('account_agent'),
            'validate' => array(
                'validate-leg'
            ),
            'class' => array(
                'woocommerce-form-row',
                'woocommerce-form-row--first',
                'form-row',
                'form-row-first'
            )*/
               'type' => 'text',
            'label' => 'Agent',
            'required' => false,
            'placeholder' => 'Agent',
            'priority' => 1,
            'class' => array(
                'woocommerce-form-row',
                'woocommerce-form-row--first',
                'form-row',
                'form-row-first'
            )
        ), get_user_meta(get_current_user_id(), 'account_agent', true) // get the data
            );
?>
              </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                <?php
        woocommerce_form_field('account_transfer_fee', array(
            'type' => 'text',
            'label' => 'Transfer fee',
            'required' => false,
            'placeholder' => 'Transfer fee',
            'priority' => 1,
            'class' => array(
                'woocommerce-form-row',
                'woocommerce-form-row--first',
                'form-row',
                'form-row-first'
            )
        ), get_user_meta(get_current_user_id(), 'account_transfer_fee', true) // get the data
            );
?>
              </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                 <?php
        woocommerce_form_field('position_2', array(
            'type' => 'select',
            'label' => 'Position 2',
            'required' => false, // remember, this doesn't make the field required, just adds an "*"
            'placeholder' => 'Position 2',
            'options' => array(
                'Keeper Right',
                'Keeper Left',
                'Keeper Central',
                'Defender Right',
                'Defender Left',
                'Defender Central',
                'Midfielder Right',
                'Midfielder Left',
                'Midfielder Central',
                'Attacker',
                'Attacker',
                'Right Back',
                'Left Back'
            ),
            'validate' => array(
                'validate-leg'
            ),
            'class' => array(
                'woocommerce-form-row',
                'woocommerce-form-row--first',
                'form-row',
                'form-row-first'
            )
        ), get_user_meta(get_current_user_id(), 'position_2', true) // get the data
            );
?>
              </div>
              </div>
            </div>
            <div class="row forth">
             <div class="input-field">
                <div class="input-select">
                <?php
        woocommerce_form_field('account_zip_code', array(
            'type' => 'text',
            'label' => 'Zip code',
            'required' => false,
            'placeholder' => 'Zip code',
            'priority' => 1,
            'class' => array(
                'woocommerce-form-row',
                'woocommerce-form-row--first',
                'form-row',
                'form-row-first'
            )
        ), get_user_meta(get_current_user_id(), 'account_zip_code', true) // get the data
            );
?>
              </div>
              </div>
            </div>
            <div class="row fifth">
              <div class="input-field">
               <input type='submit' id='pqs-btn'  class="btn-search" name='pqsbutton' value='Search' Placeholder=""/>  
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    
         <?php
    }
    function getUserMeta($userMetaKey)
    {
        global $wpdb;
        // $userMetaKey = 'account_agent';
        $placeholderForSelect = ucfirst(str_replace("account_", '', $userMetaKey));
        $placeholderForSelect = str_replace("_", ' ', $placeholderForSelect);
        $results              = $wpdb->get_results("SELECT meta_value FROM  " . $wpdb->prefix . "usermeta  where meta_key='" . $userMetaKey . "' and meta_value !='' GROUP By meta_value ", OBJECT);
        $metadataArray        = array();
        $metadataArray['0']   = $placeholderForSelect;
        foreach ($results as $result => $value) {
            $metadataArray[$value->meta_value] = $value->meta_value;
        }
        //print_r($metadataArray);
        return $metadataArray;
    }
    public function AdvancedUserProfile_quick_seach_result()
    {
        global $wpdb;
        $user        = wp_get_current_user();
        $roles       = ( array ) $user->roles;
        $carrentdate = date('Y-m-d');
        if (isset($_POST['pqsbutton'])) {
            $account_passport          = (string) $_POST['account_passport'];
            $account_height            = (string) $_POST['account_height'];
            $account_weight            = (string) $_POST['account_weight'];
            $account_dominant_leg      = (string) $_POST['account_dominant_leg'];
            $account_current_club      = (string) $_POST['account_current_club'];
            $account_contract_end_date = (string) $_POST['account_contract_end_date'];
            $account_agent             = (string) $_POST['account_agent'];
            $account_transfer_fee      = (string) $_POST['account_transfer_fee'];
            $position_2                = (string) $_POST['position_2'];
            $account_zip_code          = (string) $_POST['account_zip_code'];
            $queryArray                = array();
            if ($account_passport != '0' && $account_passport != '') {
                $queryArray[] = array(
                    'key' => 'account_passport',
                    'value' => $account_passport,
                    'compare' => '='
                );
            }
            if ($account_height != '0' && $account_height != '') {
                $queryArray[] = array(
                    'key' => 'account_height',
                    'value' => $account_height,
                    'compare' => 'LIKE'
                );
            }
            if ($account_weight != '0' && $account_weight != '') {
                $queryArray[] = array(
                    'key' => 'account_weight',
                    'value' => $account_weight,
                    'compare' => 'LIKE'
                );
            }
            if ($account_dominant_leg != '0' && $account_dominant_leg != '') {
                $queryArray[] = array(
                    'key' => 'account_dominant_leg',
                    'value' => $account_dominant_leg,
                    'compare' => '='
                );
            }
            if ($account_current_club != '0' && $account_current_club != '') {
                $queryArray[] = array(
                    'key' => 'account_current_club',
                    'value' => $account_current_club,
                    'compare' => '='
                );
            }
            if ($account_agent != '0' && $account_agent != '') {
                $queryArray[] = array(
                    'key' => 'account_agent',
                    'value' => $account_agent,
                    'compare' => 'LIKE'
                );
            }
            if ($account_transfer_fee != '' && $account_transfer_fee != '') {
                $queryArray[] = array(
                    'key' => 'account_transfer_fee',
                    'value' => $account_transfer_fee,
                    'compare' => '='
                );
            }
            if ($position_2 != '0' && $position_2 != '') {
                $queryArray[] = array(
                    'key' => 'position_2',
                    'value' => $position_2,
                    'compare' => '='
                );
            }
            if ($account_zip_code != '0' && $account_zip_code != '') {
                $queryArray[] = array(
                    'key' => 'account_zip_code',
                    'value' => $account_zip_code,
                    'compare' => '='
                );
            }
            if ($account_contract_end_date != '0' && $account_contract_end_date != '') {
                $queryArray[] = array(
                    'relation' => 'OR',
                    array(
                        'key' => 'account_contract_end_date',
                        'value' => array(
                            $carrentdate,
                            $account_contract_end_date
                        ),
                        'compare' => 'BETWEEN',
                        'type' => 'DATE'
                    ),
                    array(
                        'key' => 'account_contract_end_date',
                        'value' => $account_contract_end_date,
                        'compare' => '=',
                        'type' => 'DATE'
                    )
                );
            }
            //    return;
            $available_Palyers = get_users(array(
                'role' => 'customer',
                'meta_query' => $queryArray
            ));
            /*          echo'<pre>';
            print_r($available_Palyers);
            echo'</pre>';    
            */
            echo '<div class="AUPSP-fetchdata">';
            if (!empty($available_Palyers)) {
                foreach ($available_Palyers as $user) {
                    $user_info = get_user_meta($user->ID);
                    // echo"<pre>"; print_r($user_info); echo"</pre>";
                    if (isset($user_info['account_lives_in']) && $user_info['account_lives_in'][0] != '') {
                        $account_lives_in = WC()->countries->countries[$user_info['account_lives_in'][0]];
                    } else {
                        $account_lives_in = '';
                    }
                    if (isset($user_info['account_passport']) && $user_info['account_passport'][0] != '') {
                        $account_passport = WC()->countries->countries[$user_info['account_passport'][0]];
                    } else {
                        $account_passport = '';
                    }
                    if (isset($user_info['account_height']) && $user_info['account_height'][0] != '') {
                        $account_height = $user_info['account_height'][0];
                    } else {
                        $account_height = '';
                    }
                    if (isset($user_info['account_weight']) && $user_info['account_weight'][0] != '') {
                        $account_weight = $user_info['account_weight'][0];
                    } else {
                        $account_weight = '';
                    }
                    if (isset($user_info['account_contract_end_date']) && $user_info['account_contract_end_date'][0] != '') {
                        $account_contract_end_date = $user_info['account_contract_end_date'][0];
                    } else {
                        $account_contract_end_date = '';
                    }
                    echo '  <div class="rq-listing-item wow fadeIn"  >
                    <div class="row">
                      <div class="col-sm-2">
                        ' . get_avatar($user->ID) . '
                      </div>
                      <div class="col-sm-10">
                        <h4 class="rq-listing-item-title"><a href="#"> Name: ' . $user->first_name . ' ' . $user->last_name . ' </a></h4> 
                        
                       <div class="row">
                       <div class="rq-listing-item-sub-extra col-sm-6">
                          <div class="rq-lisitng-item-col"><i class="fa fa-building-o"></i> <b>User ID:</b> ' . $user->ID . ' </div>
                          <div class="rq-lisitng-item-col"><i class="fa fa-building-o"></i><b>Email:</b> ' . $user->user_email . ' </div>
                          <div class="rq-lisitng-item-col"><i class="ion-ios-home-outline"></i> <b>Passport:</b> ' . $account_lives_in . '</div>
                        </div>
                          <div class="rq-listing-item-sub-extra col-sm-6">
                            <div class="rq-lisitng-item-col"><i class="ion-ios-home-outline"></i> <b>Live In:</b> ' . $account_lives_in . '</div>
                            <div class="rq-lisitng-item-col"><i class="ion-ios-home-outline"></i><b> Height:</b> ' . $account_height . '</div>
                            <div class="rq-lisitng-item-col"><i class="ion-ios-home-outline"></i> <b>Weight:</b> ' . $account_weight . '</div>
                            
                            <div class="rq-lisitng-item-col"><i class="ion-ios-home-outline"></i> <b>Contract End Date:</b> ' . $account_contract_end_date . '</div>
                        </div>
                        </div>
                        </div>
                      
                      </div>
                    </div>
                  ';
                }
            } else {
                echo 'No users found.';
            }
?>
 
                          
                    <?php
            echo '</div>';
        }
    }
}