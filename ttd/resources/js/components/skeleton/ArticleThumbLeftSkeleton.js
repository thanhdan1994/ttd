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
                <span><i className="fas fa-money-bill" /> Giá: <Skeleton height={21} width={56}/> VND</span>
                <span><i className="fas fa-location" /> Khu vực: <Skeleton height={21} width={80}/></span>
                <span><i className="fas fa-phone" /><a> SĐT: <Skeleton height={21} width={80}/></a></span>
            </div>
        </article>
    )
}
export default ArticleThumbLeftSkeleton
