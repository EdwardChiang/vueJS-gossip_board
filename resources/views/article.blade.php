@extends("index_init")

@section("css")
    <title>Article</title>
    <link href="/assets/css/article.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/index.css" rel="stylesheet" type="text/css">
@endsection


@section("index_content")
    <br/><br/><br/><br/>
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="container z-depth-3">
                <div  id="article_container" class="card">
                    <div class="card-action right">
                        @if($articleData[0]->uid == Auth::user()->id)
                            <!--<img id="option_article" src="/assets/img/expand-button.png" class="dropdown-button" data-activates="update_article"/>-->
                            <img id="option_article" src="http://dmplus.cs.ccu.edu.tw/~s402410052/hw3/assets/img/expand-button.png" class="dropdown-button" data-activates="update_article"/>
                            <ul id='update_article' class='dropdown-content'>
                                <li><a href="#editArticleModal" class="modal-trigger">Edit</a></li>
                                <li class="divider"></li>
                                <li><a href="#deleteArticleModal" class="modal-trigger">Delete</a></li>
                            </ul>
                        @endif
                    </div>

                    <div class="card-content black-text">
                        <div>
                            <h1 class="card-title">{{$articleData[0]->title}}</h1>
                            <div class="author_div right right-align">
                                @if($articleData[0]->game == 1)
                                    <span class="center">
                                        <a href="/game/{{$articleData[0]->id}}" target="_blank" class="btn indigo darken-3" style="margin-bottom: 5px;">Play</a>
                                    </span>
                                @endif
                                <i class="account_box material-icons prefix">account_box</i>
                                <span class="author" style="font-size: 16px; ">{{$articleData[0]->name}}</span><br/>
                                <span class="updated_at" style="font-size: 16px">{{$articleData[0]->latestDate}}</span>
                            </div>
                        </div>
                        <div class="card-content row">
                            <div class="article_content s12 col">
                                <?php
                                    $str = $articleData[0]->content;
                                    $from = strrpos($str, "<meta");
                                    if($from === false) {
                                        $from = -1;
                                        $to = -1;
                                    } else {
                                        $to = strrpos($str, ">");
                                    }

                                    for($i=0; $i<strlen($str); $i++) {
                                        if($from != -1) {
                                            if($i>=$from && $i<=$to+1) {
                                                echo htmlspecialchars($str[$i]);
                                            }
                                            else echo $str[$i];
                                        }
                                        else echo $str[$i];
                                    }
                                ?>
                                <!---->
                            </div>
                            <div class="s12 col">
                                <p class="content-line left-align"></p>
                            </div>
                            <div class="userReply input-field s12 col  center">
                                <i class="material-icons prefix">account_box</i>
                                <textarea class="reply_content reply materialize-textarea"></textarea>
                                <i class="check_reply material-icons right" data-aid={{$articleData[0]->id}}>send</i>
                                <label for="reply">reply</label>

                                <div class="row">
                                    <button id="drawBtn" class="btn">Draw</button>
                                </div>
                                <div class="drawImgDiv center"></div>
                            </div>
                            <div class="reply_record s12 col">
                                <p class="row"></p>
                                @for($j=0; $j<count($articleData[0]->reply); $j++)
                                    <p id="rid_{{$articleData[0]->reply[$j]->id}}" class="row">
                                        <span class="author s2 col right-align">{{$articleData[0]->reply[$j]->name}}</span>
                                        <span class="reply_content s7 col left-align">
                                            <span>
                                                <?php
                                                    $str = ($articleData[0]->reply[$j]->content);
                                                    $token = strtok($str, "\n");
                                                    while ($token !== false)
                                                    {
                                                        $len = preg_match_all('/(\w+)|(.)/u', $token, $matches);
                                                        for($k=0; $k<$len; $k++)
                                                        {
                                                            echo    htmlspecialchars($matches[0][$k]);
                                                        }
                                                        echo "<br/>";

                                                        $token = strtok("\n");
                                                    }
                                                ?>
                                            </span>
                                        </span>
                                        <span class="s3 col right-align">{{$articleData[0]->reply[$j]->created_at}}</span>
                                        <img width="100%" class="replyImg">
                                    </p>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--edit modal-->
    <div id="editArticleModal" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="input-field col s11">
                        <i class="material-icons prefix">subtitles</i>
                        <input id="edit_article_title" type="text" class="validate" value="{{$articleData[0]->title}}">
                        <label for="edit_article_title">Title</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div id="editArticleContentDiv" class="input-field col s11">
                        <i class="material-icons prefix">translate</i>
                        <!--<textarea id="edit_article_content" class="materialize-textarea">{!! $articleData[0]->content !!}</textarea>-->
                        <textarea id="edit_article_content" class="materialize-textarea tinyMCE">{!! $articleData[0]->content !!}</textarea>
                        <label for="edit_article_content">Content</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a id="check_edit_article" data-aid="{{$articleData[0]->id}}" class=" modal-action modal-close waves-effect waves-green btn-flat">Done<i class="material-icons right">send</i></a>
        </div>
    </div>

    <!--delete modal-->
    <div id="deleteArticleModal" class="modal">
        <div class="modal-content">
            <div class="row">
                <h1>Are you sure to delete the article?</h1>
                <div class="center">
                    <a id="check_delete_article" data-aid="{{$articleData[0]->id}}" class="modal-action modal-close btn-large waves-effect waves-light red">yes</a>
                </div>
            </div>
        </div>
    </div>


@endsection

@section("js")
    <script src="/assets/js/article.js"></script>
    <script src="/assets/js/index.js"></script>
    <script src="/assets/js/p5.js"></script>
    <!--<script src="http://dmplus.cs.ccu.edu.tw/~s402410052//vueJS-gossip_board/assets/js/article.js"></script>-->
    <!--<script src="http://dmplus.cs.ccu.edu.tw/~s402410052//vueJS-gossip_board/assets/js/index.js"></script>-->
@endsection