<?php
function rentify_create_table()
{
    global $wpdb, $rentify_db_prefix;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $DROP_TABLES = 1;
    if($DROP_TABLES == 1 && 1==2){

        $table_name = $wpdb->prefix . $rentify_db_prefix . 'countries';
        dbDelta("DROP TABLE $table_name");

        $table_name = $wpdb->prefix . $rentify_db_prefix . 'cities';
        dbDelta("DROP TABLE $table_name");

        $table_name = $wpdb->prefix . $rentify_db_prefix . 'states';
        dbDelta("DROP TABLE $table_name");

        $table_name = $wpdb->prefix . $rentify_db_prefix . 'areas';
        dbDelta("DROP TABLE $table_name");

        $table_name = $wpdb->prefix . $rentify_db_prefix . 'testimonials';
        dbDelta("DROP TABLE $table_name");

        $table_name = $wpdb->prefix . $rentify_db_prefix . 'partners';
        dbDelta("DROP TABLE $table_name");

        $table_name = $wpdb->prefix . $rentify_db_prefix . 'cancel_policies';
        dbDelta("DROP TABLE $table_name");

        $table_name = $wpdb->prefix . $rentify_db_prefix . 'icon_vendors';
        dbDelta("DROP TABLE $table_name");

    }

    $table_name = $wpdb->prefix . $rentify_db_prefix . 'countries';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        capital VARCHAR(255),
        population INT,
        area FLOAT,
        currency VARCHAR(255),
        language VARCHAR(255),
        continent VARCHAR(255),
        timezone VARCHAR(255),
        government_type VARCHAR(255),
        calling_code VARCHAR(255),
        iso_code VARCHAR(255),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql);

    $table_name = $wpdb->prefix . $rentify_db_prefix . 'states';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$table_name} (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        country_id INT(11) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (country_id) REFERENCES {$wpdb->prefix}{$rentify_db_prefix}countries(id)
    ) {$charset_collate};";

    dbDelta($sql);

    $table_name = $wpdb->prefix . $rentify_db_prefix . 'cities';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$table_name} (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        state_id INT(11) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (state_id) REFERENCES {$wpdb->prefix}{$rentify_db_prefix}states(id)
    ) {$charset_collate};";

    dbDelta($sql);

    $table_name = $wpdb->prefix . $rentify_db_prefix . 'areas';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$table_name} (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        city_id INT(11) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (city_id) REFERENCES {$wpdb->prefix}{$rentify_db_prefix}cities(id)
    ) {$charset_collate};";


    dbDelta($sql);

    $table_name = $wpdb->prefix . $rentify_db_prefix . 'icon_vendors';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        default_icon_vendor ENUM('yes', 'no') DEFAULT 'no',
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql);

    // Addresses => countries, states, cities, areas

    //testimonials
    $table_name = $wpdb->prefix . $rentify_db_prefix . 'testimonials';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
          id INT(11) NOT NULL AUTO_INCREMENT,
          reviewer_name VARCHAR(255) NOT NULL,
          reviewer_email VARCHAR(255),
          review_text TEXT,
          reviewer_photo_id INT(11),
          reviewer_position VARCHAR(255),
          reviewer_company_name VARCHAR(255),
          attachment_id INT(11),
          created_at DATETIME,
          PRIMARY KEY (id)
          ) $charset_collate;";

    dbDelta($sql);

    //partners
    $table_name = $wpdb->prefix . $rentify_db_prefix . 'partners';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
          id INT(11) NOT NULL AUTO_INCREMENT,
          partner_name VARCHAR(255) NOT NULL,
          partner_email VARCHAR(255),
          reviewer_photo_id INT(11),
          created_at DATETIME,
          PRIMARY KEY (id)
          ) $charset_collate;";

    dbDelta($sql);

    //cancel policies
    $table_name = $wpdb->prefix . $rentify_db_prefix . 'cancel_policies';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
          id INT(11) NOT NULL AUTO_INCREMENT,
          policy_text TEXT,
          created_at DATETIME,
          PRIMARY KEY (id)
          ) $charset_collate;";

    dbDelta($sql);
}