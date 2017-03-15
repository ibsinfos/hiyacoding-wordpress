<?php if ( ! defined( 'SLZ' ) ) {
	die( 'Forbidden' );
}

$shortcode = slz_ext( 'shortcodes' )->get_shortcode( 'featured_list' );
$block_class = 'featured-list-'.SLZ_Com::make_id();
$block_cls = $block_class.' '.$data['extra_class']. ' ';
$css = $custom_css = '';
$default_params = $shortcode->get_config('params_default_arr');
$item_arr = array();

//column
$class_column = '';
if ( isset( $data['column'] ) ) {
    if (  $data['column'] == 1 ){
        $class_column = 'slz-column-1';
    }
    else if (  $data['column'] == 2 ){
        $class_column = 'slz-column-2';
    }
    else if (  $data['column'] == 3 ){
        $class_column = 'slz-column-3';
    }
    else if (  $data['column'] == 4 ){
        $class_column = 'slz-column-4';
    }
    else {
        $class_column = '';
    }
}

echo '<div class="slz-shortcode slz-shortcode-list sc_featured_list '. esc_attr( $block_cls ).' '.esc_attr($data['styles']).' '.esc_attr($data['layout']).' ">';
    if( $data['layout'] == 'layout-1' && isset( $data['styles'] ) ) {
        /*--layout 1(style 1) --*/
        if( $data['styles'] == 'style-1' ) {
            if ( !empty( $data['feature_list'] ) ) {

                if(function_exists('vc_param_group_parse_atts')){
                    $item_arr = (array) vc_param_group_parse_atts( $data['feature_list'] );
                }
                
                if( !empty( $item_arr ) ) {
                    echo '<div class="slz-list-block slz-list-feature slz-list-column '.esc_attr($class_column).'">';
                    foreach ( $item_arr as $item ) {
                        if ( empty( $item['text'] ) && empty( $item['icon'] ) && empty( $item['image'] ) ) {
                            continue;
                        }
                        $item = array_merge( $default_params, $item );

                        echo slz_render_view( $instance->locate_path( '/views/style-1.php' ), compact('item') );

                    }// end foreach
                    echo '</div>';
                }// end if
            }
        }
        /*--layout 1(style 2) --*/
        else if( $data['styles'] == 'style-2' ) {
            if ( !empty( $data['feature_list2'] ) ) {
                if(function_exists('vc_param_group_parse_atts')){
                    $item_arr = (array) vc_param_group_parse_atts( $data['feature_list2'] );
                }
               
                if( !empty( $item_arr ) ) {
                    echo '<div class="slz-list-block slz-list-feature slz-list-column '.esc_attr($class_column).'">';
                    $i = 1;
                    foreach ( $item_arr as $item ) {
                        $item = array_merge( $default_params, $item );
                        if( empty( $item['title'] ) && empty( $item['description'] ) ) {
                            continue;
                        }
                        if( $data['show_number'] == 'yes' ) {
                            $item['num'] = $i++;
                        }

                        echo slz_render_view( $instance->locate_path( '/views/style-2.php' ), compact('item') );

                    }
                    echo '</div>';
                }
            }
        }
    }
    /*--layout 2--*/
    else{
         if ( !empty( $data['feature_list_slider'] ) ) {
            if(function_exists('vc_param_group_parse_atts')){
                $item_arr = (array) vc_param_group_parse_atts( $data['feature_list_slider'] );
            }
            if( !empty( $item_arr ) ) {
                echo '<div class="slz-list-feature slz-image-carousel sc-featured-list-layout-2">';
                echo '<div class="carousel-overflow"><div class="slz-carousel">';
                foreach ( $item_arr as $item ) {
                    $item = array_merge( $default_params, $item );
                    if( empty( $item['title'] ) && empty( $item['description'] ) && empty($item['slider_img']) ) {
                        continue;
                    }
                    $item['column'] = $class_column;
                    echo slz_render_view( $instance->locate_path( '/views/layout-2.php' ), compact('item') );

                }
                echo '</div></div>';
                echo '</div>';
            }
        }
    }
    /*--end layout 2--*/
echo '</div>';

if( !empty( $data['text_color'] ) ) {
	$css = '
		.%1$s.sc_featured_list .slz-icon-box-1.style-vertical .wrapper-info .title {
			color: %2$s;
		}
	';
	$custom_css .= sprintf( $css, esc_attr( $block_class ), esc_attr( $data['text_color'] ) );
}
if( isset( $data['des_color'] ) && !empty( $data['des_color'] ) ) {
    $css = '
		.%1$s.sc_featured_list .slz-icon-box-1.style-vertical .wrapper-info .description {
			color: %2$s;
		}
	';
    $custom_css .= sprintf( $css, esc_attr( $block_class ), esc_attr( $data['des_color'] ) );
}
if( isset( $data['number_color'] ) && !empty( $data['number_color'] ) ) {
    $css = '
		.%1$s.sc_featured_list .slz-icon-box-1.style-vertical .number {
			color: %2$s;
		}
	';
    $custom_css .= sprintf( $css, esc_attr( $block_class ), esc_attr( $data['number_color'] ) );
}
if( !empty( $data['background_color'] ) && !empty( $data['background_img'] ) ) {
	$img = wp_get_attachment_url( $data['background_img'] );
	$css = '
		.%1$s.sc_featured_list {
			background: %2$s url(%3$s);
		}
	';
	$custom_css .= sprintf( $css, esc_attr( $block_class ), esc_attr( $data['background_color'] ), esc_url( $img ) );
}else{
	if ( !empty( $data['background_color'] ) ) {
		$css = '
			.%1$s.sc_featured_list {
				background-color: %2$s;
			}
		';
		$custom_css .= sprintf( $css, esc_attr( $block_class ), esc_attr( $data['background_color'] ) );
	}elseif ( $data['background_img'] ) {
		$img = wp_get_attachment_url( $data['background_img'] );
		$css = '
			.%1$s.sc_featured_list {
				 background-image: url("%2$s");
			}
		';
		$custom_css .= sprintf( $css, esc_attr( $block_class ), esc_url( $img ) );
	}
}
if( !empty( $data['border_color'] ) ) {
    $css = '
		.%1$s.sc_featured_list .slz-list-feature > .item::before {
			background-color: %2$s;
		}
	';
    $custom_css .= sprintf( $css, esc_attr( $block_class ), esc_attr( $data['border_color'] ) );
}
if( !empty( $data['arrows_color'] ) ) {
    $css = '
        .%1$s .slz-image-carousel .slick-arrow {
            color: %2$s;
        }
        .%1$s .slz-image-carousel .slick-arrow {
            border-color: %2$s;
        }
    ';
    $custom_css .= sprintf( $css, esc_attr( $block_class ), esc_attr( $data['arrows_color'] ) );
}
if( !empty( $data['arrows_hv_color'] ) ) {
    $css = '
        .%1$s .slz-image-carousel .slick-arrow:hover {
            color: %2$s;
        }
    ';
    $custom_css .= sprintf( $css, esc_attr( $block_class ), esc_attr( $data['arrows_hv_color'] ) );
}
if ( !empty( $custom_css ) ) {
	do_action('slz_add_inline_style', $custom_css);
}