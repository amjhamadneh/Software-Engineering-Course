<script>
    function visiblePicture(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/privacy',
            data: {
                id: viewedPictureID,
            },
            success: function(data) {
                viewPhoto(viewedPictureID);// to update action of visibility
            }
        });
    }

    function likePicture(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/like',
            data: {
                id: viewedPictureID,
            },
            success: function(data) {
                viewPhoto(viewedPictureID);// to update number of like
            }
        });
    }

    function addComment(){
        let note = document.getElementById('note').value;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/add-comment',
            data: {
                note: note,
                id: viewedPictureID,
            },
            success: function(data) {
                viewPhoto(viewedPictureID);// to update comments
            }
        });
    }

    function deleteComment(id){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/delete-comment',
            data: {
                id: id
            },
            success: function(data) {
                viewPhoto(viewedPictureID);// to update comments
            }
        });
    }

    function sharePicture(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/share',
            data: {
                id: viewedPictureID,
            },
            success: function(data) {
                viewPhoto(viewedPictureID);// to update number of share
            }
        });
    }

    function deletePicture(){
      if(confirm("Are you sure?")){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/delete',
            data: {
                id: viewedPictureID,
            },
            success: function(data) {
                location.reload(); // to update pictures
            }
        });
      }
    }

</script>
