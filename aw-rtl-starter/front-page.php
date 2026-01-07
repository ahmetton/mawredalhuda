<?php
/**
 * Front page template
 * Sections: hero, services, about (page content), portfolio, blog, contact
 */
get_header(); ?>

<section class="hero" style="background-image: url('<?php echo esc_url( get_theme_mod( 'aw_hero_image' ) ); ?>')">
  <div class="container hero-inner">
    <h1 class="hero-title"><?php echo esc_html( get_theme_mod( 'aw_hero_title', __( 'مرحبًا بك في موقعي', 'aw-rtl-starter' ) ) ); ?></h1>
    <p class="hero-sub"><?php echo nl2br( esc_html( get_theme_mod( 'aw_hero_subtitle', __( 'نص تعريفي موجز عن الموقع أو الشركة', 'aw-rtl-starter' ) ) ) ); ?></p>
    <?php $btn_text = get_theme_mod( 'aw_hero_button_text', __( 'اتصل بنا', 'aw-rtl-starter' ) ); $btn_url = get_theme_mod( 'aw_hero_button_url', '#' ); ?>
    <?php if ( $btn_text && $btn_url ) : ?>
      <a class="hero-btn" href="<?php echo esc_url( $btn_url ); ?>"><?php echo esc_html( $btn_text ); ?></a>
    <?php endif; ?>
  </div>
</section>

<section class="services">
  <div class="container">
    <h2><?php _e( 'خدماتنا', 'aw-rtl-starter' ); ?></h2>
    <div class="services-grid">
      <?php
      $services = new WP_Query( array( 'post_type' => 'service', 'posts_per_page' => 6 ) );
      if ( $services->have_posts() ) :
        while ( $services->have_posts() ) : $services->the_post(); ?>
          <article class="service-item">
            <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium' ); endif; ?>
            <h3><?php the_title(); ?></h3>
            <div class="service-excerpt"><?php the_excerpt(); ?></div>
            <a href="<?php the_permalink(); ?>" class="read-more"><?php _e( 'المزيد', 'aw-rtl-starter' ); ?></a>
          </article>
        <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p><?php _e( 'لم يتم إضافة خدمات بعد. أضف خدمات في لوحة التحكم > الأعمال/الخدمات.', 'aw-rtl-starter' ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="about">
  <div class="container">
    <h2><?php _e( 'من نحن', 'aw-rtl-starter' ); ?></h2>
    <div class="about-content">
      <?php
      // If a page titled "About" exists, use its content; otherwise a placeholder.
      $about = get_page_by_path( 'about' );
      if ( $about ) {
        echo apply_filters( 'the_content', $about->post_content );
      } else {
        echo '<p>' . __( 'أضف صفحة بعنوان "about" لتظهر هنا محتويات "من نحن".', 'aw-rtl-starter' ) . '</p>';
      }
      ?>
    </div>
  </div>
</section>

<section class="portfolio">
  <div class="container">
    <h2><?php _e( 'أعمالنا', 'aw-rtl-starter' ); ?></h2>
    <div class="portfolio-grid">
      <?php
      $pf = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 8 ) );
      if ( $pf->have_posts() ) :
        while ( $pf->have_posts() ) : $pf->the_post(); ?>
          <article class="portfolio-item">
            <a href="<?php the_permalink(); ?>">
              <?php if ( has_post_thumbnail() ) the_post_thumbnail( 'medium' ); ?>
              <h3><?php the_title(); ?></h3>
            </a>
          </article>
        <?php endwhile;
        wp_reset_postdata();
      else :
        echo '<p>' . __( 'لا توجد أعمال مضافة بعد.', 'aw-rtl-starter' ) . '</p>';
      endif;
      ?>
    </div>
  </div>
</section>

<section class="latest-posts">
  <div class="container">
    <h2><?php _e( 'آخر المقالات', 'aw-rtl-starter' ); ?></h2>
    <div class="posts-grid">
      <?php
      $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3 ) );
      if ( $posts->have_posts() ) :
        while ( $posts->have_posts() ) : $posts->the_post(); ?>
          <article class="post-item">
            <?php if ( has_post_thumbnail() ) the_post_thumbnail( 'medium' ); ?>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="post-excerpt"><?php the_excerpt(); ?></div>
          </article>
        <?php endwhile;
        wp_reset_postdata();
      else :
        echo '<p>' . __( 'لا توجد مقالات بعد.', 'aw-rtl-starter' ) . '</p>';
      endif;
      ?>
    </div>
  </div>
</section>

<section class="contact">
  <div class="container">
    <h2><?php _e( 'تواصل معنا', 'aw-rtl-starter' ); ?></h2>
    <form id="aw-contact-form" class="aw-form">
      <div class="form-row">
        <label for="aw-name"><?php _e( 'الاسم', 'aw-rtl-starter' ); ?></label>
        <input type="text" id="aw-name" name="name" required>
      </div>
      <div class="form-row">
        <label for="aw-email"><?php _e( 'البريد الإلكتروني', 'aw-rtl-starter' ); ?></label>
        <input type="email" id="aw-email" name="email" required>
      </div>
      <div class="form-row">
        <label for="aw-message"><?php _e( 'الرسالة', 'aw-rtl-starter' ); ?></label>
        <textarea id="aw-message" name="message" rows="6" required></textarea>
      </div>
      <div class="form-row">
        <button type="submit" class="submit-btn"><?php _e( 'أرسل', 'aw-rtl-starter' ); ?></button>
      </div>
      <div class="form-result" aria-live="polite"></div>
    </form>
  </div>
</section>

<?php
get_footer();
