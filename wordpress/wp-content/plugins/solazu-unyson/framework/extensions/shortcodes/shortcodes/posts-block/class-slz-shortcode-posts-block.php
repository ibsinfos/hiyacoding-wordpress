<?php if ( ! defined( 'SLZ' ) ) {
	die( 'Forbidden' );
}

class SLZ_Shortcode_Posts_Block extends SLZ_Shortcode
{
	protected function _render($atts, $content = null, $tag = '', $ajax = false)
	{
		if( !$ajax ){

			$data = $this->get_data( $atts );

		} else {
			$data = $atts;
		}

		$view_path = $this->locate_path('/views');

		$this->enqueue_static();

		return slz_render_view($this->locate_path('/views/view.php'), array( 'data' => $data, 'instance' => $this, 'view_path' => $view_path ));
	}
}
