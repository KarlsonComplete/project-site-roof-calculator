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
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class RoofType extends AbstractType
{

    public function __construct(private MaterialTypeRepository $materialTypeRepository){}

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coating', EntityType::class, [
                'class' => Coating::class,
                'choice_label' => 'title',
                'placeholder' => 'Пожалуйста выберите материал',
                'query_builder' => fn(CoatingRepository $coatingRepository) => $coatingRepository->findAllOrderByAscTitleQueryBuilder()
            ]);


        $formModifier = function (FormInterface $form, Coating $coating = null) {
            $material_types = $coating === null ? [] : $this->materialTypeRepository->SearchForIdenticalId($coating);

            $form->add('material', EntityType::class, [
                'class' => MaterialType::class,
                'choice_label' => 'title',
                'choices' => $material_types,
                'disabled' => $coating === null,
                'placeholder' => 'Пожалуйста выберите тип материал',
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getCoating());
            }
        );

        $builder->get('coating')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $coating = $event->getForm()->getData();

                $formModifier($event->getForm()->getParent(), $coating);
            }
        );

    }






}