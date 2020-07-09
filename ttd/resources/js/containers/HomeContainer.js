import React, { useState, useEffect } from "react";
import Article475 from "../components/Items/Article475";
import ArticleThumbLeft from "../components/Items/ArticleThumbLeft";
import ProductService from "../services/ProductService";
import Article475Skeleton from "../components/skeleton/Article475Skeleton";
import ArticleThumbLeftSkeleton from "../components/skeleton/ArticleThumbLeftSkeleton";

function HomeContainer() {
    const [articles, setArticles] = useState([]);
    const [loading, setLoading] = useState(true);
    useEffect(() => {
        async function fetchArticles() {
            const response = await ProductService.getProducts();
            setArticles(response.data);
            setLoading(false);
        }
        fetchArticles();
    }, []);
    return (
        <section>
            {loading && Array(5).fill().map((item, index) => {
                if (index === 0) {
                    return (<Article475Skeleton key={index} />);
                } else {
                    return (<ArticleThumbLeftSkeleton key={index} />);
                }
            })}
            {articles.map((article, index) => {
                if (index === 0) {
                    return (<Article475 key={index} data={article} />);
                } else {
                    return (<ArticleThumbLeft key={index} data={article} />);
                }
            })}
        </section>
    )
}

export default HomeContainer
