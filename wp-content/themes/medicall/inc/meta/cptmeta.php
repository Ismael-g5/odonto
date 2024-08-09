<?php 
/**
* Medicall Metabox for Sidebar Layout
* @package Medicall
*/ 
function medicall_add_sidebar_layout_box(){
    add_meta_box( 
        'medicall_sidebar_layout',
        __( 'Sidebar Layout', 'medicall' ),
        'medicall_sidebar_layout_callback', 
        array( 'page','post'),
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'medicall_add_sidebar_layout_box' );

function medicall_sidebar_layout_callback( $post ){
     // Output the nonce field
     wp_nonce_field( 'medicall_sidebar_nonce', 'medicall_sidebar_nonce' );

    $sidebar_layout = array(    
        'default'=> array(
            'value'     => 'default',
            'label'     => __( 'Default Sidebar', 'medicall' ),
            'thumbnail' => esc_url( get_template_directory_uri() . '/assets/images/sidebar/default.png' )
        ),
        'full-width'=> array(
            'value'     => 'full-width',
            'label'     => __( 'Full Sidebar', 'medicall' ),
            'thumbnail' => esc_url( get_template_directory_uri() . '/assets/images/sidebar/full-width.jpg')
        ),
        'left-sidebar' => array(
            'value'     => 'left-sidebar',
            'label'     => __( 'Left Sidebar', 'medicall' ),
            'thumbnail' => esc_url( get_template_directory_uri() . '/assets/images/sidebar/left.jpg' )        
        ),
        'right-sidebar' => array(
            'value'     => 'right-sidebar',
            'label'     => __( 'Right Sidebar', 'medicall' ),
            'thumbnail' => esc_url( get_template_directory_uri() . '/assets/images/sidebar/right.jpg' )        
         )    
    );
   
    ?>     
    <div>
        <h4>
            <?php esc_html_e( 'Choose Sidebar Template', 'medicall' ); ?>
        </h4>

        <div class="sidebar-layout" >
            <?php  
                foreach( $sidebar_layout as $layout ){
                    $value = get_post_meta( $post->ID, 'medicall_sidebar_layout', true );
                    $sidebar_layout_value = ( isset( $value ) && !empty( $value ) ) ? esc_html( $value ) : "";
                    ?>
                    <div class="sidebar-option">
                        <input 
                            id="<?php echo esc_attr( $layout['value'] ); ?>" 
                            type="radio" 
                            name="mp_sidebar_layout" 
                            value="<?php echo esc_attr( $layout['value'] ); ?>" 
                            <?php 
                                checked( $layout['value'], $sidebar_layout_value ); 
                                if( empty( $sidebar_layout_value ) ){ 
                                    checked( $layout['value'], 'default' );
                                }
                            ?>
                        />
                        <label class="description" for="<?php echo esc_attr( $layout['value'] ); ?>">
                            <img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" />                               
                        </label>
                    </div>
                <?php 
                }
            ?>
        </div>
    </div>
 <?php 
}

function medicall_save_sidebar_layout( $post_id ){
    
    // Verify the nonce before proceeding.
    if ( !isset( $_POST['medicall_sidebar_nonce'] ) || !wp_verify_nonce( $_POST['medicall_sidebar_nonce'], 'medicall_sidebar_nonce' ) )
    return;
    
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;
    
    if ( isset( $_POST['mp_sidebar_layout'] ) ) {
        $selected_layout = sanitize_key( $_POST['mp_sidebar_layout'] ) ;
        $valid_layouts = array(
            'default',
            'full-width',
            'left-sidebar',
            'right-sidebar'
        );
    
        if ( in_array( $selected_layout, $valid_layouts ) ) {
            update_post_meta( $post_id, 'medicall_sidebar_layout', $selected_layout );
        }
    }
}
add_action( 'save_post' , 'medicall_save_sidebar_layout' );