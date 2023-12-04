<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css">

<main class="d-flex align-items-center">

    <?php
    $ses = new \Core\Session;
    $user_id = $ses->user('id');
    $nameCreature = $form->getAllNameInForm($user_id);

    $tabs = [
        'general' => 'Chung',
        'change-password' => 'Thay đổi mật khẩu',
        'info' => 'Đóng góp của bạn'
    ];
    ?>

    <div class="container">
        <h3 class="title">Hồ sơ cá nhân</h3>
        <div class="card">
            <div class="row">
                <div class="col-md-3 pe-0 border-end">
                    <div class="list-group" role="tablist">
                        <?php foreach ($tabs as $tab => $translation) : ?>
                            <a class="list-group-item list-group-item-action <?= ($active_tab === $tab) ? 'active' : ''; ?>" data-bs-toggle="tab" href="#<?= $tab ?>"><?= $translation ?></a>
                        <?php endforeach; ?>
                        <a class="list-group-item list-group-item-action" href="<?= ROOT ?>/logout">Đăng xuất</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <?php foreach ($tabs as $tab => $translation) : ?>
                            <div class="tab-pane fade <?= ($active_tab === $tab) ? 'show active' : ''; ?>" id="<?= $tab ?>">
                                <?php if ($tab === 'general') : ?>
                                    <form id="general-form" name="general-form" method="post">
                                        <div class="card-body pb-2">
                                            <?php foreach (['username', 'email'] as $inputName) : ?>
                                                <div class="form-group">
                                                    <label class="form-label"><?= ucfirst($inputName) ?></label>
                                                    <input type="text" class="form-control mb-1" name="<?= $inputName ?>" value="<?= $ses->user($inputName) ?>" <?= ($inputName === 'email') ? 'disabled' : '' ?> />
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </form>
                                <?php elseif ($tab === 'change-password') : ?>
                                    <form id="password-form" name="password-form" method="post">
                                        <div class="card-body pb-2">
                                            <div class="form-group">
                                                <label class="form-label">Mật khẩu cũ</label>
                                                <input type="password" class="form-control" name='current_pass' />
                                            </div>
                                            <div class="my-2"><small class="text-danger"><?= $user->getError('password') ?></small></div>
                                            <div class="form-group">
                                                <label class="form-label">Mật khẩu mới</label>
                                                <input type="password" class="form-control" id="newPass" name='new_pass' />
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Nhập lại mật khẩu mới</label>
                                                <input type="password" class="form-control" id="repeatPass" />
                                            </div>
                                            <div class=" my-2"><small class="text-danger" id="repeatError"></small>
                                            </div>
                                        </div>
                                    </form>
                                <?php elseif ($tab === 'info') : ?>
                                    <div class="card-body pb-2">
                                        <div class="row pb-2">
                                            <h6 class="text-decoration-underline">Số biểu mẫu:</h6>
                                            <div class="col">
                                                <label class="form-label pe-1"><i class="fa-solid fa-file-import pe-2 text-success"></i>Đã gửi:</label>
                                                <span class="badge bg-success text-white"><?= $form->getTotalForms($user_id) ?></span>
                                            </div>
                                            <div class="col">
                                                <label class="form-label pe-1 "><i class="fa-solid fa-square-check pe-2 text-success"></i>Đã được phê duyệt:</label>
                                                <span class="badge bg-success text-white"><?= $form->getTotalForms($user_id, "approved") ?></span>
                                            </div>
                                        </div>
                                        <hr class="mt-0">
                                        <h6 class="text-decoration-underline">Biểu mẫu:</h6>
                                        <div class="form-group">
                                            <div class="wrapper">
                                                <div class="select-btn d-flex align-items-center justify-content-between fs-6 rounded-1 border px-3 py-2">
                                                    <span>Sinh vật</span>
                                                    <i class="fa-solid fa-angle-down"></i>
                                                </div>
                                                <div class="content p-2 mt-1 rounded-1 border">
                                                    <div class="search position-relative">
                                                        <i class="fa-solid fa-magnifying-glass position-absolute mx-2"></i>
                                                        <input type="text" placeholder="Search" class="rounded-1 border py-2">
                                                    </div>
                                                    <ul class="options m-0 mt-1">
                                                        <?php
                                                        foreach ($nameCreature as $creature) {
                                                            echo '<li data-id="' . $creature->id . '">' . $creature->name . ' (' . $creature->scientific_name . ')' . '</li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-information">
                                            <div class="row py-2">
                                                <div class="col">
                                                    <div class="form-group d-flex align-items-center">
                                                        <label class="form-label m-0 me-3">Ngày gửi:</label>
                                                        <input type="text" class="form-control w-auto" value="" disabled />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group d-flex align-items-center">
                                                        <label class="form-label m-0 me-3">Tình trạng:</label>
                                                        <input type="text" class="form-control w-auto" value="" disabled />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Tỉnh:</label>
                                                <input type="text" class="form-control" name="province" readonly></input>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Đặc điểm:</label>
                                                <textarea type="text" class="form-control" name="characteristic" readonly></textarea>
                                            </div>
                                            <div class="form-group" id="behavior">
                                                <label class="form-label">Hành vi:</label>
                                                <textarea type="text" class="form-control" name="behavior" readonly></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Môi trường sống:</label>
                                                <textarea type="text" class="form-control" name="habitat" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button type="submit" id="save" class="btn bg-success text-white">Save changes</button>&nbsp;
            <a href="<?= ROOT ?>/home" class="btn btn-warning">Cancel</a>
        </div>
    </div>
</main>

<?php
if ($ses->pop('profile_submission_success')) {
    $data['popup_title'] = "Thông báo!";
    $data['popup_body'] = "Thông tin của bạn đã được thay đổi.";

    $this->view('includes/popup', $data);

    echo '<script>openPopup();</script>';
}
?>

<script src="<?= ROOT ?>/assets/js/libs/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        var repeatPassInput = $("#repeatPass");
        var saveButton = $("#save");
        var saveButton = $("#save");

        repeatPassInput.on("input", checkNewPassMatch);

        saveButton.show().on('click', function() {
            if ($("#general").hasClass("active")) {
                $("#general-form").submit();
            }
            if ($("#change-password").hasClass("active")) {
                $("#password-form").submit();
            }
        });

        $(".list-group-item").on("click", function() {
            if ($("#info").hasClass("active")) {
                $("#save").show();
                $('.wrapper').removeClass("active").find('span').text("Sinh vật");;
                $('.form-information').removeClass("active");
            } else {
                $("#save").hide();
            }
        });

        function checkNewPassMatch() {
            var newPass = $("#newPass").val();
            var repeatPass = repeatPassInput.val();

            $("#repeatError").text(newPass === repeatPass ? "" : "Mật khẩu không trùng khớp!");
            saveButton.prop("disabled", newPass !== repeatPass);
        }
    });
</script>
<script>
    const creatures = <?php echo json_encode($nameCreature); ?>;
</script>
<script src="<?= ROOT ?>/assets/js/profile.js"></script>