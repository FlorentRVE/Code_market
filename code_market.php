<?php

////////////// Exemple de query builder dans une formtype //////////////////
$builder
    ->add('categorie', EntityType::class, [
        'class' => Categorie::class,
        'choice_label' => 'label',
        'placeholder' => '== Choisissez une catégorie ==',
        'required' => true,
        'label' => 'Category',
        'query_builder' => function (CategorieRepository $cr) {

            $user = $this->security->getUser()->getUserIdentifier();

            return $cr->getCategoriesViaUserDepartement($user);
            
        },
        'group_by' => function (?Categorie $categorie) {
            return $categorie ? $categorie->getDepartement()->getLabel() : '';
        }
    ])
;

/////////////// Exemple de requête DQL //////////////////
public function getQuestionsFromSearch($searchTerm) {

    return $this->createQueryBuilder('d')

    ->select('q, c, d')
    ->innerJoin('d.categories', 'c')
    ->innerJoin('c.questions', 'q')
    ->where(':searchTerm = \'\' OR 
            q.label LIKE :searchTerm OR 
            q.reponse LIKE :searchTerm')
    ->setParameter('searchTerm', '%'.$searchTerm.'%')
    ->getQuery()
    ->getResult();
}

 //////////// Barre de recherche TWIG //////////////////
<form action="#" method="get" class="p-4 shadow-lg text-lg text-center">
    <label for="search" class="text-slate-100 font-semibold">Rechercher </label>
    <input type="text" id="search" name="search" value="{{ searchTerm }}" class="w-1/2 text-slate-900 px-2 rounded-lg" placeholder="Rechercher dans les questions ou réponses ...">
    <button type="submit" class="text-center px-4 py-1 hover:brightness-125 text-slate-50 text-2xl transition-all hover:scale-110"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>

//////////// Exemple message flash TWIG /////////////////
{% for message in app.flashes('success') %}

    <div class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative font-bold" role="alert">
        <span class="block text-center text-xl">{{ message }}</span>
        <span class="close absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
{% endfor %}

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