import React, {useState} from "react";
import { connect } from "react-redux";
import { handleBookmark } from "../../redux/actions/detailpage";
import { handleShowModalLogin } from "../../redux/actions";
import UrlService from "../../services/UrlService";

const BookmarkButton = ({ bookmark, handleBookmark, login, handleShowModalLogin, productId }) => {
    const [loading, setLoading] = useState(false);
    function bookmarkProduct() {
        setLoading(true);
        axios({
            url: UrlService.bookmarkProductUrl(productId),
            method: 'post'
        }).then(response => {
            handleBookmark(true);
            setLoading(false);
        }).catch(e => {});
    }
    function unbookmarkProduct() {
        setLoading(true);
        axios({
            url: UrlService.unbookmarkProductUrl(productId),
            method: 'delete'
        }).then(response => {
            handleBookmark(false);
            setLoading(false);
        });
    }
    if (login) {
        if (bookmark) {
            if (loading) {
                return <span><i className="far fa-bookmark text-primary" /> Đã đánh dấu</span>
            }
            return <span onClick={unbookmarkProduct}><i className="far fa-bookmark text-primary" /> Đã đánh dấu</span>
        } else {
            if (loading) {
                return <span><i className="far fa-bookmark" /> Đánh dấu</span>
            }
            return <span onClick={bookmarkProduct}><i className="far fa-bookmark" /> Đánh dấu</span>
        }
    }
    return <span onClick={handleShowModalLogin}><i className="far fa-bookmark" /> Đánh dấu</span>
};
const mapStateToProps = state => {
    return { bookmark: state.product.bookmark, login: state.user.login };
};
export default connect(mapStateToProps, { handleBookmark, handleShowModalLogin })(BookmarkButton)
