#!/bin/sh
set -e

WP="wp --path=/var/www/html --allow-root"

echo "[init] Waiting for WordPress core files..."
until [ -f /var/www/html/wp-load.php ]; do
  sleep 2
done

echo "[init] Waiting for database..."
# Gate on a PHP-level DB connection, NOT `wp db check`: that shells out to the
# mariadb client, which insists on TLS and fails on MySQL 8's self-signed cert
# even though PHP (and thus WordPress itself) connects fine without TLS.
# `wp core is-installed` connects via PHP and only prints "Error establishing a
# database connection" when the DB is genuinely unreachable — so wait until that
# message is gone (whether WP is installed yet or not).
until [ "$( $WP core is-installed 2>&1 | grep -c 'Error establishing a database connection' )" -eq 0 ]; do
  sleep 2
done

if ! $WP core is-installed >/dev/null 2>&1; then
  echo "[init] Installing WordPress core..."
  $WP core install \
    --url="http://localhost:8080" \
    --title="The Wren's Hollow" \
    --admin_user="admin" \
    --admin_password="admin" \
    --admin_email="admin@example.com" \
    --skip-email
else
  echo "[init] WordPress already installed."
fi

echo "[init] Setting permalink structure..."
$WP rewrite structure '/%postname%/' --hard

echo "[init] Activating theme..."
$WP theme activate wrens-hollow

if ! $WP plugin is-installed woocommerce >/dev/null 2>&1; then
  echo "[init] Installing WooCommerce..."
  $WP plugin install woocommerce --activate
else
  echo "[init] Activating WooCommerce..."
  $WP plugin activate woocommerce
fi

# Editable-content plugins (both free, from wordpress.org): Advanced Custom
# Fields powers the labeled page/CPT fields; Custom Post Type UI lets the owner
# see the Events/Reviews/Books lists in the dashboard (the theme registers them
# in code, so they work with or without the plugin).
for plugin in advanced-custom-fields custom-post-type-ui; do
  if $WP plugin is-installed "$plugin" >/dev/null 2>&1; then
    echo "[init] Activating $plugin..."
    $WP plugin activate "$plugin"
  else
    echo "[init] Installing $plugin..."
    $WP plugin install "$plugin" --activate
  fi
done

# Note: all informational chatter here goes to stderr (>&2). The only thing this
# function may write to stdout is the page id, so command substitution stays clean.
create_page() {
  slug="$1"
  title="$2"
  template="$3"
  existing_id=$($WP post list --post_type=page --name="$slug" --field=ID --format=csv 2>/dev/null | head -n1)
  if [ -z "$existing_id" ]; then
    echo "[init] Creating page: $title ($slug)" >&2
    existing_id=$($WP post create --post_type=page --post_title="$title" --post_name="$slug" --post_status=publish --porcelain 2>/dev/null)
  fi
  if [ -n "$template" ]; then
    $WP post meta update "$existing_id" _wp_page_template "$template" >/dev/null 2>&1
  fi
  echo "$existing_id"
}

create_page "home" "Home" "front-page.php" >/dev/null
create_page "books" "Books" "page-books.php" >/dev/null
create_page "about" "About" "page-about.php" >/dev/null
create_page "on-the-horizon" "On the Horizon" "page-on-the-horizon.php" >/dev/null
create_page "events-appearances" "Events & Appearances" "page-events-appearances.php" >/dev/null
create_page "the-veiled-prophecy" "The Veiled Prophecy" "page-the-veiled-prophecy.php" >/dev/null
create_page "whiskey-tango-foxtrot" "Whiskey Tango Foxtrot" "page-whiskey-tango-foxtrot.php" >/dev/null
create_page "veilfall" "Veilfall" "page-veilfall.php" >/dev/null
create_page "veilbound" "Veilbound" "page-veilbound.php" >/dev/null
create_page "whiskey-and-secrets" "Whiskey & Secrets" "page-whiskey-and-secrets.php" >/dev/null
create_page "whiskey-and-lies" "Whiskey & Lies" "page-whiskey-and-lies.php" >/dev/null

echo "[init] Setting static front page..."
# Look the id up cleanly here rather than trusting a captured return value.
HOME_ID=$($WP post list --post_type=page --name=home --field=ID --format=csv 2>/dev/null | head -n1)
if [ -n "$HOME_ID" ]; then
  $WP option update show_on_front page
  $WP option update page_on_front "$HOME_ID"
fi

echo "[init] WooCommerce activation creates the Shop/Cart/Checkout/My Account pages automatically."

echo "[init] Setting up navigation menus..."
# Page IDs the menus link to. Looked up unconditionally (not inside the
# "if menu missing" blocks below) so they're available whether this is a fresh
# install or a rerun where only one of the two menus is missing.
BOOKS_ID=$($WP post list --post_type=page --name=books --field=ID --format=csv 2>/dev/null | head -n1)
ABOUT_ID=$($WP post list --post_type=page --name=about --field=ID --format=csv 2>/dev/null | head -n1)
HORIZON_ID=$($WP post list --post_type=page --name=on-the-horizon --field=ID --format=csv 2>/dev/null | head -n1)
EVENTS_ID=$($WP post list --post_type=page --name=events-appearances --field=ID --format=csv 2>/dev/null | head -n1)
VP_ID=$($WP post list --post_type=page --name=the-veiled-prophecy --field=ID --format=csv 2>/dev/null | head -n1)
WTF_ID=$($WP post list --post_type=page --name=whiskey-tango-foxtrot --field=ID --format=csv 2>/dev/null | head -n1)
SHOP_ID=$($WP option get woocommerce_shop_page_id 2>/dev/null)
HOME_URL=$($WP option get home 2>/dev/null)
SHOP_URL_FALLBACK="${HOME_URL}/shop/"

if [ -z "$SHOP_ID" ] || [ "$SHOP_ID" = "0" ]; then
  SHOP_ID=""
fi

if ! $WP menu list --fields=name --format=csv 2>/dev/null | grep -qx "Primary"; then
  echo "[init] Creating Primary menu..."
  $WP menu create "Primary" >/dev/null

  $WP menu item add-custom Primary "Home" "$HOME_URL" --porcelain >/dev/null

  BOOKS_ITEM=$($WP menu item add-post Primary "$BOOKS_ID" --title="Books" --porcelain)

  VP_ITEM=$($WP menu item add-post Primary "$VP_ID" --title="The Veiled Prophecy" --parent-id="$BOOKS_ITEM" --porcelain)
  $WP post update "$VP_ITEM" --post_content="Fantasy · Kingdom of Sylvaeris" >/dev/null 2>&1

  WTF_ITEM=$($WP menu item add-post Primary "$WTF_ID" --title="Whiskey Tango Foxtrot" --parent-id="$BOOKS_ITEM" --porcelain)
  $WP post update "$WTF_ITEM" --post_content="Contemporary romance" >/dev/null 2>&1

  $WP menu item add-post Primary "$ABOUT_ID" --title="About" --porcelain >/dev/null

  if [ -n "$SHOP_ID" ]; then
    $WP menu item add-post Primary "$SHOP_ID" --title="Shop" --porcelain >/dev/null
  else
    $WP menu item add-custom Primary "Shop" "$SHOP_URL_FALLBACK" --porcelain >/dev/null
  fi

  $WP menu item add-post Primary "$HORIZON_ID" --title="On the Horizon" --porcelain >/dev/null
  $WP menu item add-post Primary "$EVENTS_ID" --title="Events" --porcelain >/dev/null

  $WP menu location assign Primary primary
else
  echo "[init] Primary menu already exists."
fi

if ! $WP menu list --fields=name --format=csv 2>/dev/null | grep -qx "Footer"; then
  echo "[init] Creating Footer menu..."
  $WP menu create "Footer" >/dev/null

  $WP menu item add-custom Footer "Home" "$HOME_URL" --porcelain >/dev/null
  $WP menu item add-post Footer "$BOOKS_ID" --title="Books" --porcelain >/dev/null
  $WP menu item add-post Footer "$ABOUT_ID" --title="About" --porcelain >/dev/null

  if [ -n "$SHOP_ID" ]; then
    $WP menu item add-post Footer "$SHOP_ID" --title="Shop" --porcelain >/dev/null
  else
    $WP menu item add-custom Footer "Shop" "$SHOP_URL_FALLBACK" --porcelain >/dev/null
  fi

  $WP menu item add-post Footer "$HORIZON_ID" --title="On the Horizon" --porcelain >/dev/null
  $WP menu item add-post Footer "$EVENTS_ID" --title="Events" --porcelain >/dev/null

  $WP menu location assign Footer footer
else
  echo "[init] Footer menu already exists."
fi

echo "[init] Configuring store options, product, gateways, and shipping..."
$WP eval-file /wp-cli-scripts/setup-woocommerce.php

echo "[init] Seeding editable content (events, etc.)..."
$WP eval-file /wp-cli-scripts/seed-content.php

echo "[init] Done. Visit http://localhost:8080 (store) and http://localhost:8080/wp-admin (admin/admin)."
