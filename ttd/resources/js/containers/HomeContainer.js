import React, { useState, useEffect } from "react";
import Article475 from "../components/Items/Article475";
import ArticleThumbLeft from "../components/Items/ArticleThumbLeft";
import PostService from "../services/PostService";

function HomeContainer() {
    const [articles, setArticles] = useState([]);

    useEffect(() => {
        async function fetchArticles() {
            const response = await PostService.getProducts();
            setArticles(response.data);
        }
        fetchArticles();
    }, []);
    return (
        <section>
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
