import React from "react";
import { connect } from "react-redux";
import {handleShowModalLogin, handleShowPostModal} from '../../redux/actions';

function Post({ handleShowPostModal, handleShowModalLogin, login }) {
    if (!login) {
        return (
            <a className="btn-mail" onClick={handleShowModalLogin}><i className="icon icon-mail" /> Đăng bài</a>
        )
    } else {
        return (
            <a className="btn-mail" onClick={handleShowPostModal}><i className="icon icon-mail" /> Đăng bài</a>
        )
    }
}
const mapStateToProps = state => {
    return { login : state.user.login };
};
export default connect(mapStateToProps, { handleShowPostModal, handleShowModalLogin })(Post);
