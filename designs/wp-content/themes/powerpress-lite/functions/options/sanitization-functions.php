<?php

/**
 * Sanitization Functions
 * 
 * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php 
 */
if( class_exists( 'WP_Customize_Control' ) ):

/* Class for icon selector */

class powerpress_lite_Fontawesome_Icon_Chooser extends WP_Customize_Control{
    public $type = 'icon';

    public function render_content(){
        ?>
            <label>
                <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
                </span>

                <?php if($this->description){ ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php } ?>

                <div class="powerpress-lite-selected-icon">
                    <i class="fa <?php echo esc_attr($this->value()); ?>"></i>
                    <span><i class="fa fa-angle-down"></i></span>
                </div>

                <ul class="powerpress-lite-icon-list clearfix">
                    <?php
                    $powerpress_lite_font_awesome_icon_array = powerpress_lite_font_awesome_icon_array();
                    foreach ($powerpress_lite_font_awesome_icon_array as $powerpress_lite_font_awesome_icon) {
                            $icon_class = $this->value() == $powerpress_lite_font_awesome_icon ? 'icon-active' : '';
                            echo '<li class='.esc_attr( $icon_class ).'><i class="'.esc_attr( $powerpress_lite_font_awesome_icon ).'"></i></li>';
                        }
                    ?>
                </ul>
                <input type="hidden" value="<?php echo esc_attr($this->value()); ?>" <?php echo esc_url($this->link()); ?> />
            </label>
        <?php
    }
}
endif;

function powerpress_lite_posts_category(){
  $args = array('parent' => 0);
  $categories = get_categories($args);
  $category = array();
  $category[0] = 'All Category';
  $i = 0;
  foreach($categories as $categorys){
      if($i==0){
          $default = $categorys->slug;
          $i++;
      }
      $category[$categorys->term_id] = $categorys->name;
  }
  return $category;
}
function powerpress_lite_sanitize_select( $input, $setting ) {
  
  $input = sanitize_key( $input );
 
  $choices = $setting->manager->get_control( $setting->id )->choices;
 
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
function powerpress_lite_field_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}