<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
        
    </head>
    <body>
        <div id="app" class="container mt-3">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form action="" method="">
                        <button type="button" onclick="getWebsites()" class="btn btn-primary">Get Websites</button>
                    </form>
                    <div class="mt-3">
                        <p id="data"></p>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="/js/app.js"></script>
        <script type="text/javascript">
            function getWebsites () {
                axios.post('/axios')
                    .then(function (response) {
                        document.getElementById('data').innerHTML = JSON.stringify(response.data.websites);
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        document.getElementById('data').innerHTML = error;
                        console.log(error);
                    })
            }
        </script>

    </body>
</html>
