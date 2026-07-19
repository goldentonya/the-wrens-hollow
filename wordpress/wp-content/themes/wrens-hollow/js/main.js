(function () {
  'use strict';

  /* ---------- Placeholder for missing images (until real assets are dropped in) ---------- */
  document.addEventListener('error', function (e) {
    var img = e.target;
    if (!img || img.tagName !== 'IMG' || img.dataset.ph) return;
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

  if (navToggle && navLinks) {
    navToggle.addEventListener('click', function () {
      var open = navToggle.getAttribute('aria-expanded') === 'true';
      navToggle.setAttribute('aria-expanded', String(!open));
      navLinks.classList.toggle('is-open', !open);
    });

    navLinks.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        navToggle.setAttribute('aria-expanded', 'false');
        navLinks.classList.remove('is-open');
      });
    });
  }

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
      // TODO: wire to the real mailing-list provider (e.g. Mailchimp/ConvertKit).
      optinStatus.textContent = 'Thanks! Check your inbox for the free chapters.';
      optinForm.reset();
    });
  }

  /* ---------- Contact form (About page) ---------- */
  var contactForm = document.getElementById('contactForm');
  var contactStatus = document.getElementById('contactStatus');

  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      // TODO: wire to the real form backend / inbox (e.g. Formspree, mailto relay).
      contactStatus.textContent = 'Thanks for reaching out! I\'ll get back to you soon.';
      contactForm.reset();
    });
  }

  /* ---------- "Notify me" buttons (series / shop) ---------- */
  document.querySelectorAll('[data-notify]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      if (btn.dataset.expanded) return;
      btn.dataset.expanded = '1';

      var label = btn.getAttribute('data-notify');
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
        // TODO: wire to the real mailing-list provider, tagged for this title's release alert.
        status.textContent = 'You’re on the list for ' + label + '.';
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
