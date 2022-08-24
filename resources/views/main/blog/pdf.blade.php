<html lang="en">
<head>
    <title>Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        *, ::after, ::before {
            margin: 2.5rem 1rem 0 1rem;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans';
        }

        p {
            margin-bottom: 0;
        }

        .literatureAnswer {
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
            text-transform: uppercase;
        }
        .poetryCenter {
            text-align: left;
            margin: 0 auto;
            width: fit-content;
            width: 40%;
            min-width: 340px;
        }

        h1 {
            font-size: 1.4rem;
        }

        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 0.9rem;
            background-color: rgba(13, 105, 196, 0.2);
            text-align: center;
            line-height: 30px;
        }

        /* footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 0.9rem;
            background-color: rgba(13, 105, 196, 0.2);
            text-align: center;
            line-height: 30px;
        }

        footer a {

        } */
    </style>
</head>
<body>
    <header>
        © 2022 - Bản quyền <a href="https://chuyentauvanhoc.edu.vn">Chuyến tàu Văn Học</a> - Cô Ngọc Anh ({{ config('info.phone') }})
    </header>
    <h1>{{ $item->name }}</h1>
    {!! $item->content !!}
    <div style="text-align:right;">Bài viết gốc: <a href="https://chuyentauvanhoc.edu.vn/{{ $item->pages->seo_alias }}">https://chuyentauvanhoc.edu.vn/{{ $item->pages->seo_alias }}</a></div>
    
</body>
</html>