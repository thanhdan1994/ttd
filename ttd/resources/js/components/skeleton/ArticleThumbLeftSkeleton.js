import React from "react";
import Skeleton from "react-loading-skeleton";

function ArticleThumbLeftSkeleton() {
    return (
        <article className="art-thumb-left border-2">
            <div className="thumbnail">
                <a>
                    <Skeleton height={100} width={150}/>
                </a>
            </div>
            <div className="info">
                <Skeleton height={19} />
                <span><Skeleton height={16} width={150}/></span>
                <span><Skeleton height={16} width={150}/></span>
                <span><Skeleton height={16} width={150}/></span>
            </div>
        </article>
    )
}
export default ArticleThumbLeftSkeleton
