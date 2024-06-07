import apiFetch from '@wordpress/api-fetch';
import { create } from 'zustand';
import { devtools, persist, createJSONStorage } from 'zustand/middleware';
import { safeParseJson } from '@assist/lib/parsing';

const startingState = {
	siteType: {},
	siteInformation: {
		title: undefined,
	},
	siteTypeSearch: [],
	style: null,
	pages: [],
	plugins: [],
	goals: [],
	// initialize the state with default values
	...(safeParseJson(window.extSharedData.userData.userSelectionData)?.state ??
		{}),
};

const state = () => ({
	...startingState,
	// Add methods here
});

const path = '/extendify/v1/shared/user-selections-data';
const storage = {
	getItem: async () => await apiFetch({ path }),
	setItem: async (_name, state) =>
		await apiFetch({ path, method: 'POST', data: { state } }),
};

export const useUserSelectionStore = create(
	persist(devtools(state, { name: 'Extendify User Selections' }), {
		storage: createJSONStorage(() => storage),
		skipHydration: true,
	}),
	state,
);
