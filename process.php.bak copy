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

	$args = array(

      		'post_type' => 'post',

      		'posts_per_page' => 18,

 			'post_status'	=> 'publish',

 			'tax_query' => array(

					//'relation' => 'AND',

					array(

						'taxonomy' => 'category',

						'field'    => 'id',

						'terms'    =>  $cod_cat,

						'operator' => 'IN',

					),

				),

      		);



    $articulos = get_posts($args);



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

            $terms_noticias = wp_get_post_terms( $post->ID, 'category' );

            //var_dump($terms_noticias);

            //Ejes temáticos

            $html_terms = '';



            $xx = 0;

            if($terms_noticias)

            {

              foreach($terms_noticias as $term_single)

              {

                $xx++;

                if($xx > 1)

                {

                        break;

                }

                

                //$html_terms .= '<a href="'.get_term_link($term_single->slug, 'seccion').'">'.$term_single->name.'</a>';

                $html_terms .= $term_single->name;

                $color = get_option("cat_color".$term_single->term_id);

                

              }



            }

            $tmp['color'] = $color;



            if ( has_post_thumbnail() ) 

            {

                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );

                $tmp['images'] = $large_image_url[0];

                

            }

            else

            {

                $tmp['images'] = 'http://iamcardio.com/wp-content/uploads/2014/10/hear101.jpg';

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

	/*$data['error'] = 1;

    echo json_encode($data);*/

    //var_dump($id_cat);

    //die('si hay id_cat');

    $args = array(

            'post_type' => 'post',

            'posts_per_page' => 18,

            'post_status'   => 'publish',

            'tax_query' => array(

                    //'relation' => 'AND',

                    array(

                        'taxonomy' => 'category',

                        'field'    => 'id',

                        'terms'    =>  array(114,115),

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

            $terms_noticias = wp_get_post_terms( $post->ID, 'category' );

            //var_dump($terms_noticias);

            //Ejes temáticos

            $html_terms = '';



            $xx = 0;

            if($terms_noticias)

            {

              foreach($terms_noticias as $term_single)

              {

                $xx++;

                if($xx > 1)

                {

                        break;

                }

                

                //$html_terms .= '<a href="'.get_term_link($term_single->slug, 'seccion').'">'.$term_single->name.'</a>';

                $html_terms .= $term_single->name;

                $color = get_option("cat_color".$term_single->term_id);

                

              }



            }

            $tmp['color'] = $color;



            if ( has_post_thumbnail() ) 

            {

                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );

                $tmp['images'] = $large_image_url[0];

                

            }

            else

            {

                $tmp['images'] = 'http://iamcardio.com/wp-content/uploads/2014/10/hear101.jpg';

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