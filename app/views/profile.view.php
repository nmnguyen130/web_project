<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css">

<main class="d-flex align-items-center">

    <?php
    $ses = new \Core\Session;
    ?>

    <div class="container">
        <h3 class="title">Hồ sơ cá nhân</h3>
        <div class="card">
            <div class="row">
                <div class="col-md-3 pe-0 border-end">
                    <div class="list-group" role="tablist">
                        <a class="list-group-item list-group-item-action <?= ($active_tab === 'account-general') ? 'active' : ''; ?>" data-bs-toggle="tab" href="#account-general">Chung</a>
                        <a class="list-group-item list-group-item-action <?= ($active_tab === 'account-change-password') ? 'active' : ''; ?>" data-bs-toggle="tab" href="#account-change-password">Thay đổi mật khẩu</a>
                        <a class="list-group-item list-group-item-action <?= ($active_tab === 'account-info') ? 'active' : ''; ?>" data-bs-toggle="tab" href="#account-info">Đóng góp của bạn</a>
                        <a class="list-group-item list-group-item-action" href="<?= ROOT ?>/logout">Đăng xuất</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade <?= ($active_tab === 'account-general') ? 'show active' : ''; ?>" id="account-general">
                            <form id="general-form" name="general-form" method="post">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control mb-1" name="username" value="<?php echo $ses->user('username') ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" name='email' value="<?php echo $ses->user('email') ?>" disabled />
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade <?= ($active_tab === 'account-change-password') ? 'show active' : ''; ?>" id="account-change-password">
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
                        </div>

                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                                <div class="row pb-2">
                                    <h6 class="text-decoration-underline">Số biểu mẫu:</h6>
                                    <div class="col">
                                        <label class="form-label pe-1"><i class="fa-solid fa-file-import pe-2 text-success"></i>Đã gửi:</label>
                                        <span class="badge bg-success text-white"><?php echo $total ?></span>
                                    </div>
                                    <div class="col">
                                        <label class="form-label pe-1 "><i class="fa-solid fa-square-check pe-2 text-success"></i>Đã được phê duyệt:</label>
                                        <span class="badge bg-success text-white"><?php echo $approved ?></span>
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
                                                <input type="text" class="form-control w-auto" value="Ngày <?php echo "3/5/1995" ?>" disabled />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group d-flex align-items-center">
                                                <label class="form-label m-0 me-3">Tình trạng:</label>
                                                <input type="text" class="form-control w-auto" value="<?php echo "Đang chờ phê duyệt" ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Đặc điểm</label>
                                        <textarea type="text" class="form-control" name="creature-characteristic" readonly></textarea>
                                    </div>
                                    <div class="form-group" id="behavior">
                                        <label class="form-label">Hành vi</label>
                                        <textarea type="text" class="form-control" name="creature-behavior" readonly></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Môi trường sống</label>
                                        <textarea type="text" class="form-control" name="creature-habitat" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        $("#repeatPass").on("input", function() {
            checkNewPassMatch();
        });

        function checkNewPassMatch() {
            var newPass = $("#newPass").val();
            var repeatPass = $("#repeatPass").val();
            var repeatError = $("#repeatError");
            var saveButton = $("#save");

            if (newPass === repeatPass) {
                repeatError.text("");
                saveButton.prop("disabled", false);
            } else {
                repeatError.text("Mật khẩu không trùng khớp!");
                saveButton.prop("disabled", true);
            }
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $("#save").on("click", function() {
                if ($("#account-general").hasClass("active")) {
                    $("#general-form").submit();
                }
                if ($("#account-change-password").hasClass("active")) {
                    $("#password-form").submit();
                }
                if ($("#account-info").hasClass("active")) {
                    $("#contribution-form").submit();
                }
            });
        });
    });
</script>
<script>
    const root = "<?= ROOT ?>";
    const creatures = <?php echo json_encode($nameCreature); ?>;
</script>
<script src="<?= ROOT ?>/assets/js/form.js"></script>