<?php

namespace App\Controller\Admin;

use App\Entity\MaterialType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class MaterialTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MaterialType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Coating MaterialType')
            ->setEntityLabelInPlural('Coating MaterialTypes')
            ->setSearchFields(['title']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('coating'));
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('coating');
        yield TextField::new('title');
    }

}
