<?php
/*
Plugin Name: TM Derby Schedule
Description: Displays a schedule of roller derby games.
Plugin URI: https://thinmint333.com/wp-plugins/tm-derby-schedule/
Version: 1.8
Author: Thin Mint
Author URI: https://thinmint333.com/
License: GPL-3.0+
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

// Register custom post type for roller derby games
function tm_derby_schedule_register_post_type() {
    $labels = array(
        'name'               => _x( 'Derby Games', 'post type general name', 'tm-derby-schedule' ),
        'singular_name'      => _x( 'Derby Game', 'post type singular name', 'tm-derby-schedule' ),
        'menu_name'          => _x( 'TM Derby Schedule', 'admin menu', 'tm-derby-schedule' ),
        'name_admin_bar'     => _x( 'Derby Game', 'add new on admin bar', 'tm-derby-schedule' ),
        'add_new'            => _x( 'Add New', 'derby game', 'tm-derby-schedule' ),
        'add_new_item'       => __( 'Add New Derby Game', 'tm-derby-schedule' ),
        'new_item'           => __( 'New Derby Game', 'tm-derby-schedule' ),
        'edit_item'          => __( 'Edit Derby Game', 'tm-derby-schedule' ),
        'view_item'          => __( 'View Derby Game', 'tm-derby-schedule' ),
        'all_items'          => __( 'All Derby Games', 'tm-derby-schedule' ),
        'search_items'       => __( 'Search Derby Games', 'tm-derby-schedule' ),
        'parent_item_colon'  => __( 'Parent Derby Games:', 'tm-derby-schedule' ),
        'not_found'          => __( 'No derby games found.', 'tm-derby-schedule' ),
        'not_found_in_trash' => __( 'No derby games found in Trash.', 'tm-derby-schedule' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'tm-derby-schedule' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'derby-game' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 23,
        'supports'           => array( 'title' ),
        'register_meta_box_cb' => 'tm_derby_schedule_add_custom_fields',
        'menu_icon'           => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyOC4zLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAyMCAyMCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAgMjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQoJLnN0MHtmaWxsOiMwMTAxMDE7fQ0KPC9zdHlsZT4NCjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0xOC45LDQuMkMxNy41LDEuNywxNC44LDAsMTEuOCwwSDguMkMzLjcsMCwwLDMuOCwwLDguNGMwLDIuNCwxLDQuOSwxLjQsNS44YzIsMCw0LjEsMSw1LjItMC4yDQoJYzEuMywwLjUsMy4yLDEuNywzLjYsMy43Yy0wLjEsMC4xLTAuMSwwLjItMC4xLDAuNHYxYzAsMC41LDAuNCwwLjksMC44LDAuOXMwLjgtMC40LDAuOC0wLjl2LTFjMC0wLjEsMC0wLjMtMC4xLTAuNA0KCWMwLjItMy4zLDAuOC01LjcsMS4zLTdjMC42LTAuMSwxLjMtMC41LDEuOC0xQzE2LjIsOC40LDE4LjMsOC4zLDIwLDhDMjAsOCwxOS42LDUuNSwxOC45LDQuMnogTTUuMiwxMy4xYy0wLjMsMC0wLjUtMC4yLTAuNS0wLjUNCglzMC4yLTAuNSwwLjUtMC41YzAuMywwLDAuNSwwLjIsMC41LDAuNVM1LjQsMTMuMSw1LjIsMTMuMXogTTUuMSwxMC4ybDAuNC0zLjFMMi43LDUuOGwzLTAuNmwwLjMtMy4xbDEuNSwyLjdsMy0wLjZMOC41LDYuNUwxMCw5LjINCglMNy4yLDcuOUw1LjEsMTAuMnogTTEwLjYsMTUuMWMtMC45LTEuMi0yLjMtMS45LTMuMi0yLjRjMC0wLjEsMC4xLTAuMiwwLjEtMC40YzAuMy0xLjUsMS4zLTIuMiwyLjYtMi4yYzAuNCwwLDAuOCwwLjEsMS4yLDAuMw0KCWMwLjEsMC4xLDAuMiwwLjEsMC40LDAuMUMxMS4yLDExLjYsMTAuOCwxMy4xLDEwLjYsMTUuMXogTTEyLjcsOS4zYy0wLjMsMC0wLjUtMC4yLTAuNS0wLjVzMC4yLTAuNSwwLjUtMC41YzAuMywwLDAuNSwwLjIsMC41LDAuNQ0KCVMxMyw5LjMsMTIuNyw5LjN6Ii8+DQo8L3N2Zz4NCg==', // Add your SVG icon in base64 format here
    );

    register_post_type( 'derby-game', $args );
}
add_action( 'init', 'tm_derby_schedule_register_post_type' );

// Add custom fields to the custom post type
function tm_derby_schedule_add_custom_fields() {
    add_meta_box( 'tm_derby_schedule_custom_fields', 'Game Details', 'tm_derby_schedule_render_custom_fields', 'derby-game', 'normal', 'default' );
}

// Render custom fields
function tm_derby_schedule_render_custom_fields( $post ) {
    // Retrieve existing values for fields
    $date = get_post_meta( $post->ID, 'derby_date', true );
    $time = get_post_meta( $post->ID, 'derby_time', true );
    $game_name = get_post_meta( $post->ID, 'derby_game_name', true );
    $g1_team_1 = get_post_meta( $post->ID, 'derby_g1_team_1', true );
    $g1_team_2 = get_post_meta( $post->ID, 'derby_g1_team_2', true );
    $g2_team_1 = get_post_meta( $post->ID, 'derby_g2_team_1', true );
    $g2_team_2 = get_post_meta( $post->ID, 'derby_g2_team_2', true );
    $g3_team_1 = get_post_meta( $post->ID, 'derby_g3_team_1', true );
    $g3_team_2 = get_post_meta( $post->ID, 'derby_g3_team_2', true );
    $venue = get_post_meta( $post->ID, 'derby_venue', true );
    $location = get_post_meta( $post->ID, 'derby_location', true );
    $tickets = get_post_meta( $post->ID, 'derby_tickets', true );
    ?>

    <label for="derby_date">Date:</label>
    <input type="date" id="derby_date" name="derby_date" value="<?php echo esc_attr( $date ); ?>"><br><br>

    <label for="derby_time">Time:</label>
    <input type="time" id="derby_time" name="derby_time" value="<?php echo esc_attr( $time ); ?>"><br><br>

    <label for="derby_game_name">Game Name:</label>
    <input type="text" id="derby_game_name" name="derby_game_name" value="<?php echo esc_attr( $game_name ); ?>"><br><br>

    <label for="derby_venue">Venue Name:</label>
    <input type="text" id="derby_venue" name="derby_venue" value="<?php echo esc_attr( $venue ); ?>"><br><br>

    <label for="derby_location">Location:</label>
    <input type="text" id="derby_location" name="derby_location" value="<?php echo esc_attr( $location ); ?>"><br><br>

    <label for="derby_tickets">Ticket Link:</label>
    <input type="text" id="derby_tickets" name="derby_tickets" value="<?php echo esc_attr( $tickets ); ?>"><br><br>

    <label for="derby_fbevent">Facebook Event Link:</label>
    <input type="text" id="derby_fbevent" name="derby_fbevent" value="<?php echo esc_attr( $fbevent ); ?>"><br><br>

    <h1>Game 1</h1>

    <label for="derby_g1_team_1">Team 1:</label>
    <input type="text" id="derby_g1_team_1" name="derby_g1_team_1" value="<?php echo esc_attr( $g1_team_1 ); ?>"><br><br>

    <label for="derby_g1_team_2">Team 2:</label>
    <input type="text" id="derby_g1_team_2" name="derby_g1_team_2" value="<?php echo esc_attr( $g1_team_2 ); ?>"><br><br>

    <h1>Game 2</h1>

    <label for="derby_g2_team_1">Team 1:</label>
    <input type="text" id="derby_g2_team_1" name="derby_g2_team_1" value="<?php echo esc_attr( $g2_team_1 ); ?>"><br><br>

    <label for="derby_g2_team_2">Team 2:</label>
    <input type="text" id="derby_g2_team_2" name="derby_g2_team_2" value="<?php echo esc_attr( $g2_team_2 ); ?>"><br><br>

    <h1>Game 3</h1>

    <label for="derby_g3_team_1">Team 1:</label>
    <input type="text" id="derby_g3_team_1" name="derby_g3_team_1" value="<?php echo esc_attr( $g3_team_1 ); ?>"><br><br>

    <label for="derby_g3_team_2">Team 2:</label>
    <input type="text" id="derby_g3_team_2" name="derby_g3_team_2" value="<?php echo esc_attr( $g3_team_2 ); ?>"><br><br>

    <?php
}

// Save custom fields data
function tm_derby_schedule_save_custom_fields( $post_id ) {
    if ( isset( $_POST['derby_date'] ) ) {
        update_post_meta( $post_id, 'derby_date', sanitize_text_field( $_POST['derby_date'] ) );
    }
    if ( isset( $_POST['derby_time'] ) ) {
        update_post_meta( $post_id, 'derby_time', sanitize_text_field( $_POST['derby_time'] ) );
    }
    if ( isset( $_POST['derby_game_name'] ) ) {
        update_post_meta( $post_id, 'derby_game_name', sanitize_text_field( $_POST['derby_game_name'] ) );
    }
    if ( isset( $_POST['derby_venue'] ) ) {
        update_post_meta( $post_id, 'derby_venue', sanitize_text_field( $_POST['derby_venue'] ) );
    }
    if ( isset( $_POST['derby_location'] ) ) {
        update_post_meta( $post_id, 'derby_location', sanitize_text_field( $_POST['derby_location'] ) );
    }
    if ( isset( $_POST['derby_g1_team_1'] ) ) {
        update_post_meta( $post_id, 'derby_g1_team_1', sanitize_text_field( $_POST['derby_g1_team_1'] ) );
    }
    if ( isset( $_POST['derby_g1_team_2'] ) ) {
        update_post_meta( $post_id, 'derby_g1_team_2', sanitize_text_field( $_POST['derby_g1_team_2'] ) );
    }
    if ( isset( $_POST['derby_g2_team_1'] ) ) {
        update_post_meta( $post_id, 'derby_g2_team_1', sanitize_text_field( $_POST['derby_g2_team_1'] ) );
    }
    if ( isset( $_POST['derby_g2_team_2'] ) ) {
        update_post_meta( $post_id, 'derby_g2_team_2', sanitize_text_field( $_POST['derby_g2_team_2'] ) );
    }
    if ( isset( $_POST['derby_g3_team_1'] ) ) {
        update_post_meta( $post_id, 'derby_g3_team_1', sanitize_text_field( $_POST['derby_g3_team_1'] ) );
    }
    if ( isset( $_POST['derby_g3_team_2'] ) ) {
        update_post_meta( $post_id, 'derby_g3_team_2', sanitize_text_field( $_POST['derby_g3_team_2'] ) );
    }
    if ( isset( $_POST['derby_tickets'] ) ) {
        update_post_meta( $post_id, 'derby_tickets', sanitize_text_field( $_POST['derby_tickets'] ) );
    }
    if ( isset( $_POST['derby_fbevent'] ) ) {
        update_post_meta( $post_id, 'derby_fbevent', sanitize_text_field( $_POST['derby_fbevent'] ) );
    }
}
add_action( 'save_post', 'tm_derby_schedule_save_custom_fields' );

// Shortcode to display the schedule
// Shortcode to display the schedule
function tm_derby_schedule_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'num_games' => 5,
    ), $atts );

    $current_datetime = current_time( 'timestamp' ); // Get the current date and time as timestamp

    $args = array(
        'post_type'      => 'derby-game',
        'posts_per_page' => $atts['num_games'],
        'order'          => 'ASC',
        'meta_key'       => 'derby_date', // Order by derby date
        'orderby'        => 'meta_value', // Order by meta value
        'meta_query'     => array(
            'relation'    => 'AND',
            'date_clause' => array(
                'key'     => 'derby_date',
                'value'   => date( 'Y-m-d', $current_datetime ), // Get the current date in 'YYYY-MM-DD' format
                'compare' => '>=',
            ),
        ),
    );

    $derby_games = new WP_Query( $args );

    ob_start();
    if ( $derby_games->have_posts() ) {
        echo '<div class="tm-derby-schedule">';
        $game_count = 0; // Initialize game count
        while ( $derby_games->have_posts() ) {
            $derby_games->the_post();
            $game_count++; // Increment game count
            $date = get_post_meta( get_the_ID(), 'derby_date', true );
            $date_formatted = date( 'M j', strtotime( $date ) ); // Format date as "Jun 5"
            $time = get_post_meta( get_the_ID(), 'derby_time', true );
            $time_formatted = date( 'g:i A', strtotime( $time ) ); // Format time as "1:00 PM"
            $game_name = get_post_meta( get_the_ID(), 'derby_game_name', true );
            $g1_team_1 = get_post_meta( get_the_ID(), 'derby_g1_team_1', true );
            $g1_team_2 = get_post_meta( get_the_ID(), 'derby_g1_team_2', true );
            $g2_team_1 = get_post_meta( get_the_ID(), 'derby_g2_team_1', true );
            $g2_team_2 = get_post_meta( get_the_ID(), 'derby_g2_team_2', true );
            $g3_team_1 = get_post_meta( get_the_ID(), 'derby_g3_team_1', true );
            $g3_team_2 = get_post_meta( get_the_ID(), 'derby_g3_team_2', true );
            $venue = get_post_meta( get_the_ID(), 'derby_venue', true );
            $location = get_post_meta( get_the_ID(), 'derby_location', true );
            $tickets = get_post_meta( get_the_ID(), 'derby_tickets', true ); // Get ticket link
            $fbevent = get_post_meta( get_the_ID(), 'derby_fbevent', true ); // Get Facebook event link

            echo '<div class="tm-derby-game">';
            echo '<div class="tm-derby-game-cell-1">';
            echo '<h1>' . $date_formatted . '</h1>';
            echo '<h2>' . $time_formatted . '</h2>';
            echo '</div><div class="tm-derby-game-cell-2">'; 
            // Display game name if not empty
            if ( ! empty( $game_name ) ) {
                echo '<h3>' . $game_name . '</h3>';
            }
            echo '<p><strong> ' . $g1_team_1 . '</strong> <span style="font-size: 8px; text-transform:uppercase;">vs</span> <strong>' . $g1_team_2 . '</strong> </p>';
            // Display game 2 if not empty
            if ( ! empty( $g2_team_1 ) ) {
                echo '<p><strong> ' . $g2_team_1 . '</strong> <span style="font-size: 8px; text-transform:uppercase;">vs</span> <strong>' . $g2_team_2 . '</strong> </p>';
            }
            // Display game 3 if not empty
            if ( ! empty( $g3_team_1 ) ) {
                echo '<p><strong> ' . $g3_team_1 . '</strong> <span style="font-size: 8px; text-transform:uppercase;">vs</span> <strong>' . $g3_team_2 . '</strong> </p>';
            }
            echo '<p>' . $venue . ' | ' . $location . '</p>';
            // Display ticket link if not empty
            if ( ! empty( $tickets ) ) {
                echo '<p style="padding-top:10px;"><strong><a href="' . esc_url( $tickets ) . '">Buy Tickets!</a></strong>';
            }
            // Display ticket link if not empty
            if ( ! empty( $fbevent ) ) {       
                 echo '&nbsp;&nbsp;|&nbsp;&nbsp;<strong><a href="' . esc_url( $fbevent ) . '"><span class="dashicons dashicons-facebook"></strong></span></a></p>';
            }
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo '<h2 align="center">No upcoming games. See you next season!</h2>';
    }
    return ob_get_clean();
}
add_shortcode( 'tm_derby_schedule', 'tm_derby_schedule_shortcode' );

// Enqueue plugin styles
function tm_derby_schedule_enqueue_styles() {
    wp_enqueue_style( 'tm-derby-schedule-style', plugins_url( 'tm-derby-schedule-style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'tm_derby_schedule_enqueue_styles' );
