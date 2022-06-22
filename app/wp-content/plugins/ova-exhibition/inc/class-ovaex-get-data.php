<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class OVAEX_get_data {
	public function __construct() {

		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ), 1, 1);

		add_filter( 'OVAEX_exhibition', array( $this, 'OVAEX_exhibition' ), 10, 1 );

		add_filter( 'OVAEX_related_ex', array( $this, 'OVAEX_related_ex' ), 10, 1 );

		add_action('wp_ajax_ovaex_loadmore', array( $this, 'ovaex_loadmore' ), 10 , 0 );
		add_action('wp_ajax_nopriv_ovaex_loadmore', array( $this, 'ovaex_loadmore' ), 10, 0 );

	}

	function upload_mimes($mimes){
		$mimes['zip'] = 'application/zip';
		$mimes['7z'] = 'application/x-7z-compressed';
		$mimes['apk'] = 'application/apk';
		$mimes['psd'] = 'image/vnd.adobe.photoshop';
		$mimes['rar'] = 'application/x-rar-compressed';
		$mimes['swf'] = 'application/x-shockwave-flash';
		$mimes['exe'] = 'application/x-msdownload';
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}


	private function OVAEX_query_base( $paged = '',  $show_past = 'yes', $order = 'ASC', $orderby = 'title' ){

		$args_base = $args_paged = $args_past = $args_orderby = array();

		$args_base = array(
			'post_type' => 'exhibition',
			'post_status' => 'publish',
			'order'	=> $order
		);

		$args_paged = ( $paged != '' ) ? array( 'paged' => $paged ) : array();

		if( $show_past == 'no' ){
			$args_past = array(
				'meta_query' => array(
					array(
						'key' => 'ex_end_date',
						'value' => current_time( 'timestamp' ),
						'compare' => '>'
					)
				)
			);
		}
		
		switch ($orderby) {
			case 'title':
			$args_orderby =  array( 'orderby' => 'title' );
			break;

			case 'exhibition_custom_sort':
			$args_orderby =  array( 'orderby' => 'meta_value', 'meta_key' => $orderby );
			break;

			case 'ex_start_date':
			$args_orderby =  array( 'orderby' => 'meta_value', 'meta_key' => $orderby );
			break;
			
			case 'ID':
			$args_orderby =  array( 'orderby' => 'ID');
			break;
			
			default:
			break;
		}
		return array_merge_recursive( $args_base, $args_paged, $args_orderby, $args_past );
	}


	public function OVAEX_exhibition(){

		$paged     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$show_past = OVAEX_Settings::ovaex_show_past();
		$order     = OVAEX_Settings::archive_exhibition_order();
		$orderby   = OVAEX_Settings::archive_exhibition_orderby();

		// Query base
		$args_basic = $this->OVAEX_query_base( $paged, $show_past, $order, $orderby );
		// var_dump($args_basic); die;
		$exhibition = new WP_Query( $args_basic );
		
		return $exhibition;
	}


	public function OVAEX_related_ex($params){

		// Query base
		$args_basic = array(
			'post_type' => 'exhibition',
			'post_status' => 'publish',
			'post__not_in' => $params,
			'posts_per_page' => 3
		);

		$related_ex = new WP_Query( $args_basic );
		
		return $related_ex;
	}


	public function ovaex_loadmore(){

		$type_action     = $_POST['type_action'];
		$paged           = $_POST['pageid'];
		$ovaex_perpage   = $_POST['ovaex_perpage'];
		$ovaex_order_by  = $_POST['ovaex_order_by'];
		$ovaex_oder      = $_POST['ovaex_oder'];
		$ovaex_data_post = $_POST['ovaex_data_post'];
		$data_columns    = $_POST['ovaex_data_columns'];
		
		$upcoming_day    = $_POST['upcoming_day'];

		switch( $ovaex_order_by ) {
			case 'title' : {
				$agr_order = [
					'orderby'   => 'title',
					'order'          => $ovaex_oder,
				];
				break;
			}
			case 'ID' : {
				$agr_order = [
					'orderby'   => 'ID',
					'order'          => $ovaex_oder,
				];
				break;
			}
			case 'exhibition_custom_sort' : {
				$agr_order = [
					'orderby'   => 'meta_value',
					'meta_key' => 'exhibition_custom_sort',
					'order'          => $ovaex_oder,
				];
				break;
			}
			case 'ex_start_date' : {
				$agr_order = [
					'orderby'   => 'meta_value',
					'meta_key' => 'ex_start_date',
					'order'          => $ovaex_oder,
				];
				break;
			}
			default: {
				$agr_order = [
					'orderby'   => 'ID',
					'order'          => $ovaex_oder,
				];
				break;
			}
		}


		if( $type_action == 'current' ){
			$ovaex_args = array(
				'post_type'      => $ovaex_data_post,
				'post_status'    => 'publish',
				'paged'          => $paged,
				'posts_per_page' => $ovaex_perpage,
				// 'orderby'        => $ovaex_order_by,
				// 'order'          => $ovaex_oder,
				'meta_query'     => array(
					array(
						'relation' => 'OR',
						array(
							'key' => 'ex_start_date',
							'value' => array( current_time('timestamp' )-1, current_time('timestamp' )+(24*60*60)+1 ),
							'type' => 'numeric',
							'compare' => 'BETWEEN'	
						),
						array(
							'relation' => 'AND',
							array(
								'key' => 'ex_start_date',
								'value' => current_time('timestamp' ),
								'compare' => '<'
							),
							array(
								'key' => 'ex_end_date',
								'value' => current_time('timestamp' ),
								'compare' => '>='
							)
						)
					)
				)
			);
		} elseif( $type_action == 'upcoming' ){
			$ovaex_args = array(
				'post_type'      => $ovaex_data_post,
				'post_status'    => 'publish',
				'paged'          => $paged,
				'posts_per_page' => $ovaex_perpage,
				// 'orderby'        => $ovaex_order_by,
				// 'order'          => $ovaex_oder,
				'meta_query'     => array(
					array(
						'relation' => 'AND',
						array(
							'key' => 'ex_start_date',
							'value' => current_time( 'timestamp' ),
							'compare' => '>'
						),
						array(
							'key' => 'ex_start_date',
							'value' => current_time( 'timestamp') + ( $upcoming_day * 24 * 60 * 60 ),
							'compare' => '<='
						)	
					)
				)
			);		
		} elseif( $type_action == 'past' ){
			$ovaex_args = array(
				'post_type'      => $ovaex_data_post,
				'post_status'    => 'publish',
				'paged'          => $paged,
				'posts_per_page' => $ovaex_perpage,
				// 'orderby'        => $ovaex_order_by,
				// 'order'          => $ovaex_oder,
				'meta_query'   => array(
					array(
						'key'     => 'ex_end_date',
						'value'   => current_time('timestamp' ),
						'compare' => '<',					
					),
				),
			);		
		}

		$ovaex_args = array_merge( $ovaex_args, $agr_order );
		
		$ovaex_more_post = new WP_Query( $ovaex_args );

		if ( $ovaex_more_post -> have_posts() ) : 

			while ($ovaex_more_post -> have_posts()) : $ovaex_more_post -> the_post();

				$post_ID = get_the_ID();

				$ex_start_date = get_post_meta( $post_ID, 'ex_start_date', true );
				$ex_end_date   = get_post_meta( $post_ID, 'ex_end_date', true );

				$date_start_fm = $ex_start_date != '' ? date_i18n(get_option('date_format'), $ex_start_date ) : '';
				$date_end_fm   = $ex_end_date != '' ? date_i18n(get_option('date_format'), $ex_end_date ) : '';

				$day_week_st   = $ex_start_date != '' ? date_i18n( 'l', $ex_start_date ) : ''; 
				$day_week_end  = $ex_end_date != '' ? date_i18n( 'l', $ex_end_date ) : '';

				$time_start    = $ex_start_date != '' ? date_i18n(get_option('time_format'), $ex_start_date ) : ''; 
				$time_end      = $ex_end_date != '' ? date_i18n(get_option('time_format'), $ex_end_date ) : '';

				$link_ex = add_query_arg( apply_filters('ex_back_param', 'back'), apply_filters('ex_back_val', 'ago'), get_the_permalink() );

				?> 
				<div class="post-items <?php echo esc_attr($data_columns);?>">
					<div class="img-exhibition">
						<a href="<?php echo esc_url($link_ex); ?>" title="<?php the_title();?>"><?php the_post_thumbnail(); ?></a>
					</div>
					<div class="content">
						<h3 class="second_font"><a href="<?php echo esc_url($link_ex); ?>" title="<?php the_title();?>"><?php the_title();?></a></h3>
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

				<?php
			endwhile; endif;  wp_reset_postdata(); wp_reset_query();
			die();
		}




	}
	new OVAEX_get_data();