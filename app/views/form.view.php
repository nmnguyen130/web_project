<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/form.css">

<?php $this->view('includes/header', $data) ?>

<main>
    <?php
    $ses = new \Core\Session;
    ?>

    <div class="container form-container">
        <form name="feedback-form" method="post" class="mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="pt-2">Góp ý của bạn</h2>
                <ul class="form-select-sm my-2 d-flex justify-content-between" id="creature-type">
                    <li>
                        <input type="radio" id="animal" name="type" value="Animal" checked>
                        <label for="animal">Động vật</label>
                    </li>
                    <li>
                        <input type="radio" id="plant" name="type" value="Plant">
                        <label for="plant">Thực vật</label>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="fill-in mt-1 col">
                    <input type="text" name="name" placeholder=" ">
                    <label>Tên loài</label>
                </div>

                <div class="fill-in mt-1 col">
                    <input type="text" name="scientific_name" placeholder=" ">
                    <label>Tên khoa học</label>
                </div>
            </div>

            <div class="fill-in mt-4">
                <input type="text" name="image_url" placeholder=" ">
                <label>Link ảnh (nếu có)</label>
            </div>

            <div class="fill-in mt-4">
                <textarea type="text" name="characteristic" cols="25" rows="4" placeholder=" "></textarea>
                <label>Đặc điểm</label>
            </div>

            <div class="fill-in mt-4" id="behavior">
                <textarea type="text" name="behavior" cols="25" rows="4" placeholder=" "></textarea>
                <label>Hành vi</label>
            </div>

            <div class="fill-in mt-4">
                <textarea type="text" name="habitat" cols="25" rows="4" placeholder=" "></textarea>
                <label>Môi trường sống</label>
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