<?php if ( ! defined( 'SLZ' ) ) {
	die( 'Forbidden' );
}

class SLZ_Shortcode_Causes_Block extends SLZ_Shortcode
{
	protected function _render($atts, $content = null, $tag = '', $ajax = false)
	{

		$view_path = $this->locate_path('/views');

		if( !$ajax ){
			$data = $this->get_data( $atts );
		} else {
			$data = $atts;
		}

		$this->enqueue_static();

		return slz_render_view($this->locate_path('/views/view.php'), array( 'instance' => $this, 'data' => $data ) );
	}
}