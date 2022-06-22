<?php if ( !defined( 'ABSPATH' ) ) exit();
get_header( );

$post_ID = get_the_ID();
$date = OVAEX_Settings::ovaex_format_date_frontend_single();
// Get Data Metabox 

$ex_start_date = get_post_meta( $post_ID, 'ex_start_date', true );
$ex_end_date   = get_post_meta( $post_ID, 'ex_end_date', true );

$date_start_fm = $ex_start_date != '' ? date_i18n($date, $ex_start_date ) : '';
$date_end_fm   = $ex_end_date != '' ? date_i18n($date, $ex_end_date ) : '';

$day_week_st   = $ex_start_date != '' ? date_i18n( 'l', $ex_start_date ) : ''; 
$day_week_end  = $ex_end_date != '' ? date_i18n( 'l', $ex_end_date ) : '';

$time_start    = $ex_start_date != '' ? date_i18n(get_option('time_format'), $ex_start_date ) : ''; 
$time_end      = $ex_end_date != '' ? date_i18n(get_option('time_format'), $ex_end_date ) : ''; 


$ex_location   = get_post_meta( $post_ID,'ex_location', true );
$ex_curator    = get_post_meta( $post_ID,'ex_curator', true );
$ex_duaration  = get_post_meta( $post_ID,'ex_duaration', true );

$ovaex_member_book_link  = get_post_meta( $post_ID, 'ovaex_member_book_link', true );
$ovaex_target_member_book  = get_post_meta( $post_ID, 'ovaex_target_member_book', true );
$ovaex_order_book_link  = get_post_meta( $post_ID, 'ovaex_order_book_link', true );
$ovaex_target_order_book  = get_post_meta( $post_ID, 'ovaex_target_order_book', true );

$link_ex = ( isset( $_GET[ apply_filters('ex_back_param', 'back') ] ) && $_GET[ apply_filters('ex_back_param', 'back') ] == apply_filters('ex_back_val', 'ago') ) ? '' : get_post_type_archive_link( 'exhibition' );

?>
<div class="single_exhibition">
	<div class="container"> 
		<div class="title_top">
			<?php if( $link_ex ){ ?>

				<a href="<?php echo esc_url(get_post_type_archive_link( 'exhibition' )); ?>" class="back_event"><?php esc_html_e( 'Go to all Exhibitions', 'ovaex' );?></a>
			<?php }else{ ?>
				<a href="#" onclick="history.go(-1)" class="back_event"><?php esc_html_e( 'Back to Exhibitions', 'ovaex' );?></a>
			<?php } ?>

			<h1 class="second_font"><?php the_title(); ?></h1>
			<div class="value_mid">
				<?php
				if( $date_start_fm == $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){
					echo '<span class="exhibition-date">'.$day_week_st.',&nbsp;'.$date_start_fm.'</span>';
				} elseif( $date_start_fm != $date_end_fm && $date_start_fm != '' && $date_end_fm != ''){
					echo '<span class="exhibition-date">'.$date_start_fm.'</span>'.'&nbsp;&#45;&nbsp;'.'<span class="exhibition-date">'.$date_end_fm.'</span>';
				}
				?>
			</div>
		</div>
		<div class="exhibition_content">
			<div class="wrap_content">
				<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php if( has_post_thumbnail() ){ ?>
						<div class="feature_img">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php } ?>
					<div class="content">
						<?php the_content(); ?>
					</div>
				<?php endwhile;endif; ?>
			</div>
			<div class="line">
				<div class="wrapper_order">
					<div class="order_ticket">
						<a class="member" href="<?php echo esc_html( $ovaex_member_book_link ); ?>" target="<?php echo esc_html( $ovaex_target_member_book ); ?>"><?php esc_html_e('Become a member','ovaex');?></a>
						<a class="button_order" href="<?php echo esc_html( $ovaex_order_book_link ); ?>" target="<?php echo esc_html( $ovaex_target_order_book ); ?>"><?php esc_html_e('Order Ticket','ovaex');?></a>
						<ul class="info_order">
							<li>
								<span class="label"><?php esc_html_e('Date:','ovaex');?></span>
								<?php if( $date_start_fm === $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){ ?>
									<span><?php echo esc_html($date_start_fm);?></span>
									<span><?php echo esc_html($time_start) .'&nbsp'.'&#45;'.'&nbsp'. esc_html($time_end);?></span>
								<?php } elseif( $date_start_fm != $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){ ?>
									<span><?php echo esc_html($date_start_fm) .'&nbsp;&#45;&nbsp;'. esc_html($date_end_fm);?></span>
								<?php }
								?>

							</li>
							<?php if( $ex_location != '' ) : ?>
								<li><span class="label"><?php esc_html_e( 'Location:', 'ovaex' );?></span><span><?php echo esc_html($ex_location);?></span></li>
							<?php endif; ?>
							<?php if( $ex_curator != '' ) : ?>
								<li><span class="label"><?php esc_html_e( 'Curators:', 'ovaex');?></span><span><?php echo esc_html($ex_curator); ?></span></li>
							<?php endif; ?>
							<?php if( $ex_duaration != '' ) : ?>
								<li><span class="label"><?php esc_html_e( 'Duration:', 'ovaex');?></span><span><?php echo esc_html($ex_duaration); ?></span></li>
							<?php endif; ?>
						</ul>
						<?php if( has_filter( 'ova_share_social' ) ){ ?>
							<div class="share_social">
								<i class="fa fa-share-alt"></i>
								<span class="ova_label"><?php esc_html_e('Share', 'ovaex'); ?></span>
								<?php echo apply_filters('ova_share_social', get_the_permalink(), get_the_title() ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $gallery_slide = get_post_meta( $post_ID, 'ovaex_gallery_id', true ); if( $gallery_slide ): ?>
<div class="gallery_exhibition">
	<div class="titlte_glr">
		<div class="container">
			<h3 class="second_font"><?php esc_html_e( 'Image Gallery', 'ovaex' );?></h3>
		</div>
	</div>
	<div class="gallery_slide owl-carousel">
		<?php foreach ($gallery_slide as $items ) {
			$img_url = wp_get_attachment_image_url( $items, 'large' );
			?>
			<div class="items">
				<img class="owl-lazy" data-src="<?php echo esc_url($img_url);?>" />
			</div> 
		<?php } ?>
	</div>
</div>
<?php endif; ?>


<?php $exhibition = apply_filters( 'OVAEX_related_ex', array($post_ID) ); ?>
<?php if( $exhibition->have_posts() ){  ?>
	<div class="related_post">
		<div class="container">	
			<div class="related_ex">
				
				<h2 class="second_font"><?php esc_html_e( 'Related Exhibitions', 'ovaex' ); ?></h2>
				
				<div class="wrap-content">
					
					<?php while( $exhibition->have_posts() ): $exhibition->the_post(); ?>

						<?php
						$id = get_the_id();
						$ex_start_date = get_post_meta( $id, 'ex_start_date', true );
						$ex_end_date   = get_post_meta( $id, 'ex_end_date', true );
						$date_start_fm = $ex_start_date != '' ? date_i18n(get_option('date_format'), $ex_start_date ) : '';
						$date_end_fm   = $ex_end_date != '' ? date_i18n(get_option('date_format'), $ex_end_date ) : '';
						$time_start    = $ex_start_date != '' ? date_i18n(get_option('time_format'), $ex_start_date ) : ''; 
						$time_end      = $ex_end_date != '' ? date_i18n(get_option('time_format'), $ex_end_date ) : ''; 
						?>
						<div class="post-items">
							<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_post_thumbnail('medium_large'); ?></a>
							<div class="content">
								<h3 class="second_font"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h3>
								<div class="times">
									<?php if( $date_start_fm === $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){ ?>
										<span><?php echo esc_html($date_start_fm) .'&nbsp'.'&#47;'.'&nbsp'. esc_html($time_start) .'&nbsp'.'&#45;'.'&nbsp'. esc_html($time_end);?></span>
									<?php } elseif( $date_start_fm != $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){ ?>
										<span><?php echo esc_html($date_start_fm) .'&nbsp'.'&#45;'.'&nbsp'. esc_html($time_start);?></span>
										<span><?php echo esc_html($date_end_fm) .'&nbsp'.'&#45;'.'&nbsp'. esc_html($time_end);?></span>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
					
				</div>

			</div>
		</div>
	</div>
<?php } ?>

<div class="container">
	<?php
	
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	?>
</div>

<div class="next-prev-nav">
	<div class="container">
		<div class="row">
			<div class="nav-prev text-left">
				<?php previous_post_link( '<div class="nav-previous-post">%link</div>','<i class="ti-angle-left"></i><span class="label-event">' . esc_html__( 'Prev Exhibition', 'ovaex' ) . '</span> <span class="second_font">%title</span>' ); ?>
			</div>
			<div class="nav-next text-right">
				<?php next_post_link( '<div class="nav-next-post">%link</div>', '<span class="label-event">'. esc_html__( 'Next Exhibition', 'ovaex' ) . '</span> <span class="second_font">%title</span><i class="ti-angle-right"></i>' ); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer( );