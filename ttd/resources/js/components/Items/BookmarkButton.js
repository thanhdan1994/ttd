import React, {useState} from "react";
import { connect } from "react-redux";
import { handleBookmark } from "../../redux/actions/detailpage";
import { handleShowModalLogin } from "../../redux/actions";
import UrlService from "../../services/UrlService";
import CookieService from "../../services/CookieService";

const BookmarkButton = ({ bookmark, handleBookmark, login, handleShowModalLogin, productId }) => {
    const [loading, setLoading] = useState(false);
    function addBookmark() {
        setLoading(true);
        axios({
            url: UrlService.addOrRemoveBookmarkUrl(productId),
            method: 'post',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer '+ CookieService.get('access_token'),
            }
        }).then(response => {
            handleBookmark(true);
            setLoading(false);
        }).catch(e => {});
    }
    function removeBookmark() {
        setLoading(true);
        axios({
            url: UrlService.addOrRemoveBookmarkUrl(productId),
            method: 'delete',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer '+ CookieService.get('access_token'),
            }
        }).then(response => {
            handleBookmark(false);
            setLoading(false);
        }).catch(e => {});
    }
    if (login) {
        if (bookmark) {
            if (loading) {
                return <span><i className="far fa-bookmark text-primary" /> Đã đánh dấu</span>
            }
            return <span onClick={removeBookmark}><i className="far fa-bookmark text-primary" /> Đã đánh dấu</span>
        } else {
            if (loading) {
                return <span><i className="far fa-bookmark" /> Đánh dấu</span>
            }
            return <span onClick={addBookmark}><i className="far fa-bookmark" /> Đánh dấu</span>
        }
    }
    return <span onClick={handleShowModalLogin}><i className="far fa-bookmark" /> Đánh dấu</span>
};
const mapStateToProps = state => {
    return { bookmark: state.product.bookmark, login: state.user.login };
};
export default connect(mapStateToProps, { handleBookmark, handleShowModalLogin })(BookmarkButton)
