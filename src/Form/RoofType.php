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
use App\Form\EventListener\AddSelectSubscriber;

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
        $builder->addEventSubscriber(new AddSelectSubscriber($this->materialTypeRepository, $this->typeOfSelectMaterialRepository));
            /*->add('coating', EntityType::class, [
                'class' => Coating::class,
                'choice_label' => 'title',
                'placeholder' => 'Пожалуйста выберите материал',
                'query_builder' => fn(CoatingRepository $coatingRepository) => $coatingRepository->findAllOrderByAscTitleQueryBuilder()
            ]);


        $formModifier = function (FormInterface $form, $coating_id) {
            $material_types = $coating_id === null ? [] : $this->materialTypeRepository->SearchForIdenticalId($coating_id);

            $form->add('materialType', EntityType::class, [
                'class' => MaterialType::class,
                'choice_label' => 'title',
                'choices' => $material_types,
                'disabled' => $coating_id === null,
                'placeholder' => 'Пожалуйста выберите тип материал',
            ]);

        };
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $coating = $event->getData()->getCoating();
                $coating_id = $coating ? $coating->getId() : null;

                $formModifier($event->getForm(), $coating_id);
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();
                $coating_id = array_key_exists('coating', $data) ? $data['coating'] : null;

                $formModifier($event->getForm(), $coating_id);
            }
        );

        $formModifierLast = function (FormInterface $form,  $materialType_id) {
            $type_of_select_materials = $materialType_id === null ? [] : $this->typeOfSelectMaterialRepository->SearchForIdenticalId($materialType_id);

            $form->add('typeOfSelectMaterial', EntityType::class,
                ['class' => TypeOfSelectMaterial::class,
                    'choice_label' => 'title',
                    'placeholder' => 'Пожалуйста выберите вид материала',
                    'disabled' => $materialType_id === null,
                    'choices' => $type_of_select_materials
                ]);
        };


        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifierLast) {
                $materialType = $event->getData()->getMaterialType();
                $materialType_id = $materialType ? $materialType->getId() : null;

                $formModifierLast($event->getForm(), $materialType_id);

            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($formModifierLast) {
                $data = $event->getData();
                $materialType_id = array_key_exists('materialType', $data) ? $data['materialType'] : null;
                $formModifierLast($event->getForm(), $materialType_id);
            }
        );
*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RoofList::class,
        ]);
    }

}