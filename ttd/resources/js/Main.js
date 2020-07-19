import React, { Fragment } from "react";
import { Route } from "react-router-dom";
import Header from "./components/Header";
import Footer from "./components/Footer";
import LoginModal from "./components/modals/LoginModal";
import RegisterModal from "./components/modals/RegisterModal";
import Post from "./components/Items/Post";
import SearchModal from "./components/modals/SearchModal";
import HomeContainer from "./containers/HomeContainer";
import DetailContainer from "./containers/DetailContainer";
import BookmarkContainer from "./containers/BookmarkContainer";
import NearbyContainer from "./containers/NearbyContainer";
import Menu from "./components/Items/Menu";
import Notification from "./components/Items/Notification";

function Main() {
    return (
        <Fragment>
            <Header/>
            <Route exact path="/" component={HomeContainer}/>
            <Route path="/nearby" component={NearbyContainer}/>
            <Route path="/bookmarks" component={BookmarkContainer}/>
            <Route path="/:slug/:id" component={DetailContainer}/>
            <Footer/>
            <div className="bottom-bar">
                <Notification />
                <Post/>
                <Menu />
            </div>
            <LoginModal/>
            <RegisterModal/>
            <SearchModal/>
        </Fragment>
    )
}
export default Main
