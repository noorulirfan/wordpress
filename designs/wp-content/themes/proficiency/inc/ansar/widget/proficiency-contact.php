<?php
	// Register and load the widget
	function proficiency_contact_callout() {
	    register_widget( 'proficiency_contact_widget' );
	}
	add_action( 'widgets_init', 'proficiency_contact_callout' );

// Creating the widget
	class proficiency_contact_widget extends WP_Widget {
	 
	function __construct() {
		parent::__construct(
			'proficiency_contact_callout', // Base ID
			'proficiency - Contact Widget', // Widget Name
			array(
				'classname' => 'proficiency_contact_widget',
				'description' => 'Proficiency Contact Widget.',
			),
			array(
				'width' => 600,
			)
		);
		
	 }
	
	public function widget( $args, $instance ) {
	
	echo $args['before_widget']; ?>
						<div class="proficiency-widget col-sm-4 col-md-<?php echo apply_filters('widget_title', $instance['colum']); ?>">
						<?php if(!empty($instance['add_title'])) { ?>
									<h6><?php echo $instance['add_title']; ?></h6>
									<?php } ?>
 									<ul class="proficiency-widget-address <?php if( !empty($instance['custom_class']) ): echo htmlspecialchars_decode(apply_filters('widget_title', $instance['custom_class']));  endif; ?>">
									<li>
									<?php if(!empty($instance['fa_icon_marker'])) { ?>
									<span class="icon-addr">
									<i class="fa <?php echo $instance['fa_icon_marker']; ?>"></i>
									</span>
									<?php } ?>
									<?php if(!empty($instance['marker_label'])) { ?>
									<strong><?php echo $instance['marker_label']; ?></strong>
									<?php } ?>
									<?php if(!empty($instance['marker_title'])) { ?>
									<?php echo $instance['marker_title']; ?>
									<?php } ?></li>

									<li>
									<?php if(!empty($instance['fa_icon_envelope'])) { ?>
									<span class="icon-addr">
									<i class="fa <?php echo $instance['fa_icon_envelope']; ?>"></i>
									</span>
									<?php } ?>
									<?php if(!empty($instance['envelope_label'])) { ?>
									<strong><?php echo $instance['envelope_label']; ?></strong>
									<?php } ?>
									<?php if(!empty($instance['envelope_title'])) { ?>
									<?php echo $instance['envelope_title']; ?>
									<?php } ?></li>

									<li>
									
									<?php if(!empty($instance['fa_icon_phone'])) { ?>
									<span class="icon-addr">
									<i class="fa <?php echo $instance['fa_icon_phone']; ?>"></i>
									</span>
									<?php } ?>
									<?php if(!empty($instance['phone_label'])) { ?>
									<strong><?php echo $instance['phone_label']; ?></strong>
									<?php } ?>
									<?php if(!empty($instance['phone_title'])) { ?>
									<?php echo $instance['phone_title']; ?>
									<?php } ?></li>
									<li>
									<?php if(!empty($instance['fa_icon_globe'])) { ?>
									<span class="icon-addr">
									<i class="fa <?php echo $instance['fa_icon_globe']; ?>"></i>
									</span>
									<?php } ?>
									<?php if(!empty($instance['globe_label'])) { ?>
									<strong><?php echo $instance['globe_label']; ?></strong>
									<?php } ?> 
									<?php if(!empty($instance['globe_title'])) { ?>
									<?php echo $instance['globe_title']; ?>
									<?php } ?></li>
								</ul>
								</div>
								<div class="clearfix"></div>
	<?php
	echo $args['after_widget'];
	}
	         
	// Widget Backend
	public function form( $instance ) {
	if ( isset( $instance[ 'add_title' ])){
	$add_title = $instance[ 'add_title' ];
	}
	else {
	$add_title = __( 'Address', 'proficiency' );
	}
	if ( isset( $instance[ 'fa_icon_phone' ])){
	$fa_icon_phone = $instance[ 'fa_icon_phone' ];
	}
	else {
	$fa_icon_phone = __( 'fa fa-phone', 'proficiency' );
	}
	if ( isset( $instance[ 'phone_label' ])){
	$phone_label = $instance[ 'phone_label' ];
	}
	else {
	$phone_label = __( 'Phone:', 'proficiency' );
	}
	if ( isset( $instance[ 'phone_title' ])){
	$phone_title = $instance[ 'phone_title' ];
	}
	else {
	$phone_title = __( '+ (007) 548 58 5400', 'proficiency' );
	}
	if ( isset( $instance[ 'envelope_label' ])){
	$envelope_label = $instance[ 'envelope_label' ];
	}
	else {
	$envelope_label = __( 'Email:', 'proficiency' );
	}
	if ( isset( $instance[ 'fa_icon_envelope' ])){
	$fa_icon_envelope = $instance[ 'fa_icon_envelope' ];
	}
	else {
	$fa_icon_envelope = __( 'fa fa-envelope', 'proficiency' );
	}
	
	if ( isset( $instance[ 'envelope_title' ])){
	$envelope_title = $instance[ 'envelope_title' ];
	}
	else {
	$envelope_title = __( 'info@themeansar.com', 'proficiency' );
	}
	
	
	if ( isset( $instance[ 'marker_label' ])){
	$marker_label = $instance[ 'marker_label' ];
	}
	else {
	$marker_label = __( 'Address:', 'proficiency' );
	}
	if ( isset( $instance[ 'fa_icon_marker' ])){
	$fa_icon_marker = $instance[ 'fa_icon_marker' ];
	}
	else {
	$fa_icon_marker = __( 'fa fa-map-marker', 'proficiency' );
	}
	
	if ( isset( $instance[ 'marker_title' ])){
	$marker_title = $instance[ 'marker_title' ];
	}
	else {
	$marker_title = __( '1240 Park Avenue NYC, USA 256323', 'proficiency' );
	}
	
	
	if ( isset( $instance[ 'fa_icon_globe' ])){
	$fa_icon_globe = $instance[ 'fa_icon_globe' ];
	}
	else {
	$fa_icon_globe = __( 'fa fa-globe', 'proficiency' );
	}

	if ( isset( $instance[ 'globe_label' ])){
	$globe_label = $instance[ 'globe_label' ];
	}
	else {
	$globe_label = __( 'Website:', 'proficiency' );
	}
	
	if ( isset( $instance[ 'globe_title' ])){
	$globe_title = $instance[ 'globe_title' ];
	}
	else {
	$globe_title = __( 'www.themeansar.com', 'proficiency' );
	}

	// Widget admin form
	?>
	<table style="width: 100%;">
		<tr>
			<td colspan="2">
				<h4 for="<?php echo $this->get_field_id( 'add_title' ); ?>"><?php _e( 'Title:', 'proficiency' ); ?></h4>
				<input class="widefat" id="<?php echo $this->get_field_id( 'add_title' ); ?>" name="<?php echo $this->get_field_name( 'add_title' ); ?>" type="text" value="<?php if($add_title) echo esc_attr( $add_title );?>" />
			</td>
		</tr>
		<tr>
			<td>
            <label for="<?php echo $this->get_field_id('custom_class'); ?>"><?php _e('Custom Class', 'proficiency'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('custom_class'); ?>" id="<?php echo $this->get_field_id('custom_class'); ?>" value="<?php if( !empty($instance['custom_class']) ): echo $instance['custom_class']; endif; ?>" class="widefat">
        </td>
        	<td>
        		
                    <label for="<?php echo $this->get_field_id('colum'); ?>"><?php _e('colum', 'proficiency'); ?></label><br/>
               
                    <select name="<?php echo $this->get_field_name('colum'); ?>" id="<?php echo $this->get_field_id('colum'); ?>">
                        <option><?php if( !empty($instance['colum']) ): echo $instance['colum']; endif; ?></option>
                        <option>Select</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                        <option value="8">8</option>
                        <option value="10">10</option>
                        <option value="12">12</option>
                    </select>
        	</td>
		</tr>
		<tr>
			<td style="width: 33%;">
				<h4 for="<?php echo $this->get_field_id( 'fa_icon_marker' ); ?>"><?php _e( 'Fontawesome icon:', 'proficiency' ); ?></h4>
			</td>
			<td>
				<h4 for="<?php echo $this->get_field_id( 'marker_label' ); ?>"><?php _e( 'Marker Label:', 'proficiency' ); ?></h4>	
			</td>
			<td>
				<h4 for="<?php echo $this->get_field_id( 'marker_title' ); ?>"><?php _e( 'Marker Title:', 'proficiency' ); ?></h4>	
			</td>
		</tr>
		<tr>
			<td style="width: 33%;">
				<input class="widefat" id="<?php echo $this->get_field_id( 'fa_icon_marker' ); ?>" name="<?php echo $this->get_field_name( 'fa_icon_marker' ); ?>" type="text" value="<?php if($fa_icon_marker) echo esc_attr( $fa_icon_marker );?>" />
				<span><?php _e('Link to get fa-icon ','proficiency'); ?><a href="<?php echo esc_url('https://fortawesome.github.io/Font-Awesome/icons/') ;?>" target="_blank" ><?php _e('fa_icon_marker','proficiency'); ?></a></span>
			</td>
			<td>
				<input class="widefat" id="<?php echo $this->get_field_id( 'marker_label' ); ?>" name="<?php echo $this->get_field_name( 'marker_label' ); ?>" type="text" value="<?php if($marker_label) echo esc_attr( $marker_label ); ?>" />
				<span>&nbsp;</span>
			</td>
			<td>
				<input class="widefat" id="<?php echo $this->get_field_id( 'marker_title' ); ?>" name="<?php echo $this->get_field_name( 'marker_title' ); ?>" type="text" value="<?php if($marker_title) echo esc_attr( $marker_title ); ?>" />
				<span>&nbsp;</span>
			</td>
		</tr>
		<tr>
			<td style="width: 33%;">
				<h4 for="<?php echo $this->get_field_id( 'fa_icon_phone' ); ?>"><?php _e( 'Fontawesome icon:', 'proficiency' ); ?></h4>
			</td>
			<td>
				<h4 for="<?php echo $this->get_field_id( 'phone_label' ); ?>"><?php _e( 'Phone Label:', 'proficiency' ); ?></h4>
			</td>
			<td>
				<h4 for="<?php echo $this->get_field_id( 'phone_title' ); ?>"><?php _e( 'Phone Title:', 'proficiency' ); ?></h4>
			</td>
		</tr>
		<tr>
			<td> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'fa_icon_phone' ); ?>" name="<?php echo $this->get_field_name( 'fa_icon_phone' ); ?>" type="text" value="<?php if($fa_icon_phone) echo esc_attr( $fa_icon_phone ); ?>" />
				<span><?php _e('Link to get fa-icon ','proficiency'); ?><a href="<?php echo esc_url('https://fortawesome.github.io/Font-Awesome/icons/') ;?>" target="_blank" ><?php _e('fa_icon_phone','proficiency'); ?></a></span>
			</td>
			<td> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'phone_label' ); ?>" name="<?php echo $this->get_field_name( 'phone_label' ); ?>" type="text" value="<?php if($phone_label) echo esc_attr( $phone_label ); ?>" />
				<span>&nbsp;</span>
			</td>
			<td> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'phone_title' ); ?>" name="<?php echo $this->get_field_name( 'phone_title' ); ?>" type="text" value="<?php if($phone_title) echo esc_attr( $phone_title ); else _e( 'Phone title', 'proficiency' );?>" />
				<span>&nbsp;</span>
			</td>
		</tr>
		<tr>
			<td>
				<h4 for="<?php echo $this->get_field_id( 'fa_icon_envelope' ); ?>"><?php _e( 'Fontawesome icon:', 'proficiency' ); ?></h4>
			</td>
			<td>
				<h4 for="<?php echo $this->get_field_id( 'envelope_label' ); ?>"><?php _e( 'Mail Label:', 'proficiency' ); ?></h4>
			</td>
			<td>
				<h4 for="<?php echo $this->get_field_id( 'envelope_title' ); ?>"><?php _e( 'Mail Title:', 'proficiency' ); ?></h4>
			</td>
		</tr>
		<tr>
			<td>
				<input class="widefat" id="<?php echo $this->get_field_id( 'fa_icon_envelope' ); ?>" name="<?php echo $this->get_field_name( 'fa_icon_envelope' ); ?>" type="text" value="<?php if($fa_icon_envelope) echo esc_attr( $fa_icon_envelope ); ?>" />
				<span><?php _e('Link to get fa-icon ','proficiency'); ?><a href="<?php echo esc_url('https://fortawesome.github.io/Font-Awesome/icons/') ;?>" target="_blank" ><?php _e('fa_icon_envelope','proficiency'); ?></a></span>
			</td>
			<td>
				<input class="widefat" id="<?php echo $this->get_field_id( 'envelope_label' ); ?>" name="<?php echo $this->get_field_name( 'envelope_label' ); ?>" type="text" value="<?php if($envelope_label) echo esc_attr( $envelope_label );?>" />
				<span>&nbsp;</span>
			</td>
			<td>
				<input class="widefat" id="<?php echo $this->get_field_id( 'envelope_title' ); ?>" name="<?php echo $this->get_field_name( 'envelope_title' ); ?>" type="text" value="<?php if($envelope_title) echo esc_attr( $envelope_title ); ?>" />
				<span>&nbsp;</span>
			</td>
		</tr>
		<tr>
			<td>
				<h4 for="<?php echo $this->get_field_id( 'fa_icon_globe' ); ?>"><?php _e( 'Fontawesome icon:', 'proficiency' ); ?></h4>
			</td>
			<td>
				<h4 for="<?php echo $this->get_field_id( 'globe_label' ); ?>"><?php _e( 'Globe Label:', 'proficiency' ); ?></h4>
			</td>
			<td>
				<h4 for="<?php echo $this->get_field_id( 'globe_title' ); ?>"><?php _e( 'Globe Title:', 'proficiency' ); ?></h4>
			</td>
		</tr>
		<tr>
			<td>
				<input class="widefat" id="<?php echo $this->get_field_id( 'fa_icon_globe' ); ?>" name="<?php echo $this->get_field_name( 'fa_icon_globe' ); ?>" type="text" value="<?php if($fa_icon_globe) echo esc_attr( $fa_icon_globe ); ?>" />
				<span><?php _e('Link to get fa-icon ','proficiency'); ?><a href="<?php echo esc_url('https://fortawesome.github.io/Font-Awesome/icons/') ;?>" target="_blank" ><?php _e('fa_icon_globe','proficiency'); ?></a></span>
			</td>
			<td>
				<input class="widefat" id="<?php echo $this->get_field_id( 'globe_label' ); ?>" name="<?php echo $this->get_field_name( 'globe_label' ); ?>" type="text" value="<?php if($globe_label) echo esc_attr( $globe_label ); ?>" />
				<span>&nbsp;</span>
			</td>
			<td>
				<input class="widefat" id="<?php echo $this->get_field_id( 'globe_title' ); ?>" name="<?php echo $this->get_field_name( 'globe_title' ); ?>" type="text" value="<?php if($globe_title) echo esc_attr( $globe_title );?>" />
				<span>&nbsp;</span>
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	
	<?php
    }
	     
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
	
	$instance = array();
		 $instance['colum'] = strip_tags($new_instance['colum']);
        $instance['custom_class'] = stripslashes(wp_filter_post_kses($new_instance['custom_class']));
		$instance['add_title'] = ( ! empty( $new_instance['add_title'] ) ) ? strip_tags( $new_instance['add_title'] ) : '';
		$instance['fa_icon_phone'] = ( ! empty( $new_instance['fa_icon_phone'] ) ) ? strip_tags( $new_instance['fa_icon_phone'] ) : '';
		$instance['phone_label'] = ( ! empty( $new_instance['phone_label'] ) ) ? strip_tags( $new_instance['phone_label'] ) : '';
		$instance['phone_title'] = ( ! empty( $new_instance['phone_title'] ) ) ? strip_tags( $new_instance['phone_title'] ) : '';
		$instance['fa_icon_envelope'] = ( ! empty( $new_instance['fa_icon_envelope'] ) ) ? strip_tags( $new_instance['fa_icon_envelope'] ) : '';
		$instance['envelope_label'] = ( ! empty( $new_instance['envelope_label'] ) ) ? strip_tags( $new_instance['envelope_label'] ) : '';
		$instance['envelope_title'] = ( ! empty( $new_instance['envelope_title'] ) ) ? strip_tags( $new_instance['envelope_title'] ) : '';
		$instance['fa_icon_marker'] = ( ! empty( $new_instance['fa_icon_marker'] ) ) ? strip_tags( $new_instance['fa_icon_marker'] ) : '';
		$instance['marker_label'] = ( ! empty( $new_instance['marker_label'] ) ) ? strip_tags( $new_instance['marker_label'] ) : '';
		$instance['marker_title'] = ( ! empty( $new_instance['marker_title'] ) ) ? strip_tags( $new_instance['marker_title'] ) : '';
		$instance['fa_icon_globe'] = ( ! empty( $new_instance['fa_icon_globe'] ) ) ? strip_tags( $new_instance['fa_icon_globe'] ) : '';
		$instance['globe_label'] = ( ! empty( $new_instance['globe_label'] ) ) ? strip_tags( $new_instance['globe_label'] ) : '';
		$instance['globe_title'] = ( ! empty( $new_instance['globe_title'] ) ) ? strip_tags( $new_instance['globe_title'] ) : '';
		
		
		
		return $instance;
	}
	}