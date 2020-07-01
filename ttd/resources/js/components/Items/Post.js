import React from "react";
import { connect } from "react-redux";
import { handleShowPostModal } from '../../redux/actions';

function Post({ handleShowPostModal }) {
    return (
        <a className="btn-mail" onClick={handleShowPostModal}><i className="icon icon-mail" /> Đăng bài</a>
    )
}

export default connect(null, { handleShowPostModal })(Post);
