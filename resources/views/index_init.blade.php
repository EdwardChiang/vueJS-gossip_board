@extends("init")


@section("content")
    <nav id="index_nav">
        <div class="nav-wrapper">
            <i id="show_side_nav" class="material-icons left">view_list</i>
            <a href="/" class="brand-logo center">Gossip Board</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="dropdown-button" href="#!" data-activates="logoutDropdown">Hello {{Auth::user()->name}}!<i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </div>
        <ul id="logoutDropdown" class="dropdown-content">
            <li><a class="modal-trigger" href="#create_article_modal">發表新主題</a></li>
            <li><a href="/">所有文章列表</a></li>
            <li><a href="/recentArticle">您近期更新/<br/>被留言的文章</a></li>
            <li class="divider"></li>
            <li><a href="/auth/logout">Logout</a></li>
        </ul>
    </nav>

    @yield("index_content")


    <!-- create article modal -->
    <div id="create_article_modal" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="input-field col s11">
                        <i class="material-icons prefix">subtitles</i>
                        <input id="create_article_title" type="text" class="validate">
                        <label for="create_article_title">Title</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div class="input-field col s11">
                        <i class="material-icons prefix">translate</i>
                        <textarea id="create_article_content" class="materialize-textarea"></textarea>
                        <label for="create_article_content">Content</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a id="check_create_article" class=" modal-action modal-close waves-effect waves-green btn-flat">Done<i class="material-icons right">send</i></a>
        </div>
    </div>

    <!--side nav-->
    <ul id="side_nav" class="side-nav fixed" style="transform: translateX(0px);">
        <li class="bold"><a href="/" class="waves-effect waves-light">所有文章列表</a></li>
        <li class="bold"><a href="/recentArticle" class="waves-effect waves-light ">您近期更新/被留言的文章 Started</a></li>
    </ul>
    <div id="hide_side_nav"></div>

@endsection

