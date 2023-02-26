<?php

namespace App\Controller\Admin;

use App\Entity\TypeOfSelectMaterial;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class TypeOfSelectMaterialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeOfSelectMaterial::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('MaterialType TypeOfSelectMaterial')
            ->setEntityLabelInPlural('MaterialType TypeOfSelectMaterials')
            ->setSearchFields(['title']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('materialType'));
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('materialType');
        yield TextField::new('title');
    }

}
