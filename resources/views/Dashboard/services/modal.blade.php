<div class="modal fade" id="serviceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title_service">Add Service</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="serviceForm">
                @csrf
                <input type="hidden" name="id" id="service_id">
                <div class="modal-body row">
                    <div class="col-md-12">
                        <label>Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Name</label>
                        <input type="text" name="name" id="service_name" required
                            class="form-control form-control-solid " placeholder="Enter name">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Name (Arabic)</label>
                        <input type="text" name="name_ar" id="service_name_ar" required
                            class="form-control form-control-solid " placeholder="أدخل الاسم">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Short Description</label>
                        <textarea name="short_description" required id="service_short_description" class="form-control form-control-solid "
                            placeholder="Enter short description"></textarea>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Short Description (Arabic)</label>
                        <textarea name="short_description_ar" id="service_short_description_ar" required
                            class="form-control form-control-solid " placeholder="أدخل الوصف القصير"></textarea>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control form-control-solid  text-editor" id="service_description"
                            placeholder="Enter description"></textarea>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label>Description Arabic</label>
                        <textarea name="description_ar" class="form-control form-control-solid  text-editor" id="service_description_ar"
                            placeholder="أدخل الوصف"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
