<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div class="custom-header text-center">
            <h1>Converter</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered offset-2 col-8">
                        <thead>
                            <tr>
                                <th>File Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form class="form-inline" action="{{ route('to-json') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="csv">Select CSV File</label>
                                            </div>
                                            <div class="col-6">
                                                <input type="file" name="file_csv" id="csv" />
                                                @if($errors->has('file_csv'))
                                                    <div class="error">{{ $errors->first('file_csv') }}</div>
                                                @endif
                                                @if($errors->has('file_type'))
                                                    <div class="error">{{ $errors->first('file_type') }}</div>
                                                @endif
                                        </div>
                                        </div>
                                    </td>
                                    <td><button type="submit" class="btn btn-primary mb-2">to JSON</button></td>
                                </form>
                            </tr>
                            <tr>
                            <form class="form-inline" action="{{ route('to-csv') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="json">Select JSON File</label>
                                            </div>
                                            <div class="col-6">
                                                <input type="file" name="file_json" id="json" />
                                                @if($errors->has('file_json'))
                                                    <div class="error">{{ $errors->first('file_json') }}</div>
                                                @endif
                                                @if($errors->has('file_type'))
                                                    <div class="error">{{ $errors->first('file_type') }}</div>
                                                @endif
                                        </div>
                                        </div>
                                    </td>
                                    <td><button type="submit" class="btn btn-primary mb-2">to CSV</button></td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="output offset-2 col-8">
                    @if(session()->has('output'))
<pre>{{session('output')}}</pre>   
                    @endif
                    @php
                    session()->forget(['output']);
                    @endphp
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
