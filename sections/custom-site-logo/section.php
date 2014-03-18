<?php
/*
    Section: Custom Site Logo
    Author: Tuna Traffic
    Author URI: http://www.tunatraffic.com
    Description: A simple custom site logo.  Acutally, it's a custom logo you can use anywhere. :)
    Class Name: cslLogo
    Filter: component
    Loading: active
*/

class cslLogo extends PageLinesSection {

    // Welcome Message
    function welcome(){
        ob_start();
        ?><p>You can use PageLines DMS Grid to easy positon your logo.  Alternatively, you can also use WordPress alignment classes such as: aligncenter, alignleft, or alignright to positon your logo or add your own class to the logo to style it.</p><?php
        return ob_get_clean();
    }

    function section_opts(){
        $opts = array(
             array(
                'col'      => '2',
                'key'       => $this->id.'cslLogo_welcome',
                'type'      => 'template',
                'title'     => __('How To Use','pagelines'),
                'template'  => $this->welcome(),
            ),
            array(
                'col'      => '1',
                'type'      => 'image_upload',
                'key'       => $this->id.'cslLogo_logo', 
                'label'     => __( 'Logo', 'pagelines' ),                    
                ),
            array(
                'col'      => '1',
                'type'      => 'text',
                'key'       => $this->id.'cslLogo_alt', 
                'label'     => __( 'Alt Text', 'pagelines' ),                    
                ),
            array(
                'col'      => '1',
                'type'      => 'text',
                'key'       => $this->id.'cslLogo_logo_wrapper_class', 
                'label'     => __( 'Class for Logo', 'pagelines' ),
                'help'      => __( 'Use this to help you position the logo.  Its a great use for default WordPress Classes: Aligncenter, Alignleft, or Alignright.', 'pagelines' ),                    
                ),
            array(
                'col'      => '1',
                'type'      => 'select_animation',
                'key'       => $this->id.'cslLogo_animation',
                'label'     => __( 'Viewport Animation', 'pagelines' ),
                'help'      => __( 'Optionally animate the appearance of this section on view.', 'pagelines' ),
            )       
            
        );

        return $opts;

    }

    function section_template() {

        
        // Check if the PageLines Editor is active.
        global $pldraft;
        $edit = false;
        if( is_object( $pldraft ) && 'draft' == $pldraft->mode )
        $edit = true;

        // Put our options into varibles
        $logo       = $this->opt($this->id.'cslLogo_logo') ? $this->opt($this->id.'cslLogo_logo') : 'http://placehold.it/200x150';
        $alt        = $this->opt($this->id.'cslLogo_alt');
        $logoClass  = $this->opt($this->id.'cslLogo_logo_wrapper_class');
        $siteUrl    = site_url();
        $siteName   = get_bloginfo( 'name' );

        

        // Set up the output
        $logo = sprintf('<div class="ccw-logo-wrapper fix"><a href="%s" title="%s"><img class="ccw-logo %s" src="%s" alt="%s"></a></div>', $siteUrl, $siteName, $logoClass, $logo, $alt ); 
        $class = $this->opt($this->id.'cslLogo_animation');
            
        
        // Output this bad boy on the screen     
        printf('<div class="pl-animation %s" >%s</div>', $class, $logo);

    }
}
