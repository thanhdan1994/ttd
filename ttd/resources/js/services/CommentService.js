import axios from 'axios';
import UrlService from "./UrlService";
import CookieService from "./CookieService";

class CommentService {
    async likeComment(id) {
        try {
            const response = await axios.post(UrlService.likeCommentUrl(id), null, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '+ CookieService.get('access_token'),
                }
            });
            return  response.data;
        } catch (error) {
            console.error('Error', error.response);
            return false;
        }
    }
    async removeLikeComment(id) {
        try {
            const response = await axios.delete(UrlService.removeLikeCommentUrl(id), {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '+ CookieService.get('access_token'),
                }
            });
            return  response.data;
        } catch (error) {
            console.error('Error', error.response);
            return false;
        }
    }
}

export default new CommentService();
