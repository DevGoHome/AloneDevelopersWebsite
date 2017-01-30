<?php

namespace AloneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddDevBlog_Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sender', TextType::class, array(
            'label' => 'Absender',
        ))
            ->add('title', TextType::class, array(
                'label' => 'Titel',
            ))
            ->add('body', TextareaType::class, array(
                'label' => 'Content',

                'attr' => array(
                    'class' => 'tinymce',
                    'data-theme' => 'advanced',
                )
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Senden',
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'alone_bundle_add_dev_blog_form';
    }
}
