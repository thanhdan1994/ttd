import axios from 'axios';
import UrlService from "./UrlService";
import CookieService from "./CookieService";

class PostService {
    async doCreatePost(formData) {
        try {
            const response = await axios.post(UrlService.createProductUrl(), formData, {
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

export default new PostService();
