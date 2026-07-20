/**
 * Powers the "add row / remove row" lists in inc/inline-repeaters.php (Facts,
 * Journey timeline, Team roster) — the free-WordPress stand-in for ACF Pro's
 * Repeater field. Vanilla JS, event-delegated so it works on rows added after
 * page load; each meta box is a plain container with .wh-repeater__row items
 * cloned from a <template>.
 */
(function () {
	'use strict';

	document.addEventListener('click', function (e) {
		var addBtn = e.target.closest('.wh-repeater__add');
		if (addBtn) {
			e.preventDefault();
			var container = addBtn.closest('.wh-repeater');
			var tpl = container.querySelector('template.wh-repeater__template');
			var rows = container.querySelector('.wh-repeater__rows');
			if (tpl && rows) {
				rows.appendChild(tpl.content.cloneNode(true));
			}
			return;
		}

		var removeBtn = e.target.closest('.wh-repeater__remove');
		if (removeBtn) {
			e.preventDefault();
			var row = removeBtn.closest('.wh-repeater__row');
			if (row) {
				row.remove();
			}
			return;
		}

		var upBtn = e.target.closest('.wh-repeater__move-up');
		if (upBtn) {
			e.preventDefault();
			var rowUp = upBtn.closest('.wh-repeater__row');
			var prev = rowUp && rowUp.previousElementSibling;
			if (rowUp && prev) {
				rowUp.parentNode.insertBefore(rowUp, prev);
			}
			return;
		}

		var downBtn = e.target.closest('.wh-repeater__move-down');
		if (downBtn) {
			e.preventDefault();
			var rowDown = downBtn.closest('.wh-repeater__row');
			var next = rowDown && rowDown.nextElementSibling;
			if (rowDown && next) {
				rowDown.parentNode.insertBefore(next, rowDown);
			}
			return;
		}

		var chooseBtn = e.target.closest('.wh-repeater__choose-image');
		if (chooseBtn) {
			e.preventDefault();
			var imgRow = chooseBtn.closest('.wh-repeater__row');
			if (!imgRow || typeof wp === 'undefined' || !wp.media) {
				return;
			}
			var frame = wp.media({
				title: 'Select an image',
				multiple: false,
				library: { type: 'image' }
			});
			frame.on('select', function () {
				var attachment = frame.state().get('selection').first().toJSON();
				var input = imgRow.querySelector('.wh-repeater__image-input');
				var preview = imgRow.querySelector('.wh-repeater__image-preview');
				var thumbUrl = (attachment.sizes && attachment.sizes.thumbnail) ? attachment.sizes.thumbnail.url : attachment.url;
				if (input) {
					input.value = attachment.id;
				}
				if (preview) {
					preview.src = thumbUrl;
					preview.style.display = '';
				}
			});
			frame.open();
		}
	});
})();
