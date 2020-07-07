import React from "react";
import {Link} from "react-router-dom";

function Article475({ data }) {
    return (
        <article className="w-475 border-2">
            <div className="thumbnail">
                <Link to={'/' + data.slug + '/' + data.id}>
                    <img src={data.thumb350} />
                </Link>
            </div>
            <h4>{data.name}</h4>
            <div className="info">
                <div className="info1">
                    <span><i className="fas fa-money-bill" /> Giá: {new Intl.NumberFormat().format(data.amount)} VND</span>
                    <span>Khu vực: {data.category.name} <i className="fas fa-location" /></span>
                </div>
                <div className="info2">
                    <span><i className="fas fa-comment" /> Bình luận: {data.comments_count}</span>
                    <span><a href="tel:0982390731">0982390731</a> <i className="fas fa-phone" /></span>
                </div>
            </div>
        </article>
    )
}

export default Article475
