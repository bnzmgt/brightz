<?php get_header(); ?>

<div class="search-results-page">
    <h1>Search Results</h1>

    <?php
    // Initialize meta query array
    $meta_query = array( 'relation' => 'AND' ); // Ensure all conditions must be met

    // Add "kamar_tidur" to the meta query if it is set and not empty
    if ( isset( $_GET['kamar_tidur'] ) && ! empty( $_GET['kamar_tidur'] ) ) {
        $meta_query[] = array(
            'key'     => 'kamar_tidur',
            'value'   => intval( $_GET['kamar_tidur'] ),
            'compare' => '>=', // Filter posts with at least the entered bedroom count
            'type'    => 'NUMERIC',
        );
    }

    // Add "kamar_mandi" to the meta query if it is set and not empty
    if ( isset( $_GET['kamar_mandi'] ) && ! empty( $_GET['kamar_mandi'] ) ) {
        $meta_query[] = array(
            'key'     => 'kamar_mandi',
            'value'   => intval( $_GET['kamar_mandi'] ),
            'compare' => '>=', // Filter posts with at least the entered bathroom count
            'type'    => 'NUMERIC',
        );
    }

    // Prepare the query arguments based on input fields
    $args = array(
        'post_type'      => 'post', // Or your custom post type
        'meta_query'     => $meta_query,
        'posts_per_page' => 10, // Limit the number of results
    );

    // If a keyword is entered, add it to the query
    if ( isset( $_GET['s'] ) && ! empty( $_GET['s'] ) ) {
        $args['s'] = sanitize_text_field( $_GET['s'] );
    }

    // If a category is selected, add it to the query
    if ( isset( $_GET['cat'] ) && ! empty( $_GET['cat'] ) ) {
        $args['cat'] = intval( $_GET['cat'] );
    }

    // Run the query only if at least one search condition is provided
    if ( !empty( $args['meta_query'] ) || !empty( $args['s'] ) || !empty( $args['cat'] ) ) {
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) : ?>
            <p>Search results for: <strong>"<?php echo get_search_query(); ?>"</strong></p>

            <?php if ( ! empty( $_GET['cat'] ) ) : ?>
                <p>Category: <strong><?php echo get_cat_name( intval( $_GET['cat'] ) ); ?></strong></p>
            <?php endif; ?>

            <?php if ( ! empty( $_GET['kamar_tidur'] ) ) : ?>
                <p>Bedrooms: <strong><?php echo intval( $_GET['kamar_tidur'] ); ?>+</strong></p>
            <?php endif; ?>

            <?php if ( ! empty( $_GET['kamar_mandi'] ) ) : ?>
                <p>Bathrooms: <strong><?php echo intval( $_GET['kamar_mandi'] ); ?>+</strong></p>
            <?php endif; ?>

            <ul>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>

            <div class="pagination">
                <?php echo paginate_links( array( 'total' => $query->max_num_pages ) ); ?>
            </div>

        <?php else : ?>
            <p>No results found.</p>
        <?php endif;

        wp_reset_postdata();
    } else {
        echo '<p>Please provide at least one search criterion.</p>';
    }
    ?>
</div>

<?php get_footer(); ?>
