import apiFetch from '@wordpress/api-fetch';
import { useCallback, useEffect } from '@wordpress/element';
import { create } from 'zustand';
import { devtools, persist, createJSONStorage } from 'zustand/middleware';
import { routes as aiRoutes } from '@draft/pages/GenerateImage';
import { routes as generalRoutes } from '@draft/pages/Home';
import { routes as unsplashRoutes } from '@draft/pages/Unsplash';

const pages = [...generalRoutes, ...aiRoutes, ...unsplashRoutes];

const state = (set, get) => ({
	history: [],
	viewedPages: [],
	current: null,
	goBack: () => {
		if (get().history.length < 2) return;
		set((state) => ({
			history: state.history.slice(1),
			current: get().history[1],
		}));
	},
	setCurrent: (page) => {
		if (!page) return;
		// If history is the same, dont add (they pressed the same button)
		if (get().history[0]?.slug === page.slug) return;
		set((state) => {
			const lastViewedAt = new Date().toISOString();
			const firstViewedAt = lastViewedAt;
			const visited = state.viewedPages.find((a) => a.slug === page.slug);
			return {
				history: [page, ...state.history].filter(Boolean),
				current: page,
				viewedPages: [
					// Remove the page if it's already in the list
					...state.viewedPages.filter((a) => a.slug !== page.slug),
					// Either add the page or update the count
					visited
						? { ...visited, count: visited.count + 1, lastViewedAt }
						: {
								slug: page.slug,
								firstViewedAt,
								lastViewedAt,
								count: 1,
							},
				],
			};
		});
	},
});

const path = '/extendify/v1/draft/router-data';
const storage = {
	getItem: async () => await apiFetch({ path }),
	setItem: async (_name, state) =>
		await apiFetch({ path, method: 'POST', data: { state } }),
};

const useRouterState = create(
	persist(devtools(state, { name: 'Extendify Draft Router' }), {
		name: 'extendify-draft-router',
		storage: createJSONStorage(() => storage),
		skipHydration: true,
		partialize: ({ viewedPages }) => ({ viewedPages }),
	}),
);

export const useRouter = () => {
	const { current, setCurrent, history, goBack } = useRouterState();
	const Component = current?.component ?? (() => null);
	useEffect(() => {
		if (current) return;
		setCurrent(pages[0]);
	}, [current, setCurrent]);
	return {
		current,
		CurrentPage: useCallback(
			() => (
				<div role="region" aria-live="polite" className="h-full">
					{/* Announce to SR on change */}
					<h1 className="sr-only">{current?.title}</h1>
					<Component />
				</div>
			),
			[current],
		),
		navigateTo: (slug) => {
			const page = pages.find((a) => a.slug === slug);
			setCurrent(page ?? pages[0]);
		},
		goBack,
		history,
	};
};
