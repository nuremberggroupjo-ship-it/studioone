<div class="modal fade" id="sliderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="slider-title_header">Add Slider</h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <form id="sliderForm">
                @csrf
                <input type="hidden" name="id" id="slider_id">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6 mt-4">
                            <label>Title</label>
                            <input type="text" id="slider-title" name="title" required class="form-control"
                                placeholder="Enter the title">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label>Title (Arabic)</label>
                            <input type="text" name="title_ar" id="slider-title_ar" required class="form-control"
                                placeholder="أدخل العنوان">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label>Image</label>
                            <input type="file" multiple="false" name="image" id="image"
                                placeholder="Choose an image">
                            @error('image')
                                @foreach ($errors->all() as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @enderror
                        </div>
                        <div class="col-md-6 mt-4">
                            <label>Button Link</label>
                            <input type="text" name="button_link" id="slider-button_link" required
                                class="form-control form-control-solid" placeholder="Enter the button link">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label>Description</label>
                            <textarea name="description" cols="5" rows="5" id="slider-description" required
                                class="form-control form-control-solid text-editor" placeholder="Enter the description"></textarea>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label>Description (Arabic)</label>
                            <textarea name="description_ar" cols="5" rows="5" id="slider-description_ar" required
                                class="form-control form-control-solid text-editor" placeholder="أدخل الوصف"></textarea>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label>Button Name</label>
                            <input type="text" name="button_name" id="slider-button_name" required
                                class="form-control form-control-solid" placeholder="Enter the button name">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label>Button Name (Arabic)</label>
                            <input type="text" name="button_name_ar" id="slider-button_name_ar" required
                                class="form-control form-control-solid" placeholder="أدخل اسم الزر">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
