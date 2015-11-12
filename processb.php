<?php

require('../../../wp-load.php');



$id_cat = '';

//var_dump($_POST);

//die();

extract($_POST);


if($tag = 'depace')
{
    $args = array(

            'post_type' => 'post',
            'posts_per_page' => 18,
            'tag' => 'depace',
            'post_status'   => 'publish'
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

                
                $html_terms .= $term_single->name;

                //$color = get_option("cat_color".$term_single->term_id);
                $color = "#bd121e";

                

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