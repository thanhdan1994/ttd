import React, { Fragment } from "react";
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

function Main() {
    return (
        <Fragment>
            <Header/>
            <Route exact path="/" component={HomeContainer}/>
            <Route exact path="/bookmarks" component={BookmarkContainer}/>
            <Route path="/:slug/:id" component={DetailContainer}/>
            <Footer/>
            <div className="bottom-bar">
                <Latest/>
                <Post/>
            </div>
            <LoginModal/>
            <RegisterModal/>
            <LatestContentModal/>
            <SearchModal/>
        </Fragment>
    )
}

export default Main
