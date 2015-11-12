<?php
get_header(); ?>
<div id="primary" class="site-content">
<div id="content" role="main">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		$content_banner = '[rev_slider home]';
		?>
		<div class="homepageBOX">
			<div class="homepageBOX01">
				<div class="homepageBOX0101"><?php echo do_shortcode($content_banner);?>
				</div>
<?php
$args = array();
$color = array();
$color = array(
	'1' => 'red',
	'2' => 'azul',
	'3' => 'green',
	'4' => 'gray'
	);
$args = array(
'type'                     => 'articles',
'child_of'                 => 0,
'parent'                   => 0,
'orderby'                  => 'name',
'order'                    => 'ASC',
'hide_empty'               => 0,
'hierarchical'             => 1,
'exclude'                  => '',
'include'                  => '',
'number'                   => '',
'taxonomy'                 => 'categorias',
'pad_counts'               => false 
); 
$categories = get_categories($args);
//var_dump($categories);
$html_form = '';
if($categories)
{
	$html_titulo = '';
	foreach($categories as $cat)
	{
		if ($cat->category_parent == 0)
		{
			$html_titulo .= '<span style="font-size: 16px; font-weight:bold; font-style:normal; padding-right: 5px"> <input type="checkbox" name="catpadre" value="'.$cat->term_id.'" style="padding-right: 5px"/> '.$cat->name.'</span> ';
		}
		//var_dump($html_titulo);
	}
}
?>
				<div id="c_b" class="masterPagestyle homepageBOX0102" style="height:42%">
					<img src="<?php bloginfo('template_directory');?>/images/logo.png">
					
					<p class="pregunta1" style="font-size: 22px; font-style:italic; font-weight: bold; margin-bottom 26px">1 - How's your heart? <?php echo $html_titulo;?></p>
					
					<p class="pregunta2" style="font-size: 18px; font-style:italic; font-weight: bold; margin-bottom 26px; font-color: #c6c6c6">2 - Choose your topic from these main categories.</p>
					
					<?php
					$categories = get_categories($args);
					$html_form = '';
					if($categories)
					{
						foreach($categories as $cat)
						{
							//var_dump($cat);
							//1er nivel
							if ($cat->category_parent == 0)
							{
								$html_form .= '<div class="box_category" style="float: left; padding-right: 24px;">';
								//$html_form .= '<span class="category"><h4>'.$cat->name.'</h4></span>';
								
								$subargs = array(
								'type'                     => 'articles',
								'child_of'                 => 0,
								'parent'                   => $cat->term_id,
								'orderby'                  => 'id',
								'order'                    => 'ASC',
								'hide_empty'               => 0,
								'hierarchical'             => 1,
								'taxonomy'                 => 'categorias',
								'pad_counts'               => false 
								); 
								$subategories = get_categories($subargs);
								$xx = 0;
								//$array_cat =  array();
								if($subategories)
								{
									//2do nivel
									
									foreach($subategories as $category)
									{
										//var_dump($category);
										//$array_cat[] = $category->term_id;
										$xx++;
										if ($category->category_parent == $cat->term_id)
										{
											
											//var_dump($category);
											
											$html_form .= '<div class="subbox_category">';
											$html_form .= '<span class="title_sub fondo'.$category->slug.'">'.$category->name.' </span>';
											
											$subargs2 = array(
											'type'                     => 'articles',
											'child_of'                 => 0,
											'parent'                   => $category->term_id,
											'orderby'                  => 'id',
											'order'                    => 'ASC',
											'hide_empty'               => 0,
											'hierarchical'             => 1,
											'taxonomy'                 => 'categorias',
											'pad_counts'               => false
											);
											$subsubcategories = get_categories($subargs2);
											//$array_cat =  array();
											if($subsubcategories)
											{
												//3er nivel
												foreach($subsubcategories as $scat)
												{
													//var_dump($category);
													//$array_cat[] = $category->term_id;
													if ($scat->category_parent == $category->term_id)
													{
														$html_form .= '<input id="cat" type="checkbox" value="'.$scat->term_id.'" name="categoria"> <small style="padding-left: 5px; font-color: #756860; font-size: 15px;">'.$scat->name.'</small> ';
														
													}
													
												}
													
											}
											
											$html_form .= '</div>';
										
										}
										
									}
										
								}	
								$html_form .= '</div>';
							}
							
						}
							
					}
					echo $html_form;
					?>
				</div>
				
				<div id="content_category">
				
				<?php
				$args = array();
				$args = array(
      		'post_type' => 'articles',
      		'posts_per_page' => 30,
 					'post_status'	=> 'publish'
      		);
      	$articulos = get_posts($args);
      	if($articulos)
    		{
    		$mm = 0;
    		foreach($articulos as $post)
    		{
    			$mm++;
          setup_postdata($post);
          if ( has_post_thumbnail($post->ID) ) 
          {
          $large_image_url = '';
          $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
          $large_image_url = $large_image_url[0] ?  $large_image_url[0] : '';
          }
          else
          {
          	$large_image_url = 'http://lorempixel.com/400/200/people';
          }
          //var_dump($large_image_url);
    			if($mm == 1)
    			{
    				echo '<div class="homepageBOX03 masterPagestyle">';
    			}
    			?>
			
					<div class="contentProxy cP0<?php echo $mm;?> outer" style="position: relative; background-image: url(<?php echo $large_image_url;?>) !important">
						<div class="inner innerbox">
							<div class="texto"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
							<div class="excerpt"><a href="<?php the_permalink();?>"><?php echo recortar_texto(get_the_excerpt(),100);?></a></div>
						</div>
					</div>
				
				<?php
	        	if($mm == 3)
	        	{
	        		echo '</div>';
	        		$mm = 0;
	        	}
				}
				?>
				</div>
				<?php
			}
			?>
				
			
			</div>
		</div>
	
</article><!-- #post-## -->
</div><!-- #content -->
</div><!-- #primary .site-content -->
<script type='text/javascript' src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
<script type="text/javascript">
var base_url = "<?php echo bloginfo('template_directory'); ?>/";
function getidscheckbox() {         
   var allVals = [];
   $('#c_b :checked').each(function() {
     allVals.push($(this).val());
   });
   if(allVals.length>0)
   {
   	return allVals;
 	 }
  
}
function loadStart() {
	//alert('show');
  $('#loading').show();
}
function loadStop() {
	//alert('hide');
  $('#loading').hide();
}
$(document).ready(function() {
	$('#loading').hide();
  $("#c_b").click(function(){
  	var id_cat = '';
  	var id_cat = getidscheckbox();
  	get_contenido(id_cat);
  	});
 	return false;
});
function get_contenido(id_cat){
  $("#content_category").html("Loading...");
  //$("#dist").html("<option>Distrito</option>");
  $.ajax(
        {
        type: "POST",
        data: {cod_cat: id_cat},
        url: base_url+"process.php",
        dataType: "json",
        }
      ).done(function(d){
        //console.log(d);
        var tbody = "";
        var x = 0;
        //console.log(d);
        //return false;
        if(d.length>0){
					for(var item in d){
						x++;
						//console.log(x);
						if(x == 1)
						{
							tbody += "<div class='homepageBOX03 masterPagestyle'>";
						}
					
						tbody += "<div class='contentProxy cP0"+x+" outer' style='position: relative; background-image: url("+d[item].images+") !important'>";
	          tbody += "<div class='inner innerbox'><div class='texto'><a href='"+d[item].permalink+"'>"+d[item].post_title+"</div><div class='excerpt'><a href='"+d[item].permalink+"'>"+d[item].excerpt+"</div></div></div>";
	          			
	          			if(x ==3)
						{
							tbody += "</div>";
							x = 0;
						}
	          
	        }
      	}else{
      		tbody += 'There are no results.';
      	}
      	
        $("#content_category").html(tbody);
      });
    return false;
}
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>