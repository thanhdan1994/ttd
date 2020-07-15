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
    static likeProductUrl(id) { return apiDomain + 'api/product/'+id+'/like' }
    static dislikeProductUrl(id) { return apiDomain + 'api/product/'+id+'/dislike' }
    static getProductsUrl(page, size) { return apiDomain + 'api/product' + '?page=' + page + '&size=' + size }
    static getProductCommentsUrl(id, page) {
        if (page > 1) {
            return apiDomain + 'api/product/'+ id +'/comments' + '?page=' + page;
        }
        return apiDomain + 'api/product/'+ id +'/comments';
    }
    static getProductReportsUrl(id, page) {
        if (page > 1) {
            return apiDomain + 'api/product/'+ id +'/reports' + '?page=' + page;
        }
        return apiDomain + 'api/product/'+ id +'/reports';
    }
    static likeCommentUrl(id) { return apiDomain + 'api/comment/' + id + '/like' }
    static unlikeCommentUrl(id) { return apiDomain + 'api/comment/' + id + '/like' }
    static sendCommentUrl(id) { return apiDomain + 'api/product/' + id + '/comment' }
    static sendReportUrl(id) { return apiDomain + 'api/product/' + id + '/report' }
    static getReportUrl(id) { return apiDomain + 'api/report/'+id }
    static addOrRemoveBookmarkUrl(id) { return apiDomain + 'api/product/'+id+'/bookmark' }
    static getProductsBookmarkUrl(page, size) { return apiDomain + 'api/bookmark' + '?page=' + page + '&size=' + size }
    static getProductsNearbyUrl(lat, long, page = 1, size = 10) { return apiDomain + 'api/product/nearby' + '?lat='+lat+'&long='+long+'&page=' + page + '&size=' + size }
}

export default UrlService;
