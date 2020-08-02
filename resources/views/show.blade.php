@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3 card">
                <div class="container">
                    <p>Created at: {{$note['created_at']}}</p>
                    <p>Created_by: {{$creator['name']}} </p>
                </div>
                <div class="container">
                    <h5 class="">Files</h5>
                    @php
                    $filenames=array_slice(explode("|",$note['path']),1);
                        @endphp
                        @forelse ($filenames as $items)
                                 <a href="/watch/{{$items}}" class="list-group-item">File {{$loop->iteration}}</a>
                        @empty
                            no files
                        @endforelse
                </div>
            </div>
            <div class="col-md-8">
                <h1 class="text-center"> {{$note['header']}} </h1>
                <hr>
            <p>{{$note['body']}}</p>
            </div>
        </div>
    </div>
@endsection