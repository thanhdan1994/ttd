import React from "react";
import { connect } from "react-redux";
import { handleShowWriteReportModal, handleShowModalLogin } from "../../redux/actions";

const WriteReportButton = ({ login, handleShowModalLogin, handleShowWriteReportModal }) => {
    if (login) {
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
