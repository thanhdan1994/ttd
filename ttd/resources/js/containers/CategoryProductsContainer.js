import React, {useEffect, useState} from "react";
import ArticleThumbLeftSkeleton from "../components/skeleton/ArticleThumbLeftSkeleton";
import ArticleThumbLeft from "../components/Items/ArticleThumbLeft";
import UrlService from "../services/UrlService";

function CategoryProductsContainer({match}) {
    const [loading, setLoading] = useState(true);
    const [articles, setArticles] = useState([]);
    useEffect(() => {
        let cancel;
        setLoading(true);
        axios({
            method: 'GET',
            url: UrlService.getProductsByCategoryUrl(match.params.id),
            cancelToken: new axios.CancelToken(c => cancel = c),
        }).then(response => {
            setArticles(response.data);
            setLoading(false);
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }, [match.params.id]);

    return (
        <section>
            {loading && Array(5).fill().map((item, index) => {
                return (<ArticleThumbLeftSkeleton key={index} />);
            })}
            {articles.map((article, index) => {
                return (<ArticleThumbLeft key={index} data={article} />);
            })}
        </section>
    )
}

export default CategoryProductsContainer
