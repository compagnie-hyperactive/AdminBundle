<?php
/**
 * Created by PhpStorm.
 * User: Benoit
 * Date: 02/05/2017
 * Time: 16:18
 */

namespace Lch\AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BreadcrumbItemType extends AbstractType
{
    const NAME = 'lch_admin_breadcrumb_item_type';
    const ROOT_TRANSLATION_PATH = "lch.admin.breadcrumb_item.form.fields";


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name', TextType::class,
                [
                    'label' => static::ROOT_TRANSLATION_PATH.'.name.label',
                    'attr' => [
                        'helper' => static::ROOT_TRANSLATION_PATH.'.name.helper',
                    ]
                ]
            )
            ->add(
                'link', UrlType::class,
                [
                    'label' => static::ROOT_TRANSLATION_PATH.'.link.label',
                    'attr' => [
                        'helper' => static::ROOT_TRANSLATION_PATH.'.link.helper',
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Lch\AdminBundle\Entity\BreadcrumbItem'
        ]);
    }

    public function getName()
    {
        return self::NAME;
    }
}