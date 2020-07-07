let apiDomain = '';
if (process.env.NODE_ENV === 'production') {
    apiDomain = 'https://ttd.com/';
} else {
    apiDomain = 'https://ttd.com/';
}

class UrlService {
    static loginUrl() { return apiDomain + 'api/login'}
    static createUserUrl() { return apiDomain + 'api/register'}
    static createProductUrl() { return apiDomain + 'api/product'}
    static getProductDetailUrl(slug, id) { return apiDomain + 'api/product/' + slug + "/" + id}
    static likeProductUrl() { return apiDomain + 'api/product/like' }
    static dislikeProductUrl() { return apiDomain + 'api/product/dislike' }
    static getProductsUrl(page, size) { return apiDomain + 'api/product' + '?page=' + page + '&size=' + size }
}

export default UrlService;
