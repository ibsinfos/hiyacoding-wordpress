<?php if ( ! defined( 'SLZ' ) ) { die( 'Forbidden' ); }

$model = new SLZ_Portfolio();
$model->init( $data );

$uniq_id = $model->attributes['uniq_id'];
$block_cls = $model->attributes['extra_class'] . ' ' . $uniq_id;
$layout = $model->attributes['layout'];
if( ! $model->query->have_posts() ) {
	return;
}
?>
<div class="slz-shortcode sc_portfolio_list <?php echo esc_attr( $block_cls ).' '.esc_attr($layout); ?>" data-item="<?php echo esc_attr($uniq_id); ?>">
	<?php
	if( !empty($data['category_filter']) ){
		$model->attributes['post_id'] = array();
		$model->attributes['is_ajax'] = true;
		echo ( $model->render_category_tabs() );
	}
	switch ( $model->attributes['layout'] ) {
		case 'layout-1':
			echo slz_render_view( $instance->locate_path('/views/layout-1.php'), compact('model'));
			break;
		case 'layout-2':
			echo slz_render_view( $instance->locate_path('/views/layout-2.php'), compact('model'));
			break;
		default:
			echo slz_render_view( $instance->locate_path('/views/layout-1.php'), compact('model'));
			break;
	}
	?>
</div>
