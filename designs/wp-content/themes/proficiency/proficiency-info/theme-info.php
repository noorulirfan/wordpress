<?php
/**
 * Welcome Screen Class
 */
class proficiency_screen {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'proficiency_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'proficiency_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'proficiency_style_and_scripts' ) );

		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'proficiency_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'proficiency_info_screen', array( $this, 'proficiency_getting_started' ), 	    10 );
		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_proficiency_dismiss_required_action', array( $this, 'proficiency_dismiss_required_action_callback') );
		add_action( 'wp_ajax_nopriv_proficiency_dismiss_required_action', array($this, 'proficiency_dismiss_required_action_callback') );

	}

	public function proficiency_register_menu() {
		add_theme_page( 'Proficiency Theme', 'Proficiency Theme', 'activate_plugins', 'proficiency-info', array( $this, 'proficiency_welcome_screen' ) );
	}

	public function proficiency_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'proficiency_admin_notice' ), 99 );
			add_action( 'admin_notices', array( $this, 'proficiency_admin_video_notice' ), 99 );
			add_action( 'admin_notices', array( $this, 'proficiency_admin_import_notice' ), 99 );
			
		}
	}

	/**
	 * Load welcome screen css and javascript
	 * @sfunctionse  1.8.2.4
	 */
	public function proficiency_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_proficiency-info' == $hook_suffix ) {
			
			
			wp_enqueue_style( 'proficiency-info-css', get_template_directory_uri() . '/proficiency-info/css/bootstrap.css' );
			
			wp_enqueue_style( 'proficiency-info-screen-css', get_template_directory_uri() . '/proficiency-info/css/welcome.css' );

			global $proficiency_required_actions;

			$nr_actions_required = 0;

			/* get number of required actions */
			if( get_option('proficiency_show_required_actions') ):
				$proficiency_show_required_actions = get_option('proficiency_show_required_actions');
			else:
				$proficiency_show_required_actions = array();
			endif;

			if( !empty($proficiency_required_actions) ):
				foreach( $proficiency_required_actions as $proficiency_required_action_value ):
					if(( !isset( $proficiency_required_action_value['check'] ) || ( isset( $proficiency_required_action_value['check'] ) && ( $proficiency_required_action_value['check'] == false ) ) ) && ((isset($proficiency_show_required_actions[$proficiency_required_action_value['id']]) && ($proficiency_show_required_actions[$proficiency_required_action_value['id']] == true)) || !isset($proficiency_show_required_actions[$proficiency_required_action_value['id']]) )) :
						$nr_actions_required++;
					endif;
				endforeach;
			endif;

			wp_localize_script( 'proficiency-info-screen-js', 'proficiencyLiteWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','proficiency' )
			) );
		}
	}

	/**
	 * Load scripts for customizer page
	 * @sfunctionse  1.8.2.4
	 */
	public function proficiency_scripts_for_customizer() {

		wp_enqueue_style( 'proficiency-info-screen-customizer-css', get_template_directory_uri() . '/proficiency-info/css/welcome_customizer.css' );
		global $proficiency_required_actions;

		$nr_actions_required = 0;

		/* get number of required actions */
		if( get_option('proficiency_show_required_actions') ):
			$proficiency_show_required_actions = get_option('proficiency_show_required_actions');
		else:
			$proficiency_show_required_actions = array();
		endif;

		if( !empty($proficiency_required_actions) ):
			foreach( $proficiency_required_actions as $proficiency_required_action_value ):
				if(( !isset( $proficiency_required_action_value['check'] ) || ( isset( $proficiency_required_action_value['check'] ) && ( $proficiency_required_action_value['check'] == false ) ) ) && ((isset($proficiency_show_required_actions[$proficiency_required_action_value['id']]) && ($proficiency_show_required_actions[$proficiency_required_action_value['id']] == true)) || !isset($proficiency_show_required_actions[$proficiency_required_action_value['id']]) )) :
					$nr_actions_required++;
				endif;
			endforeach;
		endif;

		wp_localize_script( 'proficiency-info-screen-customizer-js', 'proficiencyLiteWelcomeScreenObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=proficiency-info#actions_required' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
			'themeinfo' => __('View Theme Info','proficiency'),
		) );
	}

	/**
	 * Dismiss required actions
	 * @sfunctionse 1.8.2.4
	 */
	public function proficiency_dismiss_required_action_callback() {

		global $proficiency_required_actions;

		$proficiency_dismiss_id = (isset($_GET['dismiss_id'])) ? $_GET['dismiss_id'] : 0;

		echo $proficiency_dismiss_id; /* this is needed and it's the id of the dismissable required action */

		if( !empty($proficiency_dismiss_id) ):

			/* if the option exists, update the record for the specified id */
			if( get_option('proficiency_show_required_actions') ):

				$proficiency_show_required_actions = get_option('proficiency_show_required_actions');

				$proficiency_show_required_actions[$proficiency_dismiss_id] = false;

				update_option( 'proficiency_show_required_actions',$proficiency_show_required_actions );

			/* create the new option,with false for the specified id */
			else:

				$proficiency_show_required_actions_new = array();

				if( !empty($proficiency_required_actions) ):

					foreach( $proficiency_required_actions as $proficiency_required_action ):

						if( $proficiency_required_action['id'] == $proficiency_dismiss_id ):
							$proficiency_show_required_actions_new[$proficiency_required_action['id']] = false;
						else:
							$proficiency_show_required_actions_new[$proficiency_required_action['id']] = true;
						endif;

					endforeach;

				update_option( 'proficiency_show_required_actions', $proficiency_show_required_actions_new );

				endif;

			endif;

		endif;

		die(); // this is required to return a proper result
	}


	/**
	 * Welcome screen content
	 * @sfunctionse 1.8.2.4
	 */
	public function proficiency_welcome_screen() {

		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
		<ul class="proficiency-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'How To Create Homepage','proficiency'); ?></a></li>
			
		</ul>
		</div>
		</div>
		</div>

		<div class="proficiency-tab-content">

			<?php do_action( 'proficiency_info_screen' ); ?>

		</div>
		<?php
	}

	/**
	 * Getting started
	 *
	 */
	public function proficiency_getting_started() {
		require_once( get_template_directory() . '/proficiency-info/sections/homepage.php' );
	}

}

$GLOBALS['proficiency_screen'] = new proficiency_screen();