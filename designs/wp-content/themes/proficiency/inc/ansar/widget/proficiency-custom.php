<?php 

class proficiency_custom_widget extends WP_Widget{	

	public function __construct() {
		parent::__construct(
			'proficiency_custom_widget',
			__( 'Proficiency - Custom Widget', 'proficiency' )
		);
	}

    function widget($args, $instance) {

        extract($args);

        echo $before_widget; ?>

        <div class="col-sm-4 col-md-<?php echo apply_filters('widget_title', $instance['colum']); ?>">

		    <?php if( !empty($instance['name']) ): ?> <h5><?php echo apply_filters('widget_title', $instance['name']); ?></h5> <?php endif; ?>

            <div class="<?php if( !empty($instance['custom_class']) ): echo htmlspecialchars_decode(apply_filters('widget_title', $instance['custom_class']));  endif; ?>">

                    <?php if( !empty($instance['description']) ): ?>
                    
                   <?php echo do_shortcode($instance['description']);?>
                    
                    <?php endif; ?>
            </div>
        </div>

        <?php

        echo $after_widget;

    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['colum'] = strip_tags($new_instance['colum']);
        $instance['name'] = strip_tags($new_instance['name']);
        $instance['custom_class'] = stripslashes(wp_filter_post_kses($new_instance['custom_class']));
        $instance['description'] = stripslashes(wp_filter_post_kses($new_instance['description']));

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
                        <option value="8">8</option>
                        <option value="10">10</option>
                        <option value="12">12</option>
                    </select>
            </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name', 'proficiency'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('name'); ?>" id="<?php echo $this->get_field_id('name'); ?>" value="<?php if( !empty($instance['name']) ): echo $instance['name']; endif; ?>" class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('custom_class'); ?>"><?php _e('Custom Class', 'proficiency'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('custom_class'); ?>" id="<?php echo $this->get_field_id('custom_class'); ?>" value="<?php if( !empty($instance['custom_class']) ): echo $instance['custom_class']; endif; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'proficiency'); ?></label><br/>
            
            <textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>"><?php if( !empty($instance['description']) ): echo htmlspecialchars_decode($instance['description']); endif; ?></textarea>
        </p>
       

    <?php

    }

}