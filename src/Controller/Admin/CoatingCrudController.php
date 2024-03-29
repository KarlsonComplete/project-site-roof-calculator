<?php

namespace App\Controller\Admin;

use App\Entity\Coating;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CoatingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coating::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
