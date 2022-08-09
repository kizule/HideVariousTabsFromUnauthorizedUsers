<?php

class HideVariousTabsFromUnauthorizedUsers {
	/**
	 * @param SkinTemplate $skinTemplate
	 * @param array &$links
	 * @return bool
	 */
	public static function onSkinTemplateNavigation( SkinTemplate $skinTemplate, array &$links ) {
		global $wgTabsToRemove;
		$user = RequestContext::getMain()->getUser();

		// Only remove tabs if user isn't allowed to edit pages
		if ( !$user->isRegistered() ) {

			// Remove talkpage tab
			if ( isset( $links['namespaces']['talk'] ) ) {
				unset( $links['namespaces']['talk'] );
			}

			// Remove actions tabs
			foreach ( $wgTabsToRemove as $view ) {
				if ( isset( $links['views'][$view] ) ) {
					unset( $links['views'][$view] );
				}
			}
		}

		return true;
	}
}
