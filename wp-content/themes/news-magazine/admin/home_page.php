<?php

class news_magazine_home_page_class{
	
	public $homepage;
	public $shorthomepage;
	public $options_homepage;
	
	function __construct(){
	  global $news_magazine_special_id_for_db;
		$this->homepage = "Homepage";
		$this->shorthomepage = $news_magazine_special_id_for_db;
		
		
		$value_of_std[1]=get_theme_mod($this->shorthomepage."_hide_about_us",'');
		$value_of_std[2]=get_theme_mod($this->shorthomepage."_hide_top_posts",'on');
		$value_of_std[3]=get_theme_mod($this->shorthomepage."_hide_slider",'');
		$value_of_std[4]=get_theme_mod($this->shorthomepage."_home_abaut_us_post",'on');
		$value_of_std[5]=get_theme_mod($this->shorthomepage."_top_post_categories",'');
		$value_of_std[6]=get_theme_mod($this->shorthomepage."_content_post_categories",'');
		$value_of_std[7]=get_theme_mod($this->shorthomepage."_hide_cat_tab_post",'on');
		$value_of_std[8]=get_theme_mod($this->shorthomepage."_tab_post_categories",'');
		$value_of_std[9]=get_theme_mod($this->shorthomepage."_content_post_cat_name",'Latest News');
		$value_of_std[10]=get_theme_mod($this->shorthomepage."_top_post_count",'2');
		$value_of_std[11]=get_theme_mod($this->shorthomepage."_tab_post_count",'5');
		$value_of_std[12]=get_theme_mod($this->shorthomepage."_tab_post_visible_count",'5');
		$value_of_std[13]=get_theme_mod($this->shorthomepage."_hide_content_post",'on');
		
		$this->options_homepage = array(			
			
			"hide_about_us" => array(
			
				"name" => "Featured Post",
				
				"description" => "Using this option, you can hide the Featured Post",
				
				"var_name" => "hide_about_us",

				"id" => $this->shorthomepage."_hide_about_us",

				"std" => $value_of_std[1]
			
			),

			"hide_top_posts" => array(
			
				"name" => "Top Posts",
				
				"description" => "Check the box to select the categories from which top posts will be displayed.",
				
				"var_name" => "hide_top_posts",

				"id" => $this->shorthomepage."_hide_top_posts",

				"std" => $value_of_std[2]
			
			),

			"hide_slider" => array(
			
				"name" => "Hide Slider",
				
				"description" => "Using this option, you can hide the homepage slider.",
				
				"var_name" => "hide_slider",

				"id" => $this->shorthomepage."_hide_slider",

				"std" => $value_of_std[3]
			
			),
			"home_abaut_us_post" => array(
			
				"name" => "Featured Post",
				
				"all_values" => $this->get_all_posts_in_select(),
				
				"description" => "Select Featured Post",
				
				"var_name" => "home_abaut_us_post",

				"id" => $this->shorthomepage."_home_abaut_us_post",

				"std" => $value_of_std[4]
			
			),
			"top_post_categories" => array(
			
				"name" => "Hide Top Posts",
				
				"description" => "Select the categories from which you want the homepage top posts to be selected (the posts are selected automatically).",
				
				"var_name" => "top_post_categories",

				"id" => $this->shorthomepage."_top_post_categories",

				"std" => $value_of_std[5]
			
			),
			"content_post_categories" => array(
			
				"name" => "Select Categories for Content Posts",
				
				"description" => "Select the categories from which you want the homepage content posts to be selected (the
									posts are selected automatically).",
				
				"var_name" => "content_post_categories",

				"id" => $this->shorthomepage."_content_post_categories",

				"std" => $value_of_std[6]
			
			),
			"hide_cat_tab_post" => array(
			
				"name" => "Vertical Tab",
				
				"description" => "Check the box to select the categories from which vertical tab posts will be displayed.",
				
				"var_name" => "hide_cat_tab_post",

				"id" => $this->shorthomepage."_hide_cat_tab_post",

				"std" => $value_of_std[7]
			
			),
			"tab_post_categories" => array(
			
				"name" => "Select Categories for Vertical Tab Posts",
				
				"description" => "Select the categories from which you want the homepage vertical tab posts to be selected (the
									posts are selected automatically).",
				
				"var_name" => "tab_post_categories",

				"id" => $this->shorthomepage."_tab_post_categories",

				"std" => $value_of_std[8]
			
			),
			"content_post_cat_name" => array(
			
				"name" => "",
				
				"description" => "Name of content posts",
				
				"var_name" => "content_post_cat_name",

				"id" => $this->shorthomepage."_content_post_cat_name",

				"std" => $value_of_std[9]
			
			),
			"top_post_count" => array(
			
				"name" => "",
				
				"description" => "Number of Top Posts",
				
				"var_name" => "top_post_count",

				"id" => $this->shorthomepage."_top_post_count",

				"std" => $value_of_std[10]
			
			),
			"tab_post_count" => array(
			
				"name" => "",
				
				"description" => "Number of Vertical Tab Posts",
				
				"var_name" => "tab_post_count",

				"id" => $this->shorthomepage."_tab_post_count",

				"std" => $value_of_std[11]
			
			),
			"tab_post_visible_count" => array(
			
				"name" => "",
				
				"description" => "Number of Vertical Tab Visible Posts",
				
				"var_name" => "tab_post_visible_count",

				"id" => $this->shorthomepage."_tab_post_visible_count",

				"std" => $value_of_std[12]
			
			),
			"hide_content_post" => array(
			
				"name" => "Content Posts",
				
				"description" => "Check the box to select the categories from which content posts will be displayed.",
				
				"var_name" => "hide_content_post",

				"id" => $this->shorthomepage."_hide_content_post",

				"std" => $value_of_std[13]
			
			)
			
		);
		
	}


	/// save changes or reset options
	public function web_dorado_theme_update_and_get_options_home(){
		
		if (isset($_GET['page']) &&  $_GET['page'] == "news_magazine_theme" && isset($_GET['controller']) && $_GET['controller'] == "home_page") {

			if (isset($_REQUEST['action']) && $_REQUEST['action']=='save' ) {

				foreach ($this->options_homepage as $value) {
					if(isset($_REQUEST[$value['var_name']]))
						set_theme_mod($value['id'], $_REQUEST[$value['var_name']]);
				}
				foreach ($this->options_homepage as $value) {
					if (isset($_REQUEST[$value['var_name']])) {
						set_theme_mod($value['id'], $_REQUEST[$value['var_name']]);
					} else {
						remove_theme_mod($value['id']);
					}
				}
				header("Location: themes.php?page=news_magazine_theme&controller=home_page&saved=true");
				die;
			} 
			else {
				
				if (isset($_REQUEST['action']) && $_REQUEST['action']=='reset') {
					
					foreach ($this->options_homepage as $value) {
						remove_theme_mod($value['id']);
					}
					header("Location: themes.php?page=news_magazine_theme&controller=home_page&reset=true");
					die;
				}
								
			}
		}

	
	}
	
	public function update_parametr($param_name,$value){
		set_theme_mod($this->options_homepage[$param_name]['id'],$value);
	}
	
	public function web_dorado_home_page_admin_scripts(){
		
		wp_enqueue_style('home_page_main_style',get_template_directory_uri().'/admin/css/home_page.css');	
		

	}
	private function get_all_posts_in_select(){
		$args= array(
				'posts_per_page'   => 10000,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				 );
		$posts_array_custom=array();
		
	
		$posts_array = get_posts( $args );

			foreach($posts_array as $post){
				$posts_array_custom[$post->ID]=$post->post_title;
			}
		return $posts_array_custom;
	}
	
	
	
	
	
	public function dorado_theme_admin_home(){

		if(isset($_REQUEST['controller']) && $_REQUEST['controller']=='home_page'){
			
			if (isset($_REQUEST['saved']) && $_REQUEST['saved'] ) 
			
				echo '<div id="message" class="updated"><p><strong>Home settings are saved.</strong></p></div>';
				
			if (isset($_REQUEST['reset']) && $_REQUEST['reset'] ) 
			
				echo '<div id="message" class="updated"><p><strong>Home settings are reset.</strong></p></div>';
		}
		
		foreach ($this->options_homepage as $value) {
	
			if(isset($value['id'])){
				if (get_theme_mod( $value['id'] ) === FALSE) {
					 $$value['var_name'] = $value['std']; 
				} 
				else { 		
					$$value['var_name'] = get_theme_mod( $value['id'] );
				}	
			}
		}
		global $news_magazine_admin_helepr_functions, $news_magazine_web_dor;
		
		?>
	
	
		<div id="main_home_page">

			<script>
			function open_or_hide_param_home(cur_element){			
				if(!cur_element.checked){
					jQuery(cur_element).parent().parent().parent().find('.open_hide').show();
				}
				else
				{
					jQuery(cur_element).parent().parent().parent().find('.open_hide').hide();
				}
				
			} 
			jQuery(document).ready(function() {
				jQuery('.with_input_home').each(function(){open_or_hide_param_home(this)})
				
				});					
			</script>
			<table align="center" width="90%" style="margin-top: 0px; margin-bottom: 20px;border-bottom: rgb(111, 111, 111) solid 2px;">
			    <tr>   
                      <td style="font-size:14px; font-weight:bold">
					     <a href="<?php echo $news_magazine_web_dor.'/wordpress-themes-guide-step-1.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">User Manual</a><br />This section allows you to customize the homepage. 
                         <a href="<?php echo $news_magazine_web_dor.'/wordpress-theme-options/3-4.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">More...</a>
					  </td>   
                      <td  align="right" style="font-size:16px;">
                           <a href="<?php echo $news_magazine_web_dor.'/wordpress-themes/news-magazine.html'; ?>" target="_blank" style="color:red; text-decoration:none;">
                              <img src="<?php echo get_template_directory_uri() ?>/images/header.png" border="0" alt="" width="215">
                           </a>
                        </td>
                </tr>
				<tr>
					<td colspan="2"><h3  style="margin: 0px;font-family:Segoe UI;padding-bottom: 15px;color: rgb(111, 111, 111); font-size:18pt;">Home</h3>
					</td>
				</tr>
			</table>
			<form method="post"  action="themes.php?page=news_magazine_theme&controller=home_page">
				<table align="center" width="90%" style=" padding-bottom:0px; padding-top:0px;">
					<tr>
						<td>
							<?php 							
															
								$news_magazine_admin_helepr_functions->only_checkbox($this->options_homepage['hide_slider']);  /// 
								
								$news_magazine_admin_helepr_functions->checkbox_category_checkboxses($this->options_homepage['hide_top_posts'],$this->options_homepage['top_post_categories'],$this->options_homepage['top_post_count']);  /// Home Top posts	
					
								$news_magazine_admin_helepr_functions->checkbox_category_checkboxses($this->options_homepage['hide_cat_tab_post'],$this->options_homepage['tab_post_categories'],array($this->options_homepage['tab_post_count'],$this->options_homepage['tab_post_visible_count'])); /// Vertical Tab Posts
								
								
								$news_magazine_admin_helepr_functions->checkbox_category_checkboxses($this->options_homepage['hide_content_post'],$this->options_homepage['content_post_categories'],$this->options_homepage['content_post_cat_name']); /// Home content posts

								
							?>						
						</td>
					</tr>
				</table>
                
                <br/>
				<p class="submit" style="float: left; margin-left: 63px; margin-right: 8px;">
					<input class="button" name="save" type="submit" value="Save changes"/>
					<input type="hidden" name="action" value="save"/>
				</p>
			</form>
			<form method="post" action="themes.php?page=news_magazine_theme&controller=home_page">
				<p class="submit">
					<input class="button" name="reset" type="submit" value="Reset"/>
					<input type="hidden" name="action" value="reset"/>
				</p>
			</form>
		</div>
	<?php

	
	
	}	

}
 