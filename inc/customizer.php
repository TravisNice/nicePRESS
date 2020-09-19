<?php
/**
 * NicePress Theme Customizer
 *
 * @package NicePress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nicepress_customize_register( $wp_customize ) {
    /**
     * The background color chooser is already provided as part of the custom header.
     * Now we add in a background color for the content areas.
     */

    $wp_customize->add_setting(
        'np_content_background_color',
        array(
            'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'np_content_background_color',
            array(
                'label' => __( 'Content Area Background Color', 'nicepress' ),
                'section' => 'colors',
                'settings' => 'np_content_background_color',
            )
        )
    );

    /**
     * Give people a choice over what color font to use so they can use a light font on a dark background if they so desire.
     */

    $wp_customize->add_setting(
        'np_content_color',
        array(
            'default' => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'np_content_color',
            array(
                'label' => __( 'Font Color', 'nicepress' ),
                'section' => 'colors',
                'settings' => 'np_content_color',
            )
        )
    );

	/**
	 * Customise the links in the menu
	 */

	$wp_customize->add_setting(
		'np_menu_link_color',
		array(
			'default' => '#000000',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'np_menu_link_color',
			array(
				'label' => __( 'Menu Item Color', 'nicepress' ),
				'section' => 'colors',
				'settings' => 'np_menu_link_color',
			)
		)
	);

       $wp_customize->add_setting(
	       'np_current_menu_link_color',
	       array(
		       'default' => '#000000',
		       'sanitize_callback' => 'sanitize_hex_color',
	       )
       );
       $wp_customize->add_control(
	       new WP_Customize_Color_Control(
		       $wp_customize,
		       'np_current_menu_link_color',
		       array(
			       'label' => __( 'Current Menu Item Color', 'nicepress' ),
			       'section' => 'colors',
			       'settings' => 'np_current_menu_link_color',
		       )
	       )
       );

      $wp_customize->add_setting(
	      'np_hover_menu_link_color',
	      array(
		      'default' => '#000000',
		      'sanitize_callback' => 'sanitize_hex_color',
	      )
      );
      $wp_customize->add_control(
	      new WP_Customize_Color_Control(
		      $wp_customize,
		      'np_hover_menu_link_color',
		      array(
			      'label' => __( 'Menu Item Hover Color', 'nicepress' ),
			      'section' => 'colors',
			      'settings' => 'np_hover_menu_link_color',
		      )
	      )
      );

     $wp_customize->add_setting(
	     'np_border_color',
	     array(
		     'default' => '#000000',
		     'sanitize_callback' => 'sanitize_hex_color',
	     )
     );
     $wp_customize->add_control(
	     new WP_Customize_Color_Control(
		     $wp_customize,
		     'np_border_color',
		     array(
			     'label' => __( 'Border Color', 'nicepress' ),
			     'section' => 'colors',
			     'settings' => 'np_border_color',
		     )
	     )
     );

    $wp_customize->add_setting(
	    'np_link_color',
	    array(
		    'default' => '#000000',
		    'sanitize_callback' => 'sanitize_hex_color',
	    )
    );
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
		    $wp_customize,
		    'np_link_color',
		    array(
			    'label' => __( 'Link Color', 'nicepress' ),
			    'section' => 'colors',
			    'settings' => 'np_link_color',
		    )
	    )
    );

   $wp_customize->add_setting(
	   'np_link_hover_color',
	   array(
		   'default' => '#000000',
		   'sanitize_callback' => 'sanitize_hex_color',
	   )
   );
   $wp_customize->add_control(
	   new WP_Customize_Color_Control(
		   $wp_customize,
		   'np_link_hover_color',
		   array(
			   'label' => __( 'Link Hover Color', 'nicepress' ),
			   'section' => 'colors',
			   'settings' => 'np_link_hover_color',
		   )
	   )
   );

	/**
	 * Originally from the _S theme
	 */

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'nicepress_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'nicepress_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'nicepress_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function nicepress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function nicepress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nicepress_customize_preview_js() {
	wp_enqueue_script( 'nicepress-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'nicepress_customize_preview_js' );
