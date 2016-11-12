<div id='page'>
    <br><br>
    <div id='header' class='status4xx'>
        <?php
        if (isset($arrData) && !empty($arrData)) {
            //https://es.wikipedia.org/wiki/Anexo:C%C3%B3digos_de_estado_HTTP
            ?>
            <h1>ERROR <?php echo $arrData['code'] ?> - <?php echo $arrData['text'] ?></h1>
            <?php
        }
        ?>

    </div>
    <div id='content'>
        <h2>The following error occurred:</h2>
        <p>The requested URL was not found on this server.</p>
        <P>Please check the URL or contact the <!--WEBMASTER//-->webmaster<!--WEBMASTER//-->.</p>
    </div>
    <div id='footer'>
        <p>Powered by <a href='http://www.ispconfig.org'>ISPConfig</a></p>
    </div>
</div>
