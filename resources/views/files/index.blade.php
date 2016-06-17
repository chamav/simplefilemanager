<!-- resources/views/files/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New file Form -->
        <form action="{{ url('file') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- file Name -->
            <div class="form-group">
                <label for="file-name" class="col-sm-3 control-label">File</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="file-name" class="form-control">
                </div>
            </div>

            <!-- Add file Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add file
                    </button>
                </div>
            </div>
        </form>
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
                                <!-- TODO: Delete Button -->
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection