<?php
// Display Manage Booking
function ovamt_display_booking(){

   


	//Create an instance of our package class...
    $manage_booking = new List_Booking();

    $ticket_product = OVAMT_Settings::ovamt_product_slug();

    $ticket = ovatm_get_products($ticket_product);
    if ( $ticket->have_posts() ) : while ( $ticket->have_posts() ) : $ticket->the_post();
        $default_product_id = get_the_id();
    endwhile;endif;wp_reset_postdata();


    //Fetch, prepare, sort, and filter our data...
    $manage_booking->prepare_items( );


    

    $current_room_id = isset( $_POST['room_id'] ) ? $_POST['room_id'] : $default_product_id;
    $room_code = isset( $_POST['room_code'] ) ? $_POST['room_code'] : '';
    
    $check_in_out = isset($_POST['check_in_out'] ) ? $_POST['check_in_out'] : '';
    $filter_order_status = isset($_POST['filter_order_status'] ) ? $_POST['filter_order_status'] : '';
   
    
    $from_day = isset( $_POST['from_day'] ) ? $_POST['from_day'] : '';
    $to_day = isset( $_POST['to_day'] ) ? $_POST['to_day'] : '';
    
    $date_format = OVAMT_Settings::ovamt_date_format(); 
?>
<div class="wrap">
    <form id="booking-filter" method="POST" action="<?php echo home_url('/').'wp-admin/admin.php?page=manage-ticket'; ?>">
    	<h2><?php esc_html_e( 'Manage Ticket', 'ovamt' ); ?></h2>
    	<div class="booking_filter">
    		
            

    		<input type="text" name="from_day" data-date_format="<?php echo $date_format; ?>" value="<?php echo $from_day ?>" placeholder="<?php esc_html_e('From day', 'ovamt'); ?>" class="ovamt_date" autocomplete="off"/>
    		
    		<?php esc_html_e('to','ovamt'); ?>
    		
    		<input type="text" name="to_day" data-date_format="<?php echo $date_format; ?>" value="<?php echo $to_day ?>" placeholder="<?php esc_html_e('To day', 'ovamt'); ?>" class="ovamt_date" autocomplete="off" />


           
    		
    		

    		<select name="room_id">
    			<option value="" <?php selected( '', $current_room_id, 'selected'); ?>><?php esc_html_e( '-- Choose Product --', 'ovamt' ); ?></option>

    			<?php 
    				if ( $ticket->have_posts() ) : while ( $ticket->have_posts() ) : $ticket->the_post(); ?>
    					<option value="<?php the_id(); ?>" <?php selected( get_the_id(), $current_room_id, 'selected'); ?>><?php the_title(); ?></option>
    				<?php endwhile;endif;wp_reset_postdata();
    			?>
    			
    		</select>

            <select name="filter_order_status">
                <option value=""><?php esc_html_e( '-- Order Status --', 'ovamt' ); ?></option>
                <option value="wc-completed" <?php echo ( $filter_order_status == 'wc-completed' ) ? 'selected' : ''; ?> ><?php esc_html_e( 'Completed', 'ovamt' ); ?></option>
                <option value="wc-processing" <?php echo ( $filter_order_status == 'wc-processing' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Processing', 'ovamt' ); ?></option>
                <option value="wc-on-hold" <?php echo ( $filter_order_status == 'wc-on-hold' ) ? 'selected' : ''; ?>><?php esc_html_e( 'On hold', 'ovamt' ); ?></option>
                <option value="wc-cancelled" <?php echo ( $filter_order_status == 'wc-cancelled' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Cancel', 'ovamt' ); ?></option>
                
            </select>
    		

    		

			&nbsp;&nbsp;&nbsp;
			<button type="submit" class="button"><?php esc_html_e( 'Filter', 'ovamt' ); ?></button>

    	</div>
        <!-- For plugins, we also need to ensure that the form posts back to our current page -->
        
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <!-- Now we can render the completed list table -->
        <?php $manage_booking->display() ?>
    </form>
</div>
<?php }
