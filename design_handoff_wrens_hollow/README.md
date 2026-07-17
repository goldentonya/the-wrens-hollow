# Handoff: The Wren's Hollow — Author Website Redesign

## Overview
A redesign of the author website for **Ali Wren** (brand: *The Wren's Hollow*), an indie
romance & fantasy author. The homepage acts as a **landing page** whose two primary jobs are:

1. **Get visitors reading a free chapter/book** (top conversion goal), and
2. **Explore the two book series.**

Secondary goals: capture newsletter signups (prominent), sell from the online store,
and drive to social media. The site replaces a WordPress/Astra theme site currently at
https://aliwrenauthor.com/.

The direction chosen by the client is **"The Reader's Path"** — a single, clear funnel:
hook with the free read → capture the email → explore the books → social proof → about →
"currently writing" teaser.

## About the Design Files
The files in this bundle are **design references created in HTML** — wireframe prototypes
showing intended structure, layout, hierarchy, and copy. They are **not production code to
copy directly**. The task is to **recreate these designs in the target environment**.

The current live site is **WordPress**. Implementation should be done in the client's
WordPress stack (e.g. a block theme / page builder, or a custom theme), reusing existing
plugins where they fit — **WooCommerce** already powers the shop/cart, and the existing
newsletter/mailing-list integration should be wired to the signup forms. If a different
framework is chosen, follow that environment's established patterns.

## Fidelity
**Low-fidelity (lofi) wireframes.** These show **layout, structure, content hierarchy, and
copy** — not final visual design. Use them as the blueprint for page structure and flow.
The colors, dashed image boxes, and monospace labels are wireframe placeholders, **not**
the final art direction:

- Dashed boxes labelled `COVER`, `AUTHOR PHOTO`, `HERO ART`, etc. = **image placeholders**;
  the client will supply real book covers and photos.
- The muted plum (`#7d4f61`) and pink/cream section tints are **indicative accents** to show
  emphasis and rhythm, not locked brand colors. A visual design pass (fonts, real palette,
  imagery) should follow. The client's stated mood is a **blend of warm romance + dark, moody
  fantasy**.
- Body copy shown is real, usable placeholder copy — keep it or refine with the client.

## Screens / Views
All five pages share one **sticky top navigation** and one **footer** (see Components).

### 1. Home / Landing (`/`)
- **Purpose:** Convert first-time visitors to a free reader and/or newsletter subscriber; orient them to the two series.
- **Layout:** Single column, stacked full-width sections, in this order:
  1. **Hero** — two-column row (text left, standing book cover right). Left: eyebrow "The Veiled Prophecy · Book 0", H1 "She doesn't know who to trust.", one-line subhead, primary CTA "Start Reading Free →", and a small trust line "★★★★★ · 200+ reviews · free forever". Right: portrait book-cover image (~120×172 placeholder ratio, drop shadow). Light pink section background.
  2. **Newsletter band** — dark section. Eyebrow "Join the Hollow", heading "Get bonus chapters + first look at new releases", email input + "Subscribe" button in a row.
  3. **Explore the books** — eyebrow + H2 "Two worlds, one storyteller", then two stacked book cards: **The Veiled Prophecy** (labelled *Fantasy · lead series*) and **Whiskey Tango Foxtrot** (labelled *Contemporary romance*). Each card = small cover thumbnail + genre tag + title + blurb + outline CTA.
  4. **Reviews** — a labelled divider "★ Reader reviews" then a 2-up grid of review cards (5-star row, quote, source).
  5. **About teaser** — light section, author photo + "Hi, I'm Ali Wren" blurb + "Read more" outline CTA.
  6. **On the horizon / Currently writing** — eyebrow + heading + blurb + a WIP progress bar.
- **Primary CTA:** "Start Reading Free →" (links to the series/free-read page).

### 2. Series — The Veiled Prophecy (`/the-veiled-prophecy`)
- **Purpose:** Introduce a series and funnel to the free entry book; capture "notify me" for upcoming titles. **This template is reused for Whiskey Tango Foxtrot.**
- **Layout:** Dark centered series header (eyebrow "Fantasy series · Kingdom of Sylvaeris", H2 title, one-line description) → intro paragraph → **Reading order** section with book cards (Book 0 *Veilfall* FREE, highlighted; Book 1 *coming soon* with "Notify me") → 2-up reviews grid → dark "Be first to read Book 1" newsletter band → footer.

### 3. Shop — Books & More (`/shop`)
- **Purpose:** Sell signed copies / merch direct (WooCommerce). Built to grow gracefully from one product.
- **Layout:** Light intro section (H2 "Signed copies, straight from Ali") → filter chips row (All / Paperbacks / Signed / Merch) → **2-up product grid** (product card = cover image, title, variant label, price, "Add to cart"; includes a dimmed "Coming soon / Preorder" card) → note that the grid scales as the catalog grows → light "Prefer your e-reader? Find every title on Amazon →" band → footer.

### 4. About — Behind the Pen (`/about`)
- **Purpose:** Personal author bio; convert to newsletter.
- **Layout:** Warm intro row (author portrait + "Hi, I'm Ali Wren" + one-line descriptor) → two bio paragraphs → "A few things about me" 2×2 fact grid → dark "Letters from the Hollow" newsletter band → footer.

### 5. Events & Appearances (`/events-appearances`)
- **Purpose:** List upcoming appearances; convert to newsletter for alerts.
- **Layout:** Light intro (H2 "Come say hi") → event cards (each = date chip + title + location + "Details & RSVP"; includes a "More dates coming / TBA" card) → "On the horizon" teaser with WIP progress bar → dark "Never miss an event or release" newsletter band → footer.

## Components

### Top Navigation (shared, sticky)
- Left: circular **logo mark** placeholder (real script logo goes here) + two-line wordmark — line 1 "THE WREN'S HOLLOW" (700, ~12px, letter-spacing .14em, `#3a2f36`), line 2 "Ali Wren · Author" (uppercase, ~7.5px, letter-spacing .14em, `#b3a99e`).
- Right: nav links (~10px, `#7c7266`): **Home · Books · About · Events · Read Free · 🛒 (cart)**. "Read Free" is emphasized in the accent plum (`#7d4f61`, weight 600). Cart is an icon.
- Active/current link: accent plum `#7d4f61`, weight 600.
- Bottom border `1px solid #e6e3db`, padding ~13px 18px.

### Footer (shared)
- Dark background `#2e262b`, text `#c9beb0`, padding ~20px 22px.
- Logo mark + "THE WREN'S HOLLOW" (white), tagline "Fierce love. Brilliant women. Stories with heart." (`#9a8f84`), and a row of social chips: **Facebook, Instagram, TikTok, Goodreads, Amazon** (bordered pills, `rgba(255,255,255,.18)` border).
- Real social URLs (from current site):
  - Facebook: https://www.facebook.com/share/18DP2c832v/
  - Instagram: https://www.instagram.com/aliwrenauthor
  - TikTok: https://www.tiktok.com/@aliwrenauthor
  - Goodreads: https://www.goodreads.com/author/show/14986224.Ali_Wren
  - Amazon: https://www.amazon.com/s?k=ali+wren+author

### Buttons
- **Primary** (`.btn`): plum fill `#7d4f61`, white text, weight 600, ~11px, radius 6px, padding ~9px 15px.
- **Outline** (`.btn.o`): white bg, plum text, `1.5px solid #cbb4bd` border.

### Cards / Sections
- Card: `1px solid #e6e3db`, radius 8px, bg `#fdfcf9`, padding 12px.
- Section tints used to create rhythm: light pink `#f6eff1`, warm cream `#faf6f2`/`#f3ece7`, dark `#2e262b` / `#2b2530`.
- Eyebrow labels: monospace, uppercase, letter-spacing .16em, plum `#9c6b7d`.
- Star ratings: gold `#c69a54`.
- Newsletter email input (`.field`): `1px solid #d8d2c7`, radius 6px, bg `#faf8f4`.

## Interactions & Behavior
- **Navigation:** standard page routing between the 5 pages. (The `Wrens Hollow Wireframe.dc.html` shows pages stacked for review; an earlier interactive version switched pages in place via the nav — routing target is normal multi-page navigation.)
- **Primary funnel:** every page keeps the **free-read CTA** and a **newsletter capture band** visible, so any entry point works toward the two goals.
- **Newsletter forms:** email field + submit; wire to the existing mailing-list provider. Show success/error states.
- **Shop:** WooCommerce add-to-cart, cart icon in nav reflects item count; "Preorder / Notify me" for unreleased titles.
- **"Notify me" (series/upcoming):** email capture tied to a specific title's release alert.
- **WIP progress bar:** a simple filled bar (`.line`, filled width e.g. 62%) — static/manually set is fine.
- Hover states on links (accent plum) and buttons (slight darken) should follow the final design system.

## State Management
Mostly static content pages. Dynamic pieces:
- **Cart state** (WooCommerce): item count in nav, add-to-cart.
- **Form submission state** for newsletter / notify-me (idle → submitting → success/error).
- Content (books, events, reviews, WIP progress) should be **editable by the client** — model as WordPress posts/CPTs/ACF fields or the equivalent so Ali can update events, add books, and adjust the "currently writing" teaser without a developer.

## Design Tokens (indicative — confirm in visual design pass)
Colors:
- Accent plum (primary): `#7d4f61`
- Accent plum (eyebrows/tags): `#9c6b7d`
- Dark surfaces: `#2e262b`, `#2b2530`
- Section tints: `#f6eff1` (pink), `#faf6f2`, `#f3ece7` (cream)
- Page background: `#eceae4`
- Text: heading `#241d22` / `#2e262b`, body `#5c5450` / `#8b837c`, muted `#a8a091`
- Card bg `#fdfcf9`, card border `#e6e3db`
- Star gold `#c69a54`
- Border/divider `#e6e3db`

Spacing: section padding ~22px; card padding 12px; row gap ~9–16px.

Radius: buttons/inputs 6px, cards 7–8px, chips/pills 20px (full), logo mark circle.

Typography: wireframe uses system-ui. **Choose a real pairing in the visual pass** — suggest an
elegant serif for headings (romance/fantasy feel) + a clean humanist sans for body. Confirm with client.

Shadows: cover images use a soft drop shadow ~`0 8px 18px rgba(60,40,50,.22)`.

## Assets
All imagery is **placeholder** in these wireframes. Client to provide:
- Book covers: Veilfall, Whiskey & Secrets, Whiskey & Lies (+ upcoming titles).
- Author photo / portrait.
- Hero art (atmospheric fantasy scene or cover treatment).
- Real script logo for the nav mark (exists on current site).
- Product images for the shop.

## Files
- `Wrens Hollow Wireframe.dc.html` — **the chosen design**: all five pages (Home, Series, Shop, About, Events) stacked in labelled browser frames.
- `Exploration - all wireframe directions.dc.html` — the full exploration canvas: three homepage directions (Reader's Path / Pick Your Lane / Cozy Hub), a sitemap diagram, three hero variations, and an interactive combined build. Useful for context and alternative ideas.
- `support.js` — runtime needed only to open the `.dc.html` files in a browser for reference. Not part of the implementation.

### Site map (information architecture)
```
Home / Landing
├── About (Behind the Pen)
├── The Veiled Prophecy            [Fantasy · lead series]
│   └── Enter the Story: Veilfall  (free)
├── Whiskey Tango Foxtrot          [Romance]
│   ├── Read Whiskey & Secrets — first chapters
│   ├── Read Whiskey & Lies free
│   └── Bonus Chapters — Whiskey & Lies
├── Books & More (Shop / cart)     [WooCommerce]
├── On the Horizon (Upcoming)
├── Events & Appearances
└── Newsletter signup              [global — band on every page + footer]
```
Free-to-read entry points are the primary conversion; the newsletter appears on every page.
