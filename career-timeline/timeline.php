<?php
    $events = get_field('career_timeline_events');
    if ($events):
?>
    <div class="career-timeline">
        <div class="timeline-item">
            <div class="timeline-date"><?php echo esc_html($events['pink_blog_links_date']); ?></div>
            <div class="timeline-content">
            <h3><?php echo esc_html($events['pink_blog_links_title']); ?></h3>
            <p><?php echo esc_html($events['pink_blog_links_desc']); ?></p>
            </div>
        </div>
        <div class="timeline-item">
            <div class="timeline-date"><?php echo esc_html($events['first_theme_build_date']); ?></div>
            <div class="timeline-content">
            <div class="timeline-content-img">
            </div>
            <h3><?php echo esc_html($events['first_theme_build_title']); ?></h3>
            <p><?php echo esc_html($events['first_theme_build_desc']); ?></p>
            </div>
        </div>
        <div class="timeline-item">
            <div class="timeline-date"><?php echo esc_html($events['first_ecommerce_build_date']); ?></div>
            <div class="timeline-content">
            <h3><?php echo esc_html($events['first_ecommerce_build_title']); ?></h3>
            <p><?php echo esc_html($events['first_ecommerce_build_desc']); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>