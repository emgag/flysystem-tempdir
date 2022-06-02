<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests');


$config = new PhpCsFixer\Config();
return $config->setRules([
        '@Symfony' => true,
        'binary_operator_spaces' => ['default' => 'align'],
        'concat_space' => ['spacing' => 'one'],
        'yoda_style' => false,
    ])
    ->setFinder($finder);

