<?php /* Template Name: Contact Page Template */ get_header(); ?>
<?php get_template_part("contextual-module") ?>
<main id="contact" class="l-container-w-side animsition" data-animsition-in="fade-in-right-sm" role="main"> 
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <h1>Let's Talk</h1>
    <div id="contact-image">
      <?php $image = get_field('image'); ?> 
      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"> 
    </div>
    <div id="contact-info">
      <p><?php the_field("location_description"); ?></p>
      <p class="address detail">
        <span class="street"><?php the_field("street"); ?></span><br>
        <span class="city"><?php the_field("city"); ?>,</span>
        <span class="state"><?php the_field("state"); ?></span>
        <span class="zip"><?php the_field("zip"); ?></span>
      </p>
      <p><?php the_field("phone_description"); ?></p>
      <?php $phone = get_field("phone"); ?>
      <?php $phone = substr_replace($phone, ".", 3, 0); ?>
      <?php $phone = substr_replace($phone, ".", 7, 0); ?>
      <a href="<?php 'tel:' . the_field("phone"); ?>" class="phone detail"><?php echo $phone; ?></a>
      <p><?php the_field("email_description"); ?></p>
      <a href="<?php 'mailto:' . the_field("email"); ?>" class="email detail"><?php the_field("email"); ?></a>
      <p class="employment"><?php the_field("employment") ?></p>
  </div>
  <?php endwhile; ?>
<?php endif; ?>
