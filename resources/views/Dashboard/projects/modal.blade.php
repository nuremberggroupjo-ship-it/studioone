<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="modal-title_project" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title_project">Add Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="projectForm">
                    @csrf
                    <input type="hidden" id="project_id" name="id">

                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <label>Project Image</label>
                            <input type="file" required id="image" name="image"
                                class="form-control form-control-solid">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label>Project Images</label>
                            <input type="file" id="images" name="images[]" multiple
                                class="form-control form-control-solid">
                        </div>
                        <div class="col-md-6">
                            <label>Title</label>
                            <input type="text" id="project_title" name="title" required
                                class="form-control form-control-solid">
                        </div>
                        <div class="col-md-6">
                            <label>Title (Arabic)</label>
                            <input type="text" id="project_title_ar" name="title_ar" required
                                class="form-control form-control-solid">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label>Description</label>
                            <textarea name="description" id="project_description" class="form-control form-control-solid text-editor"
                                rows="5"></textarea>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label>Description (Arabic)</label>
                            <textarea name="description_ar" id="project_description_ar" class="form-control form-control-solid text-editor"
                                rows="5"></textarea>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label>Categories</label>
                            <select id="project_categories" name="categories[]"
                                class="form-control form-control-solid select2" multiple="multiple" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->name_ar }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <input type="checkbox" id="project_is_recent" class="form-check-input" name="is_recent"
                                value="0">
                            <label>Is Recent</label>

                        </div>

                    </div>

                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
