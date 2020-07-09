import React from "react";
import {Link} from "react-router-dom";

function ArticleThumbLeft({ data }) {
    return (
        <article className="art-thumb-left border-2">
            <div className="thumbnail">
                <Link to={'/' + data.slug + '/' + data.id}>
                    <img src={data.thumb150} />
                </Link>
            </div>
            <div className="info">
                <h4><Link to={'/' + data.slug + '/' + data.id}>{data.name}</Link></h4>
                <span><i className="fas fa-money-bill" /> Giá: {new Intl.NumberFormat().format(data.amount)} VND</span>
                <span><i className="fas fa-location" /> Khu vực: {data.category.name}</span>
                <span><i className="fas fa-phone" /> SĐT: <a href={"tel:"+data.phone}>{data.phone}</a></span>
            </div>
        </article>
    )
}

export default ArticleThumbLeft
