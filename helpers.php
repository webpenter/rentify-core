<?php
if(!function_exists('myPluginGetAdminPageUrl')){
    function myPluginGetAdminPageUrl($page_slug='', $add_edit = 'admin', $type='page', $params=''){
        $url = $page_slug === '' ? admin_url(  ) : admin_url( $add_edit.'.php?'.$type.'=' . $page_slug );
        return add_query_arg(isset($params[0]) ? $params[0]: '' , isset($params[1]) ? $params[1]: '' , $url);
    }
}//myPluginGetAdminPageUrl()

if(!function_exists('rentify_wp_message_bar')){
    function rentify_wp_message_bar($message){
        if(!empty(trim($message))){
            echo '<div id="message" class="notice is-dismissible updated"><p>'.$message.'</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">'.esc_html__('Dismiss this notice.','my-plugin').'</span></button></div>';
        }
    }
}

if(!function_exists('rentify_wp_pagination_html')){
    function rentify_wp_pagination_html($total_records, $per_page, $current_page){
        // Display pagination links
        echo '<div class="tablenav-pages">
                <span class="displaying-num">'.$total_records.' '.esc_html__('items', 'my-plugiin').'</span>';
        echo paginate_links(array(
            'base' => add_query_arg('paged', '%#%'),
            'format' => '',
            'prev_text' => __('&laquo;'),
            'next_text' => __('&raquo;'),
            'total' => ceil($total_records / $per_page),
            'current' => $current_page,
        ));
        echo '</div>';
    }
}

if(!function_exists('rentify_count_records')){
    function rentify_count_records($table_name){
        global $wpdb, $rentify_db_prefix;
        $table_name = $wpdb->prefix .$rentify_db_prefix. $table_name;
        $sql = "SELECT COUNT(*) FROM $table_name";
        $count = $wpdb->get_var($sql);
        return $count;
    }
}

if(!function_exists('rentify_is_checked')){
    function rentify_is_checked($map_provider, $value='', $is_return_boolean=false, $is_echo=true){
        $return_value = $map_provider == $value ? 'checked' : '';
        if($is_return_boolean != false){
            $return_value = $map_provider == $value ? 'checked' : '';
        }

        if($is_echo == true && $is_return_boolean == false){
            echo $return_value;
        }

        return $return_value;
    }
}

if(!function_exists('rentify_is_selected')){
    function rentify_is_selected($map_provider, $value='', $is_return_boolean=false, $is_echo=true){
        $return_value = $map_provider == $value ? 'selected' : '';
        if($is_return_boolean != false){
            $return_value = $map_provider == $value ? 'selected' : '';
        }

        if($is_echo == true && $is_return_boolean == false){
            echo $return_value;
        }

        return $return_value;
    }
}

if(!function_exists('rentify_display_block_if')){
    function rentify_display_block_if($map_provider, $value=''){
        echo $map_provider == $value ? 'table-row' : 'none';
    }
}

if(!function_exists('rentify_get_default_lat_lng')){
    function rentify_get_default_lat_lng($return = 0){
        $return_data = get_option('mp_default_lat').','.get_option('mp_default_lng');
        if($return == 0){
            echo $return_data;
        }else{
            return $return_data;
        }
    }
}
if(!function_exists('rentify_add_google_map_script')){
    function rentify_add_google_map_script($map_id='', $address_input_field=''){
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var map = new google.maps.Map(document.getElementById('<?php echo $map_id;?>'), {
                    center: {
                        lat: <?php echo get_option('mp_default_lat'); ?>,
                        lng: <?php echo get_option('mp_default_lng'); ?>
                    },
                    zoom: <?php echo get_option('mp_default_map_zoom'); ?>,
                    mapTypeControl: false
                });

                const card = document.getElementById("pac-card");
                const input = document.getElementById('<?php echo $address_input_field;?>');
                const biasInputElement = document.getElementById("use-location-bias");
                const strictBoundsInputElement = document.getElementById("use-strict-bounds");
                const options = {
                    fields: ["formatted_address", "geometry", "name"],
                    strictBounds: false,
                };

                map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

                const autocomplete = new google.maps.places.Autocomplete(input, options);

                // Bind the map's bounds (viewport) property to the autocomplete object,
                // so that the autocomplete requests use the current map bounds for the
                // bounds option in the request.
                autocomplete.bindTo("bounds", map);

                const infowindow = new google.maps.InfoWindow();
                const infowindowContent = document.getElementById("infowindow-content");

                infowindow.setContent(infowindowContent);

                const marker = new google.maps.Marker({
                    map,
                    anchorPoint: new google.maps.Point(0, -29),
                });

                autocomplete.addListener("place_changed", () => {
                    infowindow.close();
                    marker.setVisible(false);

                    const place = autocomplete.getPlace();

                    if (!place.geometry || !place.geometry.location) {
                        // User entered the name of a Place that was not suggested and
                        // pressed the Enter key, or the Place Details request failed.
                        window.alert("No details available for input: '" + place.name + "'");
                        return;
                    }

                    // If the place has a geometry, then present it on a map.
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }

                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);
                    infowindowContent.children["place-name"].textContent = place.name;
                    infowindowContent.children["place-address"].textContent =
                        place.formatted_address;
                    infowindow.open(map, marker);
                });
            });
        </script>
    <?php }
}

function rentify_custom_field_editor($field_name, $value) {
    // Enqueue the media scripts (needed for image uploads)
    wp_enqueue_media();

    // Set arguments for the editor
    $editor_settings = array(
        'textarea_name' => $field_name,
    );

    // Get the current value of the field
    $value = esc_attr($value);

    // Generate the editor output
    $output =  '<style>.js .tmce-active .wp-editor-area{ color: #000000; }</style>' . wp_editor($value, $field_name, $editor_settings);

    // Return the editor output
    return $output;
}

// Register the function to display the editor for your field
add_action('admin_post_edit_page', 'rentify_custom_field_editor');

