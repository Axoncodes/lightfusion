<?php get_header(); ?>
<?php /* Template Name: Category */ ?>
<section id="whole_page_wrapup">
    <?php get_template_part( 'sidebar2' ); 
    $tempalte_dir = get_template_directory_uri();
    ?>
    <main style="padding-bottom: 30px;">
        <?php get_template_part( 'nav-status' ); ?>
        <?php $post_slug = $post->post_name; ?>
        <script> var page_slug = "<?php echo $post_slug; ?>"; </script>
        <?php
        if (get_the_title($post->post_parent)==get_the_title()) {
            echo categorySlider();
            global $post;
            $post_slug = $post->post_name;
        } else { ?>
            <?php $intro=get_field('blog_intro', get_option( 'page_on_front' )); if( $intro ): ?>
                <section id="lf_weblog_intro">
                    <h1><?php echo get_the_title(); ?></h1>
                </section>
            <?php endif; ?>
            <section id="lf_blog_items">
                <div class="lf_items">
                    <?php 
                        global $post;
                        $slug = $post->post_name;
                        $pageid = get_the_id();
                        $page_title = str_replace(" ", "-", get_the_title());
                        $page_title = strtolower($page_title);
                        $lf_category_page = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>10, 'category_name'=>$slug));
                        if ( $lf_category_page->have_posts() ) : while ( $lf_category_page->have_posts() ) : $lf_category_page->the_post();
                        $user_id = get_the_author_meta( 'ID' ); ?>

                        <div class="lf_item">
                            <a href="<?php getTheLink($post); ?>">
                                <?php 
                                    echo axgImgen(
                                        get_the_post_thumbnail_url(),
                                        get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE),
                                        "",
                                        "", "auto", "", "",
                                        ["small", "medium"]
                                    ); 
                                ?>
                            </a>
                            <div class="lf_item_profile">
                                <div>
                                    <img src="<?php echo $tempalte_dir."/assets/images/authors/".$user_id.".jpg" ?>" />
                                    <p>By:<span><?php echo get_the_author(); ?></span></p>
                                </div>
                                <p><?php echo get_the_date(); ?></p>
                            </div>
                            <div class="lf_item_content">
                                <h2><a href="<?php getTheLink($post); ?>"><?php echo get_the_title(); ?></a></h2>
                                <div class="lf_item_cat">
                                    <?php foreach((get_the_category()) as $category){echo "<a> <span>|</span> ".$category->name."</a>";} ?>
                                </div>
                                <p><?php echo get_the_excerpt(); ?></p>
                            </div>
                            <div class="lf_item_bottom">
                                <a href="<?php getTheLink($post); ?>">read this article</a>
                                <p><img src="/wp-content/themes/lightfusion/assets/icons/comment-dark.svg" /><?php echo get_comments_number(); ?></p>
                            </div>
                        </div>

                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </div>
            </section>
        <?php } ?>
        
        <?php get_template_part( 'sidebar-bottom' ); ?>
    </main>
    <?php get_template_part( 'sidebar-inpage' ); ?>
    

</section>
<?php get_footer(); ?>