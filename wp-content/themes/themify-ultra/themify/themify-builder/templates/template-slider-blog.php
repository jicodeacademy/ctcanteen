<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
/**
 * Template Slider Blog
 *
 * Access original fields: $args['settings']
 * @author Themify
 */
$type = $args['settings']['layout_display_slider'];
$fields_default = array(
    'post_type' => 'post',
    'taxonomy' => 'category',
    $type . '_category_slider' => '',
    'posts_per_page_slider' => '',
    'offset_slider' => '',
    'order_slider' => 'desc',
    'orderby_slider' => 'date',
    'display_slider' => 'content',
    'hide_post_title_slider' => 'no',
    'hide_feat_img_slider' => 'no'
);
if (isset($args['settings'][$type . '_category_slider'])) {
    $args['settings'][$type . '_category_slider'] = self::get_param_value($args['settings'][$type . '_category_slider']);
}
$fields_args = wp_parse_args($args['settings'], $fields_default);
unset($args['settings']);
if ($type !== 'blog') {
    $fields_args['post_type'] = $type;
    $fields_args['taxonomy'] = $type . '-category';
}
// The Query
$args = array(
    'post_type' => $fields_args['post_type'],
    'post_status' => 'publish',
    'order' => $fields_args['order_slider'],
    'orderby' => $fields_args['orderby_slider'],
    'cache_results'=>false,
    'suppress_filters' => false
);
if ($fields_args['posts_per_page_slider'] !== '') {
    $args['posts_per_page'] = $fields_args['posts_per_page_slider'];
}
Themify_Builder_Model::parseTermsQuery( $args, $fields_args[$type . '_category_slider'], $fields_args['taxonomy'] );
// add offset posts
if ($fields_args['offset_slider'] !== '') {
    $args['offset'] = $fields_args['offset_slider'];
}
$args = apply_filters('themify_builder_slider_' . $type . '_query_args', $args);
global $post;
$temp_post = $post;
$posts = get_posts($args);
$args=null;
if (!empty($posts)):
    $param_image = 'w=' . $fields_args['img_w_slider'] . '&h=' . $fields_args['img_h_slider'] . '&ignore=true';
    $attr_link_target = 'yes' === $fields_args['open_link_new_tab_slider'] ? ' target="_blank" rel="noopener"' : '';
    if ($fields_args['image_size_slider'] !== '' && Themify_Builder_Model::is_img_php_disabled()) {
        $param_image .= '&image_size=' . $fields_args['image_size_slider'];
    }
    $isLoop=$ThemifyBuilder->in_the_loop===true;
    $ThemifyBuilder->in_the_loop=true;
    foreach ($posts as $post): setup_postdata($post);
        ?>
        <li>
            <div class="slide-inner-wrap"<?php if ($fields_args['margin'] !== ''): ?> style="<?php echo $fields_args['margin']; ?>"<?php endif; ?>>
                <?php
                if (($ext_link = themify_builder_get('external_link'))) {
                    $ext_link_type = 'external';
                } elseif (($ext_link = themify_builder_get('lightbox_link'))) {
                    $ext_link_type = 'lightbox';
                } else {
                    $ext_link = themify_get_featured_image_link();
                    $ext_link_type = false;
                }
                if ($fields_args['hide_feat_img_slider'] !== 'yes') {

                    // Check if there is a video url in the custom field
                    if (($vurl = themify_builder_get('video_url'))) {
                        global $wp_embed;

                        $post_image = $wp_embed->run_shortcode('[embed]' . esc_url($vurl) . '[/embed]');
                    } else {
                        $post_image = themify_get_image($param_image);
                    }
                    if ($post_image) {
                        ?>
                        <?php themify_before_post_image(); // Hook ?>
                        <figure class="slide-image">
                            <?php if ($fields_args['unlink_feat_img_slider'] === 'yes'): ?>
                                <?php echo $post_image; ?>
                            <?php else: ?>
                                <a href="<?php echo $ext_link; ?>"
                                   <?php if ('lightbox' !== $ext_link_type && 'yes' === $fields_args['open_link_new_tab_slider']): ?> target="_blank" rel="noopener"<?php endif; ?>
                                   <?php if ('lightbox' === $ext_link_type) : ?> class="themify_lightbox" rel="prettyPhoto[slider]"<?php endif; ?>>
                                   <?php echo $post_image; ?>
                                </a>
                            <?php endif; ?>
                        </figure>
                        <?php themify_after_post_image(); // Hook ?>
                    <?php } ?>
                <?php } ?>

                <?php if ($fields_args['hide_post_title_slider'] !== 'yes' || $fields_args['display_slider'] !== 'none'): ?>
                    <div class="slide-content tb_text_wrap">
                        <?php if ($fields_args['hide_post_title_slider'] !== 'yes'): ?>
                            <?php if ($fields_args['unlink_post_title_slider'] === 'yes'): ?>
                                <h3 class="slide-title"><?php the_title(); ?></h3>
                            <?php else: ?>
                                <h3 class="slide-title">
                                    <a href="<?php echo $ext_link; ?>"  
                                       <?php if ('lightbox' !== $ext_link_type && 'yes' === $fields_args['open_link_new_tab_slider']): ?> target="_blank" rel="noopener"<?php endif; ?>
                                       <?php if ('lightbox' === $ext_link_type) : ?> class="themify_lightbox" rel="prettyPhoto[slider]"<?php endif; ?>>
                                       <?php the_title(); ?>
                                    </a>
                                </h3>
                            <?php endif; //unlink post title     ?>
                        <?php endif; // hide post title  ?>
						<?php if ($fields_args['hide_post_date'] !== 'yes'): ?>
                            <time datetime="<?php the_time('o-m-d') ?>" class="post-date" pubdate><?php echo get_the_date(apply_filters('themify_loop_date', '')) ?></time>
						<?php endif; //post date   ?>
                        <?php
                        // fix the issue more link doesn't output
                        global $more;
                        $more = 0;
                        if ($fields_args['display_slider'] === 'content') {
                            the_content();
                        } elseif ($fields_args['display_slider'] === 'excerpt') {
                            the_excerpt();
                        }
                        ?>
                        <?php if ($type === 'testimonial'): ?>
                            <p class="testimonial-author">
                                <?php
                                echo themify_builder_testimonial_author_name($post, 'yes');
                                ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <!-- /slide-content -->
                <?php endif; ?>
            </div>
        </li>
        <?php
    endforeach;
    wp_reset_postdata();
    $post = $temp_post;
    $ThemifyBuilder->in_the_loop=$isLoop;
    ?>
<?php endif; ?>
<!-- /themify_builder_slider -->
