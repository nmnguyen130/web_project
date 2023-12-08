<link rel="stylesheet" href="<?= ROOT ?>/assets/css/form.css">

<div class="modal fade" id="modalInfor" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border border-dark rounded-4 bg-light">
            <div class="modal-header">
                <h5 class="modal-title the-title" id="modalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="feedback-form" method="post" class="mx-1">
                    <div class="row">
                        <div class="col-6 col-md-7 flex-column mt-3">
                            <div class="fill-in mt-2">
                                <input type="text" name="name" placeholder=" " disabled>
                                <label>Creature name</label>
                            </div>

                            <div class="fill-in my-4">
                                <input type="text" name="scientific_name" placeholder=" " disabled>
                                <label>Scientific name</label>
                            </div>

                            <div class="fill-in ">
                                <textarea type="text" name="province" cols="25" rows="3" placeholder=" " disabled></textarea>
                                <label>Province</label>
                            </div>
                        </div>

                        <div class="col-6 col-md-5">
                            <div class="fill-in mt-3">
                                <img id="img-preview" class="w-100 float-end img-thumbnail" src="<?= get_image() ?>">
                            </div>
                        </div>
                    </div>

                    <div class="fill-in mt-3">
                        <textarea type="text" name="characteristic" cols="25" rows="3" placeholder=" " disabled></textarea>
                        <label>Characteristic</label>
                    </div>

                    <div class="fill-in mt-3" id="behavior">
                        <textarea type="text" name="behavior" cols="25" rows="3" placeholder=" " disabled></textarea>
                        <label>Behavior</label>
                    </div>

                    <div class="fill-in mt-3">
                        <textarea type="text" name="habitat" cols="25" rows="3" placeholder=" " disabled></textarea>
                        <label>Habitat</label>
                    </div>

                    <div class="fill-in mt-2 d-flex justify-content-end gap-2">
                        <button type="button" class="btn-edit edit btn border-2 border-dark text-dark">
                            <i class="fa-solid fa-wrench pe-2"></i>Edit
                        </button>
                        <button type="button" class="btn-approve btn border-2 border-primary text-primary">
                            <i class="fa-solid fa-thumbs-up pe-2"></i>Approve
                        </button>
                        <button type="button" class="btn-reject btn border-2 border-danger text-danger">
                            <i class="fa-solid fa-x pe-2"></i>Reject
                        </button>
                        <button type="button" class="btn-delete btn border-2 border-danger text-danger">
                            <i class="fa-solid fa-trash pe-2"></i>Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        var editBtn = $(".btn-edit");
        var form = $('form[name="feedback-form"]');
        var formElements = form.find("input, textarea");

        editBtn.on("click", () => {
            if (editBtn.hasClass("edit")) {
                editBtn
                    .removeClass("edit border-dark text-dark")
                    .addClass("border-success text-success");
                editBtn.html('<i class="fa-solid fa-check pe-2"></i>Save');

                formElements.prop("disabled", false);
            } else {
                editBtn
                    .addClass("edit border-dark text-dark")
                    .removeClass("border-success text-success");
                editBtn.html('<i class="fa-solid fa-wrench pe-2"></i>Edit');

                formElements.prop("disabled", true);
            }
        });
    });
</script>