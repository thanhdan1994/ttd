import React from "react";
import {Link} from "react-router-dom";
import {connect} from "react-redux";
import {handleCloseModal} from "../../redux/actions";

const NotificationItem = React.forwardRef(({ notification, handleCloseModal }, ref) => {
    return (
        <Link to={notification.link} ref={ref} onClick={handleCloseModal}>
            <div className={notification.status === 0 ? "notification-item not-seen" : "notification-item"}>
                <div className="thumb">
                    <img src="https://icon-library.com/images/facebook-icon-50x50/facebook-icon-50x50-25.jpg" />
                </div>
                <div className="content">
                    <span className="message"><strong>{notification.creator.name}</strong> {notification.message.message}</span>
                    <span><i className="far fa-clock"></i> {notification.timeAgo ? notification.timeAgo : 'vừa xong'}</span>
                </div>
            </div>
        </Link>
    )
});

export default connect(null, { handleCloseModal }) (NotificationItem)
