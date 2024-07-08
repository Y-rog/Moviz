<?php

namespace App\Controller\Admin;

use App\Entity\Review;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReviewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Review::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        //Utilisation de la méthode parente pour récupérer les champs de la classe mère
        yield from parent::configureFields($pageName);

        //On override jsute le champ dont on a besoin
        yield ChoiceField::new('rate', 'Note')
            ->setChoices(fn() => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
            ])->renderExpanded(true);

        yield AssociationField::new('user', 'Utilisateur');
        yield AssociationField::new('movie', 'Film');
    }
    
}
