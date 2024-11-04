"use strict";

// Class definition
var KTCreateAccount = function () {
   var stepper;
   var form;
   var formSubmitButton;
   var formContinueButton;
   var stepperObj;
   var validations = [];

   // Private Functions
   var initStepper = function () {
      // Initialize Stepper
      stepperObj = new KTStepper(stepper);

      // Stepper change event
      stepperObj.on('kt.stepper.changed', function (stepper) {
         if (stepperObj.getCurrentStepIndex() === 6) {
            formSubmitButton.classList.remove('d-none');
            formSubmitButton.classList.add('d-inline-block');
            formContinueButton.classList.add('d-none');
         } else if (stepperObj.getCurrentStepIndex() >= 4 && stepperObj.getCurrentStepIndex() < 7) {
            formSubmitButton.classList.remove('d-inline-block');
            formSubmitButton.classList.remove('d-none');
            formContinueButton.classList.remove('d-none');
         }
         else {
            formSubmitButton.classList.add('d-none');
            formContinueButton.classList.add('d-none');
         }
      });

      // 3 step radion button 
      function addRadioChangeEventListener(radioButtons) {
         radioButtons.forEach(function (radioButton) {
            radioButton.addEventListener('change', function () {
               stepperObj.goNext();
            });
         });
      }

      var radioButtonJenisLayanan = document.querySelectorAll('input[name="jenis_layanan"]');
      var radioButtonJenisPasien = document.querySelectorAll('input[name="jenis-pasien"]');
      var radioButtonJenisPelayanan = document.querySelectorAll('input[name="jenis_pelayanan"]');

      addRadioChangeEventListener(radioButtonJenisLayanan);
      addRadioChangeEventListener(radioButtonJenisPasien);
      addRadioChangeEventListener(radioButtonJenisPelayanan);

      function resetRadioButtons(radioButtons) {
         radioButtons.forEach(function (radioButton) {
            radioButton.checked = false;
         });
      }

      // Prev event
      stepperObj.on('kt.stepper.previous', function (stepper) {
         stepper.goPrevious();
         KTUtil.scrollTop();

         const currentStepIndex = stepperObj.getCurrentStepIndex()
         if (currentStepIndex === 1) {
            resetRadioButtons(radioButtonJenisLayanan);
            resetFormElements(form);
         }
         else if (currentStepIndex === 2) {
            resetRadioButtons(radioButtonJenisPasien);
         }
         else if (currentStepIndex === 3) {
            resetRadioButtons(radioButtonJenisPelayanan);
         }
      });

      // next event
      stepperObj.on('kt.stepper.next', function (stepper) {
         if (validateFormStepOne()) {
            stepperObj.goNext();
         }
      });

      var backButton = document.getElementById('back-to-start');
      backButton.addEventListener('click', function () {
         // Reset the values of the radio buttons
         resetRadioButtons(radioButtonJenisLayanan);
         resetRadioButtons(radioButtonJenisPasien);
         resetRadioButtons(radioButtonJenisPelayanan);

         // Reset all form elements inside the stepper
         resetFormElements(form);

         stepperObj.goTo(1);

         formSubmitButton.classList.add('d-none');
         formContinueButton.classList.add('d-none');
      });

      function resetFormElements(form) {
         try {
            var formElements = form.elements;

            for (var i = 0; i < formElements.length; i++) {
               var element = formElements[i];

               switch (element.type) {
                  case 'text':
                  case 'textarea':
                  case 'email':
                  case 'password':
                     element.value = '';
                     break;
                  case 'select-one':
                     // Reset the select element to its default state
                     element.selectedIndex = 0;
                     // Trigger the change event for Select2 (if used)
                     if (element.getAttribute('data-control') === 'select2') {
                        $(element).trigger('change');
                     }
                     break;
                  case 'select-multiple':
                     break;
                  case 'radio':
                  case 'checkbox':
                     element.checked = false;
                     break;
               }
            }

            validations.forEach(function (validator) {
               if (validator) {
                  validator.resetForm();
               }
            });
         } catch (error) {
            console.error(error);
            throw error
         }
      }

   }

   var validateFormStepOne = function () {
      try {
         var requiredFields = [
            'nama_pasien',
            'tgl_lahir',
            'no_ktp',
            'gender',
            'golongan_darah',
            'no_hp_1',
            'alamat',
         ];
         var isFormValid = true;

         requiredFields.forEach(function (fieldName) {
            var fieldValue = document.getElementById(fieldName).value.trim();
            var messageElement = document.getElementById(fieldName + '_message');

            if (fieldValue === '') {
               messageElement.textContent = 'Kolom ini tidak boleh kosong.';
               isFormValid = false;
            } else {
               messageElement.textContent = '';
            }
         });

         return isFormValid;

      } catch (error) {
         console.error(error);
         throw error
      }
   };

   return {
      // Public Functions
      init: function () {
         // Element
         stepper = document.querySelector('#kt_create_account_stepper');

         form = stepper.querySelector('#form-pendaftaran-pasien');
         formSubmitButton = stepper.querySelector('[data-kt-stepper-action="submit"]');
         formContinueButton = stepper.querySelector('[data-kt-stepper-action="next"]');
         initStepper();
      }
   };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
   KTCreateAccount.init();
});
