<?php
/**
 * Template Name: Lumely — Home
 */
get_header();
?>

<main id="lumely-home">

  <!-- HERO -->
  <section class="lh-hero">
    <div class="container">
      <div class="lh-hero__badge">Built for AEC · AI-powered visuals</div>
      <h1 class="lh-hero__title">
        Photoreal results from any render — <span class="mint">in minutes</span>
      </h1>
      <p class="lh-hero__lede">
        Lumely enhances CG renders, stages interiors, and explores design options while preserving
        geometry and materials. Fast, consistent, client-ready.
      </p>
      <div class="lh-hero__cta">
        <a class="btn btn--primary" href="/signup">Start Free</a>
        <a class="btn btn--ghost" href="/pricing">View Pricing</a>
      </div>

      <div class="lh-hero__trusted">
        <div class="lh-trusted__kicker">Trusted by teams in AEC &amp; Property</div>
        <ul class="lh-trusted__logos">
          <li>StudioOne</li>
          <li>UrbanLab</li>
          <li>Habitat Co.</li>
          <li>Northside</li>
          <li>Blueprint</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- DEMO TABS -->
  <section class="lh-demo">
    <div class="container">
      <div class="lh-demo__card" data-tabs>
        <div class="lh-demo__tabs" role="tablist" aria-label="Service tabs">
          <button class="is-active" role="tab" aria-selected="true" aria-controls="tab-render" id="tabbtn-render">Render Enhancement</button>
          <button role="tab" aria-selected="false" aria-controls="tab-staging" id="tabbtn-staging">Virtual Staging</button>
          <button role="tab" aria-selected="false" aria-controls="tab-design" id="tabbtn-design">Design Options</button>
        </div>

        <!-- Panel: Render Enhancement -->
        <div class="lh-demo__panel is-active" id="tab-render" role="tabpanel" aria-labelledby="tabbtn-render">
          <div class="lh-demo__left">
            <h3 class="panel-title">Precision controls. <span class="mint">No surprises.</span></h3>
            <p class="panel-body">
              Keep geometry and materials intact while adding photoreal tone and clarity.
              Choose Low / Medium / High quality — with ×2 / ×4 upscaling when you need it.
            </p>
            <ul class="panel-bullets">
              <li><?php echo lumely_check(); ?> Preserve structure and materials</li>
              <li><?php echo lumely_check(); ?> Balanced tone, contrast &amp; glare control</li>
              <li><?php echo lumely_check(); ?> Smart upscale to crisp detail</li>
            </ul>
          </div>
          <div class="lh-demo__right">
            <div class="beforeafter" data-beforeafter>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/lumely/placeholder-before.jpg" alt="Before">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/lumely/placeholder-after.jpg" alt="After">
              <div class="ba-handle" aria-hidden="true">⇆</div>
              <div class="ba-label ba-label--before">Before</div>
              <div class="ba-label ba-label--after">After</div>
            </div>
          </div>
        </div>

        <!-- Panel: Virtual Staging -->
        <div class="lh-demo__panel" id="tab-staging" role="tabpanel" aria-labelledby="tabbtn-staging">
          <div class="lh-demo__left">
            <h3 class="panel-title">Stage any interior. <span class="mint">Client-ready.</span></h3>
            <p class="panel-body">
              Add furniture and finishes to unfurnished spaces while keeping lighting, perspective and
              architectural lines consistent.
            </p>
            <ul class="panel-bullets">
              <li><?php echo lumely_check(); ?> Multiple style presets</li>
              <li><?php echo lumely_check(); ?> Materials and reflections remain true</li>
              <li><?php echo lumely_check(); ?> Export final at 4K</li>
            </ul>
          </div>
          <div class="lh-demo__right">
            <div class="beforeafter" data-beforeafter>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/lumely/staging-before.jpg" alt="Before">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/lumely/staging-after.jpg" alt="After">
              <div class="ba-handle" aria-hidden="true">⇆</div>
              <div class="ba-label ba-label--before">Before</div>
              <div class="ba-label ba-label--after">After</div>
            </div>
          </div>
        </div>

        <!-- Panel: Design Options -->
        <div class="lh-demo__panel" id="tab-design" role="tabpanel" aria-labelledby="tabbtn-design">
          <div class="lh-demo__left">
            <h3 class="panel-title">Explore variants. <span class="mint">In minutes.</span></h3>
            <p class="panel-body">
              Generate quick look-options for facades, materials and lighting without re-rendering your scene.
            </p>
            <ul class="panel-bullets">
              <li><?php echo lumely_check(); ?> Batch variations</li>
              <li><?php echo lumely_check(); ?> Save/compare and export</li>
              <li><?php echo lumely_check(); ?> Great for concept decks</li>
            </ul>
          </div>
          <div class="lh-demo__right">
            <div class="beforeafter" data-beforeafter>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/lumely/design-before.jpg" alt="Before">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/lumely/design-after.jpg" alt="After">
              <div class="ba-handle" aria-hidden="true">⇆</div>
              <div class="ba-label ba-label--before">Before</div>
              <div class="ba-label ba-label--after">After</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section class="lh-steps">
    <div class="container">
      <h2>How Lumely works</h2>
      <p class="sub">From rough to refined — without changing your workflow.</p>

      <div class="lh-steps__cards">
        <article class="card">
          <div class="card__icon"><?php echo lumely_upload(); ?></div>
          <h3>Sign in &amp; upload</h3>
          <p>Start a new job from your dashboard. 1080p–4K supported.</p>
        </article>
        <article class="card">
          <div class="card__icon"><?php echo lumely_wand(); ?></div>
          <h3>Enhance &amp; upscale</h3>
          <p>Pick Low / Medium / High. ×2 / ×4 sharpness with material fidelity.</p>
        </article>
        <article class="card">
          <div class="card__icon"><?php echo lumely_download(); ?></div>
          <h3>Download &amp; deliver</h3>
          <p>Client-ready output for decks, listings and approvals.</p>
        </article>
      </div>

      <div class="lh-features">
        <ul>
          <li><?php echo lumely_check(); ?><strong>AEC-grade realism</strong><span>Tone, lighting, reflections and skies tuned for archviz.</span></li>
          <li><?php echo lumely_check(); ?><strong>Geometry preserved</strong><span>No warping — lines, edges and materials remain true.</span></li>
          <li><?php echo lumely_check(); ?><strong>Tiered quality</strong><span>Low (1), Medium (2), High (4) credits — pick per image.</span></li>
          <li><?php echo lumely_check(); ?><strong>Fast &amp; automated</strong><span>Upload → queue → download. Optional email notifications.</span></li>
          <li><?php echo lumely_check(); ?><strong>Cost-efficient</strong><span>Use credits across enhancement, staging and options.</span></li>
          <li><?php echo lumely_check(); ?><strong>Verified views compatible</strong><span>Your studio can still deliver legal accuracy when required.</span></li>
        </ul>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="lh-testimonials">
    <div class="container">
      <h2>What teams say</h2>

      <div class="lh-testimonials__row">
        <?php for ($i=0; $i<3; $i++): ?>
        <article class="tcard">
          <div class="stars" aria-label="5 stars">★★★★★</div>
          <blockquote>
            “Cuts our iteration time by 70% on concept decks. Clients notice the realism.”
          </blockquote>
          <div class="meta">Design Director, UrbanLab</div>
        </article>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- FINAL CTA -->
  <section class="lh-finalcta">
    <div class="container">
      <h2>Ready to try Lumely?</h2>
      <p>Start free with 5 credits. No card required.</p>
      <a class="btn btn--primary" href="/signin">Sign in to start</a>
    </div>
  </section>

</main>

<?php get_footer(); ?>
