import React from "react";
import { connect } from "react-redux";
import { handleShowLatestModal } from '../../redux/actions';

function Latest({handleShowLatestModal}) {
    return (
        <a className="btn-news" onClick={handleShowLatestModal}>Tin Mới Nhất<i className="icon icon-back" /></a>
    )
}

export default connect(null, { handleShowLatestModal })(Latest);
