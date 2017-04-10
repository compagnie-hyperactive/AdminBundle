<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 10/04/17
 * Time: 15:57
 */

namespace Lch\AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Select2Type extends AbstractType
{
    const PLACEHOLDER = 'placeholder';
    const DEFAULT_PLACEHOLDER = 'lch.admin.select2.placeholder';
    const MINIMUM_INPUT_LENGTH = 'minimum_input_length';
    const SELECT2_CLASS = 'select2_class';
    const AJAX = 'ajax';


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // TODO check options and raise exceptions if necessary
//        // Handle placeholder
//        $builder->setAttribute(self::PLACEHOLDER, $options[self::PLACEHOLDER] !== null ? $options[self::PLACEHOLDER] : self::DEFAULT_PLACEHOLDER);
//
//        if($options[self::AJAX] !== false) {
//            $promotionCode = $options[self::AJAX]['parent_object'];
//            if($promotionCode instanceof PromotionCode && $promotionCode->getId() !== null) {
//                $propertyAccessor = PropertyAccess::createPropertyAccessor();
//                $builder->setAttribute('query_builder', function (EntityRepository $er) use ($promotionCode) {
//                    return $er->createQueryBuilder('u')
//                        ->where('u IN (:users)')
//                        ->setParameter('users', $promotionCode->getUsers())
//                    ;
//                });
//            } else {
//
//            }
//        }
//        // Add listener for AJAX case
//        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($builder) {
//            $form = $event->getForm();
//            $parentForm = $form->getParent();
//            $parentObject = $parentForm->getData();
//
//            $formOptions = $form->getConfig()->getOptions();
//
//            // If parent object already persisted and AJAX activated
//            //  - set choices with selected data
//            if($parentObject->getId() !== null && $formOptions[self::AJAX] && !$formOptions[self::STOP_PROPAGATION]) {
//                $propertyAccessor = PropertyAccess::createPropertyAccessor();
//
//                $items = new ArrayCollection();
//                foreach($propertyAccessor->getValue($parentObject, $form->getName()) as $item) {
//                    $items->add($item);
//                }
//                dump(array_replace(
//                    $formOptions,
//                    [
//                        'placeholder' => 'test',
//                        'choices' => $items,
//                        self::STOP_PROPAGATION => true
//                    ]
//                ));
//
//                $parentForm->add($form->getName(),
//                    Select2Type::class,
//                    array_replace(
//                        $formOptions,
//                        [
//                            'placeholder' => 'test',
//                            'query_builder' => function (EntityRepository $er) use ($items) {
//                                return $er->createQueryBuilder('o')
//                                    ->where('o IN (:items)')
//                                    ->setParameter('items', $items)
//                                ;
//                            },
//                            self::STOP_PROPAGATION => true
//                        ]
//                    )
//                );
//            }
//        });
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
//        // Add placeholder
//        if(!isset($options[self::PLACEHOLDER])) {
//            $view->vars[self::PLACEHOLDER] .= self::DEFAULT_PLACEHOLDER;
//        }
        $view->vars[self::PLACEHOLDER] = $form->getConfig()->getAttribute(self::PLACEHOLDER);

        // Add select2 class
        if(isset($view->vars['attr']['class'])) {
            $view->vars['attr']['class'] .= $options[self::SELECT2_CLASS];
        } else {
            $view->vars['attr']['class'] = $options[self::SELECT2_CLASS];
        }

        // Handle AJAX
        if(isset($options[self::AJAX]) && is_array($options[self::AJAX])) {
            $view->vars[self::AJAX] = $options[self::AJAX];
        }

        // Handle minimal input length
        if($options[self::MINIMUM_INPUT_LENGTH]) {
            $view->vars[self::MINIMUM_INPUT_LENGTH] = $options[self::MINIMUM_INPUT_LENGTH];
        }


        parent::buildView($view, $form, $options);
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            self::SELECT2_CLASS => 'select2',
            self::AJAX => false,
            self::MINIMUM_INPUT_LENGTH => false,
        ));
    }


    /**
     * @return string the prefix used on template fragment
     */
    public function getBlockPrefix()
    {
        return 'lch_admin_select2';
    }


    public function getName()
    {
        return 'lch_admin_select2';
    }

    /**
     * @return mixed the parent type
     */
    public function getParent()
    {
        return EntityType::class;
    }
}
