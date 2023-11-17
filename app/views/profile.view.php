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
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">Chung</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Thay đổi mật khẩu</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Đóng góp của bạn</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="<?= ROOT ?>/logout">Đăng xuất</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control mb-1" value="" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="text" class="form-control mb-1" value="<?php echo "name@gmail.com" ?>" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Current password</label>
                                    <input type="password" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">New password</label>
                                    <input type="password" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Repeat new password</label>
                                    <input type="password" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                                <div class="row pb-2 ">
                                    <h6 class="text-decoration-underline">Số biểu mẫu:</h6>
                                    <div class="col">
                                        <label class="form-label">Đã gửi <i class="fa-solid fa-file-import"></i></label>
                                        <input type="text" class="form-control" value="<?php echo "1" ?> " disabled />
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Đã được phê duyệt <i class="fa-solid fa-square-check"></i></label>
                                        <input type="text" class="form-control" value="<?php echo "1" ?>" disabled />
                                    </div>
                                </div>
                                <hr>
                                <h6 class="text-decoration-underline">Biểu mẫu:</h6>
                                <div class="form-group">
                                    <label class="form-label">Tên sinh vật</label>
                                    <select class="custom-select">
                                        <option>USA</option>
                                        <option selected>Canada</option>
                                        <option>UK</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                    </select>
                                </div>

                                <div class="row pb-2 ">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Ngày gửi:</label>
                                            <input type="text" class="form-control" value="Ngày <?php echo "3/5/1995" ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Tình trạng:</label>
                                            <input type="text" class="form-control" value="<?php echo "Đang chờ phê duyệt" ?>" disabled />
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="form-label">Đặc điểm</label>
                                    <textarea type="text" class="form-control" name="creature-characteristic" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Hành vi</label>
                                    <textarea type="text" class="form-control" name="creature-behavior" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Môi trường sống</label>
                                    <textarea type="text" class="form-control" name="creature-habitat" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button type="button" class="btn bg-success text-white">Save changes</button>&nbsp;
            <a href="<?= ROOT ?>/home" class="btn btn-warning">Cancel</a>
        </div>
    </div>
</main>
<script>
    const listItems = document.querySelectorAll(".list-group-item");
    const tabPanes = document.querySelectorAll(".tab-pane");

    listItems.forEach((listItem, index) => {
        listItem.addEventListener("click", (e) => {
            listItems.forEach((listItem) => {
                listItem.classList.remove("active");
            });
            tabPanes.forEach((tabPane) => {
                tabPane.classList.remove("active");
                tabPane.classList.remove("show");
            });

            listItems[index].classList.add("active");
            tabPanes[index].classList.add("active");
            tabPanes[index].classList.add("show");
        });
    });
</script>