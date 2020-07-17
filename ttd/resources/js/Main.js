import React, { Fragment, useEffect } from "react";
import { connect } from "react-redux";
import { Route } from "react-router-dom";
import Header from "./components/Header";
import Footer from "./components/Footer";
import LatestContentModal from "./components/modals/LatestContentModal";
import LoginModal from "./components/modals/LoginModal";
import RegisterModal from "./components/modals/RegisterModal";
import Latest from "./components/Items/Latest";
import Post from "./components/Items/Post";
import SearchModal from "./components/modals/SearchModal";
import HomeContainer from "./containers/HomeContainer";
import DetailContainer from "./containers/DetailContainer";
import BookmarkContainer from "./containers/BookmarkContainer";
import NearbyContainer from "./containers/NearbyContainer";
import Menu from "./components/Items/Menu";
import UrlService from "./services/UrlService";

function Main({ login }) {
    useEffect(() => {
        if (login) {
            axios({
                url: UrlService.getUserInfoUrl(),
                method: 'get'
            }).then(response => {
                let userChannel = window.Echo.channel('user-channel.'+response.data.id);
                userChannel.listen('.user-event', function(data) {
                    console.log(data);
                });
            });
        }
    }, []);
    return (
        <Fragment>
            <Header/>
            <Route exact path="/" component={HomeContainer}/>
            <Route path="/nearby" component={NearbyContainer}/>
            <Route path="/bookmarks" component={BookmarkContainer}/>
            <Route path="/:slug/:id" component={DetailContainer}/>
            <Footer/>
            <div className="bottom-bar">
                <Latest/>
                <Post/>
                <Menu />
            </div>
            <LoginModal/>
            <RegisterModal/>
            <LatestContentModal/>
            <SearchModal/>
        </Fragment>
    )
}
const mapStateToProps = state => {
    return { login: state.user.login };
};
export default connect(mapStateToProps, null)(Main)
