<div class="modal d-block modal-dialog" id="popup" role="document">
    <div class="modal-content rounded-4 shadow">
        <div class="modal-header border-bottom-0 d-flex justify-content-center">
            <h1 class="modal-title fs-5"><?php echo $popup_title ?></h1>
        </div>
        <div class="modal-body py-0">
            <p class="text-center"><?php echo $popup_body ?></p>
        </div>
        <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
            <button type="button" class="btn btn-lg btn-primary bg-success" onclick="closePopup()">OK</button>
        </div>
    </div>
</div>

<script src="<?= ROOT ?>/assets/js/libs/jquery-3.7.1.min.js"></script>
<script>
    let popup = $("#popup");

    function openPopup() {
        popup.addClass("popup");
    }

    function closePopup() {
        popup.removeClass("popup");
    }

    function removePopup() {
        popup.remove();
    }
</script>