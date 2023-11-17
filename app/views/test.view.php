<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/form.css">

<?php $this->view('includes/header', $data) ?>
<main style="margin-top: 56px;">
    <?php


    $this->view('includes/popup', $data)
    ?>
    <button onclick="openPopup()">Show</button>
</main>