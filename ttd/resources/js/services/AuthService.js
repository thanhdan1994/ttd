import UrlService from "./UrlService";
import CookieService from "./CookieService";

const expiresAt = 60 * 24;

class AuthService {
    async doUserLogin(credentials) {
        try {
            const response = await axios.post(UrlService.loginUrl(), credentials);
            return  response.data;
        } catch (error) {
            console.error('Error', error.response);
            return false;
        }
    }

    async registerUser(formData) {
        try {
            const response = await axios.post(UrlService.createUserUrl(), formData);
            return  response.data;
        } catch (error) {
            return error.response.data;
        }
    }

    doUserLogout() {
        CookieService.remove('access_token');
        window.location.reload(false);
    }

    handleLoginSuccess(response, remember) {
        if (!remember) {
            const options = { path: '/'};
            CookieService.set('access_token', response.access_token, options);
            return true;
        }
        let date = new Date();
        date.setTime(date.getTime() + expiresAt * 60 * 1000)
        const options = { path: '/', expires: date};
        CookieService.set('access_token', response.access_token, options);
        return true;
    }

    handleRegisterSuccess(response) {
        const options = { path: '/'};
        CookieService.set('access_token', response.token, options);
        return true;
    }
}

export default new AuthService();
