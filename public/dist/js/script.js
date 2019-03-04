  /* Formulaire */

  $('#newsletter').on('submit', function () {

      if ($('#email').val().length < 5) {
          $('.error').slideDown('slow');
          return false;

      }

      return true;

  });