<?php

namespace App\Form;

use App\Entity\MaterialType;
use App\Entity\RoofList;
use App\Entity\TypeOfSelectMaterial;
use App\Repository\CoatingRepository;
use App\Repository\MaterialTypeRepository;
use App\Repository\TypeOfSelectMaterialRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

//Сущности
use App\Entity\Coating;
use Symfony\Component\Form\FormInterface;


class RoofType extends AbstractType
{

    public function __construct(private MaterialTypeRepository $materialTypeRepository,
                               private TypeOfSelectMaterialRepository $typeOfSelectMaterialRepository)
    {
    }

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

            $form->add('materialType', EntityType::class, [
                'class' => MaterialType::class,
                'choice_label' => 'title',
                'choices' => $material_types,
                'disabled' => $coating === null,
                'placeholder' => 'Пожалуйста выберите тип материал',
            ]);

        };

        $formModifierLast = function (FormInterface $form, MaterialType $materialType = null) {
            $type_of_select_materials = $materialType === null ? [] : $this->typeOfSelectMaterialRepository->SearchForIdenticalId($materialType);

            $form->add('typeOfSelectMaterial', EntityType::class,
                ['class' => TypeOfSelectMaterial::class,
                    'choice_label' => 'title',
                    'placeholder' => 'Пожалуйста выберите вид материала',
                    'disabled' => $materialType === null,
                    'choices' => $type_of_select_materials
                ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getCoating());
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifierLast) {
                $data = $event->getData();

                $formModifierLast($event->getForm(), $data->getMaterialType());
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RoofList::class,
        ]);
    }

}