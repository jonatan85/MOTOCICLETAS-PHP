<?php

namespace App\Form;

use App\Entity\Moto;
use App\Entity\Tipo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('modelo')
            ->add('marca')
            ->add('img')
            ->add('cv')
            ->add('cilindrada')
            ->add('color')
            ->add('description')
            ->add('tipo', EntityType::class, [
                // looks for choices from this entity
                'class' => Tipo::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'nombre',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('enviar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Moto::class,
        ]);
    }
}
