import {
	Button,
	TextareaControl,
	__experimentalToggleGroupControl as ToggleGroupControl,
	__experimentalToggleGroupControlOptionIcon as ToggleGroupControlOptionIcon,
} from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { useGlobalStore } from '@draft/state/global';
import { CreditCounter } from './CreditCounter';

export const GenerateForm = ({ isGenerating, errorMessage }) => {
	const { imageCredits, resetImageCredits, aiImageOptions, setAiImageOption } =
		useGlobalStore();
	const usedCredits = imageCredits.total - imageCredits.remaining;
	const [refreshCheck, setRefreshCheck] = useState(0);
	const { size, prompt } = aiImageOptions;

	useEffect(() => {
		const handle = () => {
			setRefreshCheck((prev) => prev + 1);
			if (!imageCredits.refresh) return;
			if (new Date(Number(imageCredits.refresh)) > new Date()) return;
			resetImageCredits();
		};
		if (refreshCheck === 0) handle(); // First run
		const id = setTimeout(handle, 1000);
		return () => clearTimeout(id);
	}, [imageCredits, resetImageCredits, refreshCheck]);

	return (
		<>
			{isGenerating ? null : (
				<div>
					<TextareaControl
						id="draft-ai-image-textarea"
						placeholder={__(
							'Tell AI about the image you would like to create',
							'extendify-local',
						)}
						label={__('Image Prompt', 'extendify-local')}
						hideLabelFromVision
						rows="7"
						value={prompt}
						onChange={(prompt) => setAiImageOption('prompt', prompt)}
					/>

					<ToggleGroupControl
						isBlock
						label={__('Aspect Ratio', 'extendify-local')}
						onChange={(size) => setAiImageOption('size', size)}
						value={size}>
						<ToggleGroupControlOptionIcon
							className="m-auto"
							type="button"
							icon={AspectRatioSquare}
							label={__('Square: 1:1', 'extendify-local')}
							value="1024x1024"
						/>
						<ToggleGroupControlOptionIcon
							className="m-auto"
							type="button"
							icon={AspectRatioLandscape}
							label={__('Landscape: 4:3', 'extendify-local')}
							value="1792x1024"
						/>
						<ToggleGroupControlOptionIcon
							className="m-auto"
							type="button"
							icon={AspectRatioPortrait}
							label={__('Portrait: 3:4', 'extendify-local')}
							value="1024x1792"
						/>
					</ToggleGroupControl>
				</div>
			)}
			{errorMessage.length > 0 && (
				<p className="text-red-500 mb-0">{errorMessage}</p>
			)}
			<Button
				type="submit"
				className="w-full justify-center"
				variant="primary"
				disabled={isGenerating || !prompt || usedCredits >= imageCredits.total}>
				{isGenerating
					? __('Generating image...', 'extendify-local')
					: __('Generate image', 'extendify-local')}
			</Button>
			{isGenerating ? (
				<Button
					type="submit"
					className="w-full justify-center bg-gray-200 text-gray-800">
					{__('Cancel', 'extendify-local')}
				</Button>
			) : (
				<CreditCounter usedCredits={usedCredits} total={imageCredits.total} />
			)}
		</>
	);
};

const AspectRatioLandscape = (
	<svg xmlns="http://www.w3.org/2000/svg" style={{ padding: '7px 4px' }}>
		<path
			fillRule="evenodd"
			d="M0 1c0-.552285.447715-1 1-1h14c.5523 0 1 .447715 1 1v8c0 .55228-.4477 1-1 1H1c-.552285 0-1-.44772-1-1V1Z"
			clipRule="evenodd"
		/>
	</svg>
);

const AspectRatioPortrait = (
	<svg xmlns="http://www.w3.org/2000/svg" style={{ padding: '4px 6px' }}>
		<path
			fillRule="evenodd"
			d="M9.66669 3.5e-7C10.219 3.7e-7 10.6667.447716 10.6667 1v14c0 .5523-.4477 1-1.00001 1h-8c-.55229 0-1.000003-.4477-1.000003-1L.666688 1C.666688.447715 1.1144-2e-8 1.66669 0l8 3.5e-7Z"
			clipRule="evenodd"
		/>
	</svg>
);
const AspectRatioSquare = (
	<svg xmlns="http://www.w3.org/2000/svg" style={{ padding: '6px' }}>
		<path
			fillRule="evenodd"
			d="M11.3333-4e-8c.5523 2e-8 1 .44771504 1 1.00000004v10c0 .5523-.4477 1-1 1H1.33333c-.552283 0-.999998-.4477-.999998-1V.999999C.333332.447715.781047-5e-7 1.33333-4.8e-7L11.3333-4e-8Z"
			clipRule="evenodd"
		/>
	</svg>
);
