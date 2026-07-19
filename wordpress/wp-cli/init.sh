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

echo "[init] Configuring store options, product, gateways, and shipping..."
$WP eval-file /wp-cli-scripts/setup-woocommerce.php

echo "[init] Done. Visit http://localhost:8080 (store) and http://localhost:8080/wp-admin (admin/admin)."
