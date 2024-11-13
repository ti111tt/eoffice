<div class="bg-secondary rounded h-100 p-4">
    <h6 class="mb-4">Media Feed</h6>

    <!-- Media Items -->
    @foreach ($media as $item)
        <div id="media-{{ $item->id }}" class="media-item mt-4">
            <!-- Display Username and Time -->
            <h6>Uploaded by: {{ $item->nama_lengkap }}</h6>
            <h6>Time: {{ $item->created_at }}</h6>

            <!-- Display media based on type -->
            @if ($item->media_type === 'photo')
                <img src="{{ asset('images/' . $item->media_path) }}" alt="Photo" class="img-fluid rounded">
            @elseif ($item->media_type === 'video')
                <video src="{{ asset('images/' . $item->media_path) }}" class="img-fluid rounded" controls></video>
            @endif

            <!-- Display Description -->
            <p id="description-{{ $item->id }}">{{ $item->description }}</p>

            <!-- Display Like Count -->
            <p class="mt-2"><strong id="like-count-{{ $item->id }}">{{ $item->like_count }} Likes</strong></p>

            <!-- Like Button -->
            <form action="javascript:void(0);" method="post" class="mt-3" onsubmit="likeMedia({{ $item->id }})">
                <button type="submit" class="btn btn-outline-primary" id="like-button-{{ $item->id }}" {{ $item->user_has_liked ? 'disabled' : '' }}>
                    {{ $item->user_has_liked ? 'Liked' : 'Like' }}
                </button>
            </form>

            <!-- Comment Form -->
            <form action="{{ url('home/comment/' . $item->id) }}" method="post" class="mt-3">
                @csrf
                <div class="input-group mb-2">
                    <textarea class="form-control" name="comment" placeholder="Write a comment"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-primary">Comment</button>
            </form>

          <!-- Share Button -->
<form action="{{ route('media.share', $item->id) }}" method="post" class="mt-3">
    @csrf
    <button type="submit" class="btn btn-outline-success">Share</button>
</form>

            <!-- Button to Toggle Edit and Delete Box -->
            <button class="btn btn-outline-secondary mt-3" onclick="toggleEditDelete({{ $item->id }})">Edit/Delete</button>

            <!-- Hidden Edit and Delete Forms Box -->
            <div id="edit-delete-box-{{ $item->id }}" style="display: none; background-color: #f8f9fa; padding: 10px; border-radius: 10px; margin-top: 10px;">
                <!-- Edit Description Form -->
                <form action="{{ route('media.edit.description', $item->id) }}" method="post" class="mt-3">
                    @csrf
                    <div class="input-group mb-2">
                        <textarea class="form-control" name="description">{{ $item->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Update Description</button>
                </form>

                <!-- Delete Media Form -->
                <form action="{{ route('media.delete', $item->id) }}" method="post" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this media?')">Delete Media</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
<!-- @if (Auth::check()) 
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endif -->

<script>
    function toggleEditDelete(mediaId) {
        const editDeleteBox = document.getElementById(`edit-delete-box-${mediaId}`);
        editDeleteBox.style.display = editDeleteBox.style.display === 'none' ? 'block' : 'none';
    }

    function likeMedia(mediaId) {
        const xhr = new XMLHttpRequest();
        const url = `{{ url('home/like') }}/${mediaId}`;

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.setRequestHeader("X-CSRF-TOKEN", token);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const likeCountElement = document.getElementById(`like-count-${mediaId}`);
                let currentLikes = parseInt(likeCountElement.textContent) || 0;
                likeCountElement.textContent = `${currentLikes + 1} Likes`;

                const likeButton = document.querySelector(`button[id="like-button-${mediaId}"]`);
                likeButton.textContent = 'Liked';
                likeButton.disabled = true;
            }
        };

        xhr.send(`media_id=${mediaId}`);
    }
    
</script>
    