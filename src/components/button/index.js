import { Button } from '@wordpress/components';

const NoobsButton = (props) => {
    return(
        <div className="noobs-components noobs-components-button">
            <Button variant="secondary" onClick={props.onClick}>{props.value || 0}</Button>
        </div>
    )
}

export default NoobsButton;