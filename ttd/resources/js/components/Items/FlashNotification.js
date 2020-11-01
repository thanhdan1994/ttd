import React, {useEffect, useState} from "react";
import { connect } from "react-redux";
import Alert from "react-bootstrap/Alert";

function FlashNotification({ numberCommentUnread }) {
    const [show, setShow] = useState(false);
    useEffect(() => {
        if (numberCommentUnread) {
            setShow(true);
        }
    }, [numberCommentUnread]);
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
    return { numberCommentUnread: state.user.notifications.numberCommentUnread };
};
export default connect(mapStateToProps, null)(FlashNotification);
