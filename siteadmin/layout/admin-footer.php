
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Etoiles 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>   <!-- #layoutSidenav_content -->
</div> <!-- #layoutSidenav -->
<script src="<?php echo SITE_ADMIN_URL; ?>/js/jquery-3.5.1.min.js"></script>
<script src="<?php echo SITE_ADMIN_URL; ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo SITE_ADMIN_URL; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo SITE_ADMIN_URL; ?>/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo SITE_ADMIN_URL; ?>/js/dropzone.min.js"></script>
<script src="<?php echo SITE_ADMIN_URL; ?>/js/scripts.js"></script>

<script src="<?php echo SITE_ADMIN_URL; ?>/js/ckeditor.js"></script>
<script>
    if ( document.getElementById("detail") ){
        ClassicEditor
            .create( document.querySelector( '#detail' ) )
            .catch( error => {
                console.error( error );
            } );
    }
</script>
</body>

</html>