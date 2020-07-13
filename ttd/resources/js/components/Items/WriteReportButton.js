import React from "react";
import { connect } from "react-redux";
import { handleShowWriteReportModal, handleShowModalLogin } from "../../redux/actions";

const WriteReportButton = ({ login, handleShowModalLogin, handleShowWriteReportModal, reported }) => {
    if (login) {
        if (reported) {
            return (
                <span className="note">Bạn đã gửi đánh giá cho sản phẩm này</span>
            )
        }
        return (
            <button className="btn btn-yellow" onClick={handleShowWriteReportModal}>
                <i className="fas fa-pen" /> Viết Report
            </button>
        )
    }
    return (
        <button className="btn btn-yellow" onClick={handleShowModalLogin}>
            <i className="fas fa-pen" /> Viết Report
        </button>
    )
};

const mapStateToProps = state => {
    return { login: state.user.login };
};
export default connect(mapStateToProps , { handleShowModalLogin, handleShowWriteReportModal })(WriteReportButton)
