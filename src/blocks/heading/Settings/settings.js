import { createHigherOrderComponent } from '@wordpress/compose';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import { addFilter } from '@wordpress/hooks';
import { __ } from '@wordpress/i18n';
import { NoobsButton } from '../../../components';
import { HeightControl } from '@wordpress/block-editor';
import { useState } from '@wordpress/element';

const addNoobsExtraComponents = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const [ value, setValue ] = useState();
        return (
            <>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody title={__('Extra Controls', 'noobs-core-blocks-xtender')}>
                        <NoobsButton
                            onClick={() => {
                                props.setAttributes({
                                    counter: props.attributes.counter + 1
                                })
                            }}
                            value={props.attributes.counter}
                        />
                        <HeightControl
                            label={'My Height Control'}
                            onChange={setValue}
                            value={value}
                        />
                    </PanelBody>
                </InspectorControls>
            </>
        );
    };
}, 'addNoobsExtraComponents');
addFilter("editor.BlockEdit", "noobs-core-blocks-xtender/heading-editor", addNoobsExtraComponents);