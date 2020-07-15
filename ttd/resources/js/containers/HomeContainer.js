import React, { useEffect, useCallback, useRef } from "react";
import { connect } from "react-redux";
import Article475 from "../components/Items/Article475";
import ArticleThumbLeft from "../components/Items/ArticleThumbLeft";
import Article475Skeleton from "../components/skeleton/Article475Skeleton";
import ArticleThumbLeftSkeleton from "../components/skeleton/ArticleThumbLeftSkeleton";
import { handleSetArticles, handleSetLoading, handleSetPage, handleSetHasMore } from "../redux/actions/homepage";
import UrlService from "../services/UrlService";

function HomeContainer({
   articles, loading, handleSetArticles, page,
   handleSetLoading, handleSetPage, handleSetHasMore,
    hasMore
}) {
    const observer = useRef();
    const lastArticleElementRef = useCallback(node => {
        if (loading) return;
        if (observer.current) observer.current.disconnect();
        observer.current = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting && hasMore && page < 4) {
                let nextPage = ++page;
                return loadMoreArticle(nextPage);
            }
        });
        if (node) observer.current.observe(node);
    }, [loading, hasMore]);

    useEffect(() => {
        if (articles.length < 1) {
            let cancel;
            axios({
                method: 'GET',
                url: 'https://ttd.com/homepage.json',
                cancelToken: new axios.CancelToken(c => cancel = c)
            }).then(response => {
                handleSetArticles(response.data.data);
                handleSetLoading(false);
                handleSetPage(page);
                if (response.data.total_pages <= page) {
                    handleSetHasMore(false);
                }
            }).catch(e => {
                if (axios.isCancel(e)) return;
            });
            return () => cancel();
        }
    }, []);

    function loadMoreArticle(nextPage) {
        let cancel;
        axios({
            method: 'GET',
            url: UrlService.getProductsUrl(nextPage, 5),
            cancelToken: new axios.CancelToken(c => cancel = c)
        }).then(response => {
            handleSetArticles(response.data.data);
            handleSetLoading(false);
            handleSetPage(nextPage);
            if (response.data.total_pages <= nextPage) {
                handleSetHasMore(false);
            }
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }
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
                    if (articles.length === index + 1) {
                        return (<ArticleThumbLeft key={index} ref={lastArticleElementRef} data={article} />);
                    }
                    return (<ArticleThumbLeft key={index} data={article} />);
                }
            })}
            {(page >= 4 && hasMore) && <button className="btn-more-down" style={{backgroundSize: '55px'}} onClick={() => loadMoreArticle(++page)} />}
        </section>
    )
}
const mapStateToProps = state => {
    return {
        articles: state.homepage.articles,
        loading: state.homepage.loading,
        page: state.homepage.page,
        hasMore: state.homepage.hasMore
    }
};
export default connect(mapStateToProps, { handleSetArticles, handleSetLoading, handleSetPage, handleSetHasMore })(HomeContainer)
