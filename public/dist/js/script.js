  /* Formulaire */

  $('#newsletter').on('submit', function () {

      if ($('#firstname').val().length < 5) {
          $('.error').slideDown('slow');
          return false;

      } else if ($('#lastname').val().length < 5) {
          $('.error').slideDown('slow');
          return false;

      } else if ($('#email').val().length < 5) {
          $('.error').slideDown('slow');
          return false;

      }

      return true;

  });