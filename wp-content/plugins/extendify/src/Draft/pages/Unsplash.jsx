import { store as blockEditorStore } from '@wordpress/block-editor';
import {
	__experimentalHeading as Heading,
	__experimentalDivider as Divider,
} from '@wordpress/components';
import { SearchControl } from '@wordpress/components';
import { useSelect, useDispatch } from '@wordpress/data';
import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import classNames from 'classnames';
import { downloadImage, addImageToBlock } from '@draft/api/WPApi';
import { UnsplashImages } from '@draft/components/stock-images/UnsplashImages';
import { useRouter } from '@draft/hooks/useRouter';
import { useUnsplashImages } from '@draft/hooks/useUnsplashImages';
import { backArrow } from '@draft/svg/BackArrow';

export const Unsplash = () => {
	const { goBack } = useRouter();
	const [search, setSearch] = useState('');
	const [searchDebounced, setSearchDebounced] = useState('');
	const [searching, setSearching] = useState(false);
	const { data: imageData, loading } = useUnsplashImages(searchDebounced);
	const [isInsertingImage, setIsInsertingImage] = useState(null);

	const selectedBlock = useSelect(
		(select) => select(blockEditorStore).getSelectedBlock(),
		[],
	);
	const { updateBlockAttributes } = useDispatch(blockEditorStore);

	const handleClick = async (image) => {
		if (isInsertingImage) return;
		setIsInsertingImage(image);
		try {
			const downloadedImage = await downloadImage(
				imageData.requestID,
				image.urls?.regular,
				'unsplash',
				image.id,
			);
			await addImageToBlock(
				selectedBlock,
				downloadedImage,
				updateBlockAttributes,
			);
		} catch (error) {
			console.log(error);
		} finally {
			setIsInsertingImage(null);
		}
	};

	useEffect(() => {
		setSearching(false);
	}, [searchDebounced]);

	useEffect(() => {
		if (!search) return setSearchDebounced('');
		const id = setTimeout(() => setSearchDebounced(search), 300);
		return () => clearTimeout(id);
	}, [search]);

	return (
		<>
			<div className="flex gap-1 items-center h-12 pl-1">
				<button
					className="bg-transparent border-0 h-9 w-9 cursor-pointer"
					onClick={goBack}
					type="button"
					aria-label={__('Go Back', 'extendify-local')}>
					{backArrow}
				</button>
				<Heading className="mb-0">
					{__('Photos from Unsplash', 'extendify-local')}
				</Heading>
			</div>
			<Divider className="my-0 border-gray-150" />
			<div className="p-4 flex flex-col gap-2">
				<SearchControl
					autoFocus
					// This wp component has no real disabled state
					className={classNames({
						'opacity-50 pointer-events-none bg-gray-150': isInsertingImage,
					})}
					disabled={isInsertingImage}
					aria-disabled={isInsertingImage}
					onChange={(value) => {
						if (isInsertingImage) return;
						setSearch(value);
					}}
					value={search}
				/>
				<UnsplashImages
					imageData={imageData}
					isInsertingImage={isInsertingImage}
					onClick={handleClick}
					loading={loading || searching}
				/>
			</div>
		</>
	);
};

export const routes = [
	{
		slug: 'unsplash',
		title: __('Unsplash', 'extendify-local'),
		component: Unsplash,
	},
];
