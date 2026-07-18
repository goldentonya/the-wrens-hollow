# The Wren's Hollow — Ali Wren Author Site Rebuild

Static HTML/CSS/JS rebuild of the "Reader's Path" homepage redesign, based on the
lo-fi wireframes in [`design_handoff_wrens_hollow/`](design_handoff_wrens_hollow/).
The wireframes were **structure/copy only**; this rebuild adds a real visual design
(serif + sans typography, plum/romance-fantasy palette) on top of that blueprint,
per the handoff's suggested direction.

The handoff's real target platform is **WordPress + WooCommerce** (the live site
reuses WooCommerce for the shop/cart), so that's what runs now:

- `wordpress/` — the real WordPress + WooCommerce build, with a custom theme that
  reproduces the design and a working cart/checkout.
- `site/` — the original static HTML/CSS/JS build. It's no longer served by Docker
  (the WordPress build replaced it), but it's kept as a reference and as the source
  of the real image assets (the WordPress theme reads images from `site/images/`).

## Structure

- `wordpress/wp-content/themes/wrens-hollow/` — the custom WordPress theme (all pages + the shop)
- `wordpress/wp-cli/` — one-shot setup scripts that configure WordPress/WooCommerce automatically
- `site/` — the original static site (`index.html` + pages, `css/`, `js/`, `images/`) — reference only, not served
- `design_handoff_wrens_hollow/` — original design handoff (wireframe HTML, README) kept for reference
- `docker-compose.yml` — local dev services: WordPress, MySQL, and a one-shot `wpcli` bootstrap service

## Pages

- Home / Landing
- The Veiled Prophecy (fantasy series)
- Whiskey Tango Foxtrot (contemporary romance series)
- Books (shop) — with real add-to-cart, cart, and checkout
- About — Behind the Pen
- Events & Appearances
- One page per book: Veilfall, Veilbound, Whiskey & Secrets, Whiskey & Lies

## Running locally (Docker)

```
docker compose up
```

This starts the **WordPress + WooCommerce store** at http://localhost:8080.

- wp-admin: http://localhost:8080/wp-admin — user `admin`, password `admin`
- The `wpcli` service runs once on startup and is idempotent: it installs WordPress, activates the `wrens-hollow` theme, installs + activates WooCommerce, creates the one real product (**Whiskey & Secrets**, $18 signed paperback), enables **Cash on delivery** and **Direct bank transfer** as payment methods, and adds a flat-rate shipping zone. No manual wp-admin setup needed. Check its logs with `docker compose logs wpcli` if the store looks unconfigured.
- Theme code lives in `wordpress/wp-content/themes/wrens-hollow/` and is volume-mounted, so edits show up on refresh (no rebuild needed). WordPress core itself is *not* checked into this repo — it's downloaded into a Docker volume on first run.

To stop:

```
docker compose down
```

(Add `-v` to also wipe the WordPress/MySQL database volumes and start fresh next time.)

### Testing the cart/checkout flow

1. Go to http://localhost:8080/shop/ (the "Books" nav link) or the Whiskey & Secrets book page.
2. Click **Add to cart**; the 🛒 count in the nav updates.
3. Open the cart (nav 🛒 icon), adjust quantity, confirm totals recalculate.
4. Proceed to checkout, fill in shipping details, choose **Cash on delivery** or **Direct bank transfer**, and place the order.
5. Confirm the order appears under WooCommerce → Orders in wp-admin.

### Payment gateways

Only WooCommerce's built-in offline gateways (Cash on delivery, Direct bank transfer)
are enabled, since there's no merchant account configured yet — checkout is fully
functional end-to-end without one. To take real payments later, install a gateway
plugin (e.g. WooCommerce Stripe Payment Gateway or PayPal) and enable it under
WooCommerce → Settings → Payments; no theme changes are required.

### Deploying to the real site

`wordpress/wp-content/themes/wrens-hollow/` is a portable, self-contained WordPress
theme — zip that folder and install it on the real aliwrenauthor.com WordPress site
(which already has WooCommerce) whenever ready. Nothing else in this repo needs to move.

## Images

All imagery is currently **placeholder** — the wireframe handoff notes real book
covers, author photos, and product images still need to come from the client
(Ali Wren). Expected paths (drop files in with these names and they'll be picked
up automatically):

- `site/images/covers/` — `veilfall.jpg`, `veiled-prophecy.jpg`, `veiled-prophecy-book1.jpg`,
  `whiskey-tango-foxtrot.jpg`, `whiskey-and-secrets.jpg`, `whiskey-and-lies.jpg`
- `site/images/photos/` — `ali-wren.jpg`, `ali-wren-portrait.jpg`
- `site/images/products/` — `whiskey-and-secrets-signed.jpg`, `veilfall-paperback.jpg`, `hollow-tote.jpg`

The WordPress theme reads from this same `site/images/` folder (volume-mounted in),
so dropping real files in updates the live store. A missing/broken image renders
as a labeled gray placeholder so the layout stays intact.

## Not yet wired up (placeholder behavior)

- **Newsletter / notify-me forms** — currently show a local success message only;
  need wiring to the real mailing-list provider.
- **Real payment processor** — checkout uses WooCommerce's offline gateways (Cash
  on delivery / bank transfer) for now; see "Payment gateways" above for adding Stripe/PayPal.

## Tweakable options

Set in `site/css/styles.css` under `:root` — colors (`--plum`, tints), typography
(`--font-display`, `--font-body`), spacing. See `design_handoff_wrens_hollow/README.md`
for the full design-token reference from the original handoff.
