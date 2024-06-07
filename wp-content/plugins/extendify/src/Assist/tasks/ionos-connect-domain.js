import { __ } from '@wordpress/i18n';

const hostname = new URL(window.location.href)?.hostname?.split('.');
const { devbuild } = window.extSharedData;

export default {
	slug: 'ionos-connect-domain',
	title: __('Connect your domain', 'extendify-local'),
	description: __(
		'To bring real visitors to your website and to complete the website setup, we recommend you connect your domain in your hosting control panel now.',
		'extendify-local',
	),
	buttonLabels: {
		completed: __('Learn More', 'extendify-local'),
		notCompleted: __('Learn More', 'extendify-local'),
	},
	link: undefined,
	type: 'no-action-btn-card',
	dependencies: { goals: [], plugins: [] },
	show: () =>
		devbuild ||
		(hostname?.length > 2 &&
			hostname?.slice(1, hostname?.length)?.join('.') === 'live-website.com'),
	backgroundImage:
		'https://assets.extendify.com/assist-tasks/connect-your-domain-ions.webp',
};
