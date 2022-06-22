<?php if ( !defined( 'ABSPATH' ) ) exit();
get_header( );

$exhibition = apply_filters( 'OVAEX_exhibition', 10 );

$exhibition_type = ( OVAEX_Settings::archive_exhibition_type() ) ? OVAEX_Settings::archive_exhibition_type() : 'grid';
$exhibition_type =  isset( $_GET['exihibition_type'] ) ? $_GET['exihibition_type'] : $exhibition_type;

$archive_exhibition_heading = OVAEX_Settings::archive_exhibition_heading();
$archive_exhibition_desc    = OVAEX_Settings::archive_exhibition_desc();
$date                       = OVAEX_Settings::ovaex_format_date_frontend();
?>

<div class="container">
	<div class="exhibition_arc">

		<div class="heading_archive_exh">
			<?php 
			$archive_exhibition_heading   = OVAEX_Settings::archive_exhibition_heading();
			$archive_exhibition_desc      = OVAEX_Settings::archive_exhibition_desc();

			if ($archive_exhibition_heading != '') {
				?>
				<h1 class="title_exh second_font"><?php echo $archive_exhibition_heading; ?></h1>
				<?php
			}
			if ($archive_exhibition_desc != '') {
				?>
				<p class="desc_exh second_font"><?php echo $archive_exhibition_desc; ?></p>
				<?php
			}
			?>
		</div>
		<div class="wrap-content">
			
			<?php if( $exhibition->have_posts() ) : while( $exhibition->have_posts() ) : $exhibition->the_post();
				$post_ID = get_the_ID();

				$ex_start_date = get_post_meta( $post_ID, 'ex_start_date', true );
				$ex_end_date   = get_post_meta( $post_ID, 'ex_end_date', true );

				$date_start_fm = $ex_start_date != '' ? date_i18n($date, $ex_start_date ) : '';
				$date_end_fm   = $ex_end_date != '' ? date_i18n($date, $ex_end_date ) : '';

				$day_week_st   = $ex_start_date != '' ? date_i18n( 'l', $ex_start_date ) : ''; 
				$day_week_end  = $ex_end_date != '' ? date_i18n( 'l', $ex_end_date ) : '';

				$time_start    = $ex_start_date != '' ? date_i18n(get_option('time_format'), $ex_start_date ) : ''; 
				$time_end      = $ex_end_date != '' ? date_i18n(get_option('time_format'), $ex_end_date ) : ''; 
				?>
				<div class="post-items <?php echo esc_attr($exhibition_type);?>">
					<div class="img-exhibition">
						<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_post_thumbnail(); ?></a>
					</div>
					<div class="content">
						<h3 class="second_font"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h3>
						<div class="times">
							<?php if( $date_start_fm === $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){ ?>
								<span><?php echo esc_html($date_start_fm) .'&nbsp'.'&#47;'.'&nbsp'. esc_html($time_start) .'&nbsp'.'&#45;'.'&nbsp'. esc_html($time_end);?></span>
							<?php } elseif( $date_start_fm != $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){ ?>
								<span><?php echo esc_html($date_start_fm);?> -</span>
								<span><?php echo esc_html($date_end_fm);?></span>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php endwhile; endif; wp_reset_postdata(); ?>

			<?php ovaex_pagination_plugin($exhibition); ?>

		</div>

	</div>
</div>
<?php get_footer( );
