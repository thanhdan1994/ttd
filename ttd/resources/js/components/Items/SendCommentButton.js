import React from "react";
import { connect } from "react-redux";
import { handleShowModalLogin } from "../../redux/actions";

const SendCommentButton = ({ login, handleShowModalLogin, handleSendComment }) => {
    if (!login) {
        return (
            <button className="send-comment" onClick={handleShowModalLogin}><i className="far fa-paper-plane"></i></button>
        )
    } else {
        return (
            <button className="send-comment" onClick={handleSendComment}><i className="far fa-paper-plane"></i></button>
        )
    }
};

const mapStateToProps = state => {
    return {
        login: state.user.login,
    };
};

export default connect(mapStateToProps, { handleShowModalLogin })(SendCommentButton)
