<?php 
if ( class_exists( 'WP_Customize_Control' ) ) {
    /**
     * Custom Radio Image Control for WordPress Customizer.
     */
    class Medicall_Radio_Image_Control extends WP_Customize_Control {
    
    /**
     * Control type.
     *
     * @var string
     */
    public $type = 'gl-radio-image';

    /**
     * Label for the radio image control.
     *
     * @var string
     */
    public $label = '';

    /**
     * Description for the radio image control.
     *
     * @var string
     */
    public $description = '';


    public $row = '2';

    /**
     * Enqueue control related scripts/styles.
     */
    public function enqueue() {
        wp_enqueue_style( 'radio-image-control-styles', get_template_directory_uri() . '/inc/customizer/customizer-controls/radio/radio.css' );
    }
    
    /**
     * Render the control's content.
     */
    public function render_content() {
        ?>
        <div class="gl-radio-wrap">
            <?php if( !empty( $this->label ) ) { ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php } ?>
            <?php if( !empty( $this->description ) ) { ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php } ?>
            <div class="radioimgwrapper" data-row="row-<?php echo esc_attr( $this->row ); ?>">
                <?php foreach ( $this->choices as $key => $value ) { ?>
                    <label class="radio-button-label">
                        <input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
                        <img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
                    </label>
                <?php } ?>
            </div>
		</div>
        <?php
    }
}

}

