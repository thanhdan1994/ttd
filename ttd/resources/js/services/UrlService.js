let apiDomain = '';
if (process.env.NODE_ENV === 'production') {
    apiDomain = 'https://ttd.com/';
} else {
    apiDomain = 'https://ttd.com/';
}

class UrlService {
    static loginUrl() { return apiDomain + 'api/login'}
}

export default UrlService;
