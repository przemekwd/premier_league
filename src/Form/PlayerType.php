<?php

namespace App\Form;

use App\Entity\Nation;
use App\Entity\Player;
use App\Repository\NationRepository;
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
            ->add('firstname')
            ->add('lastname')
            ->add('name')
            ->add('nation', EntityType::class, [
                'class' => Nation::class,
                'query_builder' => function (NationRepository $nationRepository) {
                    return $nationRepository->findAllSortSelect();
                },
                'choice_label' => 'name'
            ])
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd-mm-yyyy',
            ])
            ->add('birthPlace')
            ->add('height')
            ->add('position')
            ->add('image', FileType::class)
            ->add('nationActive')
            ->add('clubActive')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
