<?php

namespace AloneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewUserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, array(
            'label' => 'Username',
        ))
                ->add('email', EmailType::class, array(
                    'label' => 'E-Mail',
                ))
                ->add('plainPassword', PasswordType::class, array(
                    'label' => 'Password',
                ))
            ->add('Submit', SubmitType::class, array(
               'label' => 'Senden',
            ));
    }
}
