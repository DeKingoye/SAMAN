<?php if ( !defined( 'ABSPATH' ) ) exit();
get_header( );
global $post;
?>

<?php 

$collection_artist           = get_post_meta( $post->ID,'collection_artist', true ) ? get_post_meta( $post->ID,'collection_artist', true ) : '';
$collection_artists          = apply_filters( 'OVACOLL_artist', '' );

$collection_year_number      = get_post_meta( $post->ID, 'collection_year_number', true ) ? get_post_meta( $post->ID, 'collection_year_number', true ) : '';
$collection_year_text        = get_post_meta( $post->ID, 'collection_year_text', true ) ? get_post_meta( $post->ID, 'collection_year_text', true ) : '';

$collection_address          = get_post_meta( $post->ID, 'collection_address', true ) ? get_post_meta( $post->ID, 'collection_address', true ) : '';

$collection_marterial        = get_post_meta( $post->ID, 'collection_marterial', true ) ? get_post_meta( $post->ID, 'collection_marterial', true ) : '';

$collection_accession_number = get_post_meta( $post->ID, 'collection_accession_number', true ) ? get_post_meta( $post->ID, 'collection_accession_number', true ) : '';

$collection_dimensions       = get_post_meta( $post->ID, 'collection_dimensions', true ) ? get_post_meta( $post->ID, 'collection_dimensions', true ) : '';

$collection_credit           = get_post_meta( $post->ID, 'collection_credit', true ) ? get_post_meta( $post->ID, 'collection_credit', true ) : '';

$collection_file_download    = get_post_meta( $post->ID, 'collection_file_download', true ) ? get_post_meta( $post->ID, 'collection_file_download', true ) : '';
$link_download               = wp_get_attachment_url( $collection_file_download );

$collection_visual_desc      = get_post_meta( $post->ID, 'collection_visual_desc', true ) ? get_post_meta( $post->ID, 'collection_visual_desc', true ) : '';

$collection_history          = get_post_meta( $post->ID, 'collection_history', true ) ? get_post_meta( $post->ID, 'collection_history', true ) : '';

$collection_publication      = get_post_meta( $post->ID, 'collection_publication', true ) ? get_post_meta( $post->ID, 'collection_publication', true ) : '';

$link = get_the_permalink();
$title = get_the_title(); 


$array_artist = array(); 
if($collection_artists->have_posts() ) : while ( $collection_artists->have_posts() ) : $collection_artists->the_post();
	if (in_array($post->post_name, $collection_artist) == true ) {
		array_push( $array_artist, array( get_the_permalink(), get_the_title() ) ) ;
	}
endwhile;endif; wp_reset_postdata(); 

$value_artist = '';

foreach ( $array_artist as $v1) {
	$k1 = $v1[0];
	$k2 = $v1[1];
	$value_artist .= '<a class="value_artist" href="'. $k1 .'"> '. $k2 .'</a>' ;
	$value_artist .= ',';
}


?>

<div class="single_collection">

	<div class="collection_intro">

		<div class="back_collections">
			<a href="<?php echo esc_url(get_post_type_archive_link( 'collection' )); ?>"><?php esc_html_e( 'Go to all Collections', 'ova-collection' );?></a>
		</div>

		<div class="image">
			<?php the_post_thumbnail( '' ); ?>
			<div class="caption_img"><?php the_post_thumbnail_caption(); ?></div>
		</div>
		<ul class="buttons">
			<li class="share">
				<i class="ti-share"></i>
				<?php echo apply_filters( 'ova_share_social', $link, $title  ); ?>
			</li>
			<li class="download">
				<a href="<?php echo esc_attr( $link_download ); ?>" download><i class="ti-download"></i></a>
			</li>
			<li >
				<div class="fullscreen">
					<a href="<?php echo get_the_post_thumbnail_url(); ?>" rel="prettyPhoto"><i class="ti-fullscreen" ></i></a>
				</div>
			</li>
		</ul>
	</div>


	<!-- Single Content -->
	<div class="container">
		<div class="collection_content">

			<!-- Collection Top -->
			<div class="collection_top">
				<h1 class="title_top second_font"><?php echo get_the_title(); ?></h1>
				<div class="desc">
					
					<?php if ($value_artist != '') { ?>
						<span class="artist">
							<?php echo $value_artist ?>
						</span>
					<?php } ?>
					
					
					<?php if ($collection_year_number != '') { ?>
						<span class="year_number"> 
							<?php echo esc_attr( $collection_year_number . ',' );  ?>
						</span>
					<?php } ?>
					

					<?php
					$location = get_the_terms( get_the_id(), 'location') ;
					if ($location != '') {
						foreach ( $location as $value ) {
							$key_location[] = $value->name;
						} ?>
						<span class="location">
							<?php echo (join( ", ", $key_location)); ?>
						</span>
					<?php } ?>
					
				</div>
				<div class="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
						the_content();
					endwhile; else: '' ; endif; ?>

				</div>
			</div> <!-- END Collection Top -->


			<!-- Collection Middle -->
			<div class="collection_mid">
				<ul>
					<li>
						<label class="title_mid">Artist</label>
						<span class="value_mid">
							<?php echo substr($value_artist, 0, -1) ?> 
						</span>
					</li>
					<li>
						<label class="title_mid"><?php esc_html_e('Year:','ova-collection');?></label>
						<span class="value_mid"><?php echo esc_attr( $collection_year_text ); ?></span>
					</li>
					<li>
						<label class="title_mid"><?php esc_html_e('Address:','ova-collection');?></label>
						<span class="value_mid"><?php echo esc_attr( $collection_address ); ?></span>
					</li>
					<li>
						<label class="title_mid"><?php esc_html_e('Type:','ova-collection');?></label>
						<span class="value_mid">
							<?php 
							$taxonomy = 'type';
							$terms = get_the_terms( get_the_ID(),$taxonomy );
							if ( $terms && ! is_wp_error($terms) ) :
								$tslugs_arr = array();
								foreach ($terms as $term) {
									$tslugs_arr[] = $term->name;
								}
								$terms_slug_str = join( ", ", $tslugs_arr); ?>
								<?php echo esc_html($terms_slug_str);?>
							<?php endif; ?>		
						</span>
					</li>
					<li>
						<label class="title_mid"><?php esc_html_e('Material:','ova-collection');?></label>
						<span class="value_mid"><?php echo esc_attr( $collection_marterial ); ?></span>
					</li>
					<li>
						<label class="title_mid"><?php esc_html_e('Accession Number:','ova-collection');?></label>
						<span class="value_mid"><?php echo esc_attr( $collection_accession_number ); ?></span>
					</li>
					<li>
						<label class="title_mid"><?php esc_html_e('Dimensions:','ova-collection');?></label>
						<span class="value_mid"><?php echo esc_attr( $collection_dimensions ); ?></span>
					</li>
					<li>
						<label class="title_mid"><?php esc_html_e('Credit:','ova-collection');?></label>
						<span class="value_mid"><?php echo esc_attr( $collection_credit ); ?></span>
					</li>
				</ul>
			</div><!-- END Collection Middle -->


			<!-- Collection Bottom -->
			<div class="collection_bottom">
				<div class="accordion" id="accordionExample">
					<div class="card">
						<button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<?php esc_html_e( 'Visual Description', 'ova-collection' ); ?>
							<i class="fas fa-angle-up"></i>
						</button>
						<div id="collapseOne" class="collapse show" >		
							<div class="content">
								<?php echo  $collection_visual_desc ; ?>
							</div>
						</div>
					</div>

					<div class="card">
						<button data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="collapsed">
							<?php esc_html_e( 'Timeline of Art History', 'ova-collection' ); ?>
							<i class="fas fa-angle-up"></i>
						</button>
						<div id="collapseTwo" class="collapse" >		
							<div class="content">
								<?php echo  $collection_history ; ?>

							</div>
						</div>
					</div>

					<div class="card">
						<button data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="collapsed">
							<?php esc_html_e( 'Publications', 'ova-collection' ); ?>
							<i class="fas fa-angle-up"></i>
						</button>
						<div id="collapseThree" class="collapse" >		
							<div class="content">
								<?php echo  $collection_publication ; ?>
							</div>
						</div>
					</div>
				</div>
			</div><!-- END Collection Bottom -->


			<div class="collection_comment">
				<?php
				
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</div>

		</div> <!-- End Single Content -->


	</div>
</div>






<?php get_footer( );
