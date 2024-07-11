<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $mappingsParams = $this->getParameter('vich_uploader.mappings');
        $moviesImagePath = $mappingsParams['movies']['uri_prefix'];

        yield TextField::new('name', "Nom du film");
        yield DateField::new('releaseDate', "Date de sortie");
        yield TimeField::new('duration', "Durée");
        yield TextEditorField::new('synopsis', "Synopsis");
        yield TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();
        yield ImageField::new('imageName', "Affiche")->setBasePath($moviesImagePath)->hideOnForm();
        yield AssociationField::new('directors', "Réalisateur(s)");
        yield AssociationField::new('genres', "Genre(s)");
    }
}
