import { Icon, Dropdown, MenuGroup, MenuItem } from '@wordpress/components';
import { __, sprintf } from '@wordpress/i18n';
import { moreVertical, check } from '@wordpress/icons';
import { useAIChatStore } from '@help-center/state/ai-chat';

export const Nav = ({ setShowHistory }) => {
	const experienceLevels = {
		beginner: __('Beginner', 'extendify-local'),
		intermediate: __('Intermediate', 'extendify-local'),
		advanced: __('Advanced', 'extendify-local'),
	};
	const { historyCount, hasHistory, experienceLevel, setExperienceLevel } =
		useAIChatStore();

	return (
		<nav className="absolute z-10 flex gap-2 items-center justify-between mx-4 mt-3 right-0">
			<div className="flex gap-2 items-center">
				<Dropdown
					className="flex"
					contentClassName="origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
					popoverProps={{ placement: 'bottom-start' }}
					renderToggle={({ onToggle }) => (
						<span>
							<Icon
								icon={moreVertical}
								onClick={onToggle}
								size={28}
								className="text-design-text fill-current p-1 rounded cursor-pointer hover:bg-white/10"
							/>
							<span className="sr-only">
								{__('Toggle menu', 'extendify-local')}
							</span>
						</span>
					)}
					renderContent={({ onClose }) => (
						<MenuGroup label={__('WordPress Comfort Level', 'extendify-local')}>
							{Object.entries(experienceLevels).map(([key, label]) => (
								<MenuItem
									key={key}
									isSelected={experienceLevel === key}
									onClick={() => {
										setExperienceLevel(key);
										onClose();
									}}
									icon={experienceLevel === key ? check : null}>
									{label}
								</MenuItem>
							))}
							<hr />
							<MenuItem
								disabled={!hasHistory()}
								onClick={() => {
									setShowHistory(true);
									onClose();
								}}>
								{sprintf(
									__('Chat History (%d)', 'extendify-local'),
									historyCount,
								)}
							</MenuItem>
						</MenuGroup>
					)}
				/>
			</div>
		</nav>
	);
};
