import apiFetch from '@wordpress/api-fetch';
import { decodeEntities } from '@wordpress/html-entities';
import { safeParseJson } from '@assist/lib/parsing';

const { hostname } = window.location;
let { devbuild, siteTitle, wpLanguage } = window.extSharedData;
const {
	showBanner,
	showTask,
	searchUrl,
	showSecondaryBanner,
	showSecondaryTask,
	stagingSites,
} = window.extAssistData?.domainsSuggestionSettings || {};

const hasDomains =
	(safeParseJson(window.extAssistData.resourceData)?.domains || [])?.length > 0;

const domainByLanguage = (lang, urlList) => {
	try {
		const urls = JSON.parse(decodeEntities(urlList));
		return urls[lang] ?? urls['default'];
	} catch (e) {
		return decodeEntities(urlList) || false;
	}
};

export const domainSearchUrl =
	devbuild && !searchUrl
		? 'https://extendify.com?s={DOMAIN}'
		: domainByLanguage(wpLanguage, searchUrl);

const isStagingDomain =
	stagingSites.filter((l) => hostname.toLowerCase().includes(l))?.length > 0 ||
	false;

// Show if it's not a staging domain, has a title, and is enabled
export const showDomainBanner = (() => {
	if (devbuild) return true;
	if (!showBanner) return false;
	if (!hasDomains) return false;
	if (!siteTitle) return false;
	return isStagingDomain;
})();

// Show if it's not a staging domain, has a title, and is enabled
export const showDomainTask = (() => {
	if (devbuild) return true;
	if (!showTask) return false;
	if (!hasDomains) return false;
	if (!siteTitle) return false;
	return isStagingDomain;
})();

// Show if it's a staging domain, has a title, and is enabled
export const showSecondaryDomainBanner = (() => {
	if (devbuild) return true;
	if (!showSecondaryBanner) return false;
	if (!hasDomains) return false;
	if (!siteTitle) return false;
	return !isStagingDomain;
})();

// Show if it's a staging domain, has a title, and is enabled
export const showSecondaryDomainTask = (() => {
	if (devbuild) return true;
	if (!showSecondaryTask) return false;
	if (!hasDomains) return false;
	if (!siteTitle) return false;
	return !isStagingDomain;
})();

/**
 * 	The domainSearchUrl will look something like
 * 	https://example.com?s={DOMAIN} where {DOMAIN} will be replaced with the domain name
 */
export const createDomainUrlLink = (domainSearchUrl, domain) =>
	domainSearchUrl.replace('{DOMAIN}', domain.toLowerCase());

export const deleteDomainCache = () =>
	apiFetch({
		path: 'extendify/v1/assist/delete-domains-recommendations',
		method: 'POST',
	});
