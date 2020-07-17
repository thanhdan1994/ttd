import React, {useCallback, useEffect, useRef, useState} from "react";
import { Modal } from 'react-bootstrap';
import { connect } from "react-redux";
import { handleCloseModal, handleSetNotifications } from "../../redux/actions";
import UrlService from "../../services/UrlService";
import NotificationItem from "../Items/NotificationItem";

function NotificationModal({
       handleCloseModal,
       showNotificationModal,
       handleSetNotifications,
       notifications
}) {
    const [page, setPage] = useState(1);
    const [hasMore, setHasMore] = useState(true);
    const [loading, setLoading] = useState(false);
    const observer = useRef();
    const lastNotificationElementRef = useCallback(node => {
        if (loading) return;
        if (observer.current) observer.current.disconnect();
        observer.current = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting && page < 4 && hasMore) {
                let loadNotificationPage = page + 1;
                return loadMoreNotification(loadNotificationPage);
            }
        });
        if (node) observer.current.observe(node);
    }, [page]);

    useEffect(() => {
        axios({
            url: UrlService.getNotificationsUrl(1, 10),
            method: 'get',
        }).then(response => {
            handleSetNotifications(response.data);
            if (response.data.length < 10) {
                setHasMore(false);
            }
        }).catch(e => console.log(e));
    }, []);

    function loadMoreNotification(loadNotificationPage) {
        axios({
            url: UrlService.getNotificationsUrl(loadNotificationPage, 10),
            method: 'get',
        }).then(response => {
            setLoading(false);
            handleSetNotifications(response.data);
            setPage(loadNotificationPage);
            if (response.data.length < 10) {
                setHasMore(false);
            }
        }).catch(e => console.log(e));
    }
    return (
        <Modal show={showNotificationModal} onHide={handleCloseModal} animation={false} id="notificationsModal">
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Thông báo</h4>
                    <button type="button" className="close" onClick={handleCloseModal}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body mt-3">
                    <div className="notifications">
                        {notifications.map(notification => <NotificationItem notification={notification} key={notification.id} ref={lastNotificationElementRef}/>)}
                    </div>
                    {(page >= 4 && hasMore) && <button onClick={() => loadMoreNotification(page + 1)} className="btn-more-down" style={{backgroundSize: '55px'}} />}
                </div>
            </div>
        </Modal>
    )
}
const mapStateToProps = state => {
    return {
        showNotificationModal: state.modal.showNotificationModal,
        notifications: state.user.notifications
    };
};
export default connect(mapStateToProps, { handleCloseModal, handleSetNotifications })( NotificationModal );
