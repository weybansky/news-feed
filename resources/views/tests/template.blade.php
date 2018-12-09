<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Tempate</title>
        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>
    <body id="root">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark animated fadeInDown">
          <div class="container">
            <a class="navbar-brand" href="#">{{ env('APP_NAME')}}</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="#">Feed</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Websites</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <!-- <i class="fa fa-user-times"></i> -->
                      <i class="fa fa-user-check"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Account <i class="fa fa-user float-right mt-1"></i></a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Settings <i class="fa fa-cog float-right mt-1"></i></a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Log in <i class="fa fa-lock-open float-right mt-1"></i></a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Sign out <i class="fa fa-lock float-right mt-1"></i></a>
                    </div>
                  </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                  <select name="category" id="category" class="form-control mr-sm-2">
                      <option value="select">-- Select Category --</option>
                      <option value="technology">Technology</option>
                      <option value="technology">Technology</option>
                      <option value="technology">Technology</option>
                      <option value="technology">Technology</option>
                  </select>
                  <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
              </form>
            </div>
          </div>
        </nav>

        <section id="websites_add">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <form action="" method="" class="mt-3">
                  <div class="form-group">
                    <h3>Add New Websites</h3>
                  </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="main_url">Main URL</label>
                    <input type="url" name="main_url" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="feed_url">Feed Url</label>
                    <input type="url" name="feed_url" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="feed_name">Feed Name</label>
                    <input type="text" name="feed_name" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" class="form-control">
                      <option value="0">-- Select Category --</option>
                      <option value="uncategorized">Uncategorized</option>
                      <option value="news">News</option>
                      <option value="technology">Technology</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="type_of_feed">Category</label>
                    <select name="type_of_feed" class="form-control">
                      <option value="0">-- Feed Type --</option>
                      <option value="rss">RSS</option>
                      <option value="atom">Atom</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </section>


        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
