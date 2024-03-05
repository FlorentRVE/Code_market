<?php

Prérequis:
composer require symfony/stimulus-bundle
composer require symfony/ux-toggle-password

////////////// CONTROLLER EDIT PASSWORD //////////////////////

#[Route('/{id}/edit_password', name: 'app_userPassword_edit', methods: ['GET', 'POST'])]
public function editPassword(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
{
    $form = $this->createForm(MotDePasseType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            )
        );
        $entityManager->flush();

        $this->addFlash('success', 'Mot de passe mis à jour');

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('user/motDePasse.html.twig', [
        'user' => $user,
        'form' => $form,
    ]);
}

/////////////////// TEMPLATE TWIG PASSWORD /////////////////

{% extends 'base.html.twig' %}

{% block title %}Modifier le mot de passe de l'utilisateur{% endblock %}

{% block body %}
    <div class="bg-sky-200 min-h-screen">

        <div class="flex flex-col p-4 justify-center items-center bg-slate-50">

            <h1 class="text-3xl font-semibold text-center">Modifier le mot de passe</h1>

        </div>

        <div class="bg-slate-800 p-7 mx-auto my-6 rounded-xl w-4/5 shadow-xl">


            <div class="w-11/12 mx-auto flex flex-col">
                
                {{ form_start(form) }}

                    <div class="mb-8 flex flex-col">
                        {{ form_label(form.plainPassword.first, 'Mot de passe', {'label_attr': {'class': 'text-slate-100 uppercase font-semibold mb-2'}}) }}
                        {{ form_widget(form.plainPassword.first, {'attr': {'class': 'p-2 rounded-lg'}}) }}

                        <div class="text-red-500 font-semibold mb-2">
                            {{ form_errors(form.plainPassword.first) }}
                        </div>
                    </div>

                    <div class="mb-8 flex flex-col">
                        {{ form_label(form.plainPassword.second, 'Confirmation du mot de passe', {'label_attr': {'class': 'text-slate-100 uppercase font-semibold mb-2'}}) }}
                        {{ form_widget(form.plainPassword.second, {'attr': {'class': 'p-2 rounded-lg'}}) }}
                    </div>

                    <div class="flex flex-col">
                        <button type="submit" class="w-full btn bg-green-500 rounded-2xl text-center hover:brightness-125 shadow-lg font-bold px-7 py-3 text-lg md:w-1/3 md:self-end">{{ button_label|default('Modifier le mot de passe') }}</button>
                    </div>
                    
                {{ form_end(form) }}
            </div>
        </div>

        <div class="flex flex-col w-4/5 mx-auto">

            <a href="{{ path('app_user_index') }}"  class="w-full bg-sky-800 text-slate-50 rounded-2xl text-center px-5 py-3 hover:brightness-125 shadow-lg font-semibold md:w-1/3">Retour à la liste</a>
        </div>
    </div>
/{% endblock %}

/////////// PASSWORD FORM TYPE //////////

<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class MotDePasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'mapped' => false,
            'invalid_message' => 'Les mots de passe ne sont pas identiques',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options' => [
                'label' => 'Mot de passe',
                'toggle' => true,
                'hidden_label' => 'Masquer',
                'visible_label' => 'Afficher',
                'use_toggle_form_theme' => false,
                'button_classes' => ['text-slate-50', 'flex', 'justify-end', 'items-center', 'mt-3'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit avoir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ],
            'second_options' => [
                'label' => 'Confirmer le mot de passe',
                'toggle' => true,
                'hidden_label' => 'Masquer',
                'visible_label' => 'Afficher',
                'use_toggle_form_theme' => false,
                'button_classes' => ['text-slate-50', 'flex', 'justify-end', 'items-center', 'mt-3'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit avoir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
