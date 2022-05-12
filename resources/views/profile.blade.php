@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="/image/{{$picture}}" alt="avatar" class="rounded-circle img-fluid" style="width: 200px; height: 200px;">
                    <h5 class="my-3">{{$name}}</h5>
                    <p class="text-muted mb-1">{{$email}}</p>
                    <p class="text-muted mb-4">{{$description}}</p>
                    <div class="d-flex justify-content-center mb-2">
                        <a class="m-1 btn btn-secondary w-50"  href="{{ route('my-photos', $id ) }}"> Uploaded</a>
                        @if(auth()->user()->id == $id)
                            <a class="m-1 btn btn-secondary w-50"  href="{{ route('saved-photos', $id) }}"> Saved</a>
                            <input class="m-1 btn btn-primary w-50" type="submit" value="Upload" data-toggle="modal" data-target="#model" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="/update-info" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                @if(auth()->user()->id == $id)
                                    <input type="text" class="text-muted mb-0 w-100" name="name" id="name" style="outline: none !important; border:none !important;" value="{{$name}}" />
                                @else
                                    <input type="text" class="text-muted mb-0 w-100" name="name" id="name" style="background-color:white; outline: none !important; border:none !important;" value="{{$name}}" disabled/>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="text-muted p-1 w-100 bg-transparent" name="email" id="email" style="outline: none !important; border:none !important;"  value="{{$email}}"  disabled />
                            </div>
                        </div>
                        <hr>
                        @if(auth()->user()->id == $id)
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Change Picture</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" name="picture" class="form-control-file" id="picture">
                                </div>
                            </div>
                            <hr>
                        @endif
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Bio</p>
                            </div>
                            <div class="col-sm-9">
                                @if(auth()->user()->id == $id)
                                    <textarea class="pl-3 pt-2" name="description" id="description" style="height:153px; width:100%" >{{$description}}</textarea>
                                @else
                                    <textarea class="pl-3 pt-2" name="description" id="description" style="height:153px; width:100%" disabled>{{$description}}</textarea>
                                @endif
                            </div>
                        </div>
                        @if(auth()->user()->id == $id)
                            <div class="row ">
                                <div class="col-sm-12 ">
                                    <Button class="btn btn-primary float-right" type="submit">Edit </Button>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"> Upload </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="/upload" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" class="form-control-file" id="image" accept="image/x-png,image/gif,image/jpeg">
                    <Button type="submit" class="btn btn-primary float-right"> Save </Button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
