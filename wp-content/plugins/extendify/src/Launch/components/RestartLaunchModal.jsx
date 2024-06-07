import apiFetch from '@wordpress/api-fetch';
import { Spinner } from '@wordpress/components';
import { useEffect, useState, forwardRef, useRef } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';
import { Dialog } from '@headlessui/react';
import classnames from 'classnames';
import { AnimatePresence, motion } from 'framer-motion';

export const RestartLaunchModal = ({ setPage, resetState }) => {
	const oldPages = window.extOnbData.resetSiteInformation.pagesIds ?? [];
	const oldNavigations =
		window.extOnbData.resetSiteInformation.navigationsIds ?? [];
	const templatePartsIds =
		window.extOnbData.resetSiteInformation.templatePartsIds ?? [];

	const [open, setOpen] = useState(false);
	const [processing, setProcessing] = useState(false);
	const initialFocus = useRef(null);
	const handleExit = () =>
		(window.location.href = `${window.extSharedData.adminUrl}admin.php?page=extendify-assist`);

	const handleOk = async () => {
		setProcessing(true);
		resetState();
		for (const pageId of oldPages) {
			try {
				await apiFetch({
					path: `/wp/v2/pages/${pageId}`,
					method: 'DELETE',
				});
			} catch (responseError) {
				console.warn(
					`delete pages failed to delete a page (id: ${pageId}) with the following error`,
					responseError,
				);
			}
		}
		// delete the wp_navigation posts created by Launch
		for (const navigationId of oldNavigations) {
			try {
				await apiFetch({
					path: `/wp/v2/navigation/${navigationId}`,
					method: 'DELETE',
				});
			} catch (responseError) {
				console.warn(
					`delete navigation failed to delete a navigation (id: ${navigationId}) with the following error`,
					responseError,
				);
			}
		}

		for (const template of templatePartsIds) {
			try {
				await apiFetch({
					path: `/wp/v2/template-parts/${template}?force=true`,
					method: 'DELETE',
				});
			} catch (responseError) {
				console.warn(
					`delete template failed to delete template (id: ${template}) with the following error`,
					responseError,
				);
			}
		}

		setOpen(false);
	};

	useEffect(() => {
		if (oldPages.length > 0) {
			setOpen(true);
			setPage(0);
		}
	}, [oldPages.length, setOpen, setPage]);

	return (
		<AnimatePresence>
			{open && (
				<Dialog
					initialFocus={initialFocus}
					static
					open={open}
					as={motion.div}
					initial={false}
					animate={{ opacity: 1 }}
					exit={{ opacity: 0 }}
					data-test="confirmation-launch"
					className="extendify-launch extendify-launch-modal"
					onClose={() => null}>
					<div className="mx-auto md:p-8 w-full flex justify-center items-center h-screen absolute top-0">
						<div
							className="fixed inset-0 bg-black/30"
							style={{ backdropFilter: 'blur(2px)', zIndex: 99999 }}
							aria-hidden="true"
						/>
						<div
							style={{ zIndex: 99999 + 100 }}
							className="sm:flex mx-6 rounded relative shadow-2xl sm:overflow-hidden bg-white max-w-screen-3xl">
							<Dialog.Panel className="flex flex-col">
								<Dialog.Title className="m-0 py-6 pr-7 pl-8 font-bold text-gray-900 text-2xl	flex items-center">
									{__('Start over?', 'extendify-local')}
								</Dialog.Title>
								<div className="text-left relative py-0 px-8 text-base font-normal max-w-screen-sm">
									{__(
										'Go through the onboarding process again to create a new site.',
										'extendify-local',
									)}
									<br />
									<strong>
										{sprintf(
											// translators: %3$s is the number of old pages
											__(
												'%s pages created in the prior onboarding session will be deleted.',
												'extendify-local',
											),
											oldPages.length,
										)}
									</strong>
								</div>
								<div className="px-8 py-8 flex justify-end space-x-4 text-base">
									<NavigationButton
										data-test="modal-exit-button"
										onClick={handleExit}
										disabled={processing}
										className="bg-white text-design-main border-gray-200 hover:bg-gray-50 focus:bg-gray-50">
										{__('Exit', 'extendify-local')}
									</NavigationButton>
									<NavigationButton
										onClick={handleOk}
										disabled={processing}
										className="bg-design-main text-design-text border-design-main"
										data-test="modal-continue-button">
										{!processing ? (
											__('Continue', 'extendify-local')
										) : (
											<div className="flex items-center justify-center">
												<Spinner />
												<div>{__('Processing', 'extendify-local')}</div>
											</div>
										)}
									</NavigationButton>
								</div>
							</Dialog.Panel>
						</div>
					</div>
				</Dialog>
			)}
		</AnimatePresence>
	);
};

const NavigationButton = forwardRef((props, ref) => {
	return (
		<button
			ref={ref}
			{...props}
			className={classnames(
				'rounded flex items-center px-6 py-3 leading-6 button-focus border',
				{
					'opacity-50 cursor-not-allowed': props.disabled,
				},
				props.className,
			)}
			type="button">
			{props.children}
		</button>
	);
});
