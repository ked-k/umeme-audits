
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/icon.png')}}">
    <script>
        (function (win, lib) {
            var doc = win.document;
            var docEl = doc.documentElement;
            var metaEl = doc.querySelector('meta[name="viewport"]');
            var flexibleEl = doc.querySelector('meta[name="flexible"]');
            var dpr = 0;
            var scale = 0;
            var tid;
            var flexible = lib.flexible || (lib.flexible = {});

            if (metaEl) {
                console.warn('将根据已有的meta标签来设置缩放比例');
                var match = metaEl.getAttribute('content').match(/initial\-scale=([\d\.]+)/);
                if (match) {
                    scale = parseFloat(match[1]);
                    dpr = parseInt(1 / scale);
                }
            } else if (flexibleEl) {
                var content = flexibleEl.getAttribute('content');
                if (content) {
                    var initialDpr = content.match(/initial\-dpr=([\d\.]+)/);
                    var maximumDpr = content.match(/maximum\-dpr=([\d\.]+)/);
                    if (initialDpr) {
                        dpr = parseFloat(initialDpr[1]);
                        scale = parseFloat((1 / dpr).toFixed(2));
                    }
                    if (maximumDpr) {
                        dpr = parseFloat(maximumDpr[1]);
                        scale = parseFloat((1 / dpr).toFixed(2));
                    }
                }
            }
            if (!dpr && !scale) {
                var isAndroid = win.navigator.appVersion.match(/android/gi);
                var isIPhone = win.navigator.appVersion.match(/iphone/gi);
                var devicePixelRatio = win.devicePixelRatio;
                if (isIPhone) {
                    // iOS下，对于2和3的屏，用2倍的方案，其余的用1倍方案
                    if (devicePixelRatio >= 3 && (!dpr || dpr >= 3)) {
                        dpr = 3;
                    } else if (devicePixelRatio >= 2 && (!dpr || dpr >= 2)) {
                        dpr = 2;
                    } else {
                        dpr = 1;
                    }
                } else {
                    // 其他设备下，仍旧使用1倍的方案
                    dpr = 1;
                }
                scale = 1 / dpr;
            }
            docEl.setAttribute('data-dpr', dpr);
            if (!metaEl) {
                metaEl = doc.createElement('meta');
                metaEl.setAttribute('name', 'viewport');
                metaEl.setAttribute('content', 'initial-scale=' + scale + ', maximum-scale=' + scale + ', minimum-scale=' + scale + ', user-scalable=no');
                if (docEl.firstElementChild) {
                    docEl.firstElementChild.appendChild(metaEl);
                } else {
                    var wrap = doc.createElement('div');
                    wrap.appendChild(metaEl);
                    doc.write(wrap.innerHTML);
                }
            }
            function refreshRem() {
                var width = docEl.getBoundingClientRect().width;
                if (width / dpr > 540) {
                    width = 540 * dpr;
                }
                var rem = width / 10;
                docEl.style.fontSize = rem + 'px';
                flexible.rem = win.rem = rem;
            }
            win.addEventListener('resize', function () {
                clearTimeout(tid);
                tid = setTimeout(refreshRem, 300);
            }, false);
            win.addEventListener('pageshow', function (e) {
                if (e.persisted) {
                    clearTimeout(tid);
                    tid = setTimeout(refreshRem, 300);
                }
            }, false);
            if (doc.readyState === 'complete') {
                doc.body.style.fontSize = 12 * dpr + 'px';
            } else {
                doc.addEventListener('DOMContentLoaded', function (e) {
                    doc.body.style.fontSize = 12 * dpr + 'px';
                }, false);
            }

            refreshRem();
            flexible.dpr = win.dpr = dpr;
            flexible.refreshRem = refreshRem;
            flexible.rem2px = function (d) {
                var val = parseFloat(d) * this.rem;
                if (typeof d === 'string' && d.match(/rem$/)) {
                    val += 'px';
                }
                return val;
            }
            flexible.px2rem = function (d) {
                var val = parseFloat(d) / this.rem;
                if (typeof d === 'string' && d.match(/px$/)) {
                    val += 'rem';
                }
                return val;
            }
        })(window, window['lib'] || (window['lib'] = {}));
    </script>
    <title>&lrm;</title>
</head>
<style>
    @charset "utf-8";

    html {
        color: #333;
        background: #fff;
        overflow-y: scroll;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%
    }

    html * {
        outline: 0;
        -webkit-text-size-adjust: none;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
    }

    html,
    body {
        font-family: sans-serif
    }

    body,
    div,
    dl,
    dt,
    dd,
    ul,
    ol,
    li,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    pre,
    code,
    form,
    fieldset,
    legend,
    input,
    textarea,
    p,
    blockquote,
    th,
    td,
    hr,
    button,
    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section {
        margin: 0;
        padding: 0
    }

    input,
    select,
    textarea {
        font-size: 120%
    }

    table {
        border-collapse: collapse;
        border-spacing: 0
    }

    fieldset,
    img {
        border: 0
    }

    abbr,
    acronym {
        border: 0;
        font-variant: normal
    }

    del {
        text-decoration: line-through
    }

    address,
    caption,
    cite,
    code,
    dfn,
    em,
    th,
    var {
        font-style: normal;
        font-weight: 500
    }

    ol,
    ul {
        list-style: none
    }

    caption,
    th {
        text-align: left
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-size: 120%;
        font-weight: 500
    }

    q:before,
    q:after {
        content: ''
    }

    sub,
    sup {
        font-size: 75%;
        line-height: 0;
        position: relative;
        vertical-align: baseline
    }

    sup {
        top: -.5em
    }

    sub {
        bottom: -.25em
    }

    a:hover {
        text-decoration: underline
    }

    ins,
    a {
        text-decoration: none
    }

    .container {
        background: #fff;
    }

    .top {
        color: #fff;
        border-width: 0px;
        overflow: hidden;
        width: 100%;
        background: linear-gradient(116.457856204838deg, #007bfd 0%, rgba(0, 123, 253, 1) 100%);
    }

    .top-first {
        text-align: center;
        border-bottom: 1px solid #80bdfe;
        margin: 1em;
        margin-top: 20px;
    }

    .top-first .p-first {
        font-size: 160%;
        margin-bottom: .5em;
    }

    .top-first .p-second {
        font-size: 120%;
        margin-bottom: .7em
    }

    .top-second {
        margin: 1em;
        font-size: 120%;
    }

    .top-second ul li {
        display: inline-block;
        width: 100%;
        margin-bottom: .5em;
    }

    .first {
        line-height: 400%;
        background: inherit;
        background-color: rgba(249, 249, 247, 1);
        box-sizing: border-box;
        border-width: 1px;
        border-style: solid;
        border-color: rgba(215, 215, 215, 1);
        border-left: 0px;
        border-top: 0px;
        border-right: 0px;
        border-radius: 0px;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .first .xd {
        margin: 1em;
        font-family: 'Arial Negreta', 'Arial Normal', 'Arial', sans-serif;
        font-weight: bold;
        font-style: normal;
        font-size: 150%;
        color: #02A7F0;
        text-align: right;
        margin-right: 10px;
        text-shadow: 2px 0 0 #02A7F0;
    }

    .first span:nth-child(2) {
        font-size: 120%;
    }

    .ycxx-line {
        border-bottom: 1px solid grey;
        padding-bottom: 0.2rem;
    }

    .ycxx {
        margin: 0.2rem 0.5rem;
        font-size: 110%;
    }

    .ycxx-content {
        display: flex;
        flex-direction: row;
        line-height: 0.6rem;
        align-items: center;
        justify-content: space-between;
    }

    .ycxx-content .ycxx-left,
    .ycxx-right {
        width: 50%;
        display: flex;
        flex-direction: column;
    }

    .ycxx-left span:nth-child(1) {
        color: #AAAAAA;
    }

    .ycxx-right span:nth-child(1) {
        color: #AAAAAA;
    }


    .yccs-left {
        width: 80%;
    }

    .yccs-right {
        float: right;
    }

    .bottom {
        margin-bottom: 0.5em;
        position: relative;
        margin-right: 0.7rem;
        float: right;
        line-height: 0.6rem;
        font-size: 120%;
        text-align: right;
    }

    textarea {
        margin: 0.2rem;
        width: 100%;
        height: fit-content;
        border: 1px solid #f2f2f2;
    }

    html,
    body,
    img {
        padding: 0;
        margin: 0;
        vertical-align: bottom;
        display: block
    }
</style>

<body>
    @if ($chinavisa)
    <div class="container">
        <div class="top">
            <div class="top-first">
                <p class="p-first">泉州市营业性演出准予许可决定</p>
                <p class="p-second">350500522023000023</p>
            </div>
            <div class="top-second">
                <ul>
                    <li>
                        <span style="float: left;">许可/备案事项：涉外/涉港澳台营业性演出</span>
                        <span style="float: right;">举办</span>
                    </li>
                    <li>
                        <span>证号：京演（机构）〔2009〕0770号</span>
                    </li>
                    <li>
                        <span></span>举办单位：北京中艺时尚文化传播有限公司</span>
                    </li>
                </ul>
            </div>
        </div>
    
        <div class="first">
            <span class="xd">|</span><span>演出信息</span>
        </div>
        <div class="ycxx">
            <div class="ycxx-content">
                <div class="ycxx-left">
                    <span>演出名称</span>
                    <span>外籍乌干达演员驻场演出活动</span>
                </div>
                <div class="ycxx-right">
                    <span>演员人数</span>
                    <span>12（人）</span>
                </div>
            </div>
            <div class="ycxx-content">
                <div class="ycxx-left">
                    <span>本地演出日期</span>
                    <span>{{ $chinavisa->date_from }} 至 {{ $chinavisa->date_to }}</span>
                </div>
                <div class="ycxx-right">
                    <span>项目负责人</span>
                    <span>于慧颖</span>
                </div>
            </div>
            <div class="ycxx-content">
                <div class="ycxx-left">
                    <span>入境停留日期 <span style="color:#333"> 共 90 天</span></span>
                    <span>{{ $chinavisa->date_from }} 至 {{ $chinavisa->date_to }}</span>
                </div>
                <div class="ycxx-right">
                    <span>联系电话</span>
                    <span>{{ $chinavisa->contact }}</span>
                </div>
            </div>
            <div class="ycxx-content">
                <div class="ycxx-left"  style="width: 100%;">
                    <span>是否属于或含外国人在中国短期工作任务</span>
                    <span>是</span>
                </div>
            </div>
            <div class="ycxx-content">
                
            </div>
        </div>
    
        <div class="first">
            <span class="xd">|</span><span>演出场所</span>
        </div>
    
        <div class="first" id="inData">
            <span class="xd">|</span><span>演出内容</span>
        </div>
        <div class="ycxx">
            <div class="ycxx-content" style="border: 1px solid #dfd8d8;
            height: 80px;align-items: flex-start;">
                《乌干达杂耍》，《乌干达现代舞》，《乌干达舞蹈》，《非洲杂技》，《非洲街舞》，《乌干达鼓舞》。
            </div>
        </div>
        <div class="bottom">
            <div>泉州市文化广电和旅游局</div>
            <div></div>
        </div>
    </div>
        
    @endif
</body>
<script>
    var str = ''
    var arr = [{"address":"\u798F\u5EFA\u7701\u6CC9\u5DDE\u5E02\u798F\u5EFA\u7701\u6CC9\u5DDE\u53F0\u5546\u6295\u8D44\u533A\u5F20\u5742\u9547\u4E95\u4E0B\u6751336\u53F7\u798F\u5EFA\u7701\u6CC9\u5DDE\u5E02\u6CC9\u5DDE\u6B27\u4E50\u5821","count":540}]
    for (let x in arr) {
        var obj = document.createElement("DIV")
        obj.className = 'ycxx'
        if(x < arr.length-1){
            obj.setAttribute('class','ycxx-line ycxx')
        }
        str += `<div class="ycxx-content">
                    <div class="yccs-left">
                        <span>${arr[x].address}</span>
                    </div>
                    <div class="yccs-right">
                        <span>${arr[x].count}（场）</span>
                    </div>
                </div>`
        obj.innerHTML = str
        str = ''
        var list = document.getElementById("inData")
        list.parentNode.insertBefore(obj,list)
    }
</script>
</html>