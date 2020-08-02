@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 border p-2 bg-white">
            <h2 class="text-center" onclick="document.querySelector('#add').classList.toggle('hidden')">Add Notes</h2>
            <form action="/save" enctype="multipart/form-data" method="POST" id='add' class="hidden ">
                @csrf
            <input type="hidden" name="user" value="{{$id}}">
                <div class="form-group">
                    <label for="header" class="form-control-label">Title</label>
                    <input type="text" name="header" id="header" class="form-control">
                </div>
                <div class="form-group">
                    <label for="body" class="form-control-label">Body</label>
                    <textarea name="body" id="body"  class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="file" class="form-control-label">File</label>
                    <input type="file" name="files[]" id="file" class="file-control" multiple>
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-12 mt-lg-2">
            <h1 class="display-4">Your Notes</h1>
            <hr>
        <div class="row justify-content-center">
            @forelse ($notes as $item)
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <form action="/delete/{{$item['id']}}" method="post" class="float-right">
                            @csrf
                            @method('DELETE')
                            <button class="btn text-dark"> &times;</button>
                        </form>
                        <form action="/public/{{$item['id']}}" method="post" class="float-right">
                            @csrf
                            
                            <button class="btn text-dark">@if ($item['public'])
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            @endif</button>
                        </form>
                        @if ($item['header'])
                            <h4>{{$item['header']}}</h4>
                        @endif
                    
                    </div>
                    <div class="card-body">
                        <a href="/watch/note/with/id/{{$item['id']}}" class="float-right text-dark"><i class="fa fa-share" aria-hidden="true"></i></a>
                        {{$item['body']}}
                    </div>
                    <div class="card-footer list-group">
                        @php
                            $filenames=array_slice(explode("|",$item['path']),1);
                        @endphp
                        @forelse ($filenames as $items)
                    <a href="/watch/{{$items}}" class="list-group-item">File {{$loop->iteration}}</a>
                        @empty
                            
                        @endforelse
                    </div>
                </div>
            </div>
            @empty
                No Notes Yet
            @endforelse
        </div>
        </div>
    </div>
</div>
@endsection
