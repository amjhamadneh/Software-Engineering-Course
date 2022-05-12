@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-top:60px">

        <div class="card-columns border-0">
        @foreach ($pictures as $picture)
            <!-- Card  -->
                <div class="card">
                    <a href='' data-toggle="modal" data-target="#modal" onclick="viewPhoto('{{ $picture['picture']['id'] }}')"> <img class="img w-100" src="/image/{{ $picture['picture']['name'] }}" /> </a>
                </div>
            @endforeach
        </div>

    </div>


    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="name-of-user-picture"> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="card border-0" id="image-form">

                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="card border-0">
                                    <div class="card-body p-2 justify-content-center " >
                                        <div class="w-100">
                                            <a onclick="likePicture()" class="btn btn-primary mb-3 " id="like"></a>
                                            <a onclick="sharePicture()" class="btn btn-primary ml-1 mb-3" id="share"></a>
                                        </div>
                                        <h5>Comments </h5>
                                        <div class="form-outline d-flex mb-3">
                                            <input type="text" id="note" class="form-control" placeholder="Type comment..." />
                                            <button onclick="addComment()" class="btn btn-primary float-right ml-1 ">Comment</button>
                                        </div>
                                        <div id="comments">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script>
    let viewedPictureID = 0;
    @extends('js.functions')
    function viewPhoto(id) {
        viewedPictureID = parseInt(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/view',
            data:{
                id:viewedPictureID
            },
            success: function(data) {
                document.getElementById('image-form').innerHTML =  "<img src=/image/" + data.picture.name + ">";
                document.getElementById('name-of-user-picture').innerHTML =  "By: <a href=/profile/"+ data.user.id +">" + data.user.name +"</a>";
                let comments = "";
                for( let i = data.comments.length - 1; i >= 0 ; --i) {
                    comments += "<div class='card w-100 mb-4' id=comments >" +
                        "<div class='card-body'>" +
                        "<p id='comment-body'>"+ data.comments[i]['comment'].content +"</p>" +
                        "<div class='d-flex justify-content-between'>" +
                        "<div class=' align-items-center w-100'>" +
                        "<img width='25' height='25' alt='avatar' src=/image/" + data.comments[i]['userComment'].picture + ">" +
                        "<a class='small ml-2' href=/profile/"+ data.comments[i]['userComment'].id +">" + data.comments[i]['userComment'].name + "</a>";
                    if(data.comments[i]['userComment'].id == {{Auth::user()->id}}){
                        comments += "<a class='btn btn-danger ml-2 float-right' onclick='deleteComment(`" + (data.comments[i]['comment'].id) + "`)' > <i class='fa fa-trash' aria-hidden='true'></i></a>";
                    }
                    comments += "</div>" +
                        "</div>" +
                        "</div>" +
                        "</div>"
                }
                document.getElementById('comments').innerHTML = comments;
                if(data.isLiked){
                    document.getElementById('like').innerHTML = "disLike <i class='fa fa-thumbs-up' aria-hidden='true'></i> " + data.picture.react_number;
                }
                else {
                    document.getElementById('like').innerHTML = "Like <i class='fa fa-thumbs-up' aria-hidden='true'></i> " + data.picture.react_number;
                }
                if (data.isSaved) {
                    document.getElementById('share').innerHTML = "unSave <i class='fa fa-share' aria-hidden='true'></i> " + data.picture.share_number;
                } else {
                    document.getElementById('share').innerHTML = "Save <i class='fa fa-share' aria-hidden='true'></i> " + data.picture.share_number;
                }
            }
        });
    }


</script>
@endsection
