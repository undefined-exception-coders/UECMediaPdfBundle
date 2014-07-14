<?php

namespace UEC\MediaPdfBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MediaPdfFormType extends AbstractType
{
    /**
     * @var string
     */
    protected $modelClass;

    function __construct($modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('media', 'uec_media_pdf_form_media')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->modelClass,
        ));
    }

    public function getName()
    {
        return 'uec_media_pdf_form';
    }
} 