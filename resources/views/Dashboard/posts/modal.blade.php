<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="postForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="post_id" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title_post">Add Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="image_path" class="form-label">Image</label>
                            <input type="file" class="form-control form-control-solid" id="image_path"
                                name="image_path" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="small_header" class="form-label">Small Header</label>
                            <input type="text" class="form-control form-control-solid" id="small_header"
                                name="small_header" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="small_header_ar" class="form-label">Small Header (Arabic)</label>
                            <input type="text" class="form-control form-control-solid" id="small_header_ar"
                                name="small_header_ar" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control form-control-solid" id="name" name="name"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name_ar" class="form-label">Name (Arabic)</label>
                            <input type="text" class="form-control form-control-solid" id="name_ar" name="name_ar"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control form-control-solid text-editor" id="description" name="description"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="description_ar" class="form-label">Description (Arabic)</label>
                            <textarea class="form-control form-control-solid text-editor" id="description_ar" name="description_ar"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="button_name" class="form-label">Button Name</label>
                            <input type="text" class="form-control form-control-solid" id="button_name"
                                name="button_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="button_name_ar" class="form-label">Button Name (Arabic)</label>
                            <input type="text" class="form-control form-control-solid" id="button_name_ar"
                                name="button_name_ar" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="button_link" class="form-label">Button Link</label>
                            <input type="url" class="form-control form-control-solid" id="button_link"
                                name="button_link" required>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Post</button>
                </div>
            </div>
        </form>
    </div>
</div>
