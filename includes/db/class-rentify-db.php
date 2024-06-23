<?php

class Rentify_DB {

    protected $table_name;
    protected $table_prefix = 'rentify_';

    public function __construct( $table_name, $table_prefix = 'rentify_' ) {
        global $wpdb;
        $this->table_name = $wpdb->prefix .$table_prefix. $table_name;
    }

    public function create( $data, $format = '' ) {
        global $wpdb;
        if($format != '') {
            $wpdb->insert($this->table_name, $data, $format);
        }else{
            $wpdb->insert( $this->table_name, $data );
        }

        $inserted_id = $wpdb->insert_id;

        if ( $inserted_id ) {
            return $inserted_id;
        } else {
            return false; // Handle insertion failure
        }
    }

    public function read( $id = null, $search = null, $fields= '*', $limit = 10, $offset = 0, $where_array = array() ) {
        global $wpdb;

        $sql = "SELECT $fields FROM $this->table_name";
        $where = [];
        $params = [];

        if ( $id ) {
            $where[] = "id = %d";
            $params[] = $id;
        }

        foreach ($where_array as $field => $value) {
            $where[] = $field." = %d";
            $params[] = $value;
        }

        if ( $search ) {
            $where[] = "searchable_field LIKE %s";
            $params[] = "%$search%";
        }

        if ( !empty( $where ) ) {
            $sql .= " WHERE " . implode( ' AND ', $where );
        }

        $sql .= " LIMIT %d OFFSET %d";
        $params[] = $limit;
        $params[] = $offset;
        $sql = $wpdb->prepare( $sql, $params );

        $results = $wpdb->get_results( $sql );

        return $results;
    }

    public function update( $id, $data ) {
        global $wpdb;

        // Validate and sanitize data (important security step)
        // ...

        $wpdb->update( $this->table_name, $data, array( 'id' => $id ) );

        if ( $wpdb->rows_affected ) {
            return true;
        } else {
            return false; // Handle update failure
        }
    }

    public function delete( $id ) {
        global $wpdb;

        $wpdb->delete( $this->table_name, array( 'id' => $id ) );

        if ( $wpdb->rows_affected ) {
            return true;
        } else {
            return false; // Handle delete failure
        }
    }
}
