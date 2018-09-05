<?php 
add_action('admin_enqueue_scripts', 'proficiency_service_widget_scripts');

function proficiency_service_widget_scripts() {    

    wp_enqueue_media();

}

class proficiency_service_widget extends WP_Widget{

    public function __construct() {
        parent::__construct(
            'proficiency_service_widget',
            __( 'Proficiency - Service Widget', 'proficiency' )
        );
    }


    function widget($args, $instance) {

        extract($args);

        echo $before_widget;
		$instance['service_page'] = (isset($instance['service_page'])?$instance['service_page']:'');
		$page= get_post($instance['service_page']); 
		$proficiency_btn_target = '_self';
        if( !empty($instance['open_new_window']) ):
            $proficiency_btn_target = '_blank';
        endif;
		
		if(($instance['service_page']) !=null) {
		?>

       <div class="col-sm-4 col-md-<?php echo apply_filters('widget_title', $instance['colum']); ?>">
       <div class="proficiency-service">
            <div class="proficiency-service-inner">
                
                <?php if( !empty($instance['sericon']) ): ?>
                <div class="ser-icon">
                 <i class="fa <?php echo htmlspecialchars_decode(apply_filters('widget_title', $instance['sericon'])); ?>"></i>
                </div> 
                <?php endif; 
				echo '<h3 class="widgettitle">'. $page->post_title .'</h3>'; ?>
                    <?php if($page->post_content) echo '<p>'.$page->post_content. '</p>'; // check for the page content ?>

                <?php if ( !empty($instance['btnlink']) ): ?>
                <a class="btn btn-theme"  href="<?php echo apply_filters('widget_title', $instance['btnlink']); ?>" target="<?php echo $proficiency_btn_target; ?>"><?php echo apply_filters('widget_title', $instance['btnmore']); ?></a>
                <?php endif; ?> 
                    
            </div>
          </div>
        </div>

        <?php
		}

        echo $after_widget;

    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['colum'] = strip_tags($new_instance['colum']);
        $instance['sericon'] = stripslashes(wp_filter_post_kses($new_instance['sericon']));
        $instance['service_page'] = ( ! empty( $new_instance['service_page'] ) ) ? $new_instance['service_page'] : '';
        $instance['btnmore'] = stripslashes(wp_filter_post_kses($new_instance['btnmore']));
        $instance['btnlink'] = stripslashes(wp_filter_post_kses($new_instance['btnlink']));
        $instance['open_new_window'] = strip_tags($new_instance['open_new_window']);
        

        return $instance;

    }

    function form($instance) {

        ?>
        <p>
                    <label for="<?php echo $this->get_field_id('colum'); ?>"><?php _e('colum', 'proficiency'); ?></label>
               </p>
               <p>
                    <select name="<?php echo $this->get_field_name('colum'); ?>" id="<?php echo $this->get_field_id('colum'); ?>">
                        <option><?php if( !empty($instance['colum']) ): echo $instance['colum']; endif; ?></option>
                        <option>Select</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                    </select>
            </p>


        <table>
        	<tr>
        		<td>
        			<label for="<?php echo $this->get_field_id('sericon'); ?>"><?php _e('Service Icon', 'proficiency'); ?></label>
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<input type="text" class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name('sericon'); ?>" id="<?php echo $this->get_field_id('sericon'); ?>" placeholder="fa fa-icon" value="<?php if( !empty($instance['sericon']) ): echo htmlspecialchars_decode($instance['sericon']); endif; ?>"/>
        		</td>
        	</tr>
			<tr>
        	<p>
			<label for="<?php echo $this->get_field_id( 'service_page' ); ?>"><?php _e( 'Select Pages:','proficiency' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'service_page' ); ?>" name="<?php echo $this->get_field_name( 'service_page' ); ?>">
				<option value>--Select--</option>
				<?php
					$service_page = $instance['service_page'];
					$pages = get_pages($service_page); 				
					foreach ( $pages as $page ) {
						$option = '<option value="' . $page->ID . '" ';
						$option .= ( $page->ID == $service_page ) ? 'selected="selected"' : '';
						$option .= '>';
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
					}
				?>
						
			</select>
			<br/>
			</p>
			</tr>
			
			
        	<tr>
        		<td>
        			<label for="<?php echo $this->get_field_id('btnmore'); ?>"><?php _e('Button Label', 'proficiency'); ?></label>
        		</td>
        		<td>
        			<label for="<?php echo $this->get_field_id('btnlink'); ?>"><?php _e('Button Link', 'proficiency'); ?></label>
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<input type="text" name="<?php echo $this->get_field_name('btnmore'); ?>" id="<?php echo $this->get_field_id('btnmore'); ?>" value="<?php if( !empty($instance['btnmore']) ): echo htmlspecialchars_decode($instance['btnmore']); endif; ?>" class="widefat"/>
        		</td>
        		<td>
        			<input type="text" name="<?php echo $this->get_field_name('btnlink'); ?>" id="<?php echo $this->get_field_id('btnlink'); ?>" value="<?php if( !empty($instance['btnlink']) ): echo $instance['btnlink']; endif; ?>" class="widefat"/>
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<span>&nbsp;</span>
        		</td>
        	</tr>
        	<tr>
        		<td colspan="2">
        			<input type="checkbox" name="<?php echo $this->get_field_name('open_new_window'); ?>" id="<?php echo $this->get_field_id('open_new_window'); ?>" <?php if( !empty($instance['open_new_window']) ): checked( (bool) $instance['open_new_window'], true ); endif; ?> ><?php _e( 'Open Button Link in new window?','proficiency' ); ?>
        		</td>
        	</tr>
        </table>
        
    <?php

    }

}