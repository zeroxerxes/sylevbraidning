import { __ } from '@wordpress/i18n';

export default {
	slug: 'setup-simply-appointments',
	title: __('Set up appointments', 'extendify-local'),
	description: __(
		'Start accepting appointments on your website by configuring the Simply Scheduled Appointments plugin.',
		'extendify-local',
	),
	link: 'admin.php?page=simply-schedule-appointments#/wizard/review',
	buttonLabels: {
		notCompleted: __('Set up', 'extendify-local'),
		completed: __('Revisit', 'extendify-local'),
	},
	type: 'internalLink',
	dependencies: { goals: [], plugins: ['simply-schedule-appointments'] },
	show: ({ plugins, goals, activePlugins, userGoals }) => {
		if (!plugins.length && !goals.length) return true;

		return activePlugins
			.concat(userGoals)
			.some((item) => plugins.concat(goals).includes(item));
	},
	backgroundImage:
		'https://assets.extendify.com/assist-tasks/calendar-events.webp',
};
