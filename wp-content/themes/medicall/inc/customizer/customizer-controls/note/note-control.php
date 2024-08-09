<?php 
if ( class_exists( 'WP_Customize_Control' ) ) {
    /**
     * Custom Note Control for WordPress Customizer.
     */
    class Medicall_Note_Control extends WP_Customize_Control {
    
    /**
     * Control type.
     *
     * @var string
     */
    public $type = 'gl-note';

    /**
     * Label for the Note control.
     *
     * @var string
     */
    public $label = '';

    /**
     * Description for the Note control.
     *
     * @var string
     */
    public $description = '';

    /**
     * Enqueue control related scripts/styles.
     */
    public function enqueue() {
        wp_enqueue_style( 'note-control-styles', get_template_directory_uri() . '/inc/customizer/customizer-controls/note/note.css' );
    }
    

    /**
     * Render the control's content.
     */
    public function render_content() {
        ?>
         <div class="gl-notice-custom-control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
			</div>
        <?php
    }
}

}

