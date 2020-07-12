import React, { useState, useEffect } from "react";
import Report from "./Report";
import UrlService from "../../services/UrlService";

const BlockListReport = ({productId}) => {
    const [reports, setReports] = useState([]);
    const [page, setPage] = useState(1);

    useEffect(() => {
        let cancel;
        axios({
            method: 'GET',
            url: UrlService.getProductReportsUrl(productId, page),
            cancelToken: new axios.CancelToken(c => cancel = c)
        }).then(response => {
            setReports([...reports, ...response.data.data]);
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }, []);
    return (
        <ul className="list-group list-group-flush">
            {reports.map(report => <Report report={report} key={report.id} />)}
        </ul>
    )
};

export default BlockListReport
