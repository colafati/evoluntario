<?php

namespace App\Form;

use App\Entity\Trabalho;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrabalhoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('instituicao')
            ->add('categoria')
            ->add('dataInicio')
            ->add('dataFim')
            ->add('periodo')
            ->add('descricao')
            ->add('site')
            ->add('cidade')
            ->add('telefone')
            ->add('email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trabalho::class,
        ]);
    }
}
