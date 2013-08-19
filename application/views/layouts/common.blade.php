<!DOCTYPE HTML>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/css/customize.css" />
    <script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
    @yield('extheader')
</head>
<body>
    <header> 
        <nav>
            <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                    <div class="container">
                        <a class="brand" href="/"><img src="/img/logo.png" /></a> 
                    </div>
            </div>
            </div>
        </nav>
        @yield('body')
    </header>
</body>
</html>
