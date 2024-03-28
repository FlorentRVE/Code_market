<?php 

// =============== EXEMPLE INCLUDE ============
{{ include('component/_sidebar.html.twig') }}

// =============== SIDEBAR ====================
<sidebar class="bg-cyan-950 fixed left-0 top-0 h-screen rounded-tr-3xl">
        <div class="flex flex-col items-center w-[20vw]">

            <a href="{{ path('app_accueil') }}">
                <img src="{{ asset('img/logo_clair.png') }}" alt="logo" class="w-[15vw] mt-8">
            </a>

            <div class="w-[60%] mx-auto h-[2px] bg-slate-50 rounded-xl my-10"></div>

            <div class="flex flex-col items-center gap-3 pt-4 font-semibold text-[1.5vh] lg:text-[2vh]">
                <a href="{{ path('app_accueil_admin') }}" class="text-slate-50 text-center hover:bg-sky-800 mb-5 px-2 py-1 rounded-lg w-full">Gestion formulaire</a>
                <a href="{{ path('app_user_index') }}" class="text-slate-50 text-center hover:bg-sky-800 mb-5 px-2 py-1 rounded-lg w-full h-auto">Gestion utilisateurs</a>
                <a href="{{ path('app_service_index') }}" class="text-slate-50 text-center hover:bg-sky-800 mb-5 px-3 py-1 rounded-lg w-full h-auto">Gestion services</a>


                <a href="{{ path('app_logout') }}"  class="flex flex-col text-center transition-all hover:scale-105 p-6 text-slate-50">
                    <p class="font-semibold">Se déconnecter</p>
                    <i class="fa-solid fa-right-to-bracket text-slate-50 text-2xl text-center font-semibold"></i>
                </a>
            </div>
          
        </div>
    </sidebar>

// =============== FORM ====================
    <div class="bg-slate-800 p-7 mx-auto my-6 rounded-xl w-4/5 shadow-xl">
        <div class="w-11/12 mx-auto flex flex-col">     
          
            {{ form_start(form) }}
                <div class="mb-8 flex flex-col">
                    {{ form_label(form.label, 'Label', {'label_attr': {'class': 'text-slate-100 uppercase font-semibold mb-2'}}) }}
                    {{ form_widget(form.label, {'attr': {'class': 'p-2 rounded-lg'}}) }}
                </div>

                <div class="mb-8 flex flex-col">
                    {{ form_label(form.emailSecretariat, 'Email Secretariat', {'label_attr': {'class': 'text-slate-100 uppercase font-semibold mb-2'}}) }}
                    {{ form_widget(form.emailSecretariat, {'attr': {'class': 'p-2 rounded-lg'}}) }}
                </div>

                <div class="mb-8 flex flex-col">
                    {{ form_label(form.emailResponsable, 'Email Responsable', {'label_attr': {'class': 'text-slate-100 uppercase font-semibold mb-2'}}) }}
                    {{ form_widget(form.emailResponsable, {'attr': {'class': 'p-2 rounded-lg'}}) }}
                </div>

                {{ form_errors(form, {'class': 'text-red-600 uppercase font-semibold mb-2'}) }}
          
                <div class="flex flex-col">
                    <button type="submit" class="w-full btn bg-green-500 rounded-2xl text-center hover:brightness-125 shadow-lg font-bold px-7 py-3 text-lg md:w-1/3 md:self-end">{{ button_label|default('Modifier le service') }}</button>
                </div>
            {{ form_end(form) }}
          
        </div>
    </div>
