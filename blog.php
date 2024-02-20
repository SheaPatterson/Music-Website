<?php if(! strstr(ini_get('disable_functions'), 'ini_set')) {ini_set('default_charset','UTF-8');}header('Content-Type: text/html; charset=UTF-8');header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');header('Cache-Control: post-check=0, pre-check=0', false);header('Pragma: no-cache'); ?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Blog</title>
<meta name="referrer" content="same-origin">
<link rel="canonical" href="http://heavyrocker.com/blog.php">
<meta name="robots" content="max-image-preview:large">
<meta name="viewport" content="width=960">
<?php

    $pages = 10;
    $page = (isset($_GET['page']) ? $_GET['page'] : 1);
    if($page < 1) {
        $page = 1;
    }
    $current_page = 1;
    $current_result = 0;

    $blogName = 'blog';
    $blogJSON = file_get_contents($blogName . '.json');
    if($blogJSON === FALSE) {
        echo $blogName;
        exit(-1);
    }

    $blogData = json_decode($blogJSON, TRUE);
    if($blogData == NULL) {
        echo "JSON";
        exit(-2);
    }

    $blogPostsPerPage = $blogData['blogPostsPerPage'];
    $blogPostsMargin = $blogData['blogPostsMargin'];
    $blogPosts = $blogData['blogPosts'];
    $tag = (isset($_GET['tag']) ? $_GET['tag'] : NULL);
    if($tag !== NULL) {
        $filteredBlogPosts = array();
        foreach($blogPosts as $blogPost) {
            if(in_array($tag, $blogPost['tags'])) {
                $filteredBlogPosts[] = $blogPost;
            }
        }
        $blogPosts = $filteredBlogPosts;
    }
    $devices = $blogData['devices'];
    $css = $blogData['css'];
    $mq = $blogData['mq'];

    $end_page = $page + $pages / 2 - 1;
    if($end_page < $pages) {
        $end_page = $pages;
    }
    $blogPostsCount = count($blogPosts);
    $blogPostsPages = intval(($blogPostsCount - 1) / $blogPostsPerPage) + 1;
    if($blogPostsPages < $end_page) {
        $end_page = $blogPostsPages;
    }

    $start_page = $end_page + 1 - $pages;
    if($start_page < 1) {
        $start_page = 1;
    }

    $style = '';
    foreach($devices as $deviceInfo) {
        $pos = strpos($deviceInfo, ':');
        $device = substr($deviceInfo, 0, $pos);
        $deviceWidth = substr($deviceInfo, $pos + 1);
        if(!isset($css[$device])) continue;
        $deviceCSSClasses = $css[$device];
        $mediaQuery = (isset($mq[$device]) ? $mq[$device] : NULL);
        if($mediaQuery !== NULL) {
            $style .= "@media " . $mediaQuery . ' {';
        }
        $style .= ".bpwc{width:100%;margin:auto}";
        $style .= ".bpc{width:" . $deviceWidth . "px;margin:auto}";
        $style .= ".bpm{margin-top:" . $blogPostsMargin[$device] . "px}";
        $cssClassesAdded = array();
        $blogPostIndex = ($page - 1) * $blogPostsPerPage;
        $count = 0;
        while($blogPostIndex < $blogPostsCount && ++$count <= $blogPostsPerPage) {
            $blogPost = $blogPosts[$blogPostIndex++];

            $cssClasses = $blogPost['cssClasses'];
            foreach($cssClasses as $cssClass) {
                if(!in_array($cssClass, $cssClassesAdded) && isset($deviceCSSClasses[$cssClass])) {
                    $style .= $deviceCSSClasses[$cssClass];
                }
                $cssClassesAdded[] = $cssClass;
            }
        }
        if($mediaQuery !== NULL) {
            $style .= '}';
        }
    }
    echo "<style>" . $style . "</style>";

?>

<link rel="preload" href="css/Quicksand-Regular.woff2" as="font" crossorigin>
<style>html,body{-webkit-text-zoom:reset !important}@font-face{font-display:block;font-family:"Montserrat";src:url('css/Montserrat-Regular.woff2') format('woff2'),url('css/Montserrat-Regular.woff') format('woff');font-weight:400}@font-face{font-display:block;font-family:"Permanent Marker";src:url('css/PermanentMarker.woff2') format('woff2'),url('css/PermanentMarker.woff') format('woff');font-weight:400}@font-face{font-display:block;font-family:"Quicksand";src:url('css/Quicksand-Bold.woff2') format('woff2'),url('css/Quicksand-Bold.woff') format('woff');font-weight:700}@font-face{font-display:block;font-family:"Quicksand";src:url('css/Quicksand-Regular.woff2') format('woff2'),url('css/Quicksand-Regular.woff') format('woff');font-weight:400}@font-face{font-display:block;font-family:"Quicksand";src:url('css/Quicksand-Medium.woff2') format('woff2'),url('css/Quicksand-Medium.woff') format('woff');font-weight:500}body>div{font-size:0}p,span,h1,h2,h3,h4,h5,h6,a,li{margin:0;word-spacing:normal;word-wrap:break-word;-ms-word-wrap:break-word;pointer-events:auto;-ms-text-size-adjust:none !important;-moz-text-size-adjust:none !important;-webkit-text-size-adjust:none !important;text-size-adjust:none !important;max-height:10000000px}sup{font-size:inherit;vertical-align:baseline;position:relative;top:-0.4em}sub{font-size:inherit;vertical-align:baseline;position:relative;top:0.4em}ul{display:block;word-spacing:normal;word-wrap:break-word;line-break:normal;list-style-type:none;padding:0;margin:0;-moz-padding-start:0;-khtml-padding-start:0;-webkit-padding-start:0;-o-padding-start:0;-padding-start:0;-webkit-margin-before:0;-webkit-margin-after:0}li{display:block;white-space:normal}[data-marker]::before{content:attr(data-marker) ' ';-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none}li p{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none}form{display:inline-block}a{text-decoration:inherit;color:inherit;-webkit-tap-highlight-color:rgba(0,0,0,0)}textarea{resize:none}.shm-l{float:left;clear:left}.shm-r{float:right;clear:right}.btf{display:none}.plyr{min-width:0 !important}html{font-family:sans-serif}body{font-size:0;margin:0;--z:1;zoom:var(--z)}audio,video{display:inline-block;vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background:0 0;outline:0}b,strong{font-weight:700}dfn{font-style:italic}h1,h2,h3,h4,h5,h6{font-size:1em;line-height:1;margin:0}img{border:0}svg:not(:root){overflow:hidden}button,input,optgroup,select,textarea{color:inherit;font:inherit;margin:0}button{overflow:visible}button,select{text-transform:none}button,html input[type=button],input[type=submit]{-webkit-appearance:button;cursor:pointer;box-sizing:border-box;white-space:normal}input[type=date],input[type=email],input[type=number],input[type=password],input[type=text],textarea{-webkit-appearance:none;appearance:none;box-sizing:border-box}button[disabled],html input[disabled]{cursor:default}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}input{line-height:normal}input[type=checkbox],input[type=radio]{box-sizing:border-box;padding:0}input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{height:auto}input[type=search]{-webkit-appearance:textfield;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box}input[type=search]::-webkit-search-cancel-button,input[type=search]::-webkit-search-decoration{-webkit-appearance:none}textarea{overflow:auto;box-sizing:border-box;border-color:#ddd}optgroup{font-weight:700}table{border-collapse:collapse;border-spacing:0}td,th{padding:0}blockquote{margin-block-start:0;margin-block-end:0;margin-inline-start:0;margin-inline-end:0}:-webkit-full-screen-ancestor:not(iframe){-webkit-clip-path:initial !important}
html{-webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale}#b{background-color:#fff}.c43{display:block;position:relative;width:max(960px, 100%);overflow:hidden;margin-top:-3px;min-height:315px}.v4{display:inline-block;vertical-align:top}.ps26{position:relative;margin-top:3px}.s49{width:100%;min-width:960px;min-height:213px}.c44{z-index:34;pointer-events:none}.ps27{position:relative;margin-top:0}.s50{width:100%;min-width:960px;min-height:211px;height:211px}.c45{z-index:52;border-top:0;border-bottom:2px solid rgba(0,0,0,.5);background-clip:padding-box;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;background-color:#ea4229;box-shadow:0 2px 5px rgba(0,0,0,.4)}.ps28{position:relative;margin-top:1px}.v5{display:block;vertical-align:top}.s51{min-width:960px;width:960px;margin-left:auto;margin-right:auto;min-height:214px}.ps29{position:relative;margin-left:20px;margin-top:18px}.s52{min-width:923px;width:923px;min-height:174px}.ps30{position:relative;margin-left:0;margin-top:0}.s53{min-width:205px;width:205px;min-height:174px;height:174px}.c47{z-index:53;pointer-events:auto}.a1{display:block}.i1{position:absolute;left:0;width:205px;height:174px;top:0;-webkit-border-radius:18px;-moz-border-radius:18px;border-radius:18px;-webkit-filter:drop-shadow(1px 2px 10px rgba(0,0,0,.5));-moz-filter:drop-shadow(1px 2px 10px rgba(0,0,0,.5));filter:drop-shadow(1px 2px 10px rgba(0,0,0,.5));will-change:filter;border:0}.i2{width:100%;height:100%;display:inline-block}.v6{display:inline-block;vertical-align:top;overflow:visible}.ps31{position:relative;margin-left:154px;margin-top:122px}.s54{min-width:564px;width:564px;min-height:52px;height:52px}.c48{z-index:54;pointer-events:auto}.v7{display:inline-block;vertical-align:top;overflow:hidden}.ps32{position:relative;margin-top:-45px}.s55{width:100%;min-width:960px}.c49{z-index:1;pointer-events:none}.ps33{position:relative;margin-top:88px}.s56{pointer-events:none;min-width:960px;width:960px;margin-left:auto;margin-right:auto;min-height:54px}.ps34{display:inline-block;position:relative;left:50%;-ms-transform:translate(-50%,0);-webkit-transform:translate(-50%,0);transform:translate(-50%,0)}.ps35{position:relative;margin-left:42px;margin-top:3px}.s57{min-width:859px;width:859px;min-height:48px}.c50{z-index:47}.s58{min-width:61px;width:61px;min-height:48px}.c51{z-index:35;pointer-events:auto}.f26{font-family:Quicksand;font-size:18px;font-size:calc(18px * var(--f));line-height:1.390;font-weight:700;font-style:normal;text-decoration:none;text-transform:none;letter-spacing:normal;text-shadow:none;text-indent:0;text-align:center;padding-top:11px;padding-bottom:10px;margin-top:0;margin-bottom:0}.btn1{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn1:hover{background-color:#fff;border-color:#292626;color:#292626}.btn1:active{background-color:#808080;border-color:#292626;color:#fff}.v8{display:inline-block;overflow:hidden;outline:0}.s59{width:59px;padding-right:0;height:25px}.ps36{position:relative;margin-left:12px;margin-top:0}.c52{z-index:36;pointer-events:auto}.btn2{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn2:hover{background-color:#fff;border-color:#292626;color:#292626}.btn2:active{background-color:#808080;border-color:#292626;color:#fff}.ps37{position:relative;margin-left:11px;margin-top:0}.c53{z-index:37;pointer-events:auto}.btn3{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn3:hover{background-color:#fff;border-color:#292626;color:#292626}.btn3:active{background-color:#808080;border-color:#292626;color:#fff}.c54{z-index:38;pointer-events:auto}.btn4{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn4:hover{background-color:#fff;border-color:#292626;color:#292626}.btn4:active{background-color:#808080;border-color:#292626;color:#fff}.c55{z-index:39;pointer-events:auto}.btn5{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn5:hover{background-color:#fff;border-color:#292626;color:#292626}.btn5:active{background-color:#808080;border-color:#292626;color:#fff}.c56{z-index:40;pointer-events:auto}.btn6{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn6:hover{background-color:#fff;border-color:#292626;color:#292626}.btn6:active{background-color:#808080;border-color:#292626;color:#fff}.c57{z-index:41;pointer-events:auto}.btn7{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn7:hover{background-color:#fff;border-color:#292626;color:#292626}.btn7:active{background-color:#808080;border-color:#292626;color:#fff}.c58{z-index:42;pointer-events:auto}.btn8{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn8:hover{background-color:#fff;border-color:#292626;color:#292626}.btn8:active{background-color:#808080;border-color:#292626;color:#fff}.c59{z-index:43;pointer-events:auto}.btn9{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn9:hover{background-color:#fff;border-color:#292626;color:#292626}.btn9:active{background-color:#808080;border-color:#292626;color:#fff}.c60{z-index:44;pointer-events:auto}.btn10{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn10:hover{background-color:#fff;border-color:#292626;color:#292626}.btn10:active{background-color:#808080;border-color:#292626;color:#fff}.c61{z-index:45;pointer-events:auto}.btn11{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn11:hover{background-color:#fff;border-color:#292626;color:#292626}.btn11:active{background-color:#808080;border-color:#292626;color:#fff}.c62{z-index:46;pointer-events:auto}.btn12{border:1px solid #404040;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;background-color:#292626;box-shadow:0 0 2px 1px rgba(0,0,0,.4);color:#fff}.btn12:hover{background-color:#fff;border-color:#292626;color:#292626}.btn12:active{background-color:#808080;border-color:#292626;color:#fff}.ps38{position:relative;margin-top:238px}.s60{width:100%;min-width:960px;min-height:143px}.c63{z-index:51;pointer-events:none;border-top:2px solid rgba(0,0,0,.5);border-bottom:0;background-clip:padding-box;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;background-color:#292626;box-shadow:0 -2px 5px rgba(0,0,0,.4)}.ps39{display:inline-block;width:0;height:0}.ps40{position:relative;margin-top:32px}.s61{min-width:960px;width:960px;margin-left:auto;margin-right:auto;min-height:81px}.ps41{position:relative;margin-left:20px;margin-top:0}.s62{min-width:923px;width:923px;min-height:81px}.s63{min-width:163px;width:163px;min-height:65px}.c64{z-index:48;pointer-events:auto;overflow:hidden;height:65px}.p5{text-indent:0;padding-bottom:0;padding-right:0;text-align:left}.f27{font-family:Quicksand;font-size:16px;font-size:calc(16px * var(--f));line-height:1.751;font-weight:400;font-style:normal;text-decoration:underline;text-transform:none;letter-spacing:normal;color:#fff;background-color:initial;text-shadow:none}.ps42{position:relative;margin-left:181px;margin-top:1px}.s64{min-width:233px;width:233px;min-height:80px}.c65{z-index:49;pointer-events:auto;overflow:hidden;height:80px}.p6{text-indent:0;padding-bottom:0;padding-right:0;text-align:center}.f28{font-family:Quicksand;font-size:14px;font-size:calc(14px * var(--f));line-height:1.787;font-weight:400;font-style:normal;text-decoration:none;text-transform:none;letter-spacing:normal;color:#fff;background-color:initial;text-shadow:none}.ps43{position:relative;margin-left:146px;margin-top:8px}.s65{min-width:200px;width:200px;min-height:65px;height:65px}.c66{z-index:50;pointer-events:auto}.i3{position:absolute;left:14px;width:172px;height:65px;top:0;-webkit-filter: invert(100%);-moz-filter: invert(100%);filter: invert(100%);border:0}.i4{width:100%;height:100%;display:inline-block;-webkit-transform:translate3d(0,0,0)}.c67{display:inline-block;position:relative;margin-left:0;margin-top:3px}</style>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon-334508.png">
<meta name="msapplication-TileImage" content="images/mstile-144x144-275c4a.png">
<link rel="manifest" href="manifest.json" crossOrigin="use-credentials">
<meta name="theme-color" content="#ee1000">
<link onload="this.media='all';this.onload=null;" rel="stylesheet" href="css/blog.56cdc1.css" media="print">
</head>
<body id="b">
<script>var p=document.createElement("P");p.innerHTML="&nbsp;",p.style.cssText="position:fixed;visible:hidden;font-size:100px;zoom:1",document.body.appendChild(p);var rsz=function(e){return function(){var r=Math.trunc(1e3/parseFloat(window.getComputedStyle(e).getPropertyValue("font-size")))/10,t=document.body;r!=t.style.getPropertyValue("--f")&&t.style.setProperty("--f",r)}}(p);if("ResizeObserver"in window){var ro=new ResizeObserver(rsz);ro.observe(p)}else if("requestAnimationFrame"in window){var raf=function(){rsz(),requestAnimationFrame(raf)};requestAnimationFrame(raf)}else setInterval(rsz,100);</script>

<div class="c43">
<div class="v4 ps26 s49 c44">
<div class="v4 ps27 s50 c45">
<div class="ps28 v5 s51">
<div class="v4 ps29 s52 c46">
<div class="v4 ps30 s53 c47">
<a href="./" class="a1"><picture class="i2"><source srcset="images/30665de7-3283-40ca-a9ed-b3591476a9aa-205.webp 1x, images/30665de7-3283-40ca-a9ed-b3591476a9aa-410.webp 2x, images/30665de7-3283-40ca-a9ed-b3591476a9aa-615.webp 3x" type="image/webp"><source srcset="images/30665de7-3283-40ca-a9ed-b3591476a9aa-205.jpeg 1x, images/30665de7-3283-40ca-a9ed-b3591476a9aa-410.jpeg 2x, images/30665de7-3283-40ca-a9ed-b3591476a9aa-615.jpeg 3x"><img src="images/30665de7-3283-40ca-a9ed-b3591476a9aa-410.jpeg" class="un1 i1"></picture></a>
</div>
<div class="v6 ps31 s54 c48">
<ul class="menu-dropdown v1 ps1 s1 m1" id="m1">
<li class="v1 ps1 s2 mit1">
<a href="https://on.soundcloud.com/YpKQY" target="_blank" rel="noopener" class="ml1"><div class="menu-content mcv1"><div class="v1 ps1 s3 c1"><div class="v1 ps2 s4 c2"><p class="p1 f1">Music</p></div></div></div></a>
</li>
<li class="v1 ps3 s5 mit1">
<div class="menu-content mcv1">
<div class="v1 ps1 s6 c3">
<div class="v1 ps2 s7 c2">
<p class="p1 f1">Equipment</p>
</div>
</div>
</div>
<ul class="menu-dropdown v2 ps1 s8 m1">
<li class="v1 ps1 s9 mit1">
<a href="my-gear.html" class="ml1"><div class="menu-content mcv1"><div class="v1 ps1 s10 c4"><div class="v1 ps1 s10 c2"><p class="p1 f1">Gear</p></div></div></div></a>
</li>
<li class="v1 ps4 s9 mit1">
<a href="guitar-setup.html" class="ml1"><div class="menu-content mcv1"><div class="v1 ps1 s10 c5"><div class="v1 ps1 s10 c2"><p class="p1 f1">Setup</p></div></div></div></a>
</li>
<li class="v1 ps4 s9 mit1">
<a href="guitar-s.html" class="ml1"><div class="menu-content mcv1"><div class="v1 ps1 s10 c6"><div class="v1 ps1 s10 c2"><p class="p1 f1">Guitar's</p></div></div></div></a>
</li>
<li class="v1 ps4 s9 mit1">
<a href="amplification.html" class="ml1"><div class="menu-content mcv1"><div class="v1 ps1 s10 c7"><div class="v1 ps1 s10 c2"><p class="p1 f1">Amplification</p></div></div></div></a>
</li>
</ul>
</li>
<li class="v1 ps3 s11 mit1">
<a href="#" class="ml1"><div class="menu-content mcv1"><div class="v1 ps1 s12 c8"><div class="v1 ps2 s13 c2"><p class="p1 f1">Contact</p></div></div></div></a>
</li>
<li class="v1 ps3 s14 mit1">
<a href="brands-used.html" class="ml1"><div class="menu-content mcv1"><div class="v1 ps1 s15 c9"><div class="v1 ps2 s16 c2"><p class="p1 f1">Brands</p></div></div></div></a>
</li>
<li class="v1 ps3 s17 mit1">
<a href="about.html" class="ml1"><div class="menu-content mcv1"><div class="v1 ps1 s18 c10"><div class="v1 ps2 s19 c2"><p class="p1 f1">About</p></div></div></div></a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="v7 ps32 s55 c49">
<?php

    $blogPostIndex = ($page - 1) * $blogPostsPerPage;
    $documentReady = '';
    $documentLoad = '';
    $facebookFix = '';
    $resizeImages = '';
    $animations = '';
    $count = 0;
    while($blogPostIndex < $blogPostsCount && ++$count <= $blogPostsPerPage) {
        $blogPost = $blogPosts[$blogPostIndex++];

        echo '<article class="bp';
        if($blogPost['w']) echo 'w';
        echo 'c';
        if($count > 1) echo ' bpm';
        echo '">';
        echo $blogPost['html'];
        echo '</article>';

        $documentReady .= $blogPost['documentReady'];
        $documentLoad .= $blogPost['documentLoad'];
        $facebookFix .= $blogPost['facebookFix'];
        $resizeImages .= $blogPost['resizeImages'];
        $animations .= $blogPost['animations'];
    }

    echo '<script>var blogDocumentReady=function(){' . $documentReady . '}';
    echo ',blogDocumentLoad=function(){' . $documentLoad . '}';
    echo ',blogFacebookFix=function(){' . $facebookFix . '}';
    echo ',blogResizeImages=function(){' . $resizeImages . '}';
    echo ',blogAnimationsSetup=function(){' . $animations . '}';
    echo '</script>';

?>

</div>
<div class="ps33 v5 s56">
<div class="v4 ps35 s57 c50">
<div class="ps34">
<?php

    echo '<style>.pbdn{display:none}.pbc{border: 1px solid;background-color:#292626;color:#fff;border-color:#ee1000}</style>';
    $control = '<div class="v4 ps30 s58 c51 {btnclass}"><a href="#" class="f26 btn1 v8 s59 {lnkclass}">&lt;&lt;</a></div>';
    if($page > 1) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . ($page - 1);
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        $control = str_replace('href="#"', 'href="' . $url . '"', $control);
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps36 s58 c52 {btnclass}"><a href="#" class="f26 btn2 v8 s59 {lnkclass}">{page_num}</a></div>';
    $buttonPage = $start_page + 1 - 1;
    if($buttonPage <= $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . $buttonPage;
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        if($buttonPage == $page) {
            $control = str_replace('href="#"', '', $control);
            $control = str_replace('{lnkclass}', 'pbc', $control);
        }
        else {
            $control = str_replace('href="#"', 'href="' . $url . '"', $control);
            $control = str_replace('{lnkclass}', '', $control);
        }
        $control = str_replace('{page_num}', $buttonPage, $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{page_num}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps37 s58 c53 {btnclass}"><a href="#" class="f26 btn3 v8 s59 {lnkclass}">{page_num}</a></div>';
    $buttonPage = $start_page + 2 - 1;
    if($buttonPage <= $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . $buttonPage;
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        if($buttonPage == $page) {
            $control = str_replace('href="#"', '', $control);
            $control = str_replace('{lnkclass}', 'pbc', $control);
        }
        else {
            $control = str_replace('href="#"', 'href="' . $url . '"', $control);
            $control = str_replace('{lnkclass}', '', $control);
        }
        $control = str_replace('{page_num}', $buttonPage, $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{page_num}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps36 s58 c54 {btnclass}"><a href="#" class="f26 btn4 v8 s59 {lnkclass}">{page_num}</a></div>';
    $buttonPage = $start_page + 3 - 1;
    if($buttonPage <= $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . $buttonPage;
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        if($buttonPage == $page) {
            $control = str_replace('href="#"', '', $control);
            $control = str_replace('{lnkclass}', 'pbc', $control);
        }
        else {
            $control = str_replace('href="#"', 'href="' . $url . '"', $control);
            $control = str_replace('{lnkclass}', '', $control);
        }
        $control = str_replace('{page_num}', $buttonPage, $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{page_num}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps37 s58 c55 {btnclass}"><a href="#" class="f26 btn5 v8 s59 {lnkclass}">{page_num}</a></div>';
    $buttonPage = $start_page + 4 - 1;
    if($buttonPage <= $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . $buttonPage;
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        if($buttonPage == $page) {
            $control = str_replace('href="#"', '', $control);
            $control = str_replace('{lnkclass}', 'pbc', $control);
        }
        else {
            $control = str_replace('href="#"', 'href="' . $url . '"', $control);
            $control = str_replace('{lnkclass}', '', $control);
        }
        $control = str_replace('{page_num}', $buttonPage, $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{page_num}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps36 s58 c56 {btnclass}"><a href="#" class="f26 btn6 v8 s59 {lnkclass}">{page_num}</a></div>';
    $buttonPage = $start_page + 5 - 1;
    if($buttonPage <= $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . $buttonPage;
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        if($buttonPage == $page) {
            $control = str_replace('href="#"', '', $control);
            $control = str_replace('{lnkclass}', 'pbc', $control);
        }
        else {
            $control = str_replace('href="#"', 'href="' . $url . '"', $control);
            $control = str_replace('{lnkclass}', '', $control);
        }
        $control = str_replace('{page_num}', $buttonPage, $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{page_num}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps36 s58 c57 {btnclass}"><a href="#" class="f26 btn7 v8 s59 {lnkclass}">{page_num}</a></div>';
    $buttonPage = $start_page + 6 - 1;
    if($buttonPage <= $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . $buttonPage;
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        if($buttonPage == $page) {
            $control = str_replace('href="#"', '', $control);
            $control = str_replace('{lnkclass}', 'pbc', $control);
        }
        else {
            $control = str_replace('href="#"', 'href="' . $url . '"', $control);
            $control = str_replace('{lnkclass}', '', $control);
        }
        $control = str_replace('{page_num}', $buttonPage, $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{page_num}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps37 s58 c58 {btnclass}"><a href="#" class="f26 btn8 v8 s59 {lnkclass}">{page_num}</a></div>';
    $buttonPage = $start_page + 7 - 1;
    if($buttonPage <= $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . $buttonPage;
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        if($buttonPage == $page) {
            $control = str_replace('href="#"', '', $control);
            $control = str_replace('{lnkclass}', 'pbc', $control);
        }
        else {
            $control = str_replace('href="#"', 'href="' . $url . '"', $control);
            $control = str_replace('{lnkclass}', '', $control);
        }
        $control = str_replace('{page_num}', $buttonPage, $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{page_num}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps36 s58 c59 {btnclass}"><a href="#" class="f26 btn9 v8 s59 {lnkclass}">{page_num}</a></div>';
    $buttonPage = $start_page + 8 - 1;
    if($buttonPage <= $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . $buttonPage;
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        if($buttonPage == $page) {
            $control = str_replace('href="#"', '', $control);
            $control = str_replace('{lnkclass}', 'pbc', $control);
        }
        else {
            $control = str_replace('href="#"', 'href="' . $url . '"', $control);
            $control = str_replace('{lnkclass}', '', $control);
        }
        $control = str_replace('{page_num}', $buttonPage, $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{page_num}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps37 s58 c60 {btnclass}"><a href="#" class="f26 btn10 v8 s59 {lnkclass}">{page_num}</a></div>';
    $buttonPage = $start_page + 9 - 1;
    if($buttonPage <= $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . $buttonPage;
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        if($buttonPage == $page) {
            $control = str_replace('href="#"', '', $control);
            $control = str_replace('{lnkclass}', 'pbc', $control);
        }
        else {
            $control = str_replace('href="#"', 'href="' . $url . '"', $control);
            $control = str_replace('{lnkclass}', '', $control);
        }
        $control = str_replace('{page_num}', $buttonPage, $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{page_num}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps36 s58 c61 {btnclass}"><a href="#" class="f26 btn11 v8 s59 {lnkclass}">{page_num}</a></div>';
    $buttonPage = $start_page + 10 - 1;
    if($buttonPage <= $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . $buttonPage;
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        if($buttonPage == $page) {
            $control = str_replace('href="#"', '', $control);
            $control = str_replace('{lnkclass}', 'pbc', $control);
        }
        else {
            $control = str_replace('href="#"', 'href="' . $url . '"', $control);
            $control = str_replace('{lnkclass}', '', $control);
        }
        $control = str_replace('{page_num}', $buttonPage, $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{page_num}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

<?php

    $control = '<div class="v4 ps37 s58 c62 {btnclass}"><a href="#" class="f26 btn12 v8 s59 {lnkclass}">&gt;&gt;</a></div>';
    if($page < $end_page) {
        $url = strtok($_SERVER['REQUEST_URI'],'?') . '?page=' . ($page + 1);
        if($tag !== NULL) {
            $url .= '&tag=' . $tag;
        }
        $control = str_replace('href="#"', 'href="' . $url . '"', $control);
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{btnclass}', '', $control);
    }
    else {
        $control = str_replace('{lnkclass}', '', $control);
        $control = str_replace('{btnclass}', 'pbdn', $control);
    }
    echo $control;

?>

</div>
</div>
</div>
<div class="v5 ps38 s60 c63">
<div class="ps39">
</div>
<div class="ps40 v5 s61">
<div class="v4 ps41 s62 c46">
<div class="v4 ps30 s63 c64">
<p class="p5"><span class="f27"><a href="Policy/privacy-policy.html">Privacy Policy</a></span></p>
<p class="p5"><span class="f27"><a href="Privacy/terms-of-use.html">Terms of Service</a></span></p>
</div>
<div class="v4 ps42 s64 c65">
<p class="p6 f28">Copyrights 2023</p>
<p class="p6 f28">SRP Consulting Group, LLC</p>
<p class="p6 f28">All Rights Reserved</p>
</div>
<div class="v4 ps43 s65 c66">
<picture class="i4 un3">
<source data-srcset="images/img_1467-172.webp 1x, images/img_1467-344.webp 2x, images/img_1467-516.webp 3x" srcset="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" type="image/webp">
<source data-srcset="images/img_1467-172.png 1x, images/img_1467-344.png 2x, images/img_1467-516.png 3x" srcset="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
<img src="images/img_1467-344.png" class="un2 i3">
</picture>
</div>
</div>
</div>
</div>
<div class="c67">
</div>
<script>dpth="/";!function(){for(var e=["js/jquery.d26858.js","js/jqueryui.d26858.js","js/menu.d26858.js","js/menu-dropdown-animations.d26858.js","js/menu-dropdown.56cdc1.js","js/blog.56cdc1.js"],n={},s=-1,t=function(t){var o=new XMLHttpRequest;o.open("GET",e[t],!0),o.onload=function(){for(n[t]=o.responseText;s<6&&void 0!==n[s+1];){s++;var e=document.createElement("script");e.textContent=n[s],document.body.appendChild(e)}},o.send()},o=0;o<6;o++)t(o)}();
</script>
</body>
</html>