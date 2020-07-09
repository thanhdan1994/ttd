import React from "react";
import Skeleton from "react-loading-skeleton";

const CommentSkeleton = () => {
    return (
        <div className="comment">
            <span className="comment-avatar">EXAMPLE</span>
            <div className="comment-media">
                <div className="comment-content">
                    <span className="comment-name"><Skeleton height={21} /></span>
                    <span className="comment-text">
                       <Skeleton count={3}/>
                    </span>
                </div>
            </div>
        </div>
    )
};
export default CommentSkeleton
