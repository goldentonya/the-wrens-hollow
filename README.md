# The Wren's Hollow — Ali Wren Author Site Rebuild

Static HTML/CSS/JS rebuild of the "Reader's Path" homepage redesign, based on the
lo-fi wireframes in [`design_handoff_wrens_hollow/`](design_handoff_wrens_hollow/).
The wireframes were **structure/copy only**; this rebuild adds a real visual design
(serif + sans typography, plum/romance-fantasy palette) on top of that blueprint,
per the handoff's suggested direction.

## Structure

- `site/` — the rebuilt site (`index.html` + 5 pages, `css/`, `js/`, `images/`)
- `design_handoff_wrens_hollow/` — original design handoff (wireframe HTML, README) kept for reference
- `docker-compose.yml` — local dev server (nginx)

## Pages

- `index.html` — Home / Landing
- `the-veiled-prophecy.html` — Series: The Veiled Prophecy (fantasy)
- `whiskey-tango-foxtrot.html` — Series: Whiskey Tango Foxtrot (contemporary romance)
- `shop.html` — Books & More (shop)
- `about.html` — About — Behind the Pen
- `events-appearances.html` — Events & Appearances

## Running locally (Docker)

```
docker compose up
```

Then open http://localhost:8090. Files are volume-mounted, so edits in `site/` show up on refresh — no rebuild needed.

To stop:

```
docker compose down
```

## Images

All imagery is currently **placeholder** — the wireframe handoff notes real book
covers, author photos, and product images still need to come from the client
(Ali Wren). Expected paths (drop files in with these names and they'll be picked
up automatically):

- `site/images/covers/` — `veilfall.jpg`, `veiled-prophecy.jpg`, `veiled-prophecy-book1.jpg`,
  `whiskey-tango-foxtrot.jpg`, `whiskey-and-secrets.jpg`, `whiskey-and-lies.jpg`
- `site/images/photos/` — `ali-wren.jpg`, `ali-wren-portrait.jpg`
- `site/images/products/` — `whiskey-and-secrets-signed.jpg`, `veilfall-paperback.jpg`, `hollow-tote.jpg`

A missing/broken image renders as a labeled gray placeholder so the layout stays intact.

## Not yet wired up (placeholder behavior)

Per the handoff, several pieces are meant to connect to real systems later:

- **Newsletter / notify-me forms** — currently show a local success message only;
  need wiring to the real mailing-list provider.
- **Shop cart** — "Add to cart" just increments a local counter; the handoff calls
  for WooCommerce if the final build target is WordPress.
- **Notify me (upcoming titles)** — same as newsletter, needs a real backend.

## Tweakable options

Set in `site/css/styles.css` under `:root` — colors (`--plum`, tints), typography
(`--font-display`, `--font-body`), spacing. See `design_handoff_wrens_hollow/README.md`
for the full design-token reference from the original handoff.
