@extends("init")


@section("content")
    <nav id="index_nav">
        <div class="nav-wrapper">
            <i id="show_side_nav" class="material-icons left">view_list</i>
            <a href="/" class="brand-logo center">Gossip Board</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="dropdown-button" href="#!" data-activates="logoutDropdown"><h6 style="float: left;">Hello {{Auth::user()->name}}!</h6><i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </div>
        <ul id="logoutDropdown" class="dropdown-content">
            <li><a id="create_article_modal_link" class="modal-trigger" href="#create_article_modal">發表新主題</a></li>
            <li><a href="/">所有文章列表</a></li>
            <li><a href="/recentArticle">您近期更新/<br/>被留言的文章</a></li>
            <li class="divider"></li>
            <li><a href="/auth/logout">Logout</a></li>
        </ul>
    </nav>

    @yield("index_content")


    <!-- create article modal -->
    <div id="create_article_modal" class="modal">
        <form enctype="multipart/form-data" accept-charset="utf-8" method="POST" id="createArticleForm" action="/api/article/create">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s11">
                            <i class="material-icons prefix">subtitles</i>
                            <input id="create_article_title" name="title" type="text" class="validate">
                            <label for="create_article_title">Title</label>
                        </div>
                    </div>
                </div>
                <div class="file_input_div row">
                    <div class="file_input">
                        <label class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">
                            <i class="material-icons">file_upload</i>
                            <input id="file_input_file" name="unityFile" class="none" type="file" />
                        </label>
                    </div>
                    <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                        <input class="file_input_text mdl-textfield__input" type="text" disabled readonly id="file_input_text" style="color: black;" placeholder="unity file"/>
                        <label class="mdl-textfield__label" for="file_input_text"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div id="createArticleContentDiv" class="input-field col s11">
                            <i class="material-icons prefix translate">translate</i>
                            <!--<div class="Editor"></div>-->
                            <input id="createArticleContent" type="hidden" name="content">
                            <textarea id="create_article_content" class="materialize-textarea tinyMCE"></textarea>
                            <label for="create_article_content">Content</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!--<a id="check_create_article" class=" modal-action modal-close waves-effect waves-green btn-flat">Done<i class="material-icons right">send</i></a>-->

                <button id="check_create_article" class="btn waves-effect waves-light" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>

    <!--<form enctype="multipart/form-data" accept-charset="utf-8"  id="upload_form" role="form" method="POST" action="/api/article/create">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="file" name="file" required=""/>

        <button id="submitbutton" type="submit">Upload</button>

        <div id="status_area"></div>
    </form>-->

    <!--side nav-->
    <ul id="side_nav" class="side-nav fixed" style="transform: translateX(0px);">
        <li class="bold"><a href="/" class="waves-effect waves-light">所有文章列表</a></li>
        <li class="bold"><a href="/recentArticle" class="waves-effect waves-light ">您近期更新/被留言的文章 Started</a></li>
    </ul>
    <div id="hide_side_nav"></div>

@endsection

