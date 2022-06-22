<?php if ( !defined( 'ABSPATH' ) ) exit();

get_header();

global $post;

$artists = apply_filters( 'OVACOLL_artist', '' );


?>
<div class="container">
	<div class="archive_artist">

		<div class="heading_archive_artist">
			<?php 
			$archive_artist_heading = OVACOLL_Settings::archive_artist_heading();
			$archive_artist_desc    = OVACOLL_Settings::archive_artist_desc();

			if ($archive_artist_heading != '') {
				?>
				<h1 class="heading_artist second_font"><?php echo $archive_artist_heading; ?></h1>
				<?php
			}
			if ($archive_artist_desc != '') {
				?>
				<p class="desc_artist second_font"><?php echo $archive_artist_desc; ?></p>
				<?php
			}
			?>
		</div>
		
		<div class="content">
			<?php if($artists->have_posts() ) : while ( $artists->have_posts() ) : $artists->the_post(); ?>
				
				<div class="items">
					<div class="wrap_item">
						<?php

						$id = get_the_id();

						$collection_artist  = get_post_meta( $id , 'collection_artist' , true ); 

						$artist_skill = get_post_meta( $id, 'artist_skill', true );

						$artist_phone = get_post_meta( $id, 'artist_phone', true );

						$artist_email = get_post_meta( $id, 'artist_email', true );
						?>


						<a class="img" href="<?php echo get_the_permalink(); ?>">
							<?php echo get_the_post_thumbnail(); ?>
						</a>

						<a class="name second_font" href="<?php echo get_the_permalink(); ?>">
							<?php echo get_the_title(); ?>
						</a>


						<?php if ($artist_skill != '') { ?>
							<div class="skill"> 
								<?php echo esc_html($artist_skill);  ?>
							</div>
						<?php } ?>

						<div class="contact">
							<?php if ($artist_phone != '') { ?>
								<span><a class="phone" href="tel:<?php echo preg_replace('/\s+/', '', $artist_phone);  ?>"><?php echo esc_html($artist_phone . ' /');  ?></a></span>
							<?php } ?>

							<?php if ($artist_email != '') { ?>
								<a href="mailto:<?php echo esc_html($artist_email); ?>" class="email"> 
									<?php esc_html_e( 'Email', 'ova-collection' );  ?>
								</a>
							<?php } ?>
						</div>
					</div>
					

				</div>

			<?php endwhile; endif; wp_reset_postdata(); ?>
		</div>
		
		<?php ovaev_pagination_plugin1($artists); ?>

	</div>
</div>


<?php get_footer( );
