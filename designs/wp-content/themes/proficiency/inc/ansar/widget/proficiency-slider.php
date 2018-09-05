<?php
add_action('admin_enqueue_scripts', 'proficiency_slider_widget_scripts');

function proficiency_slider_widget_scripts() {    

	wp_enqueue_media();

    wp_enqueue_script('proficiency_slider_widget_script', get_template_directory_uri() . '/js/widget-sliders.js', false, '1.0', true);

}

class proficiency_slider_widget extends WP_Widget {	

	public function __construct() {
		parent::__construct(
			'proficiency_slider-widget',
			__( 'Proficiency - Slider Widget', 'proficiency' )
		);
	}

    function widget($args, $instance) {

        extract($args);

        echo $before_widget;
		$instance['slider_page'] = (isset($instance['slider_page'])?$instance['slider_page']:'');
		$page= get_post($instance['slider_page']);

		$proficiency_btnone_target = '_self';
        if( !empty($instance['open_btnone_new_window']) ):
            $proficiency_btnone_target = '_blank';
        endif;

        $proficiency_btntwo_target = '_self';
        if( !empty($instance['open_btntwo_new_window']) ):
            $proficiency_btntwo_target = '_blank';
        endif;

        ?>
    <div class="item">
    	<figure>
        	<?php echo '<img src="'. wp_get_attachment_url( get_post_thumbnail_id($instance['slider_page']) ) .'" />'; ?>
        </figure>
        
      <div class="proficiency-slider-inner">
        <div class="container inner-table">
          <div class="inner-table-cell">
            <div class="slide-caption">
              <?php echo '<h1>'. $page->post_title .'</h1>'; ?>
              <div class="description">
                <?php if($page->post_excerpt) echo '<p>'.$page->post_excerpt. '</p>'; // check for the page content ?>
              </div>
              <?php if ( !empty($instance['btnonelink']) ): ?>
                <a class="btn btn-tislider"  href="<?php echo apply_filters('widget_title', $instance['btnonelink']); ?>" target="<?php echo $proficiency_btnone_target; ?>"><?php echo apply_filters('widget_title', $instance['btnone']); ?></a>
                <?php endif; ?>
              <?php if ( !empty($instance['btntwolink']) ): ?>
                <a class="btn btn-tislider-two"  href="<?php echo apply_filters('widget_title', $instance['btntwolink']); ?>" target="<?php echo $proficiency_btntwo_target; ?>"><?php echo apply_filters('widget_title', $instance['btntwo']); ?></a>
                <?php endif; ?>     
            </div>
          </div>
        </div>
      </div>
    </div>
        <?php

        echo $after_widget;

    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
		$instance['slider_page'] = ( ! empty( $new_instance['slider_page'] ) ) ? $new_instance['slider_page'] : '';
		$instance['hide_image'] = isset($new_instance['hide_image']) ? $new_instance['hide_image'] : '';
		
        $instance['btnone'] = stripslashes(wp_filter_post_kses($new_instance['btnone']));
        $instance['btnonelink'] = stripslashes(wp_filter_post_kses($new_instance['btnonelink']));
        $instance['open_btnone_new_window'] = strip_tags($new_instance['open_btnone_new_window']);
        $instance['btntwo'] = stripslashes(wp_filter_post_kses($new_instance['btntwo']));
        $instance['btntwolink'] = stripslashes(wp_filter_post_kses($new_instance['btntwolink']));
        $instance['open_btntwo_new_window'] = strip_tags($new_instance['open_btntwo_new_window']);

        $proficiency_btnone_target = '_self';
        if( !empty($instance['open_btnone_new_window']) ):
            $proficiency_btnone_target = '_blank';
        endif;

        $proficiency_btntwo_target = '_self';
        if( !empty($instance['open_btntwo_new_window']) ):
            $proficiency_btntwo_target = '_blank';
        endif;

        return $instance;

    }

    function form($instance) {
	?>
		<p>
        	<label for="<?php echo $this->get_field_id( 'slider_page' ); ?>"><?php _e( 'Select Pages:','proficiency' ); ?></label> 
               
        	<select class="widefat" id="<?php echo $this->get_field_id( 'slider_page' ); ?>" name="<?php echo $this->get_field_name( 'slider_page' ); ?>">
				<option value>--Select--</option>
				<?php $slider_page = $instance['slider_page'];
					$pages = get_pages($slider_page); 				
					foreach ( $pages as $page ) {
						$option = '<option value="' . $page->ID . '" ';
						$option .= ( $page->ID == $slider_page ) ? 'selected="selected"' : '';
						$option .= '>';
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
					} ?>
			</select>
		</p>
		<table>
		<tr>
        		<td style="width: 50%;">
        			<label for="<?php echo $this->get_field_id('btnone'); ?>"><?php _e('Button One Label', 'proficiency'); ?></label>
        		</td>
        		<td>
        			<label for="<?php echo $this->get_field_id('btnonelink'); ?>"><?php _e('Button One Link', 'proficiency'); ?></label>
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<input type="text" name="<?php echo $this->get_field_name('btnone'); ?>" id="<?php echo $this->get_field_id('btnone'); ?>" value="<?php if( !empty($instance['btnone']) ): echo htmlspecialchars_decode($instance['btnone']); endif; ?>" class="widefat"/>
        		</td>
        		<td>
        			<input type="text" name="<?php echo $this->get_field_name('btnonelink'); ?>" id="<?php echo $this->get_field_id('btnonelink'); ?>" value="<?php if( !empty($instance['btnonelink']) ): echo $instance['btnonelink']; endif; ?>" class="widefat"/>
        		</td>
        	</tr>
        	<tr>
        		<td colspan="2">
        			<input type="checkbox" name="<?php echo $this->get_field_name('open_btnone_new_window'); ?>" id="<?php echo $this->get_field_id('open_btnone_new_window'); ?>" <?php if( !empty($instance['open_btnone_new_window']) ): checked( (bool) $instance['open_btnone_new_window'], true ); endif; ?> ><?php _e( 'Open Button One Link in new window?','proficiency' ); ?>
        		</td>
        	</tr>

        	<tr>
        		<td>
        			<span>&nbsp;</span>
        		</td>
        	</tr>

        	<tr>
        		<td style="width: 50%;">
        			<label for="<?php echo $this->get_field_id('btntwo'); ?>"><?php _e('Button Two Label', 'proficiency'); ?></label>
        		</td>
        		<td>
        			<label for="<?php echo $this->get_field_id('btntwolink'); ?>"><?php _e('Button Two Link', 'proficiency'); ?></label>
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<input type="text" name="<?php echo $this->get_field_name('btntwo'); ?>" id="<?php echo $this->get_field_id('btntwo'); ?>" value="<?php if( !empty($instance['btntwo']) ): echo htmlspecialchars_decode($instance['btntwo']); endif; ?>" class="widefat"/>
        		</td>
        		<td>
        			<input type="text" name="<?php echo $this->get_field_name('btntwolink'); ?>" id="<?php echo $this->get_field_id('btntwolink'); ?>" value="<?php if( !empty($instance['btntwolink']) ): echo $instance['btntwolink']; endif; ?>" class="widefat"/>
        		</td>
        	</tr>
        	<tr>
        		<td colspan="2">
        			<input type="checkbox" name="<?php echo $this->get_field_name('open_btntwo_new_window'); ?>" id="<?php echo $this->get_field_id('open_btntwo_new_window'); ?>" <?php if( !empty($instance['open_btntwo_new_window']) ): checked( (bool) $instance['open_btntwo_new_window'], true ); endif; ?> ><?php _e( 'Open Button Two Link in new window?','proficiency' ); ?>
        		</td>
        	</tr>
        </table>

    <?php

    }

}