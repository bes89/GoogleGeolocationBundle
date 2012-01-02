Symfony2 Instalation
====================

deps
----
    [PenfoldGoogleGeolocationBundle]
        git=git://github.com/penfold45/GoogleGeolocationBundle.git
        target=/bundles/Penfold/Bundle/GoogleGeolocationBundle

app/autoload.php
----------------
    'Penfold'          => __DIR__.'/../vendor/bundles',

app/AppKernel.php
-----------------
    new Penfold\GoogleGeolocationBundle\PenfoldGoogleGeolocationBundle(),
