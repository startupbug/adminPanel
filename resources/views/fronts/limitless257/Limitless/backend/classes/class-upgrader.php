<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * ARTLGNC Framework Auto Upgrader.
 *
 * Class that handles auto updates for ARTLGNC Framework
 *
 * @class    ARTLGNC_Upgrader
 * @version  1.0.0
 * @package  Framework/Classes
 * @category Class
 * @author   Artillegence
 * @since    V6
 */


if(! class_exists('ARTLGNC_Upgrader')) {

    class ARTLGNC_Upgrader  {

        var $license = null;
        var $theme = '';
        var $version = '';
        var $endpoint = 'http://artillegence.com/apicheck';

        function __construct() {

         //set_site_transient('update_themes', null);
         
         $current_theme  = wp_get_theme();
         $this->theme = strtolower($current_theme->get('Name'));
         $this->version = strtolower($current_theme->get('Version'));
         
         $params = array( 
                            'type' => 'web', 
                            'url' => $this->endpoint, 
                            'theme' => $this->theme, 
                            'title' => $this->theme );

         add_filter( 'pre_set_site_transient_update_themes', array(&$this, 'check_for_update') );
         add_filter( 'upgrader_pre_install', array(&$this, 'create_backup') );

         // $this->addDashboardCheck();
         $this->notifyUpdate();

        }

        function create_backup($theme) {
            global $wp_filesystem;
            $folder = get_template_directory();
            
            if( $this->initialize_wpfilesystem() ) {

                $wp_filesystem->mkdir(ABSPATH . '/wp-content/ARTLGNC-backups/');
                $this->recurse_copy($folder,ABSPATH . '/wp-content/ARTLGNC-backups/'.$this->theme.'-v-'.$this->version);
            }
            

        }

        function recurse_copy($src,$dst) { 
                global $wp_filesystem;
                $dir = opendir($src); 
                $wp_filesystem->mkdir($dst); 
                while(false !== ( $file = readdir($dir)) ) { 
                    if (( $file != '.' ) && ( $file != '..' )) { 
                        if ( is_dir($src . '/' . $file) ) { 
                            $this->recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                        } 
                        else { 
                            copy($src . '/' . $file,$dst . '/' . $file); 
                        } 
                    } 
                } 
                closedir($dir); 
            } 

        function check_for_update( $transient ) {
           
           if (empty($transient->checked)) return $transient;
            
          
            $raw_response = wp_remote_post( $this->endpoint, $this->prepare_request( array('theme' => $this->theme) ) );
            $response = null;
            
         

             if( !is_wp_error($raw_response) && ($raw_response['response']['code'] == 200) ) {
                  $response = json_decode($raw_response['body'],true);
             }
              

            
            if( !empty($response) && version_compare($response['new_version'],$this->version) == 1 ) // Feed the update data into WP updater
                $transient->response[$this->theme] = $response;

            
            return $transient;
        }

        function prepare_request(  $args ) {
            global $wp_version;
            
            return array(
                'body' => array(
                    'request' => serialize($args),
                ),
                'user-agent' => 'WordPress/'. $wp_version .'; '. esc_url(home_url('/'))
            );  
        }

        function initialize_wpfilesystem() {

                 global $wp_filesystem;

                   $access_type = get_filesystem_method();
                 
                   if($access_type=="direct") {

                    $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());

                    /* initialize the API */
                    if ( ! WP_Filesystem($creds) ) {
                            /* any problems and we exit */
                            return false;
                        } else
                        {
                            return true;
                        }
                        

                   }

            }

        function notifyUpdate() {

            $theme_update = get_site_transient('update_themes');
            $name = $this->theme;

                   if(isset($theme_update->response[$name]['bad'])) return;
            


                if(isset($theme_update->response) && isset($theme_update->response[$name])) {

                    $t = wp_get_theme();

               

                  if(isset($theme_update->response[$name]) && version_compare($theme_update->response[$name]['new_version'], $t->get('Version')) == 1 ) {
                     add_action('admin_footer','ARTLGNC_themeupdate',1);

                  }
                      


                   function ARTLGNC_themeupdate() {
                              echo 'testlol';
                            ?>
                            <div class="ARTLGNC-update-available">
                                 <h4><?php echo sprintf(esc_html__('Update Available is available. %s to update.','[artlgnc'), "<a href='".network_admin_url('update-core.php')."'>".esc_html__('Click here','[artlgnc]')."</a>" ) ?></h4>
                                 <a href="#" class='material-icons close-ARTLGNC-update-available'>close</a>
                            </div>
                            <?php
                        }

             }
                        

        }    
        
        function addDashboardCheck() {

               add_action('wp_dashboard_setup', 'ARTLGNC_addAutoUpdateWidget' );

                function ARTLGNC_addAutoUpdateWidget() {
                    add_meta_box('ARTLGNC_wpauto_widget', esc_html__('Auto Update','wakana'), 'ARTLGNC_wpauto_widget', 'dashboard', 'side', 'high');
                }
                function ARTLGNC_wpauto_widget() {
                   
                   $val = '';

                   if(isset($_POST['ARTLGNC_theme_license'])) {
                        update_option('ARTLGNC_theme_license',$_POST['ARTLGNC_theme_license']);
                   }

                   if(get_option('ARTLGNC_theme_license'))
                    $val = get_option('ARTLGNC_theme_license');
                  ?>
                  <div class="full ARTLGNC-ajax-save clearfix" data-type='save-ajax'>
                     <form action="" method="post">
                         <?php if(get_option('ARTLGNC_enable_auto_update')) : ?> <p class='ARTLGNC-information-p'> <i class="material-icons">&#xE877;</i> <?php esc_html_e('Auto Update is enabled on the site','wakana') ?></p> <?php endif; ?>
                        
                        <div class="ARTLGNC_input">
                            <label for="ARTLGNC_theme_license"><?php esc_html_e('Enter Theme Purchase Code','[artlgnc]') ?>
                                <span><?php esc_html_e('To enable auto updates, enter your theme purchase code here.','[artlgnc]') ?></span>
                            </label>
                            <div class="ARTLGNC_input_holder">
                                <input type="text" name="ARTLGNC_theme_license" id="ARTLGNC_theme_license" value="<?php echo $val; ?>" placeholder="">
                            </div>
                        </div>

                       <div class="clearfix" style="padding:20px">
                            <input type="submit" class="ARTLGNC-auto-update-save ARTLGNC-ajax-trigger button-save" value="Save" name="ARTLGNC_update_action">  
                       </div>

                     </form>
                  </div>
                  <?php
                }


        }

    }


}

add_action('init', 'artlgnc_init_update');
function artlgnc_init_update() {
   
        $theme = new ARTLGNC_Upgrader();
}

add_action('admin_head','artlgnc_add_update_css');
function artlgnc_add_update_css() {

   ?>
   <style type="text/css">
   div.ARTLGNC-update-available {  position: fixed; top:0; left:0; right:0; height: 40px; z-index:9990; line-height:40px; text-align: center; background:#3cb26a; display: none;}
div.ARTLGNC-update-available h4 { margin: 0; padding: 0; color:#fff;  }
div.ARTLGNC-update-available h4 a { text-decoration: none; color:#fff; border-bottom:1px solid #fff; }

body.ARTLGNC-update { padding-top: 40px; }
body.ARTLGNC-update #wpadminbar { top:40px; }
.ARTLGNC-update div.artlgnc_builder-global-search{ top: 47px; }
.ARTLGNC-update div.ARTLGNC-update-available { display: block; }

a.close-ARTLGNC-update-available {     position: absolute;
    top: 10px;
    right: 10px;
    color: #fff;
    text-decoration: none;
    font-size: 11px;
    text-transform: uppercase;
    background: rgba(0,0,0,0.1);
    padding: 5px 15px;
    line-height: 1;
    font-weight: 600; }

</style>

<?php
}


 ?>