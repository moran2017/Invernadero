/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES (Spanish; Español)
 */
(function ($) {
	$.extend($.validator.messages, {
		required: "Campo obligatorio.",
		remote: "Rellenar este campo.",
		email: "Dirección de correo no válida",
		url: "URL no válida.",
		date: "Fecha no válida.",
		dateISO: "Por favor, escribe una fecha (ISO) válida.",
		number: "Número entero no válido.",
		digits: "Escribir sólo dígitos.",
		creditcard: "Número de tarjeta no válido.",
		equalTo: "Por favor, escribe el mismo valor de nuevo.",
		accept: "Por favor, escribe un valor con una extensión aceptada.",
		maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
		minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
		rangelength: $.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
		range: $.validator.format("Por favor, escribe un valor entre {0} y {1}."),
		max: $.validator.format("Por favor, escribe un valor menor o igual a {0}."),
		min: $.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
	});
}(jQuery));