@extends("index_init")

@section("css")
    <title>Gossip Board</title>
    <link href="/assets/css/index.css" rel="stylesheet" type="text/css">

    <link href="/assets/css/index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/froala_editor.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/froala_style.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/code_view.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/colors.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/draggable.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/emoticons.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/fullscreen.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/image_manager.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/image.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/line_breaker.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/table.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/char_counter.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/video.css">
    <link rel="stylesheet" href="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/css/plugins/quick_insert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

@endsection


@section("index_content")
<?php
    header("Content-Security-Policy: default-src *");
?>
    <div id="index_container" class="center container">
        <br/><br/>
        <ul class="collapsible popout" data-collapsible="accordion">
            <li class="row">
              <div class="collapsible-header">
                  <span class="s3 col left-align">發表日期</span>
                  <span class="s2 col left-align">Author</span>
                  <span class="s2 col left-align">Title</span>
                  <span class="s2 col center">回覆</span>
                  <span class="s3 col left-align">最後更新</span>
              </div>
            </li>
            @for($i=0; $i<count($articleData); $i++)
                @if($articleData[$i]->status == 0)
                    <li class="row">
                        <div class="collapsible-header">
                            <span class="s3 col left-align">{{$articleData[$i]->created_at}}</span>
                            <span class="s2 col left-align">{{$articleData[$i]->name}}</span>
                            <span class="s2 col left-align">{{$articleData[$i]->title}}</span>
                            <span class="s2 col">
                                <span class="chip">
                                    {{count($articleData[$i]->reply)}}
                                </span>
                            </span>
                            <span class="s3 col left-align">{{$articleData[$i]->latestDate}}</span>
                        </div>
                        <div class="collapsible-body row">
                            <div class="article_content s12 col">
                                <p class="content left-align">
                                    <a class="single_page_link" href="article/{{$articleData[$i]->id}}"><i class="material-icons right">input</i></a>
                                    {!!  nl2br($articleData[$i]->content) !!}
                                    <!---->
                                </p>
                            </div>
                            <div class="input-field s12 col replyDiv">
                                <i class="material-icons prefix">account_box</i>
                                <!--<input class="reply_content reply" type="text" name="reply">-->
                                <!--<textarea class="reply_content reply materialize-textarea"></textarea>-->
                                <!--<iframe src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/html/iframe.html" frameborder="0" border="0" cellspacing="0" width="100%";></iframe>-->
                                <!--<div id="editor">
                                    <div id='edit'>
                                    </div>
                                </div>-->

                                <i class="check_reply material-icons right" data-aid="{{$articleData[$i]->id}}">send</i>
                                <label for="reply">reply</label>
                            </div>
                            <div class="reply_record s12 col">
                                @for($j=0; $j<count($articleData[$i]->reply); $j++)
                                    <p class="row">
                                        <span class="author s2 col left-align">{{$articleData[$i]->reply[$j]->name}}</span>
                                        <span class="reply_content s7 col left-align">
                                            <span>
                                                {!!  nl2br($articleData[$i]->reply[$j]->content) !!}
                                                <?php
                                                    /*$str = ($articleData[$i]->reply[$j]->content);
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
                                                    }*/
                                                ?>
                                            </span>
                                        </span>
                                        <span class="s3 col right-align">{{$articleData[$i]->reply[$j]->created_at}}</span>
                                    </p>
                                @endfor
                            </div>
                        </div>
                    </li>
                @endif
            @endfor
        </ul>
    </div>

@endsection

@section("js")
    <script src="/assets/js/index.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/froala_editor.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/align.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/code_beautifier.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/code_view.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/colors.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/draggable.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/emoticons.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/font_size.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/font_family.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/fullscreen.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/image.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/image_manager.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/line_breaker.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/link.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/lists.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/paragraph_format.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/paragraph_style.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/table.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/video.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/url.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/entities.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/char_counter.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/inline_style.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/save.min.js"></script>
    <script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052/wysiwyg-editor/js/plugins/quick_insert.min.js"></script>

@endsection
