<?php

namespace App\Form;

use App\Entity\Nation;
use App\Entity\Player;
use App\Entity\Position;
use App\Repository\NationRepository;
use App\Repository\PositionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null,  [
                'attr' => ['class' => 'form-control']
            ])
            ->add('lastname', null,  [
                'attr' => ['class' => 'form-control']
            ])
            ->add('name', null,  [
                'attr' => ['class' => 'form-control']
            ])
            ->add('nation', EntityType::class, [
                'class' => Nation::class,
                'query_builder' => function (NationRepository $nationRepository) {
                    return $nationRepository->findAllSortSelect();
                },
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control']
            ])
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => ['class' => 'form-control']
            ])
            ->add('birthPlace', null,  [
                'attr' => ['class' => 'form-control']
            ])
            ->add('height', null,  [
                'attr' => ['class' => 'form-control']
            ])
            ->add('position', EntityType::class, [
                'class' => Position::class,
                'query_builder' => function (PositionRepository $positionRepository) {
                    return $positionRepository->findAllSortSelect();
                },
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control']
            ])
            ->add('image', null,  [
                'attr' => [
                    'class' => 'form-control',
                    'readonly' => 'readonly',
                ]
            ])
            ->add('imageFile', FileType::class,  [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('nationActive', null,  [
                'attr' => ['class' => 'form-control']
            ])
            ->add('clubActive', null,  [
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
            'attr' => ['class' => 'form-app']
        ]);
    }
}
