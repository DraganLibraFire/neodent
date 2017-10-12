<div class="container">
    <div class="row">
        <div class="latest-news-post-content-wrapp-home-page col-md-12">
            <?php $latest_news = new WP_Query(array(
                'post_type' => 'post',
                'category_name' => 'najnovije-vesti',
                'posts_per_page' => 3,
            ));
            ?>
            <h2 class="title-post-border-right"><span>Najnovije vesti</span></h2>
            <?php if ($latest_news->have_posts()) : ?>
                <?php while ($latest_news->have_posts()) : $latest_news->the_post(); ?>
                    <div class="row">
                        <div class="latest-news-post-description-wrapp">
                            <div class="border-top"></div>
                            <div class="latest-news-post-date col-sm-2">
								<span class="entry-date">
									<?php echo get_the_date('d-m-Y'); ?>
								</span>
                            </div>
                            <a href="<?php the_permalink(); ?>">
                                <div class="latest-news-post-img-wrapp col-sm-3">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="latest-news-post-content-excerpt-wrapp col-sm-7">
                                    <h2><?php the_title(); ?></h2>
                                    <?php the_excerpt(); ?>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
                <a href="http://www.neodent.verteez.net/vesti/" class="read-more">Procitaj jos &#62; &#62;</a>
            <?php endif; ?>
        </div>
    </div>
</div>