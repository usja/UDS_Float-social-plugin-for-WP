<?php
/*
Plugin Name: Float Social
Plugin URI: http://uds.kiev.ua/
Description: This plugin shows social icons
Author: Uskov Andrei Uskov <uskov@uds.kiev.ua>
Author URI: http://uds.kiev.ua/
*/ 

DEFINE('PLUGIN_URL', trailingslashit(WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__))));
function uds_floatsocial_options_page() {
		$uds_fs_fb = get_option('uds_fs_fb');
		$uds_fs_vk = get_option('uds_fs_vk');
		$uds_fs_inst = get_option('uds_fs_inst');
		$uds_fs_pi = get_option('uds_fs_pi');
?>
<div class="wrap">
	<h2>Float Social configs</h2>
	<?php
	if($_POST['uds_fs_hash']) {
		update_option('uds_fs_fb', $_POST['uds_fs_fb']);
		update_option('uds_fs_vk', $_POST['uds_fs_vk']);
		update_option('uds_fs_inst', $_POST['uds_fs_inst']);
		update_option('uds_fs_pi', $_POST['uds_fs_pi']);
		
		echo '<div class="updated"><p>Changes are saved</p></div>';
	}
	?>

	<form method="post">
	<fieldset class="options">
		<legend>Input your urls:</legend>	
			<input type="hidden" name="uds_fs_hash" value=<?=uniqid();?> />
			<table>
			<tr><td><b>Facebook:</b> </td><td><input type="text" name="uds_fs_fb" value="<?=$uds_fs_fb;?>" /></td></tr>
			<tr><td><b>VK:</b> </td><td><input type="text" name="uds_fs_vk"  value="<?=$uds_fs_vk;?>" /> </td></tr>
			<tr><td><b>Instagram:</b> </td><td><input type="text" name="uds_fs_inst" value="<?=$uds_fs_inst;?>" /></td></tr>
			<tr><td><b>Pinterest:</b> </td><td><input type="text"  name="uds_fs_pi" value="<?=$uds_fs_pi;?>" /> </td></tr>
			<tr><td></td><td><input type="submit" value="UPDATE" /></td></tr>
			</table>
	</fieldset>
	</form>
</div>
<?php
}
function uds_fs_add_admin_menu() {
		add_options_page('Float Social', 'Float Social', 8, __FILE__, 'uds_floatsocial_options_page');
}
function  uds_fs_structure(){
		$uds_fs_fb = get_option('uds_fs_fb');
		$uds_fs_vk = get_option('uds_fs_vk');
		$uds_fs_inst = get_option('uds_fs_inst');
		$uds_fs_pi = get_option('uds_fs_pi');
  ?>
	<div id="uds_float_social">
		<div class="top-right">
		<? if (isset($uds_fs_fb)):?>
				<a class="uds_fs_fbbg" href="<?=$uds_fs_fb;?>" rel="nofollow">
					<i class="uds_ico-facebook2"></i>
				</a>
		<? endif;?>
		
		<? if (isset($uds_fs_vk)):?>
				<a class="uds_fs_vkbg" href="<?=$uds_fs_vk;?>" rel="nofollow">
					<i class="uds_ico-vk"></i>
				</a>
		<? endif;?>
		
		<? if (isset($uds_fs_inst)):?>
				<a class="uds_fs_instbg" href="<?=$uds_fs_inst;?>" rel="nofollow">
					<i class="uds_ico-instagram"></i>
				</a>
		<? endif;?>
		
		<? if (isset($uds_fs_pi)):?>
				<a class="uds_fs_pibg" href="<?=$uds_fs_pi;?>" rel="nofollow">
					<i class="uds_ico-social-pinterest"></i>
				</a>
		<? endif;?>
		<? if (isset($uds_fs_linkedin)):?>
				<a class="uds_fs_linkedinbg" href="<?=$uds_fs_linkedin;?>" rel="nofollow">
					<i class="uds_ico-social-pinterest"></i>
				</a>
		<? endif;?>
		</div>
	</div>
  <?php
}
function uds_fs_fload_styles()
{
 wp_register_style('uds_fs_css', PLUGIN_URL . 'inc/css/style.css' );
 wp_enqueue_style('uds_fs_css');
}
add_action('admin_menu', 'uds_fs_add_admin_menu');
if ( !is_admin() ) {
 add_action('wp_print_styles', 'uds_fs_fload_styles');
 add_action('wp_footer','uds_fs_structure');
}
?>