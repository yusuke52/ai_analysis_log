<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h5 class="card-header">画像解析</h5>
                    <form action="/send" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="textarea">画像パス</label>
                            <textarea id="textarea" class="form-control" cols="100" name="image_path">/image/d03f1d36ca69348c51aa/c413eac329e1c0d03/test.jpg</textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">解析</button>
                        @if (session('flash_message'))
                            <div class="flash_message alert alert-success alert-block">
                                {!! session('flash_message') !!}
                            </div>
                            <div class="form-group">
                                <label>結果:</label>
                                <label>{!! session('success') !!}</label>
                            </div>
                            <div class="form-group">
                                <label>メッセージ:</label>
                                <label>{!! session('message') !!}</label>
                            </div>
                            @if (session('success')!='失敗')
                                <div class="form-group">
                                    <label>クラス:</label>
                                    <label>{!! session('class') !!}</label>
                                </div>
                                <div class="form-group">
                                    <label>信頼値:</label>
                                    <label>{!! session('confidence') !!}</label>
                                </div>
                            @endif
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>