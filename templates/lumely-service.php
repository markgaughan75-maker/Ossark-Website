<?php
/**
 * Template Name: Lumely — Service
 * Description: Flexible service layout for Lumely.ai (Render Enhancement, Virtual Staging, Design Options)
 */

get_header();

$service_slug   = get_field('service_slug') ?: 'service';
$hero_title     = get_field('hero_title');
$hero_kicker    = get_field('hero_kicker');
$hero_subtitle  = get_field('hero_subtitle');
$hero_bg        = get_field('hero_background');
$hero_cta       = get_field('hero_cta'); // ACF link array
$badges         = get_field('badges');   // repeater: label
$features       = get_field('features'); // repeater: icon/title/text
$gallery        = get_field('gallery');  // repeater: image (before/after optional)
$process        = get_field('process');  // repeater: step_title/step_text
$cta_block      = get_field('cta_block'); // title, text, button
$faq            = get_field('faq');       // repeater: q/a
?>

<section class="lumely-service__hero lumely-<?= esc_attr($service_slug); ?>" <?php if($hero_bg){ ?>style="--hero-bg:url('<?= esc_url($hero_bg['url']); ?>')"<?php } ?>>
  <div class="container">
    <div class="row">
      <div class="col-7">
        <?php if($hero_kicker): ?><p class="kicker"><?= esc_html($hero_kicker); ?></p><?php endif; ?>
        <?php if($hero_title): ?><h1 class="display"><?= esc_html($hero_title); ?></h1><?php endif; ?>
        <?php if($hero_subtitle): ?><p class="lede"><?= esc_html($hero_subtitle); ?></p><?php endif; ?>
        <?php if($hero_cta): ?>
          <div class="cta">
            <a class="btn" href="<?= esc_url($hero_cta['url']); ?>" target="<?= esc_attr($hero_cta['target'] ?: '_self'); ?>">
              <?= esc_html($hero_cta['title']); ?>
            </a>
          </div>
        <?php endif; ?>
        <?php if($badges): ?>
          <ul class="badges">
            <?php foreach($badges as $b): ?>
              <li><?= esc_html($b['label']); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
      <div class="col-5 hero-art">
        <!-- optional decorative/hero image is handled via background -->
      </div>
    </div>
  </div>
</section>

<?php if($features): ?>
<section class="lumely-service__features">
  <div class="container">
    <div class="row">
      <?php foreach($features as $f): 
        $icon = $f['icon'];
        ?>
        <div class="col-4 feature">
          <?php if($icon): ?><img class="feature__icon" src="<?= esc_url($icon['url']); ?>" alt="<?= esc_attr($icon['alt']); ?>"><?php endif; ?>
          <h3 class="feature__title"><?= esc_html($f['title']); ?></h3>
          <p class="feature__text"><?= esc_html($f['text']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if($gallery): ?>
<section class="lumely-service__gallery">
  <div class="container">
    <div class="row">
      <?php foreach($gallery as $g): 
        $img = $g['image'];
        $caption = $g['caption'];
      ?>
        <figure class="col-4 gallery__item">
          <?php if($img): ?><img src="<?= esc_url($img['url']); ?>" alt="<?= esc_attr($img['alt']); ?>"><?php endif; ?>
          <?php if($caption): ?><figcaption><?= esc_html($caption); ?></figcaption><?php endif; ?>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if($process): ?>
<section class="lumely-service__process">
  <div class="container">
    <div class="row">
      <?php $i=1; foreach($process as $p): ?>
        <div class="col-3 process__step">
          <div class="process__index"><?= $i++; ?></div>
          <h4 class="process__title"><?= esc_html($p['step_title']); ?></h4>
          <p class="process__text"><?= esc_html($p['step_text']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if($cta_block): ?>
<section class="lumely-service__cta">
  <div class="container">
    <div class="row">
      <div class="col-8">
        <h3><?= esc_html($cta_block['title']); ?></h3>
        <p><?= esc_html($cta_block['text']); ?></p>
      </div>
      <div class="col-4 align-right">
        <?php if(!empty($cta_block['button'])):
          $btn = $cta_block['button']; ?>
          <a class="btn btn--primary" href="<?= esc_url($btn['url']); ?>" target="<?= esc_attr($btn['target'] ?: '_self'); ?>">
            <?= esc_html($btn['title']); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if($faq): ?>
<section class="lumely-service__faq">
  <div class="container">
    <div class="row">
      <div class="col-12"><h3>FAQs</h3></div>
      <?php foreach($faq as $q): ?>
        <div class="col-12 faq__item">
          <button class="faq__q" aria-expanded="false"><?= esc_html($q['question']); ?></button>
          <div class="faq__a"><?= wp_kses_post(wpautop($q['answer'])); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
