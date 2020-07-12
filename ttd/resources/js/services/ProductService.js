import axios from 'axios';
import UrlService from "./UrlService";
import CookieService from "./CookieService";

class ProductService {
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

    async getProducts(page = 1, size = 10) {
        try {
            const response = await axios.get(UrlService.getProductsUrl(page, size));
            return  response.data;
        } catch (error) {
            console.error('Error', error.response);
            return false;
        }
    }

    async getProductDetail(slug, id) {
        try {
            const response = await axios.get(UrlService.getProductDetailUrl(slug, id), {
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
    async doLikeProduct(productId) {
        try {
            const response = await axios.post(UrlService.likeProductUrl(), {id: productId}, {
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

    async doUnLikeProduct(productId) {
        try {
            const response = await axios.post(UrlService.dislikeProductUrl(), {id: productId}, {
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

    async getComments(productId, page = 1) {
        try {
            const response = await axios.get(UrlService.getProductCommentsUrl(productId, page), {
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

    async sendComment(productId, formData) {
        try {
            const response = await axios.post(UrlService.sendCommentUrl(productId), formData, {
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

    async sendReport(productId, formData) {
        try {
            const response = await axios.post(UrlService.sendReportUrl(productId), formData, {
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

export default new ProductService();
