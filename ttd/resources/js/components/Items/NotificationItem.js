import React from "react";
import {Link} from "react-router-dom";
import {connect} from "react-redux";
import {handleCloseModal} from "../../redux/actions";

const NotificationItem = (props) => {
    return (
        <Link to={props.notification.link} ref={props.myForwardedRef} onClick={handleCloseModal}>
            <div className={props.notification.status === 0 ? "notification-item not-seen" : "notification-item"}>
                <div className="thumb">
                    <img src="https://icon-library.com/images/facebook-icon-50x50/facebook-icon-50x50-25.jpg" />
                </div>
                <div className="content">
                    <span className="message"><strong>{props.notification.creator.name}</strong> {props.notification.message.message}</span>
                    <span><i className="far fa-clock"></i> {props.notification.timeAgo ? props.notification.timeAgo : 'vừa xong'}</span>
                </div>
            </div>
        </Link>
    )
}


const ConnectedNotificationItem = connect(null, { handleCloseModal })(NotificationItem);

export default React.forwardRef((props, ref) =>
    <ConnectedNotificationItem {...props} myForwardedRef={ref} />
);
