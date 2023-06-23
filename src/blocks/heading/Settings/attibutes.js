import { addFilter } from '@wordpress/hooks';

const addHeadingAttributes = ( settings, name ) => {
    if(name === "core/heading"){
        settings.attributes = {
            ...settings.attributes,
            counter: {
                type: 'number',
                default: 0
            }
        }
    }
    return settings;
}

addFilter('blocks.registerBlockType', 'noobs-core-blocks-xtender/heading', addHeadingAttributes);