import { __ } from '@wordpress/i18n';

const { partnerId, devbuild } = window.extSharedData;

export default {
	slug: 'demo-card',
	title: __('Managed WordPress Hosting', 'extendify-local'),
	description: __(
		'We take care of WordPress settings, updating themes and plugins, security and backing up your website.',
		'extendify-local',
	),
	buttonLabels: {
		completed: __('Learn More', 'extendify-local'),
		notCompleted: __('Learn More', 'extendify-local'),
	},
	link: 'https://hosting.aruba.it/en/wordpress/managed-wordpress-hosting.aspx',
	type: 'demo-card',
	dependencies: { goals: [], plugins: [] },
	show: () => {
		return devbuild || ['CFDemo1', 'CFDemo2', 'CFDemo3'].includes(partnerId);
	},
	backgroundImage:
		'https://extendify.com/content/uploads/2024/03/task_wp_aruba_bg.webp',
};
