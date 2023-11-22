<link rel="stylesheet" href="<?= ROOT ?>/assets/css/includes/sidebar.css">

<!-- Sidebar -->
<div class="sidebar">
    <a href="<?= ROOT ?>\home" class="logo">
        <i class="fa-solid fa-paw"></i>
        <span><?= APP_NAME ?></span>
    </a>
    <ul class="side-menu" role="tablist">
        <li class="active"><a class="active" href="#dashboard-tab" data-bs-toggle="tab"><i class="fa-solid fa-table-list"></i>Dashboard</a></li>
        <li><a href="#form-tab" data-bs-toggle="tab"><i class="fa-regular fa-clipboard"></i>Form</a></li>
        <li><a href="#information-tab" data-bs-toggle="tab"><i class="fa-solid fa-circle-info"></i>Information</a></li>
    </ul>
    <ul class="side-menu">
        <li><a href="<?= ROOT ?>\logout" class="logout text-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a></li>
    </ul>
</div>

<div class="content">
    <nav>
        <i class="fa-solid fa-bars menu"></i>
        <form>
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button class="search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        <a href="#" class="notif">
            <i class="fa-regular fa-bell"></i>
            <span class="count bg-danger">12</span>
        </a>
        <a href="#" class="profile">
            <img src="<?= ROOT ?>/assets/images/admin.png" alt="admin">
        </a>
    </nav>

    <script>
        $(document).ready(function() {
            const sideLinks = $(".sidebar .side-menu li a:not(.logout)");

            sideLinks.on("click", function() {
                const li = $(this).parent();
                sideLinks.parent().removeClass("active");
                li.addClass("active");
            });

            const menuBar = $(".content nav .menu");
            const sideBar = $(".sidebar");

            menuBar.on("click", function() {
                sideBar.toggleClass("close");
            });

            const searchBtn = $(".content nav form .form-input button");
            const searchBtnIcon = $(".content nav form .form-input button i");
            const searchForm = $(".content nav form");

            searchBtn.on("click", function(e) {
                if (window.innerWidth < 576) {
                    e.preventDefault();
                    searchForm.toggleClass("show");
                    if (searchForm.hasClass("show")) {
                        searchBtnIcon.removeClass("fa-magnifying-glass").addClass("fa-xmark");
                    } else {
                        searchBtnIcon.removeClass("fa-xmark").addClass("fa-magnifying-glass");
                    }
                }
            });

            $(window).on("resize", function() {
                if (window.innerWidth < 768) {
                    sideBar.addClass("close");
                } else {
                    sideBar.removeClass("close");
                }
                if (window.innerWidth > 576) {
                    searchBtnIcon.removeClass("fa-xmark").addClass("fa-magnifying-glass");
                    searchForm.removeClass("show");
                }
            });
        });
    </script>