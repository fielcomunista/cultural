<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cultural
 */

if ( ! function_exists( 'cultural_the_format' ) ) :
/**
 * Return the post format (if not Standard)
 */
function cultural_the_format() {

    global $post;

    $format = get_post_format();

    switch ( get_post_format() ) {
        case 'aside':
            $pretty_format = '<i class="fa fa-asterisk"></i>';
        break;
        case 'chat':
            $pretty_format = '<i class="fa fa-comments"></i>';
        break;
        case 'image':
            $pretty_format = '<i class="fa fa-camera"></i>';
        break;
        case 'gallery':
            $pretty_format = '<i class="fa fa-picture-o"></i>';
        break;
        case 'link':
            $pretty_format = '<i class="fa fa-bookmark"></i>';
        break;
        case 'video':
            $pretty_format = '<i class="fa fa-video-camera"></i>';
        break;
        case 'quote':
            $pretty_format = '<i class="fa fa-quote-right"></i>';
        break;
        case 'audio':
            $pretty_format = '<i class="fa fa-music"></i>';
        break;
        case 'status':
            $pretty_format = '<i class="fa fa-coffee"></i>';
        break;

        default:
            $pretty_format = '<i class="fa fa-bicycle"></i>';
        break;
    }

    if( $format ) echo '<span class="entry__format  u-pull-right">' . $pretty_format . '</span>';
}
endif;

if ( ! function_exists( 'cultural_comment' ) ) :
function cultural_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="pingback">
        <?php if(function_exists('cultural_get_favicon')) { ?><img src="<?php echo cultural_get_favicon( $comment->comment_author_url ); ?>" alt="Favicon" class="favicon" /><?php } ?><?php comment_author_link(); ?><?php edit_comment_link( sprintf( __( '%s Edit', 'cultural' ), '<i class="fa fa-pencil"></i>' ) ); ?>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment-container">
            <div class="comment-content">
                <?php comment_text(); ?>
            </div><!-- /comment-content -->

            <footer class="comment-meta vcard">
                <div class="comment-author-avatar">
                    <?php echo get_avatar( $comment, 96 ); ?>
                </div>
                <cite class="fn">
                    <?php echo get_comment_author_link(); ?>
                </cite>
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php printf( __( '%1$s at %2$s', 'cultural' ), get_comment_date(), get_comment_time() ); ?>" class="comment-permalink"><i class="fa fa-check"></i><span class="assistive-text"><? _e('Permalink', 'cultural'); ?></span></a>
                <?php edit_comment_link( sprintf( __( '%s Edit', 'cultural' ), '<i class="fa fa-pencil"></i>' ) ); ?>
            </footer>

            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-on-hold"><?php _e( 'Your comment is awaiting moderation.', 'cultural' ); ?></em>
            <?php endif; ?>
        </article><!-- /comment -->

    <?php
            break;
    endswitch;
}
endif;

if ( ! function_exists( 'cultural_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function cultural_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    }
    ?>
    <nav class="navigation paging-navigation" role="navigation">
        <h1 class="assistive-text"><?php _e( 'Posts navigation', 'cultural' ); ?></h1>
        <div class="nav-links">

            <?php if ( get_next_posts_link() ) : ?>
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'cultural' ) ); ?></div>
            <?php endif; ?>

            <?php if ( get_previous_posts_link() ) : ?>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'cultural' ) ); ?></div>
            <?php endif; ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

if ( ! function_exists( 'cultural_share' ) ) :
function cultural_share() {
    global $post; ?>
        <div class="entry-share  cf">
            <input type="text" class="share-shortlink" value="<?php echo wp_get_shortlink( get_the_ID() ); ?>" onclick="this.focus(); this.select();" readonly="readonly" />

            <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                <a href="<?php comments_link(); ?>" class="comments-link"><i class="fa fa-comment"></i> <?php echo comments_number( __('Leave a reply','cultural'), __('One comment','cultural'), __('% comments','cultural') ); ?></a>
            <?php endif; ?>
        </div>
    <?php
}
endif;

if ( ! function_exists( 'cultural_postedby' ) ) :
function cultural_postedby() {
    global $post;
?>
    <span class="author vcard">
        <?php if ( is_multi_author() ) {
            the_author_posts_link();
        } else {
            the_author();
        } ?>
    </span>
    <?php
}
endif;

if ( ! function_exists( 'cultural_the_time' ) ) :
/**
 * Filter the date so the human_time_diff appears on posts that have less then 1 month
 */
function cultural_the_time() {
    global $post;

    $time = mysql2date( 'G', $post->post_date );
    $time_diff = time() - $time; ?>

    <div class="entry__date">
        <i class="fa fa-clock-o"></i>
        <?php if ( ! is_single() && ( $time_diff > 0 && $time_diff < 30*24*60*60 ) )
            printf( __( '%s ago', 'cultural' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
        else
            the_time( get_option( 'date_format' ) );
        ?>
    </div>
<?php }
endif;

if ( ! function_exists( 'cultural_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function cultural_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous ) {
        return;
    }
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <h1 class="assistive-text"><?php _e( 'Post navigation', 'cultural' ); ?></h1>
        <div class="nav-links">
            <?php
                previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'cultural' ) );
                next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'cultural' ) );
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

if ( ! function_exists( '_s_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function _s_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        _x( 'Posted on %s', 'post date', 'cultural' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    $byline = sprintf(
        _x( 'by %s', 'post author', 'cultural' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'cultural_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function cultural_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( __( ', ', 'cultural' ) );
        if ( $categories_list && cultural_categorized_blog() ) {
            echo '<div class="cat-links"><i class="fa fa-folder-open"></i> ' . $categories_list . '</div>';
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', __( ', ', 'cultural' ) );
        if ( $tags_list ) {
            echo '<div class="tags-links"><i class="fa fa-tags"></i> ' . $tags_list . '</div>';
        }
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( __( 'Leave a comment', 'cultural' ), __( '1 Comment', 'cultural' ), __( '% Comments', 'cultural' ) );
        echo '</span>';
    }

    edit_post_link( __( 'Edit', 'cultural' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'cultural_categories' ) ) :
function cultural_categories() {
    global $post;

    $before = '<div class="entry__categories  u-pull-left">';
    $after = '</div>';
    $categories = get_the_category();
    $separator = ' ';
    $output = '';
    if($categories){
        foreach($categories as $category) {
            $cat_data = get_option('category_' . $category->cat_ID );
            $cat_color = $cat_data['color'];
            $output .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" style="background-color:'. $cat_color . ';">' . $category->cat_name . '</a>'.$separator;
        }
        echo $before;
        echo trim($output, $separator);
        echo $after;
    }
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function cultural_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'cultural_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'cultural_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so cultural_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so cultural_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in cultural_categorized_blog.
 */
function cultural_category_transient_flusher() {
    // Like, beat it. Dig?
    delete_transient( 'cultural_categories' );
}
add_action( 'edit_category', 'cultural_category_transient_flusher' );
add_action( 'save_post',     'cultural_category_transient_flusher' );