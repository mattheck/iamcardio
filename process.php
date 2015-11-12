<?php
require('../../../wp-load.php');
//var_dump($_POST);
//die();
/*array(1) { 
    ["cod_cat"]=> array(2) { 
        [0]=> string(2) "95" 
        [1]=> string(2) "96" 
    }
}*/

$id_cat = '';
//var_dump($_POST);
//die();
extract($_POST);
//$id_cat = intval($cod_cat);
//var_dump(count($cod_cat));
//die();
if(count($cod_cat) > 0)
{
	//var_dump($id_cat);
	//die('si hay id_cat');
	$args = array(
      		'post_type' => 'articles',
      		'posts_per_page' => 30,
 			'post_status'	=> 'publish',
 			'tax_query' => array(
					//'relation' => 'AND',
					array(
						'taxonomy' => 'categorias',
						'field'    => 'id',
						'terms'    =>  $cod_cat,
						'operator' => 'IN',
					),
				),
      		);

    $articulos = get_posts($args);
    //var_dump($articulos);
    //die();
    if($articulos)
    {
    	//echo json_encode($articulos);
        $data = array();
        foreach($articulos as $post)
        {
            setup_postdata($post);
            $tmp['post_title'] = get_the_title($post->ID);
            $tmp['permalink'] = get_permalink($post->ID);
            $tmp['excerpt'] = recortar_texto(get_the_excerpt($post->ID),100);
            if ( has_post_thumbnail() ) 
            {
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                $tmp['images'] = $large_image_url[0];
                
            }
            else
            {
                $tmp['images'] = 'http://lorempixel.com/400/200';
            }
            array_push($data,$tmp);
        }
        echo json_encode($data);
    }
    else
    {
    	//die('No hay articulos');
    	$data['error'] = 1;
    	echo json_encode($data);
    }
   
}
else
{
	$data['error'] = 1;
    echo json_encode($data);
}