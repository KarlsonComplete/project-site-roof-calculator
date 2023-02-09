<?php

namespace App\Form\EventListener;

use App\Entity\Coating;
use App\Entity\MaterialType;
use App\Entity\TypeOfSelectMaterial;
use App\Repository\CoatingRepository;
use App\Repository\MaterialTypeRepository;
use App\Repository\TypeOfSelectMaterialRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormInterface;

class AddSelectSubscriber implements EventSubscriberInterface
{
    public function __construct(private MaterialTypeRepository $materialTypeRepository,
                                private TypeOfSelectMaterialRepository $typeOfSelectMaterialRepository)
    {
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData', // check preSetData method below
            FormEvents::PRE_SUBMIT => 'preSubmitData', // check preSubmitData method below
        );
    }

    public function preSetData(FormEvent $event)
    {
        $location = $event->getData();
        $form = $event->getForm();

        $coating = '';
        $materialType = '';
        $typeOfSelectMaterial = '';

        if ($location) {
            $coating = $location->getCoating();
            $materialType = $location->getMaterialType();
            $typeOfSelectMaterial = $location->getTypeOfSelectMaterial();
        }

        $form->add('coating', EntityType::class, [
            'class' => Coating::class,
            'choice_label' => 'title',
            'placeholder' => 'Пожалуйста выберите материал',
            'query_builder' => fn(CoatingRepository $coatingRepository) => $coatingRepository->findAllOrderByAscTitleQueryBuilder()
        ]);

        $this->addMaterialType($form, $coating);
        $this->addTypeOfSelectMaterial($form, $materialType);
    }

    public function preSubmitData(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        // Here $data will be in array format.

        // Add property field if parent entity data is available.
        $coating = isset($data['coating']) ? $data['coating'] : $data['coating'];
        $materialType = isset($data['coating']) ? $data['coating'] : $data['coating'];
        $typeOfSelectMaterial = isset($data['coating']) ? $data['coating'] : $data['coating'];

        // Call methods to add child fields.
        $this->addMaterialType($form, $coating);
        $this->addTypeOfSelectMaterial($form, $materialType);
    }

    private function addMaterialType(FormInterface $form, $coating) {
        $material_types = $coating === null ? [] : $this->materialTypeRepository->SearchForIdenticalId($coating);

        $form->add('materialType', EntityType::class, [
            'class' => MaterialType::class,
            'choice_label' => 'title',
            'choices' => $material_types,
            'disabled' => $coating === null,
            'placeholder' => 'Пожалуйста выберите тип материал',
        ]);

    }

    private function addTypeOfSelectMaterial(FormInterface $form, $materialType) {
        $type_of_select_materials = $materialType === null ? [] : $this->typeOfSelectMaterialRepository->SearchForIdenticalId($materialType);

        $form->add('typeOfSelectMaterial', EntityType::class,
            ['class' => TypeOfSelectMaterial::class,
                'choice_label' => 'title',
                'placeholder' => 'Пожалуйста выберите вид материала',
                'disabled' => $materialType === null,
                'choices' => $type_of_select_materials
            ]);
    }

}