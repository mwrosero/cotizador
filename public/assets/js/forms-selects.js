/**
 * Selects & Tags
 */

'use strict';

$(function () {
  const selectPicker = $('.selectpicker'),
    select2 = $('.select2'),
    select2Icons = $('.select2-icons');

  // Bootstrap Select
  // --------------------------------------------------------------------
  if (selectPicker.length) {
    selectPicker.selectpicker();
  }

  // Select2
  // --------------------------------------------------------------------

  // Default
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      var closeOnSelect = 'true';
      if($(this).attr("id") == "localidad"){
        closeOnSelect = false;
      }

      $this.wrap('<div class="position-relative"></div>').select2({
        placeholder: 'Selecciona una opción',
        dropdownParent: $this.parent(),
        language: 'es',
        closeOnSelect: closeOnSelect,
        //templateResult: formatOption,
        allowClear: true,
        tags: true
      });
    
    });
  }

  function formatOption(option) {
    // Verifica si el select actual tiene la clase 'miSelectEspecial'
    // Obtén la información del elemento actual
    console.log(option)
    var $element = $(option.element);

    // Verifica si el select actual tiene la clase 'miSelectEspecial'
    if ($element.hasClass('localidad-item')) {
      console.log(0)
      if (!option.id) {
        console.log(1)
        return option.text;
      }
      console.log(2)

      // Crea un elemento de opción personalizado con checkbox
      var $option = $(
        '<span><input type="checkbox" class="select2-checkbox" />' + option.text + '</span>'
      );

      // Sincroniza el estado del checkbox con la selección/deselección del texto
      $option.find('.select2-checkbox').prop('checked', option.selected);

      // Maneja el cambio de estado del checkbox
      $option.find('.select2-checkbox').on('change', function() {
        // Sincroniza el estado del texto con la selección/deselección del checkbox
        $element.prop('selected', $(this).prop('checked')).trigger('change');
      });

      return $option;
    } else {
      // Si no es el select especial, utiliza el formato por defecto
      console.log(3)
      return option.text;
    }
  }

  // Select2 Icons
  if (select2Icons.length) {
    // custom template to render icons
    function renderIcons(option) {
      if (!option.id) {
        return option.text;
      }
      var $icon = "<i class='" + $(option.element).data('icon') + " me-2'></i>" + option.text;

      return $icon;
    }
    select2Icons.wrap('<div class="position-relative"></div>').select2({
      templateResult: renderIcons,
      templateSelection: renderIcons,
      escapeMarkup: function (es) {
        return es;
      },
      language: 'es'
    });
  }
});
