    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    <script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
    <script src="/js/notiflix-2.1.2.min.js"></script>
    <script>
        Notiflix.Notify.Init({
            width: '280px',
            position: 'right-top',
            distance: '10px',
            opacity: 1,
            borderRadius: '5px',
            rtl: false,
            timeout: 6000,
            messageMaxLength: 110,
            backOverlay: false,
            backOverlayColor: 'rgba(0,0,0,0.5)',
            plainText: true,
            showOnlyTheLastOne: false,
            clickToClose: false,
            ID: 'NotiflixNotify',
            className: 'notiflix-notify',
            zindex: 4001,
            useGoogleFont: true,
            fontFamily: 'Quicksand',
            fontSize: '13px',
            cssAnimation: true,
            cssAnimationDuration: 400,
            cssAnimationStyle: 'fade',
            closeButton: false,
            useIcon: true,
            useFontAwesome: false,
            fontAwesomeIconStyle: 'basic',
            fontAwesomeIconSize: '34px',
            success: {
                background: '#32c682',
                textColor: '#fff',
                childClassName: 'success',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-check-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
            },
            failure: {
                background: '#ff5549',
                textColor: '#fff',
                childClassName: 'failure',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-times-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
            },
            warning: {
                background: '#eebf31',
                textColor: '#fff',
                childClassName: 'warning',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-exclamation-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
            },
            info: {
                background: '#26c0d3',
                textColor: '#fff',
                childClassName: 'info',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-info-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
            },
        });
    </script>
    <?php if (isset($_SESSION['SUCCESS']) && !is_array($_SESSION['SUCCESS'])) { ?>
        <script>
            Notiflix.Notify.Success('<?php echo $_SESSION['SUCCESS']; ?>');
        </script>
    <?php unset($_SESSION['SUCCESS']);
    } ?>

    <?php if (isset($_SESSION['ERROR']) && !is_array($_SESSION['ERROR'])) { ?>
        <script>
            Notiflix.Notify.Failure('<?php echo $_SESSION['ERROR']; ?>');
        </script>
    <?php unset($_SESSION['ERROR']);
    } ?>

    <?php if (isset($_SESSION['SUCCESS']) && is_array($_SESSION['SUCCESS'])) {
        foreach ($_SESSION['SUCCESS'] as $msg) { ?>

            <script>
                Notiflix.Notify.Success('<?php echo $msg ?>');
            </script>

    <?php }
        unset($_SESSION['SUCCESS']);
    } ?>

    <?php if (isset($_SESSION['ERROR']) && is_array($_SESSION['ERROR'])) {
        foreach ($_SESSION['ERROR'] as $msg) { ?>
            <script>
                Notiflix.Notify.Failure('<?php echo $msg; ?>');
            </script>
            <?  ?>
    <?php }
        unset($_SESSION['ERROR']);
    } ?>
    </body>

    </html>