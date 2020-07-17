import React from "react";
import { connect } from "react-redux";
import { handleShowNotificationModal, handleShowModalLogin } from '../../redux/actions';
import NotificationModal from "../modals/NotificationModal";

function Notification({ handleShowNotificationModal, handleShowModalLogin, login }) {
    if (login) {
        return (
            <>
                <a onClick={ handleShowNotificationModal } className="notification">
                    <span className="bell-icon"><i className="fas fa-2x fa-bell"></i></span>
                    <span className="badge">3</span>
                </a>
                <NotificationModal />
            </>
        )
    }
    return (
        <a onClick={ handleShowModalLogin } className="notification">
            <span className="bell-icon"><i className="fas fa-2x fa-bell"></i></span>
            <span className="badge">3</span>
        </a>
    )
}

const mapStateToProps = state => {
    return { login: state.user.login };
};
export default connect(mapStateToProps, { handleShowNotificationModal, handleShowModalLogin })(Notification);
