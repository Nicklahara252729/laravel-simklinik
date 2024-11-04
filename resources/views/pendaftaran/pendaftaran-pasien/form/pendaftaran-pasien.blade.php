<form class="mx-auto mw-600px w-100" id="form-pendaftaran-pasien">
    <div class="form-stepper">
        @include(customForm('pendaftaran', 'pendaftaran-pasien', 'step', 'step-1'))
        @include(customForm('pendaftaran', 'pendaftaran-pasien', 'step', 'step-2'))
        @include(customForm('pendaftaran', 'pendaftaran-pasien', 'step', 'step-3'))
        @include(customForm('pendaftaran', 'pendaftaran-pasien', 'step', 'step-4'))
        @include(customForm('pendaftaran', 'pendaftaran-pasien', 'step', 'step-5'))
        @include(customForm('pendaftaran', 'pendaftaran-pasien', 'step', 'step-button'))
    </div>
</form>