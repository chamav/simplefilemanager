<!-- resources/views/files/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New file Form -->
        {!! Form::open(array('url'=>url('file'),'method'=>'POST', 'files'=>true,'class' => 'form-horizontal')) !!}
        <div class="form-group">
            <label for="file-name" class="col-sm-3 control-label">File</label>

            <div class="col-sm-6">
                {!! Form::file('file') !!}
            </div>
            <p class="errors">{!!$errors->first('file')!!}</p>
            @if(Session::has('error'))
                <p class="errors">{!! Session::get('error') !!}</p>
            @endif
        </div>
        <div id="success"> </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add file
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <!-- Current files -->
    @if (count($files) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current files
            </div>

            <div class="panel-body">
                <table class="table table-striped file-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>File</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <!-- file Name -->
                            <td class="table-text">
                                <div>{{ $file->name }}</div>
                            </td>
                            <td>
                                <form action="{{ url('file/'.$file->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('GET') }}

                                    <button type="submit" id="donload-file-{{ $file->id }}" class="btn">
                                        <i class="fa fa-btn"></i>Download
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('file/'.$file->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-file-{{ $file->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection