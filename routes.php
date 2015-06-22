<?php

use RadioInfo\Entity\Site;
use RadioInfo\Entity\Radio;

$app->get('/', function() use ($app, $entityManager)
{
    $sites = $entityManager->getRepository(Site::class)->findAll();

    $app->render('sites/index.html.twig', ['sites' => $sites]);
});

$app->get('/site/:site', function($siteName) use ($app, $entityManager)
{
    $site = $entityManager->getRepository(Site::class)->findOneBy(['name' => $siteName]);

    $app->render('sites/show.html.twig', ['site' => $site]);
});

$app->get('/site/:site/:radio', function($siteName, $radioName) use ($app, $entityManager)
{
    $site = $entityManager->getRepository(Site::class)->findOneBy(['name' => $siteName]);
    $radio = $entityManager->getRepository(Radio::class)->findOneBy(['name' => $radioName, 'site' => $site]);

    $app->render('radio/show.html.twig', ['radio' => $radio, 'site' => $site]);
});