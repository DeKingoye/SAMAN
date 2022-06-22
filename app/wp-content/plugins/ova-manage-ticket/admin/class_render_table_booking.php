<?php if ( !defined( 'ABSPATH' ) ) exit();

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class List_Booking extends WP_List_Table {

    function __construct(){

        global $page;

        
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'bookings',     //singular name of the listed records
            'plural'    => 'bookings',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'id':
            case 'customer':
            case 'date':
            case 'time':
            case 'name':
            case 'order_status':
            case 'order_id':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

    function column_order_status($item){

        switch ($item['order_status']) {
            case 'processing':
                $order_status_text = esc_html__( 'Processing', 'ovamt' );
                break;
            case 'completed':
                $order_status_text = esc_html__( 'Completed', 'ovamt' );
                break;
            case 'on-hold':
                $order_status_text = esc_html__( 'On hold', 'ovamt' );
                break;
            case 'cancelled':
                $order_status_text = esc_html__( 'Cancel', 'ovamt' );
                break;            
            
            default:
                $order_status_text = esc_html__( 'Update Order', 'ovamt' );
                break;
        }
        
        //Build row actions
        

        return sprintf('<span>%1$s</span>',
            '<mark class="order-status status-'.$item['order_status'].' tips"><span>'.$order_status_text.'</span></mark>'
            
        );
        
        
    }

    function column_id($item){
    	//Build row actions
        
    	return sprintf('<span>%1$s</span>',
            '<a target="_blank" href="'.home_url('/').'wp-admin/post.php?post='.$item['id'].'&action=edit">'.$item['id'].'</a>'
        );
    }
    
    function column_customer($item){
        //Build row actions
        // var_dump($item);
        return sprintf('<span>%1$s</span>%2$s',
           $item['customer'], '<br/> <a target="_blank" title="view more" href="'.home_url('/').'wp-admin/post.php?post='.$item['id'].'&action=edit">'.esc_html__('view more','ovamt').'</a>'
        );
    }
    

    function get_columns(){
        $columns = array(
            'id'     	=> __( 'Order ID','ovamt' ),
            'customer'  => __( 'Customer','ovamt' ),
            'date'	=> __( 'Date','ovamt' ),
            'time'	=> __( 'Time','ovamt' ),
            'name'	=> __( 'Product','ovamt' ),
            'order_status'    => __( 'Order Status','ovamt' ),
          
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'id'    		=> array('id',true),
            'customer' 		=> array('customer',false),
            'date'     	=> array('date',false),  //true means it's already sorted
            'time'     => array('time',false),  //true means it's already sorted
            'name'		=> array('name',false),  //true means it's already sorted
            'order_status'  		=> array('order_status',false),
            
        );
        return $sortable_columns;
    }



    function prepare_items() {
        global $wpdb; //This is used only if making any database queries

         $ticket_product = OVAMT_Settings::ovamt_product_slug();
        $ticket = ovatm_get_products($ticket_product);
        if ( $ticket->have_posts() ) : while ( $ticket->have_posts() ) : $ticket->the_post();
            $default_product_id = get_the_id();
        endwhile;endif;wp_reset_postdata();


        /**
         * First, lets decide how many records per page to show
         */
        $per_page = OVAMT_Settings::ovamt_pagi_num() ? OVAMT_Settings::ovamt_pagi_num() : '20';
        

        $ovamt_time = $ovamt_date = '';
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        // $this->process_bulk_action();

        $data = array();

        $filter_order_status =  isset( $_POST['filter_order_status'] ) ? $_POST['filter_order_status'] : '';

        if( $filter_order_status != '' ){
            $order_status = array( $filter_order_status );
        }else{
            $order_status = array( 'wc-processing','wc-completed', 'wc-half-completed', 'wc-on-hold', 'wc-cancelled' );    
        }

        

        $product_query = ( isset( $_POST['product_id'] ) && $_POST['product_id'] != '' ) ? 'AND order_item_meta.meta_value = '.$_POST['product_id'] : 'AND order_item_meta.meta_value = '.$default_product_id;


        $result = $wpdb->get_col("
	        SELECT Distinct order_items.order_id
	        FROM {$wpdb->prefix}woocommerce_order_items as order_items
	        LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id
	        LEFT JOIN {$wpdb->posts} AS posts ON order_items.order_id = posts.ID
	        WHERE posts.post_type = 'shop_order'
	        AND posts.post_status IN ( '" . implode( "','", $order_status ) . "' )
	        AND order_items.order_item_type = 'line_item'
	        AND order_item_meta.meta_key = '_product_id'
	        $product_query
	    ");

	    $from_day = isset( $_POST['from_day'] ) ? strtotime( str_replace('/', '-', $_POST['from_day'])  ) : '';
    	$to_day = isset( $_POST['to_day'] ) ? strtotime( str_replace('/', '-', $_POST['to_day'])  ) : '';
	    
	    
        $check = true;

	    foreach ($result as $key => $value) {

	        // Get Order Detail by Order ID
	        $order = wc_get_order($value);
	        

	        // Get Meta Data type line_item of Order
	        $order_line_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );

	        
	       
	        // For Meta Data
	        foreach ( $order_line_items as $item_id => $item ) {

	            $name = $item->get_name();
	            
	            foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {

	                if( $meta->key == 'ovamt_date' ){
	                    $ovamt_date = date_i18n( get_option('date_format'), strtotime( str_replace('/', '-', $meta->value) ) );
	                }
                    if( $meta->key == 'ovamt_time' ){
                        $ovamt_time = $meta->value;
                    }
	                
	            }

                if( $ovamt_date != '' ){

                    $ovamt_date_timep = strtotime( $ovamt_date );
                    
                    if( $from_day != '' && $to_day != '' ){
                        $check = ( $from_day <=  $ovamt_date_timep && $ovamt_date_timep <= $to_day ) ? true : false;
                    }    
                }
                
                // echo "<pre>";
                // var_dump($order);


	            if( $check){
	            	$data[] = array(
		                'id'            => $order->get_ID(),
		                'customer'     	=> $order->get_formatted_billing_full_name().'<br/>'.$order->get_billing_phone().'<br/>'.$order->get_billing_email(),
    		            'date'          => $ovamt_date,
    		            'time'    	    => $ovamt_time,
    		            'name'		    => $name,
		                'order_status'  => $order->get_status(),
		                
		            );
	            }
	            
	            
	        }
	    }



       $sortable = $this->get_sortable_columns();
       function get_sortable_columns() {
          $sortable_columns = array(
            'id'  => array('id',false),
            'created' => array('created',false)
          );
          return $sortable_columns;
        }


        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'id'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        //usort($data, 'usort_reorder');

        
        $current_page = $this->get_pagenum();
        
        $total_items = count($data);
        
       
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
       
        $this->items = $data;
        
       
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }


}
