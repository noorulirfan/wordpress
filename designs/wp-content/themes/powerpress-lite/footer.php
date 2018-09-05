<?php
/*
 * Powerpress Lite default footer file
 */
/*if(!is_search() && !is_404() && isset($post->ID)) :
    $post_id = isset($post->ID)?$post->ID:"";
    $footer_option = get_post_meta($post_id, 'footerOption', true);
endif;*/
$footer_options = isset($footer_option)?$footer_option: 1; 
$footer_widget_style = get_theme_mod('footerWidgetStyle',3);
$hide_footer_widget_bar = get_theme_mod('hideFooterWidgetBar',1);
$hide_credit_links = get_theme_mod('hideCreditLinks'); ?>
<?php if($footer_options != 0) : ?>
    <footer>
        <?php if(($hide_footer_widget_bar == 1) || ($hide_footer_widget_bar == '')) : 
            $footer_widget_style = $footer_widget_style+1;
        $footer_column_value = floor(12/($footer_widget_style)); ?>
            <div class="footer-box">
                <div class="container">
                    <div class="row">
                        <?php $k = 1; ?>
                        <?php for( $i=0; $i<$footer_widget_style; $i++) { ?>
                            <?php if (is_active_sidebar('footer-'.$k)) { ?>
                                <div class="col-md-<?php echo esc_attr($footer_column_value); ?> col-sm-<?php echo esc_attr($footer_column_value); ?> col-xs-12"><?php dynamic_sidebar('footer-'.$k); ?></div>
                            <?php }
                            $k++;
                        } ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(get_theme_mod('hideCopyrightArea',1) != 2) : ?>
            
                <div class="footer-wrap">
                    <div class="container">
                        <div class="photographer-section">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="powered-by fadeIn animated">
                                        <p><?php esc_html_e('Powered by ','powerpress-lite');?>
                                            <a href="<?php echo esc_url('https://voilathemes.com/wordpress-themes/powerpress-lite/'); ?>" target="_blank">
                                                <?php esc_html_e('Powerpress Lite WordPress Theme','powerpress-lite'); ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="copyright fadeIn animated">
                                        <p><?php echo wp_kses_post(get_theme_mod('CopyrightAreaText')); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="footer-social-icon fadeIn animated">
                                        <ul>
                                            <?php for($i=1; $i<=6; $i++) : ?>
                                                <?php if(get_theme_mod('powerpressliteSocialIcon'.$i) != '' && get_theme_mod('powerpressliteSocialIconLink'.$i) != '' ): ?>
                                                <li>
                                                    <a href="<?php echo esc_url(get_theme_mod('powerpressliteSocialIconLink'.$i)); ?>" class="fb" title="" target="_blank">
                                                    <i class="fa <?php echo esc_attr(get_theme_mod('powerpressliteSocialIcon'.$i)); ?>"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        <?php endif; ?>
    </footer>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>