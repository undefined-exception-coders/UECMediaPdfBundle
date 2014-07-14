<?php

namespace UEC\MediaPdfBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use UEC\MediaPdfBundle\ExtractMode;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('uec_media_pdf');

        $rootNode
            ->children()
                ->arrayNode('model')
                    ->children()
                        ->scalarNode('pdf')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('pdf_image')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->enumNode('extract_mode')
                    ->values(array(
                        ExtractMode::SCHEDULE,
                        ExtractMode::RUNTIME,
                    ))
                    ->cannotBeEmpty()
                ->end()
                ->integerNode('extract_limit')
                    ->defaultNull()
                ->end()
                ->integerNode('extract_quality')
                    ->defaultValue(100)
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('base_file_path')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('ocr')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')
                            ->defaultFalse()
                        ->end()
                        ->scalarNode('service')
                            ->defaultNull()
                        ->end()
                        ->arrayNode('services')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('tesseract')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('temp_dir')
                                            ->defaultValue('/tmp')
                                            ->cannotBeEmpty()
                                        ->end()
                                        ->scalarNode('service')
                                            ->defaultValue('uec_media_pdf.ocr.tesseract')
                                            ->cannotBeEmpty()
                                        ->end()
                                    ->end()
                                ->end()
                                ->arrayNode('xpdf')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('bin')
                                            ->defaultValue('/opt/local/xpdf/bin/pdftotext')
                                            ->cannotBeEmpty()
                                        ->end()
                                        ->integerNode('timeout')
                                            ->defaultValue(30)
                                            ->cannotBeEmpty()
                                        ->end()
                                        ->scalarNode('service')
                                            ->defaultValue('uec_media_pdf.ocr.xpdf')
                                            ->cannotBeEmpty()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('parser')
                    ->defaultValue('uec_media_pdf.parser.default')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('cdn')
                    ->defaultValue('uec_media_pdf.cdn.default')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('file_system')
                    ->defaultValue('uec_media_pdf.file_system.default')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('form_name')
                    ->defaultValue('uec_media_pdf_form')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('form_processor')
                    ->defaultValue('uec_media_pdf.form.processor.default')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('model_manager')
                    ->defaultValue('uec_media_pdf.manager.media_pdf.default')
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
