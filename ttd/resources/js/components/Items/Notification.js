import React from "react";
import { connect } from "react-redux";
import { handleShowNotificationModal, handleShowModalLogin, handleSetNotifications } from '../../redux/actions';
import NotificationModal from "../modals/NotificationModal";
import UrlService from "../../services/UrlService";

function Notification({ handleShowNotificationModal, handleShowModalLogin, login, numberCommentUnread, handleSetNotifications }) {
    function handleSeenNotification() {
        handleShowNotificationModal();
        if (numberCommentUnread) {
            axios({
                url: UrlService.setReadNotificationAtUrl(),
                method: 'post'
            }).catch(e => console.log(e));
            handleSetNotifications({notifications: [], numberCommentUnread: 0});
        }
    }
    if (login) {
        return (
            <>
                <a onClick={ handleSeenNotification } className="notification">
                    <span className="bell-icon"><i className="fas fa-2x fa-bell"></i></span>
                    {numberCommentUnread > 0 && <span className="badge">{numberCommentUnread}</span>}
                </a>
                <NotificationModal />
            </>
        )
    }
    return (
        <a onClick={ handleShowModalLogin } className="notification">
            <span className="bell-icon"><i className="fas fa-2x fa-bell"></i></span>
        </a>
    )
}

const mapStateToProps = state => {
    return { login: state.user.login, numberCommentUnread: state.user.notifications.numberCommentUnread };
};
export default connect(mapStateToProps, { handleShowNotificationModal, handleShowModalLogin, handleSetNotifications })(Notification);
