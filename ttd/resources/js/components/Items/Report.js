import React from "react";
import { connect } from "react-redux";
import { handleShowReportModal } from "../../redux/actions";

const Report = ({ report, handleShowReportModal }) => {
    return (
        <li className="list-group-item"><strong>{report.author.name}</strong> đã gửi <span className="text-primary" onClick={() => handleShowReportModal(report.id) }>đánh giá</span> cho sản phẩm này</li>
    )
};
export default connect(null, { handleShowReportModal })(Report)
