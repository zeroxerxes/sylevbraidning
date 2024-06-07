import {
	Button,
	BaseControl,
	PanelBody,
	__experimentalSpacer as Spacer,
	__experimentalDivider as Divider,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useRouter } from '@draft/hooks/useRouter';

export const Home = () => {
	const { navigateTo } = useRouter();
	return (
		<PanelBody>
			<BaseControl
				id="extendify-draft-image-gen"
				label={__('AI Image Generator', 'extendify-local')}
				help={__(
					'Use AI to generate custom images based on your description.',
					'extendify-local',
				)}>
				<Button
					variant="primary"
					className="justify-center w-full"
					onClick={() => navigateTo('ai-image')}>
					{__('Add a prompt', 'extendify-local')}
				</Button>
			</BaseControl>
			<Spacer marginY="5" />
			<Divider />
			<BaseControl
				id="extendify-draft-image-stock-photos"
				label={__('Discover Stock Photos', 'extendify-local')}
				help={__(
					'Search and add free stock photos from Unsplash.com',
					'extendify-local',
				)}>
				<Button
					variant="primary"
					className="justify-center w-full"
					onClick={() => navigateTo('unsplash')}>
					{__('Search Unsplash', 'extendify-local')}
				</Button>
			</BaseControl>
		</PanelBody>
	);
};

export const routes = [
	{
		slug: 'home',
		title: __('Home', 'extendify-local'),
		component: Home,
	},
];
