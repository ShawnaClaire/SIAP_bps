<?= $this->include('layout/header'); ?>
<?= $this->include('layout/sidenav'); ?>

<div id="layoutSidenav_content">
    <main>
        <?= $this->renderSection('content'); ?>
    </main>
    <?= $this->include('layout/page-footer'); ?>
</div>

<?= $this->include('layout/footer'); ?>