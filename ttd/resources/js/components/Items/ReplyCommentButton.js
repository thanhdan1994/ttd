import React from "react";
import { connect } from "react-redux";
import { handleShowModalLogin } from "../../redux/actions";

const ReplyCommentButton = ({ login, handleShowModalLogin, handleShowBlockSendComment }) => {
    if (login) {
        return (
            <span className="rep-comment" onClick={handleShowBlockSendComment}><i className="far fa-reply"></i></span>
        )
    }
    return (
        <span className="rep-comment" onClick={handleShowModalLogin}><i className="far fa-reply"></i></span>
    )
};

const mapStateToProps = state => {
    return { login: state.user.login }
};
export default connect(mapStateToProps, { handleShowModalLogin })(ReplyCommentButton);
