<?php

namespace AloneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class Comment_Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sender', TextType::class, array(
            'label' => 'Name',
        ))->add('content', TextareaType::class, array(
            'label' => 'Content',
            'attr' => array(
                'placeholder' => 'Thanks for wanting to share a comment!
                 Before we can publish it we must check it for spam or other nasty things.
                  Please have a little patience. Oh and the maximum character length is 1000.'
            )
        ))->add('send', SubmitType::class, array(
            'label' => 'Send',
        ));
    }

    public function getName()
    {
        return 'alone_bundle_comment_form';
    }
}
