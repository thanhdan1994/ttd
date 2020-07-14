import React from "react";
import Skeleton from "react-loading-skeleton";

const Article475Skeleton = () => {
    return (
        <article className="w-475 border-2">
            <div className="thumbnail">
                <Skeleton height={200}/>
            </div>
            <h4><Skeleton height={28}/></h4>
            <div className="info">
                <div className="info1">
                    <span><Skeleton height={16} width={150}/></span>
                    <span><Skeleton height={16} width={150}/></span>
                </div>
                <div className="info2">
                    <span><Skeleton height={16} width={150}/></span>
                    <span><a><Skeleton height={16} width={150}/></a></span>
                </div>
            </div>
        </article>
    )
};
export default Article475Skeleton
