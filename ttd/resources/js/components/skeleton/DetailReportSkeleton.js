import React from "react";
import Skeleton from "react-loading-skeleton";

const DetailReportSkeleton = () => {
    return (
        <>
            <div className="report-content">
                <Skeleton count={5}/>
            </div>
            <div className="form-group">
                <Skeleton height={32} />
                <Skeleton height={32} />
                <Skeleton height={32} />
                <Skeleton height={32} />
            </div>
            <div className="row">
                <div className="col-6">
                    <Skeleton height={140} />
                </div>
                <div className="col-6">
                    <Skeleton height={140} />
                </div>
                <div className="col-6">
                    <Skeleton height={140} />
                </div>
                <div className="col-6">
                    <Skeleton height={140} />
                </div>
            </div>
        </>
    )
};

export default DetailReportSkeleton
