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
                    <span><i className="fas fa-money-bill" /> Giá: <Skeleton height={21} width={56}/> VND</span>
                    <span>Khu vực: <Skeleton height={21} width={80}/> <i className="fas fa-location" /></span>
                </div>
                <div className="info2">
                    <span><i className="fas fa-comment" /> Bình luận: <Skeleton height={21} width={20}/></span>
                    <span><a> SĐT: <Skeleton height={21} width={80}/></a> <i className="fas fa-phone" /></span>
                </div>
            </div>
        </article>
    )
};
export default Article475Skeleton
