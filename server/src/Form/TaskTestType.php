<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\TaskTest;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class TaskTestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('task', EntityType::class, [
                'label' => 'Task',
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'class' => Task::class,
                'choice_value' => 'id',
                'choice_label' => 'name'
            ])
            ->add('tests', FileType::class, [
                'mapped' => false,
                'required' => true,
                'attr' => ['class' => 'form-control', 'accept' => ".zip"],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/zip',
                        ],
                    ])
                ]
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TaskTest::class,
        ]);
    }
}
