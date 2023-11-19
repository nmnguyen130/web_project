<div class="d-flex justify-content-between align-items-center">
    <a href="<?= ROOT ?>/home" class="my-2"><i class="fa-solid fa-backward fs-5 text-white ms-3"></i></a>
    <h2 style="text-align: right; color: var(--text-color)" class="pt-1" id="province_name"></h2>
</div>
<div class="text-show mt-4">
    <h1 class="text-white text-center">Chọn tỉnh muốn xem.</h1>
</div>
<div class="card card-infor hidden">
    <div>
        <div>
            <img src="" class="infor-img m-2" id="image" alt="image" />
            <h5 class="px-4 my-3 text-break" id="name"></h5>
            <p class="px-4" id="characteristic"></p>
            <p class="px-4" id="behavior"></p>
            <p class="px-4" id="habitat"></p>
            <p class="px-4" id="province_list"></p>
        </div>
    </div>
</div>
<hr>
<div class="card card-list hidden">
    <h5 class="px-4 mt-2" id="list-title"></h5>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-3 g-3 mx-2 mb-2" id="creature-list">

    </div>
    <button class="btn btn-primary w-50 m-auto mb-1" id="more-btn">Hiển thị thêm</button>
</div>
<div class="d-flex justify-content-center btn-container hidden">
    <button class="btn btn-secondary mx-2 my-2 custom-btn">Động Vật</button>
    <button class="btn btn-primary mx-2 my-2 custom-btn">Thực Vật</button>
</div>