@extends("index_init")

@section("css")
    <title>Gossip Board</title>
    <link href="/assets/css/index.css" rel="stylesheet" type="text/css">
@endsection


@section("index_content")

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
                                    <?php
                                        $str = ($articleData[$i]->content);
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
                                </p>
                            </div>
                            <div class="input-field s12 col">
                                <i class="material-icons prefix">account_box</i>
                                <!--<input class="reply_content reply" type="text" name="reply">-->
                                <textarea class="reply_content reply materialize-textarea"></textarea>
                                <i class="check_reply material-icons right" data-aid="{{$articleData[$i]->id}}">send</i>
                                <label for="reply">reply</label>
                            </div>
                            <div class="reply_record s12 col">
                                @for($j=0; $j<count($articleData[$i]->reply); $j++)
                                    <p class="row">
                                        <span class="author s2 col left-align">{{$articleData[$i]->reply[$j]->name}}</span>
                                        <span class="reply_content s7 col left-align">
                                            <span>
                                                <?php
                                                    $str = ($articleData[$i]->reply[$j]->content);
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
@endsection
