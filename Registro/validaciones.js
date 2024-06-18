$(document).ready(function() {
    // Método personalizado para verificar que la contraseña coincida con la confirmación
    $.validator.addMethod("equalPass", function(value, element, param) {
        return $(param).val() === value;
    }, "Las contraseñas no coinciden.");

    // Método personalizado para validar el formato del nombre de usuario
    $.validator.addMethod("validarUsuario", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9_]+$/.test(value);
    }, "El nombre de usuario solo puede contener letras, números y guiones bajos.");

    // Método personalizado para validar que al menos una letra esté presente en la contraseña
    $.validator.addMethod("contieneLetra", function(value, element) {
        return this.optional(element) || /[a-zA-Z]/.test(value);
    }, "La contraseña debe contener al menos una letra.");

    // Método personalizado para validar que al menos un número esté presente en la contraseña
    $.validator.addMethod("contieneNumero", function(value, element) {
        return this.optional(element) || /[0-9]/.test(value);
    }, "La contraseña debe contener al menos un número.");

    // Método personalizado para validar que no haya caracteres especiales en el nombre de usuario
    $.validator.addMethod("sinCaracteresEspeciales", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9ñÑ ]*$/.test(value);
    }, "El usuario no puede contener caracteres especiales.");

    // Método personalizado para validar el formato de la contraseña
    $.validator.addMethod("formatoClave", function(value, element) {
        return this.optional(element) ||
            /[A-Z]/.test(value) && /[a-z]/.test(value) && /\d/.test(value) && /[@$!%*?&]/.test(value);
    }, "La contraseña debe contener:  mayúsculas,  minúsculas, números y un carácter especial.");

    // Configuración de validación del formulario
    $("#formularioRegistro").validate({
        rules: {
            nombre: {
                required: true,
                maxlength: 255
            },
            apellidos: {
                required: true,
                maxlength: 255
            },
            usuario: {
                required: true,
                maxlength: 50,
                validarUsuario: true,
                sinCaracteresEspeciales: true
            },
            contra: {
                required: true,
                minlength: 8,
                contieneLetra: true,
                contieneNumero: true,
                formatoClave: true
            },
            "contra-confirm": {
                required: true,
                minlength: 8,
                equalPass: "#contra"
            },
            rol: {
                required: "#rol:checked" // Solo requerido si el checkbox está marcado
            }
        },
        messages: {
            nombre: {
                required: "Por favor, ingrese su nombre.",
                maxlength: "El nombre no puede superar los 255 caracteres."
            },
            apellidos: {
                required: "Por favor, ingrese sus apellidos.",
                maxlength: "El nombre no puede superar los 255 caracteres."
            },
            usuario: {
                required: "Por favor, ingrese un nombre de usuario.",
                maxlength: "El usuario no puede superar los 50 caracteres.",
                validarUsuario: "El nombre de usuario solo puede contener letras, números y guiones bajos.",
                sinCaracteresEspeciales: "El usuario no puede contener caracteres especiales."
            },
            contra: {
                required: "Por favor, ingrese una contraseña.",
                minlength: "La contraseña debe tener al menos 8 caracteres.",
                contieneLetra: "La contraseña debe contener al menos una letra.",
                contieneNumero: "La contraseña debe contener al menos un número.",
                formatoClave: "La contraseña debe contener: letras mayúsculas, letras minúsculas, números y un carácter especial."
            },
            "contra-confirm": {
                required: "Por favor, confirme su contraseña.",
                minlength: "La contraseña debe tener al menos 8 caracteres.",
                equalPass: "Las contraseñas no coinciden."
            },
            rol: {
                required: "Seleccione esta casilla si el usuario es un administrador."
            }
        },
        errorElement: "div", // Elemento para mostrar mensajes de error
        errorPlacement: function(error, element) {
            // Personalizar la ubicación de los mensajes de error
            if (element.attr("type") === "checkbox") {
                error.insertAfter(element.parent()); // Insertar después del checkbox
            } else {
                error.insertAfter(element); // Insertar después del elemento
            }
        }
    });
});
