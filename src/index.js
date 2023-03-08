/**
 * WordPress dependencies.
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';

/**
 * Internal dependencies.
 */
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit: () => (
		<p { ...useBlockProps() }>
			{ __( 'My Block – hello from the editor!', 'my-block' ) }
		</p>
	),

	save: () => (
		<p { ...useBlockProps.save() }>
			{ __( 'My Block – hello from the saved content!', 'my-block' ) }
		</p>
	),
} );
