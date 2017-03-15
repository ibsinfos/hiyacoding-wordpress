<?php if ( ! defined( 'SLZ' ) ) {
    die( 'Forbidden' );
}

$cfg = array();

$articles_extension = slz_ext( 'articles' )->get_article('article_02');

$cfg['general'] = array(
    'name'           => __( 'Article 02', 'slz' ),
    'description'    => __( 'Article 02', 'slz' ),
    'small_img'      => array(
        'height' => 70,
        'src'    => $articles_extension->locate_URI('/static/img/thumbnail.png')
    ),
    'large_img'      => array(
        'height' => 214,
        'src'    => $articles_extension->locate_URI('/static/img/thumbnail.png')
    )
);

$cfg ['image_size'] = array (
    'large' => '550x350',
    'no-image-large' => '550x350',
);

$cfg['title_length'] = 15;

$cfg['excerpt_length'] = 30;
