<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content={{ csrf_token() }}>
    <link rel="shortcut icon" type="image/png" href="/favicon.png" />

    <!--material css-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/assets/materialize/css/materialize.css" type="text/css">
    <link href="/assets/css/general.css" rel="stylesheet" type="text/css">

    <!--Froala css-->
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


    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.0/lodash.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dustjs-linkedin/2.7.2/dust-core.min.js" defer></script>

    <!--material js-->
    <script src="/assets/materialize/js/materialize.js" defer></script>

    <!--vue js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.16/vue-resource.min.js"></script>

    <!--Froala js-->
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

    <!--tinymce js-->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    @yield("css")
</head>
<body id="main">
    @yield("content")

    @yield("js")
</body>
</html>
