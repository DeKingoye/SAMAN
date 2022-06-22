<?php if ( !defined( 'ABSPATH' ) ) exit();

get_header();

global $post;


$artists = apply_filters( 'OVACOLL_artist_list', 10 );
$search_all_artist = '';
$selected = '';

/* Search Collection */
$get_search = isset( $_GET["search_collection"] ) ? $_GET["search_collection"] : '';

if( $get_search == 'search-collection' ){
	$collections = apply_filters( 'OVACOLL_search_collection', $_REQUEST );
} else {
	$collections = apply_filters( 'OVACOLL_collection', 10 );
}

$get_search_location = isset( $_GET["coll_location"] ) ? $_GET["coll_location"] : '';
$get_search_type     = isset( $_GET["coll_type"] ) ? $_GET["coll_type"] : '';
$get_search_artist   = isset( $_GET["coll_artist"] ) ? $_GET["coll_artist"] : '';

if( is_tax( 'location' ) ||  get_query_var( 'location' ) != '' ){
	$get_search_location = get_query_var( 'location' );
}

if( is_tax( 'type' ) ||  get_query_var( 'type' ) != '' ){
	$get_search_type = get_query_var( 'type' );
}


$collection_type = isset( $_GET['collection_type'] ) ? $_GET['collection_type'] : OVACOLL_Settings::archive_collection_type();

$collection_heading = OVACOLL_Settings::archive_collection_heading();
$collection_desc = OVACOLL_Settings::archive_collection_desc();

?>

<div class="wrap_archive_masonry">

	<div class="archive_collection <?php echo esc_attr($collection_type);?>">
		
		<div class="heading_archive_coll">
			<h1 class="title_collection second_font"><?php echo $collection_heading; ?></h1>
			<p class="desc_collection second_font"><?php echo $collection_desc; ?></p>
		</div>

		<div class="search_archive_coll">
			<form action="<?php echo esc_url(get_post_type_archive_link( 'collection' )) ?>" id="search_collection" method="GET" name="search_collection" autocomplete="off">
				<div class="coll_artist">
					<select name="coll_artist">
						<?php $search_all_artist .= '<option value="" '.$selected.'>'.esc_html__('All Artist', 'ova-collection').'</option>' ; ?>
						<?php if( $artists->have_posts() ): while( $artists->have_posts() ): $artists->the_post();
							$post_slug = $post->post_name;
							$selected =	$get_search_artist == $post_slug ? 'selected' : '';
							$search_all_artist .= '<option value="'.$post_slug.'" '.$selected.'>'.get_the_title().'</option>' ;
						endwhile; endif; wp_reset_postdata(); ?>
						<?php echo $search_all_artist; ?>
					</select>
				</div>
				<div class="ovacoll_location_search"><?php $dropdown_args = apply_filters( 'OVACOLL_location', $get_search_location ); ?></div>
				<div class="ovacoll_type_search"><?php $dropdown_args = apply_filters( 'OVACOLL_type', $get_search_type ); ?></div>
				<input type="hidden" name="post_type" value="collection">
				<input type="hidden" name="search_collection" value="search-collection">
				<input class="ovacoll_submit" type="submit" value="<?php esc_html_e( 'Find Collection', 'ova-collection' ); ?>" />
			</form>
		</div>

		
		<?php if($collections->have_posts() ) : ?>
			<div class="content_archive_coll <?php echo esc_attr( $collection_type );?>">
				<?php while ( $collections->have_posts() ) : $collections->the_post(); ?>
					<?php 
					$id = get_the_id();

					$collection_year_number = get_post_meta( $id, 'collection_year_number', true );

					$collection_artist  = get_post_meta( $id, 'collection_artist', true );


					$args_artist = array(
						'post_type'      => 'artist',
						'posts_per_page' => '-1',
						'post_name__in'  => $collection_artist,
					);

					$artists = get_posts( $args_artist );

					$value_artist = '';
					
					?>

					<div class="items_archive_coll">
						<div class="wrapper-content">
							<div class="img">
								<?php if( has_image_size( 'shop_single' ) ){ ?>
									<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'shop_single', '' ); ?></a>
								<?php }else{ ?>
									<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'medium_large', '' ); ?></a>
								<?php } ?>
								
							</div>
							<div class="desc">
								<h2 class="title second_font">
									<a href="<?php the_permalink(); ?>">
										<?php echo get_the_title(); ?>, <?php echo esc_attr( $collection_year_number ); ?>
									</a>
								</h2>
								
								<div class="artists">
										
									<?php 

										foreach ($artists as $value) {

											$artist_id = $value->ID;
											$artist_link = get_the_permalink( $artist_id );
											$artist_title = get_the_title( $artist_id );
										
											$value_artist .= '<a href=" '.$artist_link.' ">'.$artist_title.'</a>'.', ' ;

										}
										echo substr($value_artist, 0, -2) ;

									 ?>

									
									
								</div>
							</div>
						</div>
					</div>
					
				<?php endwhile; ?>
			</div> 
			<?php else: ?>
				<div class="search_not_found">
					<?php esc_html_e( 'Not Found Collection', 'ova-collection' ); ?>
				</div>
			<?php endif; wp_reset_postdata(); ?>

			<?php ovaev_pagination_plugin1($collections); ?>

		</div>

	</div>


	<?php get_footer( );
