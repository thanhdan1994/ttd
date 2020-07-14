import React, {useEffect, useState} from "react";
import Article475Skeleton from "../components/skeleton/Article475Skeleton";
import ArticleThumbLeftSkeleton from "../components/skeleton/ArticleThumbLeftSkeleton";
import Article475 from "../components/Items/Article475";
import ArticleThumbLeft from "../components/Items/ArticleThumbLeft";
import UrlService from "../services/UrlService";
import ArticleNearby475 from "../components/Items/ArticleNearby475";
import ArticleNearbyThumbLeft from "../components/Items/ArticleNearbyThumbLeft";

function NearbyContainer() {
    const [loading, setLoading] = useState(true);
    const [articles, setArticles] = useState([]);
    const [page, setPage] = useState(2);
    const [hasMore, setHasMore] = useState(true);
    const [lat, setLat] = useState(0);
    const [long, setLong] = useState(0);
    useEffect(() => {
        let cancel;
        navigator.geolocation.getCurrentPosition(function(position) {
            setLoading(true);
            setLat(position.coords.latitude);
            setLong(position.coords.longitude);
            axios({
                url: UrlService.getProductsNearbyUrl(position.coords.latitude, position.coords.longitude),
                method: 'get',
                cancelToken: new axios.CancelToken(c => cancel = c)
            }).then(response => {
                if (response) {
                    setArticles(response.data);
                    setLoading(false);
                    if (response.data.length < 10) {
                        setHasMore(false);
                    }
                }
            }).catch(e => {
                if (axios.isCancel(e)) return;
            });
        });
        return () => cancel();
    }, []);

    function loadMoreArticles() {
        let cancel;
        setPage(page + 1);
        axios({
            url: UrlService.getProductsNearbyUrl(lat, long, page, 10),
            method: 'get',
            cancelToken: new axios.CancelToken(c => cancel = c)
        }).then(response => {
            if (response) {
                setArticles([...articles, ...response.data]);
                setLoading(false);
                if (response.data.length < 10) {
                    setHasMore(false);
                }
            }
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }
    return (
        <section>
            {loading && Array(5).fill().map((item, index) => {
                return (<Article475Skeleton key={index} />);
            })}
            {articles.map((article, index) => {
                if (index < 5) {
                    return (<ArticleNearby475 key={index} data={article} />);
                } else {
                    return (<ArticleNearbyThumbLeft key={index} data={article} />);
                }
            })}
            {hasMore && <button className="btn-more-down" style={{backgroundSize: '55px'}} onClick={loadMoreArticles}/>}
        </section>
    )
}
export default NearbyContainer
