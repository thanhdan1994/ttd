import React, {useEffect, useState} from "react";
import { connect } from "react-redux";
import Alert from "react-bootstrap/Alert";

function FlashNotification({ numberNotSeen }) {
    const [show, setShow] = useState(false);
    useEffect(() => {
        if (numberNotSeen) {
            setShow(true);
        }
    }, [numberNotSeen]);
    if (show) {
        return (
            <Alert className="flash-notification" variant="success" onClose={() => setShow(false)} dismissible>
                <Alert.Heading>Bạn có thông báo mới</Alert.Heading>
            </Alert>
        )
    }
    return null;
}
const mapStateToProps = state => {
    return { numberNotSeen: state.user.notifications.numberNotSeen };
};
export default connect(mapStateToProps, null)(FlashNotification);
