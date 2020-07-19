import React from "react";
import { connect } from "react-redux";
import { handleShowNotificationModal, handleShowModalLogin, handleSetNotifications } from '../../redux/actions';
import NotificationModal from "../modals/NotificationModal";
import UrlService from "../../services/UrlService";

function Notification({ handleShowNotificationModal, handleShowModalLogin, login, numberNotSeen, handleSetNotifications }) {
    function handleSeenNotification() {
        handleShowNotificationModal();
        if (numberNotSeen) {
            axios({
                url: UrlService.setReadNotificationAtUrl(),
                method: 'post'
            }).catch(e => console.log(e));
            handleSetNotifications({notifications: [], numberNotSeen: 0});
        }
    }
    if (login) {
        return (
            <>
                <a onClick={ handleSeenNotification } className="notification">
                    <span className="bell-icon"><i className="fas fa-2x fa-bell"></i></span>
                    {numberNotSeen > 0 && <span className="badge">{numberNotSeen}</span>}
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
    return { login: state.user.login, numberNotSeen: state.user.notifications.numberNotSeen };
};
export default connect(mapStateToProps, { handleShowNotificationModal, handleShowModalLogin, handleSetNotifications })(Notification);
