<?php 
/*
	========================================
	INCLUDE FUNTIONS FROM THE /incs/
	========================================
 * @package awesometheme
 * @since 1.0
 * @version 1.0
*/

/*=============================================
   includes
 * ============================================
 */
// Import the helper functions
require_once get_template_directory().'/incs/helper.php';

// Add custom menu for the application
require_once get_template_directory().'/incs/menu.php';

// Defined CPT for app
require_once get_template_directory().'/incs/admin/cpts/tb-resume.php';
require_once get_template_directory().'/incs/admin/cpts/tb-order.php';
require_once get_template_directory().'/incs/admin/cpts/tb-designer.php';
require_once get_template_directory().'/incs/admin/cpts/tb-comment.php';

require_once get_template_directory().'/incs/admin/taxonomy.php';
require_once get_template_directory().'/incs/admin/shortcodes.php';
require_once get_template_directory().'/incs/enqueue.php';
require_once get_template_directory().'/incs/supports.php';
require_once get_template_directory().'/incs/widgets.php';
require_once get_template_directory().'/incs/ajax.php';