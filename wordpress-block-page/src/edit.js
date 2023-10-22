import {
    useBlockProps,
    RichText,
    InspectorControls
} from '@wordpress/block-editor';

import {
    TextControl,
    ToggleControl,
    PanelBody,
    PanelRow
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {

    const blockProps = useBlockProps();

    return (
        <>
            <InspectorControls>
                <PanelBody title="Block Settings" initialOpen={false}>
					<PanelRow>
                        <TextControl
                            label="Staff ID (leave blank for all)"
                            onChange={(list_id) => setAttributes({ list_id })}
                            value={attributes.list_id}
                        />
                    </PanelRow>
                </PanelBody>
            </InspectorControls>
            <div {...blockProps}>
				<span>Team Block</span>
            </div>
        </>
    )
}