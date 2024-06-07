import { __ } from '@wordpress/i18n';
import { waitUntilExists, waitUntilGone } from '@help-center/lib/tour-helpers';

export default {
	id: 'library-tour',
	title: __('Design Library', 'extendify-local'),
	settings: {
		allowOverflow: true,
		hideDotsNav: true,
		startFrom: [window.extSharedData.adminUrl + 'post-new.php?post_type=page'],
	},
	onStart: async () => {
		// Wait for gutenberg to be ready
		await waitUntilExists('#extendify-library-btn');

		// Close sidebar if open
		document
			.querySelector(`[aria-label="${__('Settings')}"].is-pressed`)
			?.click();
	},
	steps: [
		{
			title: __('Open the Pattern Library', 'extendify-local'),
			text: __(
				'The Extendify pattern library can be opened by clicking the button to the left.',
				'extendify-local',
			),
			attachTo: {
				element: '#extendify-library-btn [role="button"]',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {
				beforeAttach: () => {
					// If the Extendify library is open, close it
					return dispatchEvent(new CustomEvent('extendify::close-library'));
				},
			},
		},
		{
			title: __('Filter Patterns', 'extendify-local'),
			text: __(
				'Click on any pattern category to refine the selection.',
				'extendify-local',
			),
			attachTo: {
				element: '#extendify-library-category-control',
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			options: {
				allowPointerEvents: true,
			},
			events: {
				beforeAttach: async () => {
					// Open the Extendify library panel
					dispatchEvent(new CustomEvent('extendify::open-library'));

					return await waitUntilExists('#extendify-library-category-control');
				},
			},
		},
		{
			title: __('Select a Pattern', 'extendify-local'),
			text: __(
				'Simply select any pattern you wish to insert into a page by clicking on it.',
				'extendify-local',
			),
			attachTo: {
				element: '#extendify-library-patterns-list',
				position: {
					x: 'left',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {
				beforeAttach: async () => {
					await waitUntilExists('#extendify-library-patterns-list');
				},
			},
		},
		{
			title: __('View the Inserted Pattern', 'extendify-local'),
			text: __(
				'The selected pattern has been inserted into the page.',
				'extendify-local',
			),
			attachTo: {
				element: '.wp-block-group:last-child',
				frame: 'iframe[name="editor-canvas"]',
				offset: {
					marginTop: 15,
					marginLeft: 0,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top right',
			},
			events: {
				beforeAttach: async () => {
					document
						.querySelector('#extendify-library-patterns-list .library-pattern')
						?.click();

					return await waitUntilGone('#extendify-library-patterns-list');
				},
			},
			options: {
				hideBackButton: true,
			},
		},
	],
};
