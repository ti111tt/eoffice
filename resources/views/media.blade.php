<!-- resources/views/media.blade.php -->
<div class="bg-secondary rounded h-100 p-4">
    <h6 class="mb-4">Upload Media</h6>

    <!-- Upload Form -->
    <form action="{{ route('media.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Upload</span>
            <input type="file" class="form-control" name="media_file" required aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Description</span>
            <textarea class="form-control" name="description" placeholder="Description" aria-label="Description"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
