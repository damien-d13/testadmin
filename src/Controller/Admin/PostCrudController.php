<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;


class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Post')
            ->setEntityLabelInPlural('Posts')
            ;
    }

    public function configureFields(string $pageName): iterable
    {

            $id = IdField::new('id')->onlyOnIndex();
            $name = TextField::new('name');
            $slug = TextField::new('slug');
            $content = TextEditorField::new('content');
            $category = AssociationField::new('category');
            $tags = AssociationField::new('tags');
            $createdAt = DateTimeField::new('created_at')->onlyOnIndex();
            $updatedAt = DateTimeField::new('updated_at')->onlyOnIndex();

         if (Crud::PAGE_INDEX === $pageName) {
             return [$id, $name, $slug, $content, $category, $createdAt->setFormat('short', 'short'), $updatedAt->setFormat('short', 'short'), $tags];
         }

        return [
            FormField::addPanel('Basic information'),
            $name, $content, $category->autocomplete(),
            FormField::addPanel('Product Details'),
             $createdAt, $updatedAt,
            FormField::addPanel(),
            $tags,

        ];
    }

}
