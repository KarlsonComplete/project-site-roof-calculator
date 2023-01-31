<?php

namespace App\Form;

use App\Entity\MaterialType;
use App\Repository\CoatingRepository;
use App\Repository\MaterialTypeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

//Сущности
use App\Entity\Coating;
use Symfony\Component\Validator\Constraints\NotBlank;

class RoofType extends AbstractType
{

    public function __construct(private MaterialTypeRepository $materialTypeRepository){}

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event)  {
        $coating = $event->getData()['coating'] ?? null;

        $material_types = $coating ===null ? [] : $this->materialTypeRepository->findByCoating($coating, ['title' => 'ASC']);

        $event->getForm()->add('material', EntityType::class, [
            'class' => MaterialType::class,
            'choice_label' => 'title',
            'choices' => $material_types,
            'disabled' => $coating === null,
            'placeholder' => 'Пожалуйста выберите тип материал',
            'constraints' => new NotBlank(['message'=> 'Выберите тип материала'])

        ]);
    })
        ->add('coating', EntityType::class, [
            'class' => Coating::class,
            'choice_label' => 'title',
            'placeholder' => 'Пожалуйста выберите материал',
            'query_builder' => function (CoatingRepository $coatingRepository) {
                return $coatingRepository->findAllOrderByAscTitleQueryBuilder();
            },
            'constraints' => new NotBlank(['message' => 'Выберите материал']),

        ]);
    }


}