import React, {useCallback, useEffect, useRef, useState} from "react";
import { connect } from "react-redux";
import ArticleThumbLeftSkeleton from "../components/skeleton/ArticleThumbLeftSkeleton";
import ArticleThumbLeft from "../components/Items/ArticleThumbLeft";
import UrlService from "../services/UrlService";
import { handleSetBookmarks, handleSetHasMore, handleSetPage } from "../redux/actions/bookmarkpage";
import CookieService from "../services/CookieService";

function BookmarkContainer({ login, page, hasMore, bookmarks, handleSetBookmarks, handleSetHasMore, handleSetPage }) {
    const [loading, setLoading] = useState(false);

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
    }, [hasMore]);

    useEffect(() => {
        if (bookmarks.length < 1) {
            setLoading(true);
            let cancel;
            axios({
                method: 'GET',
                url: UrlService.getProductsBookmarkUrl(page, 5),
                cancelToken: new axios.CancelToken(c => cancel = c),
            }).then(response => {
                setLoading(false);
                handleSetBookmarks(response.data.data);
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
            url: UrlService.getProductsBookmarkUrl(nextPage, 5),
            cancelToken: new axios.CancelToken(c => cancel = c),
        }).then(response => {
            handleSetBookmarks(response.data.data);
            handleSetPage(nextPage);
            if (response.data.total_pages <= nextPage) {
                handleSetHasMore(false);
            }
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }

    if (login) {
        return (
            <section>
                {loading && Array(5).fill().map((item, index) => {
                    return (<ArticleThumbLeftSkeleton key={index} />);
                })}
                {bookmarks.map((bookmark, index) => {
                    if (bookmarks.length === index + 1) {
                        return (<ArticleThumbLeft key={index} ref={lastArticleElementRef} data={bookmark.product} />);
                    }
                    return (<ArticleThumbLeft key={index} data={bookmark.product} />);
                })}
                {bookmarks.length < 1 && <span className="note pl-3">Bạn vẫn chưa có sản phẩm đánh dấu.</span>}
            </section>
        )
    }
    window.location.href = "/";
}

const mapStateToProps = state => {
    return {
        login: state.user.login,
        bookmarks: state.bookmarkpage.bookmarks,
        page: state.bookmarkpage.page,
        hasMore: state.bookmarkpage.hasMore
    }
};
export default connect(mapStateToProps, { handleSetBookmarks, handleSetHasMore, handleSetPage })(BookmarkContainer)
