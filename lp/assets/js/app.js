$(document).ready(function () {

  function showMessage(message, type) {
    var messageContainer = $('#message');
    
    var messageType = type === 'error' ? 'danger' : 'success';
    
    messageContainer.removeClass('success error bg-success bg-danger')
      .addClass(messageType + ' col-12 text-center bg-' + messageType + ' text-white fs-5 py-3 px-2 rounded show mt-4')
      .text(message);
  }
  
  
  
  // Validación de formulario con jQuery Validator
  $('#register-form').validate({
    rules: {
      name: {
        required: true,
        minlength: 3,
        maxlength: 50,
      },
      doc_type: {
        required: true,
      },
      doc_number: {
        required: true,
        minlength: function () {
          return $('#doc_type').val() === 'dni' ? 8 : 8;
        },
        maxlength: function () {
          return $('#doc_type').val() === 'dni' ? 8 : 12;
        },
        digits: true,
      },
    },
    messages: {
      name: {
        required: 'Por favor ingrese su nombre completo.',
        minlength: 'Por favor ingrese al menos 10 caracteres.',
        maxlength: 'Por favor ingrese máximo 50 caracteres.',
      },
      doc_type: {
        required: 'Por favor seleccione un tipo de documento.',
      },
      doc_number: {
        required: 'Por favor ingrese su número de documento.',
        minlength: function () {
          return $('#doc_type').val() === 'dni' ? 'Por favor ingrese un número de DNI válido.' : 'Por favor ingrese un número de carnet de extranjería válido.';
        },
        maxlength: function () {
          return $('#doc_type').val() === 'dni' ? 'Por favor ingrese un número de DNI válido.' : 'Por favor ingrese un número de carnet de extranjería válido.';
        },
        digits: 'Por favor ingrese solo números.',
        remote: 'El nro. de documento ya ha sido registrado anteriormente.',
      },
    },
    errorPlacement: function (error, element) {
      if (element.attr('name') == 'doc_type') {
        error.addClass('text-danger');
        error.appendTo($('#doc_type'));
      } else {
        error.addClass('col-12');
        error.addClass('text-danger');
        error.insertAfter(element);
      }
    },
    
    submitHandler: function(form) {
      $.ajax({
        url: 'app/registro.php',
        type: 'POST',
        data: $('#register-form').serialize(),
        dataType: 'json',
        success: function(response) {
          $('#register-form')[0].reset();
          showMessage(response.success, 'success');
          $('#doc_number').prop('disabled', true);
          bgicon.removeClass('bg-white').addClass('bg-disabled');
          toggleSubmitBtn();
        },
        error: function(response) {
          var errorMessage = JSON.parse(response.responseText).error;
          showMessage(errorMessage, 'error');
        }        
      });
    }
  });

  // Deshabilitar campo doc_number hasta que se seleccione un tipo de documento

  var bgicon = $('#bg-icon');

  $('#doc_number').prop('disabled', true);

  $('#doc_type').change(function () {
    if ($(this).val() == '') {
      $('#doc_number').prop('disabled', true);
      bgicon.removeClass('bg-white').addClass('bg-disabled');
    } else {
      $('#doc_number').prop('disabled', false);
      bgicon.removeClass('bg-disabled').addClass('bg-white');
    }
  });

  const checkboxes = document.querySelectorAll('.form-check-input');
  const submitBtn = document.querySelector('#submit-btn');
  
  function toggleSubmitBtn() {
    let allChecked = true;
    checkboxes.forEach((checkbox) => {
      if (!checkbox.checked) {
        allChecked = false;
      }
    });
    submitBtn.disabled = !allChecked;
  }
  
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', toggleSubmitBtn);
  });
});



  