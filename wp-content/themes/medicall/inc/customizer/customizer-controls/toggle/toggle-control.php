<?php 
if ( class_exists( 'WP_Customize_Control' ) ) {
    /**
     * Custom Toggle Control for WordPress Customizer.
     */
    class Medicall_Toggle_Control extends WP_Customize_Control {
    
    /**
     * Control type.
     *
     * @var string
     */
    public $type = 'gl-toggle';

    /**
     * Label for the toggle control.
     *
     * @var string
     */
    public $label = '';

    /**
     * Description for the toggle control.
     *
     * @var string
     */
    public $description = '';

    /**
     * Enqueue control related scripts/styles.
     */
    public function enqueue() {
        wp_enqueue_style( 'toggle-control-styles', get_template_directory_uri() . '/inc/customizer/customizer-controls/toggle/toggle.css' );
    }
    

    /**
     * Render the control's content.
     */
    public function render_content() {
        ?>
         <label>
             <div class="customize-control-wrapper">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
                <div class="customize-control-switch">
                    <input type="checkbox" <?php $this->link(); ?> <?php checked( $this->value() ); ?> />
                    <div class="slider"></div>
                </div>
            </div>
        </label>
        <?php
    }
}

}

