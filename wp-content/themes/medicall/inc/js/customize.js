( function( api ) {

    api.sectionConstructor['pro-section'] = api.Section.extend( {

        attachEvents: function () {},

        isContextuallyActive: function () {
            return true;
        }
    } );

} )( wp.customize );

jQuery(document).ready(function($) {
    //Scroll to front page section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings_panel .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    }); 

    function scrollToSection( section_id ){

        var preview_section_id = "banner-section";
    
        var $contents = jQuery('#customize-preview iframe').contents();
    
        switch ( section_id ) {  
            case 'accordion-section-about_section':
            preview_section_id = "front-about";
            break;

            case 'accordion-section-service_section':
            preview_section_id = "front-service";
            break;

            case 'accordion-section-department_section':
            preview_section_id = "front-department";
            break;

            case 'accordion-section-front_video_cta_section':
            preview_section_id = "front-video-cta";
            break;

            case 'accordion-section-front_appointment_section':
            preview_section_id = "book-appointment";
            break;

            case 'accordion-section-front_team_section':
            preview_section_id = "front-team";
            break;

            case 'accordion-section-front_cta_section':
            preview_section_id = "front-cta";
            break;

            case 'accordion-section-blog_section':
            preview_section_id = "front-blog";
            break;    
        }
    
        if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
            $contents.find("html, body").animate({
            scrollTop: $contents.find( "#" + preview_section_id ).offset().top
            }, 1000);
        }
    }
});