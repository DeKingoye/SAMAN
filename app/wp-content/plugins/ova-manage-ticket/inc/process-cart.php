<?php






 // Add a Custom Field to Your Product
add_action( 'woocommerce_before_add_to_cart_button', 'ovamt_output_date_field', 10 );
function ovamt_output_date_field() {
    global $product;
 
    if ( $product->get_slug() == OVAMT_Settings::ovamt_product_slug() ): ?>
        
        <?php 
        $date_format = OVAMT_Settings::ovamt_date_format(); 
        $disabled_week_days = OVAMT_Settings::ovamt_disabled_week_days(); 
        $disabled_date = OVAMT_Settings::ovamt_disabled_date(); 
        $ovamt_lang = OVAMT_Settings::ovamt_lang();
        ?>

        <div class="extra_fields_ticket">

            <div class="ovamt_date-field">
                <label for="ovamt-engraving"><?php _e( 'Select Date', 'ovamt' ); ?></label>
                <input type="text" value="" autocomplete="off" id="ovamt_date" name="ovamt_date" data-disabled_date="<?php echo $disabled_date; ?>" data-disabled_week_days="<?php echo $disabled_week_days; ?>" data-message="<?php esc_html_e( 'Please choose date', 'ovamt' ); ?>" data-date_format="<?php echo $date_format; ?>" data-lang="<?php echo esc_attr($ovamt_lang); ?>" class="ovamt_date" placeholder="<?php _e( 'Select Date', 'ovamt' ); ?>">
            </div>
            
            <?php $ovamt_date_time = OVAMT_Settings::ovamt_date_time(); 
                if( $ovamt_date_time != '' ){
                    $times = explode('|', $ovamt_date_time );
            ?>
                    <div class="ovamt_date-field">
                        <label for="ovamt-engraving"><?php _e( 'Select Time', 'ovamt' ); ?></label>
                        <select name="ovamt_time" id="ovamt_time" data-message="<?php esc_html_e( 'Please choose time', 'ovamt' ); ?>">
                            <?php foreach ($times as $key => $value) { ?>
                                <?php 
                                $time = explode(',', $value);
                                $time_val = isset( $time[1] ) ? $time[1] : '';
                                $time_lab = isset( $time[0] ) ? $time[0] : '';
                                ?>
                                <option value="<?php echo $time_val; ?>"><?php echo $time_lab; ?></option>
                            <?php } ?>
                        </select>
                    </div>
            <?php } ?>

        </div>

    <?php
    endif;
}
 

// 0: Validate Booking Form And Rent Time
add_filter( 'woocommerce_add_to_cart_validation', 'ovamt_validation_booking_form', 10, 5 );      
function ovamt_validation_booking_form( $passed ) {


    // Get Value From Booking Form
    $ovamt_date = filter_input( INPUT_POST, 'ovamt_date' );
    $ovamt_time = filter_input( INPUT_POST, 'ovamt_time' );

    if(  $ovamt_date === NULL && $ovamt_time === NULL ){
        return $passed;
    }

    if ( empty( $ovamt_date )  ) {
        wc_clear_notices();
        echo wc_add_notice( __("Please choose date", 'ovamt'), 'error');
        return false;
    }

    if ( empty( $ovamt_time )  ) {
        wc_clear_notices();
        echo wc_add_notice( __("Please choose time", 'ovamt'), 'error');
        return false;
    }



    return $passed;
}


// Add  Data to the Cart Item
function ovamt_add_date_to_cart_item( $cart_item_data, $product_id, $variation_id ) {

    $date = filter_input( INPUT_POST, 'ovamt_date' );
    $time = filter_input( INPUT_POST, 'ovamt_time' );
 
    if ( empty( $date ) && empty( $time ) ) {
        return $cart_item_data;
    }
 
    $cart_item_data['ovamt_date'] = $date;
    $cart_item_data['ovamt_time'] = $time;
 
    return $cart_item_data;
}
 
add_filter( 'woocommerce_add_cart_item_data', 'ovamt_add_date_to_cart_item', 10, 3 );


// Display  Data in the Cart
function ovamt_display_date_cart( $item_data, $cart_item ) {
    if ( empty( $cart_item['ovamt_date'] ) && empty( $cart_item['ovamt_time'] ) ) {
        return $item_data;
    }
 
    $item_data[] = array(
        'key'     => esc_html__('Date', 'ovamt'),
        'value'   => wc_clean( $cart_item['ovamt_date'] ),
        'display' => '',
    );

    $item_data[] = array(
        'key'     => esc_html__('Time', 'ovamt'),
        'value'   => wc_clean( $cart_item['ovamt_time'] ),
        'display' => '',
    );
 
    return $item_data;
}
 
add_filter( 'woocommerce_get_item_data', 'ovamt_display_date_cart', 10, 2 );



// Save Data to the Order
add_action( 'woocommerce_checkout_create_order_line_item', 'ovamt_add_date_to_order_items', 10, 4 );
function ovamt_add_date_to_order_items( $item, $cart_item_key, $values, $order ) {
    if ( empty( $values['ovamt_date'] ) && empty( $values['ovamt_time'] ) ) {
        return;
    }
 
    $item->add_meta_data( 'ovamt_date', $values['ovamt_date'] );
    $item->add_meta_data( 'ovamt_time', $values['ovamt_time'] );
}



/* Replace key to text for friendly */

add_filter( 'woocommerce_display_item_meta', 'ovacrs_filter_woocommerce_display_item_meta', 10, 3 ); 
function ovacrs_filter_woocommerce_display_item_meta( $html, $item, $args ) { 
    
    $html = str_replace('ovamt_date', esc_html__('Date', 'ovamt') , $html );
    $html = str_replace('ovamt_time', esc_html__('Time', 'ovamt') , $html );
    
    return $html;
};



add_filter( 'woocommerce_order_item_display_meta_value', 'ovamt_change_order_item_meta_value', 20, 3 );
function ovamt_change_order_item_meta_value( $value, $meta, $item ) {
    
    // By using $meta-key we are sure we have the correct one.
    if ( 'ovamt_date' === $meta->key ) { $key = esc_html__('Date', 'ovamt'); }
    if ( 'ovamt_time' === $meta->key ) { $key = esc_html__('Time', 'ovamt'); }
    
     
    return $value;
}



add_filter( 'woocommerce_order_item_display_meta_key', 'ovamt_change_order_item_meta_title', 20, 3 );
function ovamt_change_order_item_meta_title( $key, $meta, $item ) {
    
    // By using $meta-key we are sure we have the correct one.
    if ( 'ovamt_date' === $meta->key ) { $key = esc_html__('Date', 'ovamt'); }
    if ( 'ovamt_time' === $meta->key ) { $key = esc_html__('Time', 'ovant'); }
    
     
    return $key;
}