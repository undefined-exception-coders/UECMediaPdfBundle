<?php

namespace UEC\MediaPdfBundle\Form\Type;

use UEC\MediaBundle\Form\Type\MediaFormType as BaseMediaFormType;
use Symfony\Component\Form\FormBuilderInterface;

class MediaFormType extends BaseMediaFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'label.select_pdf',
            ))
        ;
    }

    public function getName()
    {
        return 'uec_media_pdf_form_media';
    }
} 