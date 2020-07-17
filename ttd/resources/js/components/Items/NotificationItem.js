import React from "react";
import {Link} from "react-router-dom";

const NotificationItem = React.forwardRef(({ notification }, ref) => {
    return (
        <Link to={"/"} ref={ref}>
            <div className={notification.status === 0 ? "notification-item not-seen" : "notification-item"}>
                <div className="thumb">
                    <img src="https://scontent-sin6-2.xx.fbcdn.net/v/t1.0-1/cp0/p48x48/106922487_1593407717482715_1857948941138900736_n.jpg?_nc_cat=103&amp;_nc_sid=dbb9e7&amp;_nc_ohc=0Z7xj5IWiVUAX_Tf-cn&amp;_nc_ht=scontent-sin6-2.xx&amp;oh=b3339cd07fbbb460b3b52ff80b8ac70c&amp;oe=5F3893B9" />
                </div>
                <div className="content">
                    <span className="message"><strong>{notification.creator.name}</strong> {notification.message.message}</span>
                    <span><i className="far fa-clock"></i> {notification.timeAgo}</span>
                </div>
            </div>
        </Link>
    )
});

export default NotificationItem
