import React, {Fragment} from "react";
import { connect } from "react-redux";
import {handleShowModalLogin, handleShowPostModal} from '../../redux/actions';
import PostModal from "../modals/PostModal";

function Post({ handleShowPostModal, handleShowModalLogin, login }) {
    if (!login) {
        return (
            <a className="btn-mail" onClick={handleShowModalLogin}><i className="icon icon-mail" /> Đăng bài</a>
        )
    } else {
        return (
            <>
                <a className="btn-mail" onClick={handleShowPostModal}><i className="icon icon-mail" /> Đăng bài</a>
                <PostModal/>
            </>
        )
    }
}
const mapStateToProps = state => {
    return { login : state.user.login };
};
export default connect(mapStateToProps, { handleShowPostModal, handleShowModalLogin })(Post);
