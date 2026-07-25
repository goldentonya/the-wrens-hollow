(function () {
  'use strict';

  /* ---------- Placeholder for missing images (until real assets are dropped in) ---------- */
  document.addEventListener('error', function (e) {
    var img = e.target;
    if (!img || img.tagName !== 'IMG' || img.dataset.ph) return;
    // Ignore errors on images a lazy-load plugin (SiteGround Speed Optimizer /
    // Jetpack, both installed in production) hasn't swapped to their real src
    // yet — those fire on a tiny pending placeholder, not a genuinely broken
    // asset. Once the plugin sets the real src, an actual 404 still fires its
    // own error event afterward and gets caught normally.
    if (img.dataset.src || img.dataset.lazySrc || img.hasAttribute('data-lazy-src') || img.classList.contains('jetpack-lazy-image')) return;
    img.dataset.ph = '1';
    var box = img.closest('.ph-box') || img.parentNode;
    var lbl = document.createElement('span');
    lbl.textContent = img.getAttribute('alt') || 'image';
    lbl.style.cssText = 'padding:0 4px;';
    img.remove();
    box.appendChild(lbl);
  }, true);

  /* ---------- Mobile nav toggle ---------- */
  var navToggle = document.getElementById('navToggle');
  var navLinks = document.getElementById('navLinks');

  function closeNavDropdowns() {
    document.querySelectorAll('.nav__dropdown-toggle[aria-expanded="true"]').forEach(function (toggle) {
      toggle.setAttribute('aria-expanded', 'false');
      var menu = document.getElementById(toggle.getAttribute('aria-controls'));
      if (menu) menu.classList.remove('is-open');
    });
  }

  if (navToggle && navLinks) {
    navToggle.addEventListener('click', function () {
      var open = navToggle.getAttribute('aria-expanded') === 'true';
      navToggle.setAttribute('aria-expanded', String(!open));
      navLinks.classList.toggle('is-open', !open);
      if (open) closeNavDropdowns();
    });

    navLinks.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        navToggle.setAttribute('aria-expanded', 'false');
        navLinks.classList.remove('is-open');
        closeNavDropdowns();
      });
    });
  }

  /* ---------- Mobile nav dropdown (Books → series flyout) accordion ----------
     On desktop this flyout opens on :hover/:focus-within (pure CSS, see
     style.css). Mobile has no hover, so the chevron renders as its own
     <button> (inc/nav-walker.php) that toggles the submenu open/closed
     without following the "Books" link itself. */
  document.querySelectorAll('.nav__dropdown-toggle').forEach(function (toggle) {
    toggle.addEventListener('click', function () {
      var expanded = toggle.getAttribute('aria-expanded') === 'true';
      var menu = document.getElementById(toggle.getAttribute('aria-controls'));
      toggle.setAttribute('aria-expanded', String(!expanded));
      if (menu) menu.classList.toggle('is-open', !expanded);
    });
  });

  /* ---------- Newsletter / notify-me form (placeholder submit handler) ---------- */
  var newsletterForm = document.getElementById('newsletterForm');
  var newsletterStatus = document.getElementById('newsletterStatus');

  if (newsletterForm) {
    newsletterForm.addEventListener('submit', function (e) {
      e.preventDefault();
      // TODO: wire to the real mailing-list provider (e.g. Mailchimp/ConvertKit).
      newsletterStatus.textContent = 'Thanks for joining the Hollow! (Signup isn’t wired to a mailing list yet.)';
      newsletterForm.reset();
    });
  }

  /* ---------- Opt-in form (free-chapters lead magnet, e.g. Veilfall) ---------- */
  var optinForm = document.getElementById('optinForm');
  var optinStatus = document.getElementById('optinStatus');

  if (optinForm) {
    optinForm.addEventListener('submit', function (e) {
      e.preventDefault();
      // This handler only runs when no provider is configured (Customize >
      // Forms > "Free-chapters opt-in") — see template-parts/optin-form.php.
      optinStatus.textContent = 'Thanks for your interest! (This form isn’t connected to a mailing list yet, so the free chapters can’t send — check back soon.)';
      optinForm.reset();
    });
  }

  /* ---------- Contact form (About page) ---------- */
  var contactForm = document.getElementById('contactForm');
  var contactStatus = document.getElementById('contactStatus');

  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      // This handler only runs when no provider is configured (Customize >
      // Forms > "Contact form") — see template-parts/contact-form.php.
      contactStatus.textContent = 'Thanks for reaching out! (This form isn’t connected yet, so the message wasn’t sent — please reach out on social media in the meantime.)';
      contactForm.reset();
    });
  }

  /* ---------- "Notify me" buttons (series / shop) ---------- */
  document.querySelectorAll('[data-notify]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      if (btn.dataset.expanded) return;
      btn.dataset.expanded = '1';

      var label = btn.getAttribute('data-notify');
      var providedHtml = window.wrensHollowForms && window.wrensHollowForms.notifyFormHtml;

      if (providedHtml) {
        // A real newsletter provider is configured (Customize > Forms) — reuse
        // its already-rendered signup form instead of faking one. Note: any
        // <script> tag in the embed won't execute via innerHTML — fine for a
        // shortcode-rendered form, but a script-driven embed (e.g. some
        // Klaviyo snippets) may need its own script loaded sitewide already
        // (which the plugin typically does) rather than relying on this insert.
        var embed = document.createElement('div');
        embed.className = 'form-embed';
        embed.style.marginTop = '10px';
        embed.innerHTML = providedHtml;
        btn.replaceWith(embed);
        return;
      }

      // No provider configured yet — fall back to an inline placeholder form.
      var wrap = document.createElement('form');
      wrap.className = 'newsletter-form';
      wrap.style.marginTop = '10px';
      wrap.innerHTML =
        '<input class="field" type="email" placeholder="your@email.com" required aria-label="Email address for ' + label + ' alert">' +
        '<button class="btn btn--sm" type="submit">Notify me</button>';

      var status = document.createElement('p');
      status.className = 'form-status';

      btn.replaceWith(wrap);
      wrap.after(status);

      wrap.addEventListener('submit', function (e) {
        e.preventDefault();
        status.textContent = 'You’re on the list for ' + label + '. (Not wired to a mailing list yet.)';
        wrap.querySelector('input').disabled = true;
        wrap.querySelector('button').disabled = true;
      });
    });
  });

  /* Reviews carousel (Homepage) is a pure CSS marquee — the track animates
     continuously and pauses on :hover/:focus-within, no JS needed. */

  /* Nav dropdown (Books → series flyout) is pure CSS :hover/:focus-within —
     no JS needed. On mobile it's simply always expanded under Books. */

  /* Cart add/remove/quantity/checkout are handled by WooCommerce's own
     scripts (wc-add-to-cart, wc-cart-fragments) — no custom cart JS here. */
})();
