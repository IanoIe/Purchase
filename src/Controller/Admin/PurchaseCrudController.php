<?php

namespace App\Controller\Admin;

use App\Entity\Purchase;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PurchaseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Purchase::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('store_name')->setLabel('Store Name');
        yield TextField::new('product_name')->setLabel('Product Name');
        yield NumberField::new('unit_price')->setLabel('Unit Price')->setNumDecimals(2);
        yield NumberField::new('quantity')->setLabel('Quantity');
        yield NumberField::new('total_price')->setLabel('Total Price')->setNumDecimals(2);
        yield DateTimeField::new('date')->setLabel('Purchase Date')->setFormat('dd/MM/yyyy HH:mm');

    }
}
