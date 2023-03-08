/**
 * WordPress dependencies.
 */
import domReady from '@wordpress/dom-ready';
import { __ } from '@wordpress/i18n';
import { render } from '@wordpress/element';

const SettingsPage = () => (
	<div style={ {
		padding: '15px',
		background: '#fff',
		border: '3px solid #72aee6',
	} }>
		{ __( 'Hello world', 'my-block' ) }
	</div>
);

domReady( () => {
	render(
		<SettingsPage />,
		document.getElementById( 'my-block' )
	);
} );
