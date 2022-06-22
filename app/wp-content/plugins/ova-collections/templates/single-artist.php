<?php if ( !defined( 'ABSPATH' ) ) exit();
get_header( );
global $post;

?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	<?php 

	$slug_artist = $post->post_name;

	$id = get_the_id();
	
	$artist_skill = get_post_meta( $id, 'artist_skill', true ) ? $artist_skill = get_post_meta( $id, 'artist_skill', true ) : '';
	
	$artist_phone = get_post_meta( $id, 'artist_phone', true ) ? $artist_phone = get_post_meta( $id, 'artist_phone', true ) : '';
	
	$artist_email = get_post_meta( $id, 'artist_email', true ) ? $artist_email = get_post_meta( $id, 'artist_email', true ) : '';
	
	$collections = apply_filters( 'OVACOLL_collection_get', $slug_artist );

	$background_heading_archive_aritst = OVACOLL_Settings::background_heading_archive_aritst();
	$image_attributes = wp_get_attachment_image_src( $background_heading_archive_aritst, '' );
	$src = $image_attributes[0];
	?>
	<?php if ($background_heading_archive_aritst != '') : ?>
		<div class="heading_artist" style="background-image: url(<?php echo esc_attr($src); ?>); ">
			<div class="container">
				<h2><?php echo get_the_title(); ?></h2>
			</div>
		</div>
	<?php endif ?>

	<div class="single_artist">
		<div class="container">

			<!-- <div class="back_artists">
				<a href="<?php echo esc_url(get_post_type_archive_link( 'artist' )); ?>"><?php esc_html_e( 'Back to all Artists', 'ova-collection' );?></a>
			</div> -->

			<div class="intro">
				<div class="image"><?php the_post_thumbnail( '' ); ?></div>
				<div class="desc">
					<h2 class="name second_font"><?php echo get_the_title(); ?></h2>

					<?php if ($artist_skill != '') { ?>
						<div class="skill"><?php echo esc_html($artist_skill);  ?></div>
					<?php } ?>

					<?php if ($artist_phone != '') { ?>
						<span><a class="phone" href="tel:<?php echo preg_replace('/\s+/', '', $artist_phone);  ?>"><?php echo esc_html($artist_phone . ' /');  ?></a></span>
					<?php } ?>

					<?php if ($artist_email != '') { ?>
						<a href="mailto:<?php echo esc_html($artist_email); ?>" class="email"><?php esc_html_e( 'Email', 'ova-collection' );  ?></a>
					<?php } ?>

					<div class="content"><?php the_content(); ?></div>

				</div>
			</div>
		</div>

		<div class="work">
			<div class="container">
				<h1 class="title second_font "><?php echo esc_html__('Some of Works','ova-collection');  ?></h1>
			</div>
			<div class="wrap_archive_masonry">

				<div class="wrap_items">
					<?php if($collections->have_posts() ) : while ( $collections->have_posts() ) : $collections->the_post(); ?>

						<div class="items">
							<a class="wrapper-content" href="<?php echo get_the_permalink(); ?>" >
								<?php the_post_thumbnail(); ?>
								<div><?php echo get_the_title(); ?></div>
							</a>
						</div>

					<?php endwhile;endif; wp_reset_postdata(); ?>

				</div>
			</div>

		</div>

		<div class="container">
			<?php
			
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			?>
		</div>
	</div>

<?php endwhile; endif; wp_reset_postdata();?>


<?php get_footer( );