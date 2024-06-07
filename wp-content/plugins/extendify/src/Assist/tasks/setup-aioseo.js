import { __ } from '@wordpress/i18n';

export default {
	slug: 'setup-aioses',
	title: __('Set up All in One SEO', 'extendify-local'),
	description: __(
		'Set up the All in One SEO plugin to enhance your website discoverability.',
		'extendify-local',
	),
	link: '?page=aioseo-setup-wizard#/welcome',
	buttonLabels: {
		notCompleted: __('Set up', 'extendify-local'),
		completed: __('Revisit', 'extendify-local'),
	},
	type: 'internalLink',
	dependencies: { goals: [], plugins: ['all-in-one-seo-pack'] },
	show: ({ plugins, goals, activePlugins, userGoals }) => {
		if (!plugins.length && !goals.length) return true;

		return activePlugins
			.concat(userGoals)
			.some((item) => plugins.concat(goals).includes(item));
	},
	backgroundImage: 'https://assets.extendify.com/assist-tasks/bg-for-seo.webp',
};
