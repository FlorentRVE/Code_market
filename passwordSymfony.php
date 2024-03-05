/////////// Exemple gestion mot de passe double avec toggle TWIG //////////
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
