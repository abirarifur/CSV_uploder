<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="wapper d-flex align-items-center" style="height: 100vh">
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ Session::get('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(Session::has('errorQuery'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>  {{ Session::get('errorQuery') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header bg-secondary p-3"><h4 class="text-white">Upload Your CSV File</h4></div>
                        <div class="card-body">
                            
                            <form action="{{route('uploadcsv')}}" method="post" enctype="multipart/form-data" class="form">
                                @csrf
                                <div class="mb-3">
                                    <label for="selectTables" class="form-label m-0"><strong>Tables</strong></label>
                                    <select type="file" class="form-control" name="csvfile" id="selectTables" placeholder="File" required>
                                        <option value="">Select table name</option>
                                        @foreach($tables as $table)
                                            <option value="{{$table}}">{{$table}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label m-0"><strong>File</strong></label>
                                    <input type="file" class="form-control" name="csvfile" id="file" placeholder="File">
                                </div>
                                <button class="btn btn-dark" onclick="alertHide()">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>