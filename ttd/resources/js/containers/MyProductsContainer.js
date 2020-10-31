import React, {useEffect, useState} from "react";
import { connect } from "react-redux";
import ArticleThumbLeftSkeleton from "../components/skeleton/ArticleThumbLeftSkeleton";
import ArticleThumbLeft from "../components/Items/ArticleThumbLeft";
import UrlService from "../services/UrlService";

function MyProductsContainer({ login }) {
    const DEFAULT_SIZE = 10;
    const [loading, setLoading] = useState(false);
    const [articles, setArticles] = useState([]);

    useEffect(() => {
        setLoading(true);
        let cancel;
        axios({
            method: 'GET',
            url: UrlService.getMyProductsUrl(1, DEFAULT_SIZE),
            cancelToken: new axios.CancelToken(c => cancel = c),
        }).then(response => {
            setLoading(false);
            setArticles(response.data);
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }, []);

    if (login) {
        return (
            <section>
                {loading && Array(DEFAULT_SIZE).fill().map((item, index) => {
                    return (<ArticleThumbLeftSkeleton key={index} />);
                })}
                {articles.map((article, index) => {
                    return (<ArticleThumbLeft key={index} data={article} />);
                })}
                {articles.length < 1 && <span className="note pl-3">Bạn vẫn chưa có sản phẩm nào cả :(.</span>}
            </section>
        )
    }
    window.location.href = "/";
}

const mapStateToProps = state => {
    return {
        login: state.user.login,
    }
};
export default connect(mapStateToProps, null)(MyProductsContainer)
