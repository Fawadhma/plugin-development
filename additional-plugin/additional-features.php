<?php
/*
Plugin Name: additional features
Plugin URI: http://example.com/wordpress-plugins/additional-features
Description: This is a brief description of my plugin
Version: 1.0
Author: Fawad Ali
Author URI: http://example.com
License: GPLv2
*/
       
  add_action( 'admin_enqueue_scripts', 'scripts_method' );
		 
		 function scripts_method() {
			 wp_register_script('my_script',plugins_url('/additional-plugin/additional.js'), '','',false);
			 wp_enqueue_script('my_script');
		 }

  add_filter('the_content', 'additional_text');

        function additional_text($content){
       
	   $text_value = get_option('extra-text');
	   $location_value = get_option('location-text');
	   $for_homepage = get_option('show-onhome');
	   $for_page = get_option('show-onpage');
	   $for_singlepage = get_option('show-onsinglepage');
	   $for_customtemplate = get_option('show-oncustomtemplate');
	   $for_frontpage = get_option('show-onfrontpage');
	   
	    if(is_home()AND$location_value=="before"AND$for_homepage=="yes"){
	    $content =  $text_value.$content;}

		elseif(is_home()AND$location_value=="after"AND$for_homepage=="yes")
		{$content =  $content.$text_value;}
		
		elseif(is_page()AND$location_value=="before"AND$for_page=="yes"){
	    $content =  $text_value.$content;}
		
		elseif(is_page()AND$location_value=="after"AND$for_page=="yes")
		{$content =  $content.$text_value;}
		
		elseif(is_single()AND$location_value=="before"AND$for_singlepage=="yes"){
	    $content =  $text_value.$content;}
		
		elseif(is_single()AND$location_value=="after"AND$for_singlepage=="yes")
		{$content =  $content.$text_value;}
		
		elseif(is_page_template('custom-template.php')AND$location_value=="before"AND$for_customtemplate=="yes"){
	    $content =  $text_value.$content;}
		
		elseif(is_page_template('custom-template.php')AND$location_value=="after"AND$for_customtemplate=="yes")
		{$content =  $content.$text_value;}
		
		elseif(is_front_page()AND$location_value=="before"AND$for_frontpage=="yes"){
	    $content =  $text_value.$content;}
		
		elseif(is_front_page()AND$location_value=="after"AND$for_frontpage=="yes")
		{$content =  $content.$text_value;}
		
        return $content;
         }


// create custom plugin settings menu
add_action( 'admin_menu', 'features_create_menu' );
function features_create_menu() {
//create new top-level menu
add_menu_page( 'Features Plugin Page', 'Features Plugin','manage_options', 'features_main_menu', 'my_plugin_options');
add_submenu_page('features_main_menu','testing-page','testing page','manage_options','testing_page','testing_for_option');
add_submenu_page('features_main_menu','features plugin data','features plugin data','manage_options','features_plugin_data','features_plugin_data');
}



/** Step 1. */
function additional_features_menu() {
	add_options_page( 'My Plugin Options', 'Additional features', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
}

/** Step 2 (from text above). */
add_action( 'admin_menu', 'additional_features_menu' );


/** Step 3. */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<h2>Add extra features to contents.</h2>';?>
    
          <?php   $text_value = get_option( 'extra-text');
		          $location_value = get_option('location-text');
				  $for_homepage = get_option('show-onhome');
				  $for_page = get_option('show-onpage');
				  $for_singlepage = get_option('show-onsinglepage');
				  $for_customtemplate = get_option('show-oncustomtemplate');
				  $for_frontpage = get_option('show-onfrontpage');
				
				
				if(isset($_POST['submit'])){ 
                
                $text = sanitize_text_field( $_POST['extra-text'] );
                 update_option( 'extra-text', $text );
	
	           $location_text = sanitize_text_field( $_POST['location-text'] );
                update_option( 'location-text', $location_text );
				
				$home_show = sanitize_text_field( $_POST['show-onhome'] );
                update_option( 'show-onhome', $home_show );
				
				$page_show = sanitize_text_field( $_POST['show-onpage'] );
                update_option( 'show-onpage', $page_show );
				
				$singlepage_show = sanitize_text_field( $_POST['show-onsinglepage'] );
                update_option( 'show-onsinglepage', $singlepage_show );
				
				$customtemplate_show = sanitize_text_field( $_POST['show-oncustomtemplate'] );
                update_option( 'show-oncustomtemplate', $customtemplate_show );
				
				$frontpage_show = sanitize_text_field( $_POST['show-onfrontpage'] );
                update_option( 'show-onfrontpage', $frontpage_show );
				}
				
	  ?>
                
    <table border="0" class="form-table">
    <form method="post" action="" name="text_form" onsubmit="return validateform()">
    <tr><th scope="row"><label for="textarea">Enter text here</label></th>
        <td><textarea name="extra-text" id="extra-text" cols="20" rows="2"><?php echo $text_value; ?></textarea></td></tr>
         
    <tr><th scope="row"><label for="select">Select location</label></th>
        <td><select name="location-text" id="location-text" style="width:80px">
                 <option value=""></option>
                 <option value="before" <?php selected($location_value, 'before');?>>before</option>
                 <option value="after" <?php selected($location_value, 'after');?>>after</option></select></td></tr>
                 
    <tr><th scope="row"><label for="select">Show on homepage</label></th>
        <td><select name="show-onhome" id="show-onhome" style="width:80px">
                 <option value=""></option>
                 <option value="yes" <?php selected($for_homepage, 'yes');?>>yes</option>
                 <option value="no" <?php selected($for_homepage, 'no');?>>no</option></select></td></tr>
                 
    <tr><th scope="row"><label for="select">show on page</label></th>
        <td><select name="show-onpage" id="show-onpage" style="width:80px">
                 <option value=""></option>
                 <option value="yes" <?php selected($for_page, 'yes');?>>yes</option>
                 <option value="no" <?php selected($for_page, 'no');?>>no</option></select></td></tr>
                 
    <tr><th scope="row"><label for="select">show on single page</label></th>
        <td><select name="show-onsinglepage" id="show-onsinglepage" style="width:80px">
                 <option value=""></option>
                 <option value="yes" <?php selected($for_singlepage, 'yes');?>>yes</option>
                 <option value="no" <?php selected($for_singlepage, 'no');?>>no</option></select></td></tr>
                 
    <tr><th scope="row"><label for="select">show on custom template</label></th>
        <td><select name="show-oncustomtemplate" id="show-oncustomtemplate" style="width:80px">
                 <option value=""></option>
                 <option value="yes" <?php selected($for_customtemplate, 'yes');?>>yes</option>
                 <option value="no" <?php selected($for_customtemplate, 'no');?>>no</option></select></td></tr>
                 
    <tr><th scope="row"><label for="select">show on fron page</label></th>
        <td><select name="show-onfrontpage" id="show-onfrontpage" style="width:80px">
                 <option value=""></option>
                 <option value="yes" <?php selected($for_frontpage, 'yes');?>>yes</option>
                 <option value="no" <?php selected($for_frontpage, 'no');?>>no</option></select></td></tr>
                 
     <tr><th></th><td><input type="submit" name="submit" value="submit" class="button button-primary"></td></tr>
            
    </form></table>
    
<?php	echo '</div>';
    
}

 function testing_for_option() {   
 
   if(isset($_POST['submit-optionform']))
	 {
	   $setting_option = array( 'lptr_url' => $_POST['url'], 'lptr_leicence' => $_POST['licence'], 'lptr_report' => $_POST['report'], 'lptr_perpage' => $_POST['perpage'] );		
				
		 update_option('lptr_setting_option',$setting_option);
		
	   $lptr_setting = array( 'lptr_sagree' => $_POST['sagree'], 'lptr_magree' => $_POST['magree'], 'lptr_natural' => $_POST['natural'], 'lptr_dagree' => $_POST['dagree'], 'lptr_sdagree' => $_POST['sdagree']);
			
		 update_option('lptr_admin_option',$lptr_setting);	
				
		 echo '<div class="updated"><p> Information updated succesfully </p></div>';
		  }
	   
?>
   
   <div class="wrap">
   <h4> LPTR <br /> Setting </h4>
   
<?php   $admin_option_value = get_option('lptr_setting_option');    
        $admin_option_setting = get_option('lptr_admin_option');    ?>
   
    <form method="post" action="">
     <table border="0" class="widefat fixed" style="border:1px solid #CCC;">
        <tbody>
        
            <tr>
              <th>URL</th> <th><input type="text" name="url" value="<?php echo $admin_option_value['lptr_url'] ?>"/></th>
            </tr>
            
            <tr>
              <th>Number of licences obtained</th> <th><input type="text" name="licence" value="<?php echo $admin_option_value['lptr_leicence'] ?>"/></th>
            </tr>
            
            <tr>
              <th>Number of report generated</th> <th><input type="text" name="report" value="<?php echo $admin_option_value['lptr_report'] ?>"/></th>
            </tr>
            
            <tr>
              <th>Number of question per page</th> <th><input type="text" name="perpage" value="<?php echo $admin_option_value['lptr_perpage'] ?>"/></th>
            </tr>
        
        </tbody>
     </table>
     
     <br />
     <br />
     
     <table border="0" class="widefat fixed" style="border:1px solid #CCC;">
        <tbody>
             
            <tr>
            <th colspan="2"><strong>Option</strong></th>
            </tr>
             
            <tr>
              <th>Strongly Agree</th> <td><input type="text" name="sagree" value="<?php echo $admin_option_setting['lptr_sagree'] ?>"/></td>
            </tr>
            
            <tr>
              <th>Moderately Agree</th> <td><input type="text" name="magree" value="<?php echo $admin_option_setting['lptr_magree'] ?>"/></td>
            </tr>
            
            <tr>
              <th>Nautral</th> <td><input type="text" name="natural" value="<?php echo $admin_option_setting['lptr_natural'] ?>"/></td>
            </tr>
            
            <tr>
              <th>Moderately Disagree</th> <td><input type="text" name="dagree" value="<?php echo $admin_option_setting['lptr_dagree'] ?>"/></td>
            </tr>
            
            <tr>
              <th>Strongly Disagree</th> <td><input type="text" name="sdagree" value="<?php echo $admin_option_setting['lptr_sdagree'] ?>"/></td>
            </tr>
        
        </tbody>
     </table>
     <br />
     <input class="button button-primary" type="submit" name="submit-optionform" value="submit form" />
    </form>
     
<?php 
     
       
	   }
	   
	   
	   
  require("feature-class-install.php");
  $obj = new feature_install();
  $obj->install_table();
  
  $obj2 = new feature_install();
  
   if(isset($_POST['submit-personal']))
   {
  $obj2->insert_data($_POST['fname'],$_POST['lname'],$_POST['question']);
   }
	  function features_plugin_data()
	  {     ?>
      
   <div class="wrap">
   <h4> Testing for the insert query </h4>	
   	  
	  <form method="post" action="" name="custom_form">
      <table border="0" class="widefat fixed">
         <tbody>
         
            <tr valign="top">
              <th>Your First Name</th> <td><input type="text" name="fname" /></td>
            </tr>
            
            <tr valign="top">
              <th>Your Last Name</th> <td><input type="text" name="lname" /></td>
            </tr>
            
            <tr valign="top">
              <th>Your Question</th> <td><input type="text" name="question" /></td>
            </tr>
         
          </tbody>    
       </table>
            <br />
            <input class="button button-primary" type="submit" name="submit-personal" value="submit form" />
      </form> 
  </div>		  
<?php	  }

?>