<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/map.css">

<div class="container-fluid">
    <div class="row vh-100">
        <div class="col-5 bg-primary-subtle position-fixed">
            <div id="map"></div>
            <div id="info-box"></div>
        </div>
        <div class="col-7 bg-image offset-5">
            <?php $this->view('includes/detail', $data) ?>
        </div>
    </div>
</div>

<script src="<?= ROOT ?>/assets/js/libs/bootstrap.bundle.min.js"></script>
<script src="<?= ROOT ?>/assets/js/libs/raphael.min.js"></script>
<script src="<?= ROOT ?>/assets/js/libs/jquery-3.7.1.min.js"></script>

<script src="<?= ROOT ?>/assets/js/mapdata.js"></script>
<script src="<?= ROOT ?>/assets/js/countrymap.js"></script>

<script src="<?= ROOT ?>/assets/js/drawmap.js"></script>
<script>
    function sendData(provinceName) {
        $.ajax({
            url: "<?= ROOT ?>/ajax",
            method: "POST",
            data: {
                provinceName: provinceName,
            },
            success: function(response) {
                var animalInfo = response.animal_info;

                $("#image").attr('src', animalInfo.image_url)
                $("#province_name").text(provinceName);
                $("#name").text(
                    animalInfo.name + " (tên khoa học: " + animalInfo.scientific_name + ")"
                );
                $("#characteristic").html("<b>Đặc điểm: </b>" + animalInfo.characteristic);
                $("#behavior").html("<b>Tập tính: </b>" + animalInfo.behavior);
                $("#habitat").html("<b>Môi trường sống: </b>" + animalInfo.habitat);

                // Update Province has Animal
                var provinceHasAnimal = response.animal_province;

                var provinceListHTML = "<b>Có thể tìm thấy ở: </b>";
                for (var i = 0; i < provinceHasAnimal.length; i++) {
                    provinceListHTML += "<a href='#'>" + provinceHasAnimal[i].name + "</a>";
                    if (i < provinceHasAnimal.length - 1) {
                        provinceListHTML += ", ";
                    }
                }
                $("#province_list").html(provinceListHTML);
            },
        });
    }
</script>
</body>

</html>