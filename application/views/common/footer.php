    <div class="container">
        <hr>
        <footer>
            
        </footer>
    </div>
        <script src="<?=base_url('/assets/js/jquery.min.js')?>"></script>
        <script src="<?=base_url('/assets/js/bootstrap.min.js')?>"></script>
        <script src="<?=base_url('/assets/js/navbar_script.js') ?>"></script>
        <script src="<?=base_url('/assets/js/fontawesome.min.js') ?>"></script>
    <?php
        if(isset($script)){
            echo $script;
        }
    ?>
</body>
</html>