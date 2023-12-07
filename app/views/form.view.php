<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/form.css">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/includes/multi-select-tag.css">

<style id="customStyles"></style>

<?php $this->view('includes/header', $data) ?>

<main>
    <?php
    $ses = new \Core\Session;
    ?>

    <div class="container form-container">
        <form name="feedback-form" method="post" class="mt-2" enctype="multipart/form-data">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="pt-2">Góp ý của bạn</h2>
                <ul class="form-select-sm my-2 d-flex justify-content-between" id="creature-type">
                    <?php foreach (['Animal' => 'Động vật', 'Plant' => 'Thực vật'] as $value => $label) : ?>
                        <li>
                            <input type="radio" id="<?= strtolower($value) ?>" name="type" value="<?= $value ?>" <?= $value === 'Animal' ? 'checked' : '' ?>>
                            <label for="<?= strtolower($value) ?>"><?= $label ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="row">
                        <?php foreach (['name' => 'Tên loài', 'scientific_name' => 'Tên khoa học'] as $name => $label) : ?>
                            <div class="fill-in mt-1 col">
                                <input type="text" name="<?= $name ?>" placeholder=" ">
                                <label><?= $label ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="fill-in mt-4">
                        <select name="provinces[]" id="provinces" multiple>
                            <?php foreach ((new \Model\Province)->getProvinces() as $province) : ?>
                                <option value="<?= $province->name ?>"><?= $province->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Tỉnh</label>
                    </div>
                    <?php foreach (['characteristic' => 'Đặc điểm', 'behavior' => 'Hành vi', 'habitat' => 'Môi trường sống'] as $name => $label) : ?>
                        <div class="fill-in mt-4" <?= $name === 'behavior' ? ' id="behavior"' : '' ?>>
                            <textarea type="text" name="<?= $name ?>" cols="25" rows="4" placeholder=" "></textarea>
                            <label><?= $label ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-md-4 col-12 mt-4 mt-md-0 text-center">
                    <label>
                        <div class="fill-in mt-1">
                            <input onchange="displayImage(this.files[0])" name="image" type="file">
                            <label>Select Image</label>
                        </div>
                        <div>
                            <img src="<?= get_image() ?>" class="image-preview img-thumbnail">
                        </div>
                    </label>
                    <div class="my-2"><small class="text-danger"><?= $form->getError('image') ?></small></div>
                </div>
            </div>



            <div class="fill-in my-2 d-flex justify-content-center">
                <button class="btn btn-primary bg-success w-25">Send</button>
            </div>
        </form>
    </div>
</main>

<?php
if ($ses->pop('form_submission_success')) {
    $data['popup_title'] = "Đã gửi thành công!";
    $data['popup_body'] = "Cảm ơn bạn đã đóng góp.";

    $this->view('includes/popup', $data);

    echo '<script>openPopup();</script>';
}
?>

<script>
    $(document).ready(function() {
        var behaviorDiv = $("#behavior");
        var behaviorTextarea = behaviorDiv.find("textarea");

        handleCreatureTypeChange();

        $('input[name="type"]').on('change', handleCreatureTypeChange);

        function handleCreatureTypeChange() {
            if ($('input[name="type"]:checked').val() === "Animal") {
                behaviorDiv.show();
                behaviorTextarea.prop("required", true);
            } else {
                behaviorDiv.hide();
                behaviorTextarea.prop("required", false);
            }
        }
    });
</script>
<script src="<?= ROOT ?>/assets/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag("provinces");
</script>
<script>
    function displayImage(file) {
        let allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

        if (!allowed.includes(file.type)) {
            return;
        }

        $('.image-preview').attr('src', URL.createObjectURL(file));
    }

    function checkContainDiv() {
        var inputContainer = $(".input-container");
        var itemContainer = inputContainer.find(".item-container");

        var customStyles = $('#customStyles');
        var cssRules = `
            .fill-in select ~ label {
                padding: 0 10px;
                top: -4px;
                left: 22px;
                transform: translateX(10px) translateY(-7px);
                color: var(--primary-color);
                background-color: var(--white-color);
                border-left: 1px solid var(--primary-color);
                border-right: 1px solid var(--primary-color);
            }`;

        if (itemContainer.length > 0) {
            customStyles.html(cssRules);
        } else {
            customStyles.html("");
        }
    }
    setInterval(checkContainDiv, 10);
</script>