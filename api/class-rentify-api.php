<?php
class Rentify_API {
    protected static $api_base_url = 'rentify-api/v1';

    public function __construct($api_base_url = null) {
        if ($api_base_url !== null) {
            self::$api_base_url = $api_base_url;
        }
    }
    public static function register_routes() {
        register_rest_route( self::$api_base_url, '/users', array(
            'methods' => 'POST',
            'callback' => array(__CLASS__, 'rentify_api_get_users'), // Replace with your callback function
            'permission_callback' => '__return_true', // Adjust permissions as needed
        ) );
    }

    // Callback functions for each endpoint (replace with your actual logic)
    public static function rentify_api_get_users( $request ) {
        global $wpdb;
        $search = $request->get_param('search_term');

        if (empty($search)) {
            return new WP_Error('no_search_term', 'No search term provided', array('status' => 400));
        }

        $like = '%' . $wpdb->esc_like($search) . '%';

        $query = $wpdb->prepare("SELECT ID, display_name, user_login, user_email 
    FROM {$wpdb->users}
    WHERE ID != %d AND (display_name LIKE %s 
    OR user_login LIKE %s 
    OR user_email LIKE %s)
", get_current_user_id(), $like, $like, $like);

        $results = $wpdb->get_results($query);

        // Organize results by conversation
        $users = array();
        foreach ($results as $row) {
            $users[] = array(
                'user_id' => $row->ID,
                'user_login' => $row->user_login,
                'display_name' => $row->display_name,
                'avatar_url' => get_avatar_url($row->ID)
            );
        }

        return new WP_REST_Response( array_values($users), 200 );
    }
}
